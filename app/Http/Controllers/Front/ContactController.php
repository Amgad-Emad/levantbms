<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

        return $this->acknowledge($request, $lead);
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
