<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\PageImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ContentController extends Controller
{
    /** Icon per page label for the index cards. */
    protected array $icons = [
        'Global' => 'ti-world', 'Home' => 'ti-home', 'About' => 'ti-info-circle',
        'Services' => 'ti-briefcase', 'Partners' => 'ti-building-store', 'Gallery' => 'ti-photo',
        'FAQs' => 'ti-help-circle', 'Blog' => 'ti-article', 'Article' => 'ti-file-text',
        'Contact' => 'ti-mail',
    ];

    /**
     * Editable image slots per page (page label => [slot => [label, hint]]).
     * The front-end uses these via PageImage::url($page, $slot) with a fallback.
     */
    public const IMAGE_SLOTS = [
        'About' => [
            'harbour' => ['Story illustration', 'Shown beside the “About the company” story. Tall portrait, ~4:5 (e.g. 1000×1250).'],
            'md_portrait' => ['Managing Director photo', 'Shown in the Leadership section. Portrait, ~4:5.'],
        ],
        'Home' => [
            'hero_bg' => ['Hero background image', 'Full-width photo behind the homepage headline. Wide landscape, ~3:2 (e.g. 1600×1066). Tick “Remove current image” (then Save) to clear it — the hero then shows a clean gradient with no photo.'],
            'hero' => ['Hero image', 'Optional hero/office image for the homepage. Wide, ~16:9.'],
        ],
    ];

    /** Maps a page label to the lowercase key used by PageImage / the front-end. */
    protected function pageKey(string $pageName): string
    {
        return strtolower($pageName);
    }

    /** Display order for page cards. */
    protected array $order = ['Global', 'Home', 'About', 'Services', 'Partners', 'Gallery', 'FAQs', 'Blog', 'Article', 'Contact'];

    public function index(): View
    {
        $pages = Content::where('group', 'front')
            ->selectRaw('page, COUNT(*) as fields')
            ->groupBy('page')
            ->get()
            ->sortBy(fn ($row) => array_search($row->page, $this->order) === false ? 99 : array_search($row->page, $this->order))
            ->values()
            ->map(fn ($row) => [
                'page' => $row->page,
                'slug' => Str::slug($row->page),
                'fields' => $row->fields,
                'icon' => $this->icons[$row->page] ?? 'ti-file-text',
            ]);

        return view('dashboard.content.index', compact('pages'));
    }

    public function edit(string $page): View
    {
        $pageName = $this->resolvePage($page);

        $sections = Content::where('group', 'front')
            ->where('page', $pageName)
            ->orderBy('position')
            ->get()
            ->groupBy('section');

        $slots = self::IMAGE_SLOTS[$pageName] ?? [];
        $images = PageImage::where('page', $this->pageKey($pageName))->get()->keyBy('slot');

        // Map the page to its public front-end route for the "View page" link.
        $frontRoute = 'front.'.Str::slug($pageName);

        return view('dashboard.content.edit', [
            'pageName' => $pageName,
            'slug' => Str::slug($pageName),
            'sections' => $sections,
            'slots' => $slots,
            'images' => $images,
            'frontRoute' => $frontRoute,
        ]);
    }

    public function update(Request $request, string $page): RedirectResponse
    {
        $pageName = $this->resolvePage($page);

        $data = $request->validate([
            'values' => ['array'],
            'values.*.en' => ['nullable', 'string'],
            'values.*.ar' => ['nullable', 'string'],
            'images' => ['array'],
            'images.*' => ['nullable', 'image', 'max:5120'],
            'remove_images' => ['array'],
            'remove_images.*' => ['nullable'],
        ]);

        $rows = Content::where('group', 'front')->where('page', $pageName)->get()->keyBy('id');

        foreach ($data['values'] ?? [] as $id => $value) {
            if ($row = $rows->get((int) $id)) {
                $row->update(['values' => [
                    'en' => $value['en'] ?? '',
                    'ar' => $value['ar'] ?? '',
                ]]);
            }
        }

        // Image slots — upload replaces, "remove" clears.
        $allowedSlots = array_keys(self::IMAGE_SLOTS[$pageName] ?? []);
        $files = $request->file('images', []);
        $removals = $request->input('remove_images', []);

        foreach ($allowedSlots as $slot) {
            $file = $files[$slot] ?? null;
            $remove = ! empty($removals[$slot]);

            if ($file) {
                $pageImage = PageImage::firstOrCreate(['page' => $this->pageKey($pageName), 'slot' => $slot]);
                $pageImage->clearMediaCollection('image');
                $pageImage->addMedia($file)->toMediaCollection('image');
            } elseif ($remove) {
                PageImage::where('page', $this->pageKey($pageName))->where('slot', $slot)->first()?->clearMediaCollection('image');
            }
        }

        return redirect()
            ->route('dashboard.content.edit', $this->slugOf($pageName))
            ->with('status', "“{$pageName}” content updated — changes are live on the site.");
    }

    protected function resolvePage(string $slug): string
    {
        $page = Content::where('group', 'front')
            ->get(['page'])
            ->pluck('page')
            ->unique()
            ->first(fn ($p) => Str::slug($p) === $slug);

        abort_if($page === null, 404);

        return $page;
    }

    protected function slugOf(string $page): string
    {
        return Str::slug($page);
    }
}
