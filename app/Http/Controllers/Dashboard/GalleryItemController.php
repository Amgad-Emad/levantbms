<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryItemController extends Controller
{
    public const CATEGORIES = ['Office', 'Events', 'Team', 'Bahrain'];

    public const RATIOS = ['square' => '1/1', 'wide' => '4/3', 'tall' => '3/4'];

    public function index(): View
    {
        $items = GalleryItem::orderBy('position')->orderBy('id')->get();

        return view('dashboard.gallery.index', [
            'items' => $items,
            'categories' => self::CATEGORIES,
            'ratios' => self::RATIOS,
        ]);
    }

    public function create(): View
    {
        return view('dashboard.gallery.form', [
            'item' => new GalleryItem(['ratio' => '4/3', 'is_published' => true]),
            'categories' => self::CATEGORIES,
            'ratios' => self::RATIOS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request, true);
        $item = GalleryItem::create($this->attributes($data));
        $item->addMediaFromRequest('image')->toMediaCollection('image');

        return redirect()->route('dashboard.gallery.index')->with('status', 'Image added to the gallery.');
    }

    public function edit(GalleryItem $gallery): View
    {
        return view('dashboard.gallery.form', [
            'item' => $gallery,
            'categories' => self::CATEGORIES,
            'ratios' => self::RATIOS,
        ]);
    }

    public function update(Request $request, GalleryItem $gallery): RedirectResponse
    {
        $data = $this->validateData($request, false);
        $gallery->update($this->attributes($data));

        if ($request->hasFile('image')) {
            $gallery->clearMediaCollection('image');
            $gallery->addMediaFromRequest('image')->toMediaCollection('image');
        } elseif ($request->boolean('remove_image')) {
            $gallery->clearMediaCollection('image');
        }

        return redirect()->route('dashboard.gallery.index')->with('status', 'Gallery item updated.');
    }

    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        $gallery->delete();

        return redirect()->route('dashboard.gallery.index')->with('status', 'Gallery item deleted.');
    }

    protected function validateData(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            'label' => ['array'],
            'label.en' => ['nullable', 'string', 'max:255'],
            'label.ar' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'ratio' => ['required', 'string', 'max:10'],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ]);
    }

    protected function attributes(array $data): array
    {
        return [
            'label' => $data['label'] ?? [],
            'category' => $data['category'] ?? null,
            'ratio' => $data['ratio'],
            'position' => $data['position'] ?? 0,
            'is_published' => (bool) ($data['is_published'] ?? false),
        ];
    }
}
