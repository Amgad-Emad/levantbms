<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Translation\ListContent;
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

    /**
     * Exact keys that override $excludedPrefixes — the home page renders these
     * two featured-partner cards from static translations (not the Partner
     * model), so they must stay editable in the CMS.
     */
    protected array $includedKeys = [
        'p1.name', 'p1.tag', 'p1.body',
        'p2.name', 'p2.tag', 'p2.body',
    ];

    /** Override the admin section (card) a key is grouped under. */
    protected array $sectionMap = [
        'p1' => 'featuredPartners',
        'p2' => 'featuredPartners',
    ];

    /** Map a key's leading segment to a friendly page label for the admin UI. */
    protected array $pageMap = [
        'top' => 'Global', 'nav' => 'Global', 'logo' => 'Global', 'c' => 'Global',
        'home' => 'Home', 'stat1' => 'Home', 'stat2' => 'Home', 'stat3' => 'Home', 'stat4' => 'Home',
        'svc1' => 'Home', 'svc2' => 'Home', 'svc3' => 'Home',
        'pi1' => 'Home', 'pi2' => 'Home', 'pi3' => 'Home', 'pi4' => 'Home',
        'p1' => 'Home', 'p2' => 'Home',
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
            if (Str::startsWith($key, $this->excludedPrefixes) && ! in_array($key, $this->includedKeys, true)) {
                continue;
            }

            // List keys (arrays) are editable as one-item-per-line textareas;
            // any other array is owned by code and skipped.
            if (is_array($enValue)) {
                if (! ListContent::isList($key)) {
                    continue;
                }

                $enValue = ListContent::encode($key, $enValue);
                $arValue = is_array($ar[$key] ?? null) ? ListContent::encode($key, $ar[$key]) : '';
                $type = 'textarea';
            } elseif (is_string($enValue)) {
                $arValue = is_string($ar[$key] ?? null) ? $ar[$key] : '';
                $type = mb_strlen($enValue) > 80 ? 'textarea' : 'text';
            } else {
                continue;
            }

            $segment = Str::before($key, '.');

            Content::updateOrCreate(
                ['group' => 'front', 'key' => $key],
                [
                    'values' => ['en' => $enValue, 'ar' => $arValue],
                    'type' => $type,
                    'page' => $this->pageMap[$segment] ?? Str::headline($segment),
                    'section' => $this->sectionMap[$segment] ?? $segment,
                    'position' => $position++,
                ]
            );
        }
    }
}
