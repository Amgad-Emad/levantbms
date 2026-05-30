<?php

use App\Http\Controllers\Front\BlogController;
use App\Models\Post;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN, 'email_verified_at' => now()]);
});

/** Slugs the public blog page would render (featured + grid). */
function blogSlugs(): array
{
    $data = app(BlogController::class)->index()->getData();

    return collect([$data['featured']])->filter()->merge($data['posts'])->pluck('slug')->all();
}

test('an admin can create a published post that appears on the blog', function () {
    $this->actingAs($this->admin)
        ->post(route('dashboard.posts.store'), [
            'title' => ['en' => 'Setting Up in Bahrain', 'ar' => 'تأسيس في البحرين'],
            'excerpt' => ['en' => 'A quick guide.', 'ar' => 'دليل سريع.'],
            'body' => ['en' => '<p>Full English body.</p>', 'ar' => '<p>المحتوى العربي.</p>'],
            'category' => 'Guides',
            'read_minutes' => 6,
            'is_published' => '1',
        ])
        ->assertRedirect(route('dashboard.posts.index'));

    $post = Post::where('slug', 'setting-up-in-bahrain')->first();
    expect($post)->not->toBeNull();
    expect($post->is_published)->toBeTrue();

    // Surfaces on the public blog page, and the article renders its HTML body.
    expect(blogSlugs())->toContain('setting-up-in-bahrain');

    app()->setLocale('en');
    $article = app(BlogController::class)->show($post->slug)->getData();
    expect((string) $article['post']->body)->toContain('Full English body');

    app()->setLocale('ar');
    expect((string) $article['post']->title)->toBe('تأسيس في البحرين');
});

test('only one post can be featured at a time', function () {
    $a = Post::create(['slug' => 'a', 'title' => ['en' => 'A'], 'is_featured' => true, 'is_published' => true, 'read_minutes' => 5, 'published_at' => now()]);

    $this->actingAs($this->admin)->post(route('dashboard.posts.store'), [
        'title' => ['en' => 'B'], 'read_minutes' => 5, 'is_published' => '1', 'is_featured' => '1',
    ]);

    expect($a->fresh()->is_featured)->toBeFalse();
    expect(Post::where('is_featured', true)->count())->toBe(1);
});

test('drafts do not appear on the blog', function () {
    Post::create(['slug' => 'secret-draft', 'title' => ['en' => 'Secret Draft'], 'is_published' => false, 'read_minutes' => 5, 'published_at' => now()]);
    Post::create(['slug' => 'live-one', 'title' => ['en' => 'Live One'], 'is_published' => true, 'read_minutes' => 5, 'published_at' => now()]);

    expect(blogSlugs())->toContain('live-one')->not->toContain('secret-draft');
});
