<?php

use App\Models\Content;
use App\Models\PageImage;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN, 'email_verified_at' => now()]);
});

test('an admin can upload an image slot for a page and the front-end uses it', function () {
    Storage::fake('public');
    Content::create(['group' => 'front', 'key' => 'about.h1', 'values' => ['en' => 'About'], 'page' => 'About', 'section' => 'about']);

    $this->actingAs($this->admin)->put(route('dashboard.content.update', 'about'), [
        'images' => ['harbour' => UploadedFile::fake()->image('harbour.jpg', 1000, 1250)],
    ])->assertRedirect(route('dashboard.content.edit', 'about'));

    $pageImage = PageImage::where('page', 'about')->where('slot', 'harbour')->first();
    expect($pageImage)->not->toBeNull();
    expect(PageImage::url('about', 'harbour'))->not->toBeNull();
});

test('unknown image slots are ignored', function () {
    Storage::fake('public');
    Content::create(['group' => 'front', 'key' => 'about.h1', 'values' => ['en' => 'About'], 'page' => 'About', 'section' => 'about']);

    $this->actingAs($this->admin)->put(route('dashboard.content.update', 'about'), [
        'images' => ['evil_slot' => UploadedFile::fake()->image('x.jpg')],
    ]);

    expect(PageImage::where('slot', 'evil_slot')->exists())->toBeFalse();
});

test('the pages index lists content pages', function () {
    Content::create(['group' => 'front', 'key' => 'home.h1a', 'values' => ['en' => 'Hi', 'ar' => 'مرحبا'], 'page' => 'Home', 'section' => 'home']);

    $this->actingAs($this->admin)
        ->get(route('dashboard.content.index'))
        ->assertOk()
        ->assertSee('Home');
});

test('an admin can edit page content and it updates the live site', function () {
    $row = Content::create([
        'group' => 'front', 'key' => 'home.h1a',
        'values' => ['en' => 'Old', 'ar' => 'قديم'], 'page' => 'Home', 'section' => 'home',
    ]);

    $this->actingAs($this->admin)
        ->put(route('dashboard.content.update', 'home'), [
            'values' => [$row->id => ['en' => 'Brand New Headline', 'ar' => 'عنوان جديد']],
        ])
        ->assertRedirect(route('dashboard.content.edit', 'home'));

    app()->setLocale('en');
    expect(__('front.home.h1a'))->toBe('Brand New Headline');
    app()->setLocale('ar');
    expect(__('front.home.h1a'))->toBe('عنوان جديد');
});

test('non-dashboard users cannot edit content', function () {
    $row = Content::create(['group' => 'front', 'key' => 'home.h1a', 'values' => ['en' => 'X'], 'page' => 'Home', 'section' => 'home']);
    $outsider = User::factory()->create(['role' => 'guest', 'email_verified_at' => now()]);

    $this->actingAs($outsider)
        ->put(route('dashboard.content.update', 'home'), ['values' => [$row->id => ['en' => 'Hacked']]])
        ->assertForbidden();
});
