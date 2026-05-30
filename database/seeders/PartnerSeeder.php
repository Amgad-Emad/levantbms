<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $en = require lang_path('en/front.php');
        $ar = require lang_path('ar/front.php');

        $partners = [
            ['k' => 'p1', 'services' => 5],
            ['k' => 'p2', 'services' => 4],
        ];

        foreach ($partners as $i => $p) {
            $k = $p['k'];
            $servicesEn = [];
            $servicesAr = [];
            for ($s = 1; $s <= $p['services']; $s++) {
                $servicesEn[] = $en["$k.s$s"] ?? '';
                $servicesAr[] = $ar["$k.s$s"] ?? '';
            }

            Partner::updateOrCreate(
                ['position' => $i],
                [
                    'name' => ['en' => $en["$k.name"] ?? '', 'ar' => $ar["$k.name"] ?? ''],
                    'tag' => ['en' => $en["$k.tag"] ?? '', 'ar' => $ar["$k.tag"] ?? ''],
                    'region' => ['en' => $en["$k.region"] ?? '', 'ar' => $ar["$k.region"] ?? ''],
                    'body' => ['en' => $en["$k.fullBody"] ?? '', 'ar' => $ar["$k.fullBody"] ?? ''],
                    'services' => ['en' => array_filter($servicesEn), 'ar' => array_filter($servicesAr)],
                    'is_published' => true,
                ]
            );
        }
    }
}
