<?php

namespace App\View\Composers;

use App\Models\Post;
use App\Models\SeoMeta;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SeoComposer
{
    public function compose(View $view): void
    {
        $data = $view->getData();
        $locale = app()->getLocale();
        $routeName = optional(request()->route())->getName() ?? '';
        $page = str_starts_with($routeName, 'front.') ? substr($routeName, 6) : 'default';

        $default = SeoMeta::forPage('default');
        $meta = SeoMeta::forPage($page) ?? $default;

        // Only the article page passes a real Post model; other views (e.g. home)
        // may carry an unrelated local `$post` (array) in their data.
        $post = ($data['post'] ?? null) instanceof Post ? $data['post'] : null;
        $isArticle = $page === 'article' && $post;

        // Resolve title / description with article + page + default fallbacks.
        $title = $this->pick([
            $isArticle ? ($post->meta_title->get($locale) ?: $post->title->get($locale)) : null,
            $meta?->title?->get($locale),
            $default?->title?->get($locale),
            config('app.name'),
        ]);

        $description = $this->pick([
            $isArticle ? ($post->meta_description->get($locale) ?: $post->excerpt->get($locale)) : null,
            $meta?->description?->get($locale),
            $default?->description?->get($locale),
        ]);

        $suffix = (string) Setting::get('seo.title_suffix', ' | LevantBMS');
        $fullTitle = ($suffix && ! str_contains($title, trim($suffix, ' |'))) ? $title.$suffix : $title;

        $ogImage = ($isArticle ? $post->coverUrl() : null)
            ?? $meta?->ogImageUrl()
            ?? $default?->ogImageUrl();

        $view->with([
            'seoTitle' => $fullTitle,
            'seoRawTitle' => $title,
            'seoDescription' => $description,
            'seoKeywords' => $isArticle ? '' : ($meta?->keywords?->get($locale) ?: $default?->keywords?->get($locale)),
            'seoRobots' => $meta?->robots ?? 'index, follow',
            'seoCanonical' => $meta?->canonical ?: request()->url(),
            'seoOgImage' => $ogImage,
            'seoOgType' => $isArticle ? 'article' : 'website',
            'seoLocale' => $locale,
            'seoTwitter' => Setting::get('seo.twitter_handle', '@levantbms'),
            'seoAlternates' => $this->alternates(),
            'seoJsonLd' => $this->schema($page, $locale, $post, $data, $fullTitle, $description),
        ]);
    }

    protected function pick(array $candidates): string
    {
        foreach ($candidates as $c) {
            if (filled($c)) {
                return (string) $c;
            }
        }

        return '';
    }

    /** hreflang alternates for the current URL. */
    protected function alternates(): array
    {
        $out = [];
        foreach (array_keys(LaravelLocalization::getSupportedLocales()) as $loc) {
            try {
                $out[$loc] = LaravelLocalization::getLocalizedURL($loc, null, [], true);
            } catch (\Throwable) {
                // skip
            }
        }

        return $out;
    }

    /** Build the JSON-LD @graph (Organization always; FAQPage / BlogPosting contextually). */
    protected function schema(string $page, string $locale, ?Post $post, array $data, string $title, string $description): array
    {
        $graph = [$this->organization()];

        if ($page === 'faqs' && isset($data['grouped'])) {
            $faqs = collect($data['grouped'])->flatten(1)
                ->map(fn ($f) => [
                    '@type' => 'Question',
                    'name' => (string) $f->question,
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => (string) $f->answer],
                ])->values()->all();

            if ($faqs) {
                $graph[] = ['@type' => 'FAQPage', 'mainEntity' => $faqs];
            }
        }

        if ($page === 'article' && $post) {
            $graph[] = array_filter([
                '@type' => 'BlogPosting',
                'headline' => (string) $post->title,
                'description' => (string) $post->excerpt,
                'image' => $post->coverUrl(),
                'datePublished' => optional($post->published_at)->toIso8601String(),
                'dateModified' => optional($post->updated_at)->toIso8601String(),
                'author' => ['@type' => 'Organization', 'name' => Setting::get('seo.org_legal_name', config('app.name'))],
                'publisher' => ['@type' => 'Organization', 'name' => Setting::get('seo.org_legal_name', config('app.name'))],
                'mainEntityOfPage' => request()->url(),
            ]);
        }

        return ['@context' => 'https://schema.org', '@graph' => $graph];
    }

    protected function organization(): array
    {
        $sameAs = collect([
            Setting::get('social.linkedin'), Setting::get('social.facebook'),
            Setting::get('social.instagram'), Setting::get('social.x'),
        ])->filter()->values()->all();

        $knowsAbout = Service::where('is_published', true)->get()
            ->map(fn ($s) => $s->title->get('en'))->filter()->values()->all();

        return array_filter([
                '@type' => 'ProfessionalService',
                'name' => Setting::get('seo.org_legal_name', config('app.name')),
                'alternateName' => 'LevantBMS',
                'url' => config('app.url'),
                'foundingDate' => Setting::get('seo.founding_year'),
                'areaServed' => 'Bahrain',
                'telephone' => Setting::get('contact.phone_primary'),
                'email' => Setting::get('contact.email'),
                'address' => array_filter([
                    '@type' => 'PostalAddress',
                    'streetAddress' => Setting::get('contact.address'),
                    'addressLocality' => 'Manama',
                    'addressCountry' => 'BH',
                ]),
                'knowsAbout' => $knowsAbout,
                'sameAs' => $sameAs,
                'hasCredential' => array_filter([
                    '@type' => 'EducationalOccupationalCredential',
                    'credentialCategory' => 'Professional License',
                    'name' => 'Recognized Professional Body'.(Setting::get('seo.license_number') ? ' — License '.Setting::get('seo.license_number') : ''),
                    'recognizedBy' => [
                        '@type' => 'GovernmentOrganization',
                        'name' => Setting::get('seo.credential_authority', 'Ministry of Industry & Commerce, Kingdom of Bahrain'),
                    ],
                ]),
            ]);
    }
}
