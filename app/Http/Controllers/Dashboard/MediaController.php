<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function index(): View
    {
        // Every uploaded asset across the site (posts, partners, gallery, library).
        $media = Media::latest()->paginate(24);

        return view('dashboard.media.index', compact('media'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'files' => ['required', 'array'],
            'files.*' => ['file', 'max:10240', 'mimes:jpg,jpeg,png,webp,gif,svg,pdf,doc,docx,xls,xlsx'],
        ]);

        foreach ($request->file('files') as $file) {
            $request->user()->addMedia($file)->toMediaCollection('library');
        }

        return redirect()->route('dashboard.media.index')->with('status', 'Files uploaded to the media library.');
    }

    public function destroy(Media $medium): RedirectResponse
    {
        $medium->delete();

        return redirect()->route('dashboard.media.index')->with('status', 'File deleted.');
    }
}
