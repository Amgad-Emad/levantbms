<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'contact.phone_primary', 'group' => 'contact', 'value' => '+973 36314567'],
            ['key' => 'contact.phone_secondary', 'group' => 'contact', 'value' => ''],
            ['key' => 'contact.email', 'group' => 'contact', 'value' => 'info@levantbms.com'],
            ['key' => 'contact.whatsapp', 'group' => 'contact', 'value' => '97336314567'],
            ['key' => 'contact.map_url', 'group' => 'contact', 'value' => 'https://www.google.com/maps/search/?api=1&query=Bahrain+Financial+Harbour%2C+Manama'],
            ['key' => 'contact.address', 'group' => 'contact', 'value' => 'Suite 2131, Bahrain Financial Harbour, Harbour Gate, 2nd Floor, Building No. 1435, Road No. 4626, Manama, Sea Front 346, P.O. Box: 60855'],
            ['key' => 'social.linkedin', 'group' => 'social', 'value' => ''],
            ['key' => 'social.instagram', 'group' => 'social', 'value' => ''],
            ['key' => 'social.facebook', 'group' => 'social', 'value' => ''],
            ['key' => 'social.x', 'group' => 'social', 'value' => ''],

            // SEO / Organization schema (JSON-LD) — the authority signals.
            ['key' => 'seo.org_legal_name', 'group' => 'seo', 'value' => 'Levant Business Management Services W.L.L.'],
            ['key' => 'seo.founding_year', 'group' => 'seo', 'value' => '2003'],
            ['key' => 'seo.credential_authority', 'group' => 'seo', 'value' => 'Ministry of Industry & Commerce, Kingdom of Bahrain'],
            ['key' => 'seo.license_number', 'group' => 'seo', 'value' => ''],
            ['key' => 'seo.twitter_handle', 'group' => 'seo', 'value' => '@levantbms'],
            ['key' => 'seo.title_suffix', 'group' => 'seo', 'value' => ' | LevantBMS'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
