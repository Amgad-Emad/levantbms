<?php

use App\Http\Controllers\Front\GalleryController;
use App\Http\Controllers\Front\PartnerController;
use App\Models\GalleryItem;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN, 'email_verified_at' => now()]);
    Storage::fake('public');
});

test('uploading a gallery image creates a published item with media', function () {
    $this->actingAs($this->admin)->post(route('dashboard.gallery.store'), [
        'label' => ['en' => 'Boardroom', 'ar' => 'قاعة الاجتماعات'],
        'category' => 'Office',
        'ratio' => '4/3',
        'is_published' => '1',
        'image' => UploadedFile::fake()->image('boardroom.jpg', 800, 600),
    ])->assertRedirect(route('dashboard.gallery.index'));

    $item = GalleryItem::first();
    expect($item)->not->toBeNull();
    expect($item->imageUrl())->not->toBeNull();
    expect((string) $item->label)->toBe('Boardroom');
});

test('only published gallery items and partners render publicly', function () {
    GalleryItem::create(['category' => 'Office', 'label' => ['en' => 'Shown'], 'ratio' => '1/1', 'is_published' => true, 'position' => 1]);
    GalleryItem::create(['category' => 'Office', 'label' => ['en' => 'Hidden'], 'ratio' => '1/1', 'is_published' => false, 'position' => 2]);

    $items = app(GalleryController::class)->index()->getData()['items'];
    expect($items->pluck('label')->map->get('en')->all())->toContain('Shown')->not->toContain('Hidden');
});

test('a partner stores bilingual service lists from textareas', function () {
    $this->actingAs($this->admin)->post(route('dashboard.partners.store'), [
        'name' => ['en' => 'OrangeHRM', 'ar' => 'أورنج'],
        'tag' => ['en' => 'HR Platform', 'ar' => 'منصة'],
        'region' => ['en' => 'Global', 'ar' => 'عالمي'],
        'body' => ['en' => 'HR tools.', 'ar' => 'أدوات.'],
        'services_en' => "Implementation\nTraining\n\nSupport",
        'services_ar' => "التنفيذ\nالتدريب",
        'is_published' => '1',
    ])->assertRedirect(route('dashboard.partners.index'));

    $partner = Partner::first();
    expect($partner->servicesFor('en'))->toBe(['Implementation', 'Training', 'Support']);
    expect($partner->servicesFor('ar'))->toBe(['التنفيذ', 'التدريب']);

    $rendered = app(PartnerController::class)->index()->getData()['partners'];
    expect($rendered)->toHaveCount(1);
});

test('a file can be uploaded to the media library', function () {
    $this->actingAs($this->admin)->post(route('dashboard.media.store'), [
        'files' => [UploadedFile::fake()->create('brochure.pdf', 120, 'application/pdf')],
    ])->assertRedirect(route('dashboard.media.index'));

    expect($this->admin->fresh()->getMedia('library'))->toHaveCount(1);
});
