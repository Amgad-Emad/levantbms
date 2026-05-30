<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /** Editable settings schema: key => [label, group, type]. */
    public const SCHEMA = [
        'contact.phone_primary' => ['Primary phone', 'Contact', 'text'],
        'contact.phone_secondary' => ['Secondary phone', 'Contact', 'text'],
        'contact.email' => ['Email address', 'Contact', 'email'],
        'contact.whatsapp' => ['WhatsApp number', 'Contact', 'text'],
        'contact.address' => ['Office address', 'Contact', 'textarea'],
        'contact.map_url' => ['Google Maps URL', 'Contact', 'url'],
        'social.linkedin' => ['LinkedIn URL', 'Social', 'url'],
        'social.instagram' => ['Instagram URL', 'Social', 'url'],
        'social.facebook' => ['Facebook URL', 'Social', 'url'],
        'social.x' => ['X / Twitter URL', 'Social', 'url'],
        'seo.org_legal_name' => ['Legal company name', 'SEO & Schema', 'text'],
        'seo.founding_year' => ['Founding year', 'SEO & Schema', 'text'],
        'seo.credential_authority' => ['Licensing authority', 'SEO & Schema', 'text'],
        'seo.license_number' => ['License number (optional)', 'SEO & Schema', 'text'],
        'seo.twitter_handle' => ['Twitter handle', 'SEO & Schema', 'text'],
        'seo.title_suffix' => ['Title suffix', 'SEO & Schema', 'text'],
    ];

    public function index(): View
    {
        $values = Setting::all()->pluck('value', 'key');

        $groups = collect(self::SCHEMA)
            ->map(fn ($meta, $key) => [
                'key' => $key, 'label' => $meta[0], 'group' => $meta[1], 'type' => $meta[2],
                'value' => $values[$key] ?? '',
            ])
            ->groupBy('group');

        return view('dashboard.settings.index', compact('groups'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'settings' => ['array'],
            'settings.*' => ['nullable', 'string', 'max:2000'],
        ]);

        foreach ($data['settings'] ?? [] as $key => $value) {
            if (! array_key_exists($key, self::SCHEMA)) {
                continue;
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => self::SCHEMA[$key][1]]
            );
        }

        return redirect()->route('dashboard.settings.index')
            ->with('status', 'Settings saved — the website is updated.');
    }
}
