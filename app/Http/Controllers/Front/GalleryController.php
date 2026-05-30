<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $items = GalleryItem::where('is_published', true)->orderBy('position')->orderBy('id')->get();

        return view('front.gallery', compact('items'));
    }
}
