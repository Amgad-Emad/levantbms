<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public const CATEGORIES = ['Company Setup', 'Investment', 'Regulation', 'Guides'];

    public function index(): View
    {
        $posts = Post::orderByDesc('is_featured')->orderByDesc('published_at')->orderByDesc('id')->get();

        return view('dashboard.posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('dashboard.posts.form', [
            'post' => new Post(['read_minutes' => 5, 'is_published' => true]),
            'categories' => self::CATEGORIES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $post = new Post();
        $this->fill($post, $data);
        $post->save();
        $this->handleCover($request, $post);
        $this->enforceSingleFeatured($post);

        return redirect()->route('dashboard.posts.index')
            ->with('status', 'Post created — it’s now live on the blog.');
    }

    public function edit(Post $post): View
    {
        return view('dashboard.posts.form', [
            'post' => $post,
            'categories' => self::CATEGORIES,
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $this->validateData($request, $post);
        $this->fill($post, $data);
        $post->save();
        $this->handleCover($request, $post);
        $this->enforceSingleFeatured($post);

        return redirect()->route('dashboard.posts.index')
            ->with('status', 'Post updated.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('dashboard.posts.index')->with('status', 'Post deleted.');
    }

    protected function validateData(Request $request, ?Post $post = null): array
    {
        return $request->validate([
            'title.en' => ['required', 'string', 'max:255'],
            'title.ar' => ['nullable', 'string', 'max:255'],
            'excerpt.en' => ['nullable', 'string'],
            'excerpt.ar' => ['nullable', 'string'],
            'body.en' => ['nullable', 'string'],
            'body.ar' => ['nullable', 'string'],
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:posts,slug,'.($post?->id ?? 'NULL')],
            'meta_title' => ['array'], 'meta_title.en' => ['nullable', 'string', 'max:255'], 'meta_title.ar' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['array'], 'meta_description.en' => ['nullable', 'string', 'max:400'], 'meta_description.ar' => ['nullable', 'string', 'max:400'],
            'category' => ['nullable', 'string', 'max:100'],
            'read_minutes' => ['required', 'integer', 'min:1', 'max:120'],
            'published_at' => ['nullable', 'date'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'cover' => ['nullable', 'image', 'max:5120'],
            'remove_cover' => ['nullable', 'boolean'],
        ]);
    }

    protected function fill(Post $post, array $data): void
    {
        $post->title = $data['title'];
        $post->excerpt = $data['excerpt'] ?? [];
        $post->body = $data['body'] ?? [];
        $post->slug = ($data['slug'] ?? null) ?: Str::slug($data['title']['en']);
        $post->category = $data['category'] ?? null;
        $post->read_minutes = $data['read_minutes'];
        $post->published_at = $data['published_at'] ?? now();
        $post->is_featured = (bool) ($data['is_featured'] ?? false);
        $post->is_published = (bool) ($data['is_published'] ?? false);
        $post->meta_title = $data['meta_title'] ?? [];
        $post->meta_description = $data['meta_description'] ?? [];
    }

    protected function handleCover(Request $request, Post $post): void
    {
        if ($request->hasFile('cover')) {
            $post->clearMediaCollection('cover');
            $post->addMediaFromRequest('cover')->toMediaCollection('cover');
        } elseif ($request->boolean('remove_cover')) {
            $post->clearMediaCollection('cover');
        }
    }

    protected function enforceSingleFeatured(Post $post): void
    {
        if ($post->is_featured) {
            Post::where('id', '!=', $post->id)->where('is_featured', true)->update(['is_featured' => false]);
        }
    }
}
