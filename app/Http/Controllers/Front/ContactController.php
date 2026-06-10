<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Mail\NewLeadMail;
use App\Models\Lead;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /** Minimum seconds a genuine human needs to fill the form. */
    protected int $minSeconds = 3;

    public function store(StoreLeadRequest $request): JsonResponse|RedirectResponse
    {
        // Bot protection: drop silently (pretend success) so bots don't retry.
        if ($this->looksLikeSpam($request)) {
            return $this->acknowledge($request, null);
        }

        $lead = Lead::create([
            ...$request->validated(),
            'status' => 'new',
            'locale' => app()->getLocale(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $this->notify($lead);

        return $this->acknowledge($request, $lead);
    }

    /**
     * Email the new lead to the office inbox. The lead is already persisted,
     * so a mail failure must never break the form — log it and move on.
     */
    protected function notify(Lead $lead): void
    {
        $recipient = Setting::get('contact.lead_recipient')
            ?: Setting::get('contact.email', 'info@levantbms.com');

        try {
            Mail::to($recipient)->send(new NewLeadMail($lead));
        } catch (\Throwable $e) {
            Log::error('Lead notification email failed', [
                'lead_id' => $lead->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Honeypot + signed time-trap. No external service required.
     */
    protected function looksLikeSpam(Request $request): bool
    {
        // 1) Honeypot — a hidden field only bots fill in.
        if (filled($request->input('website'))) {
            return true;
        }

        // 2) Time-trap — the form carries an encrypted render timestamp.
        try {
            $renderedAt = (int) Crypt::decryptString((string) $request->input('_ts'));
        } catch (\Throwable) {
            return true; // missing or forged token
        }

        return (time() - $renderedAt) < $this->minSeconds;
    }

    protected function acknowledge(Request $request, ?Lead $lead): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'id' => $lead?->id], 201);
        }

        return back()->with('status', __('front.contact.success'));
    }
}
