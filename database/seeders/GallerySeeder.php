<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['cat' => 'Office',  'label' => 'Reception, 2nd floor',        'ratio' => '3/4'],
            ['cat' => 'Bahrain', 'label' => 'Financial Harbour, dusk',     'ratio' => '4/3'],
            ['cat' => 'Events',  'label' => 'MOIC seminar, 2024',          'ratio' => '1/1'],
            ['cat' => 'Team',    'label' => 'Senior partners',             'ratio' => '3/4'],
            ['cat' => 'Office',  'label' => 'Boardroom',                   'ratio' => '4/3'],
            ['cat' => 'Bahrain', 'label' => 'Harbour Gate entrance',       'ratio' => '1/1'],
            ['cat' => 'Events',  'label' => 'Client appreciation evening', 'ratio' => '3/4'],
            ['cat' => 'Team',    'label' => 'Consulting floor',            'ratio' => '4/3'],
            ['cat' => 'Bahrain', 'label' => 'Manama skyline',              'ratio' => '1/1'],
        ];

        foreach ($items as $i => $item) {
            GalleryItem::updateOrCreate(
                ['position' => $i],
                [
                    'category' => $item['cat'],
                    'label' => ['en' => $item['label'], 'ar' => ''],
                    'ratio' => $item['ratio'],
                    'is_published' => true,
                ]
            );
        }
    }
}
