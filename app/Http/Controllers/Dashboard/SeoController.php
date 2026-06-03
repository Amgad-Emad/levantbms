<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeoController extends Controller
{
    /** Pages that have SEO metadata, in display order. */
    public const PAGES = [
        'default' => ['Site default', 'ti-world-cog'],
        'home' => ['Home', 'ti-home'],
        'about' => ['About', 'ti-info-circle'],
        'services' => ['Services', 'ti-briefcase'],
        'partners' => ['Partners', 'ti-building-store'],
        'gallery' => ['Gallery', 'ti-photo'],
        'faqs' => ['FAQs', 'ti-help-circle'],
        'blog' => ['Blog', 'ti-article'],
        'contact' => ['Contact', 'ti-mail'],
    ];

    public function index(): View
    {
        $metas = SeoMeta::all()->keyBy('page');

        $pages = collect(self::PAGES)->map(fn ($meta, $page) => [
            'page' => $page,
            'label' => $meta[0],
            'icon' => $meta[1],
            'seo' => $metas->get($page),
        ]);

        return view('dashboard.seo.index', compact('pages'));
    }

    public function edit(string $page): View
    {
        abort_unless(array_key_exists($page, self::PAGES), 404);

        $seo = SeoMeta::firstOrCreate(['page' => $page], ['robots' => 'index, follow']);

        return view('dashboard.seo.edit', [
            'seo' => $seo,
            'page' => $page,
            'label' => self::PAGES[$page][0],
        ]);
    }

    public function update(Request $request, string $page): RedirectResponse
    {
        abort_unless(array_key_exists($page, self::PAGES), 404);

        $data = $request->validate([
            'title' => ['array'], 'title.en' => ['nullable', 'string', 'max:255'], 'title.ar' => ['nullable', 'string', 'max:255'],
            'description' => ['array'], 'description.en' => ['nullable', 'string', 'max:400'], 'description.ar' => ['nullable', 'string', 'max:400'],
            'keywords' => ['array'], 'keywords.en' => ['nullable', 'string', 'max:500'], 'keywords.ar' => ['nullable', 'string', 'max:500'],
            'robots' => ['required', 'string', 'max:60'],
            'canonical' => ['nullable', 'url', 'max:255'],
            'og_image' => ['nullable', 'image', 'max:5120'],
            'remove_og_image' => ['nullable', 'boolean'],
        ]);

        $seo = SeoMeta::firstOrNew(['page' => $page]);
        $seo->fill([
            'title' => $data['title'] ?? [],
            'description' => $data['description'] ?? [],
            'keywords' => $data['keywords'] ?? [],
            'robots' => $data['robots'],
            'canonical' => $data['canonical'] ?? null,
        ])->save();

        if ($request->hasFile('og_image')) {
            $seo->clearMediaCollection('og');
            $seo->addMediaFromRequest('og_image')->toMediaCollection('og');
        } elseif ($request->boolean('remove_og_image')) {
            $seo->clearMediaCollection('og');
        }

        return redirect()->route('dashboard.seo.edit', $page)
            ->with('status', 'SEO settings saved — live on the “'.self::PAGES[$page][0].'” page.');
    }
}
