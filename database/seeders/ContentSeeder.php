<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    /**
     * Key prefixes that are owned by dedicated models (Post, Service, Faq,
     * Partner, Gallery) and therefore must NOT become editable Content rows.
     */
    protected array $excludedPrefixes = [
        'posts.',
        'svc',
        'process',
        'p1.',
        'p2.',
        'article.body.',
    ];

    /** Map a key's leading segment to a friendly page label for the admin UI. */
    protected array $pageMap = [
        'top' => 'Global', 'nav' => 'Global', 'logo' => 'Global', 'c' => 'Global',
        'home' => 'Home', 'stat1' => 'Home', 'stat2' => 'Home', 'stat3' => 'Home', 'stat4' => 'Home',
        'svc1' => 'Home', 'svc2' => 'Home', 'svc3' => 'Home',
        'pi1' => 'Home', 'pi2' => 'Home', 'pi3' => 'Home', 'pi4' => 'Home',
        'about' => 'About', 'val1' => 'About', 'val2' => 'About', 'val3' => 'About', 'val4' => 'About',
        'tm1' => 'About', 'tm2' => 'About', 'tm3' => 'About', 'tm4' => 'About',
        'services' => 'Services', 'process1' => 'Services', 'process2' => 'Services',
        'process3' => 'Services', 'process4' => 'Services',
        'partners' => 'Partners', 'gallery' => 'Gallery', 'faqs' => 'FAQs',
        'blog' => 'Blog', 'article' => 'Article', 'contact' => 'Contact',
    ];

    public function run(): void
    {
        $en = require lang_path('en/front.php');
        $ar = require lang_path('ar/front.php');

        $position = 0;

        foreach ($en as $key => $enValue) {
            if (! is_string($enValue)) {
                continue; // skip the marquee array, etc.
            }

            if (Str::startsWith($key, $this->excludedPrefixes)) {
                continue;
            }

            $segment = Str::before($key, '.');

            Content::updateOrCreate(
                ['group' => 'front', 'key' => $key],
                [
                    'values' => [
                        'en' => $enValue,
                        'ar' => is_string($ar[$key] ?? null) ? $ar[$key] : '',
                    ],
                    'type' => mb_strlen($enValue) > 80 ? 'textarea' : 'text',
                    'page' => $this->pageMap[$segment] ?? Str::headline($segment),
                    'section' => $segment,
                    'position' => $position++,
                ]
            );
        }
    }
}
