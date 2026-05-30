<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    /** Maps a stored category to its bilingual lang key. */
    public const CATEGORY_KEYS = [
        'Company Setup' => 'blog.catSetup',
        'Investment' => 'blog.catInvest',
        'Regulation' => 'blog.catReg',
        'Guides' => 'blog.catGuides',
    ];

    public function index(): View
    {
        $published = Post::published()->orderByDesc('published_at')->orderByDesc('id')->get();

        $featured = $published->firstWhere('is_featured', true) ?? $published->first();
        $posts = $published->reject(fn ($p) => $featured && $p->getKey() === $featured->getKey())->values();

        return view('front.blog', [
            'featured' => $featured,
            'posts' => $posts,
            'catKeys' => self::CATEGORY_KEYS,
        ]);
    }

    public function show(string $slug): View
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        return view('front.article', [
            'post' => $post,
            'catKeys' => self::CATEGORY_KEYS,
        ]);
    }
}
