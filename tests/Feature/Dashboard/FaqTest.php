<?php

use App\Http\Controllers\Front\FaqController as FrontFaq;
use App\Models\Faq;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN, 'email_verified_at' => now()]);
});

test('an admin can create a bilingual FAQ', function () {
    $this->actingAs($this->admin)->post(route('dashboard.faqs.store'), [
        'category' => 'Setup',
        'question' => ['en' => 'How long?', 'ar' => 'كم المدة؟'],
        'answer' => ['en' => 'Two weeks.', 'ar' => 'أسبوعان.'],
        'is_published' => '1',
    ])->assertRedirect(route('dashboard.faqs.index'));

    $faq = Faq::first();
    expect((string) $faq->question)->toBe('How long?');
    app()->setLocale('ar');
    expect((string) $faq->answer)->toBe('أسبوعان.');
});

test('the public FAQ page groups published faqs by category in order', function () {
    Faq::create(['category' => 'After', 'question' => ['en' => 'After Q'], 'answer' => ['en' => 'A'], 'is_published' => true, 'position' => 1]);
    Faq::create(['category' => 'Setup', 'question' => ['en' => 'Setup Q'], 'answer' => ['en' => 'A'], 'is_published' => true, 'position' => 2]);
    Faq::create(['category' => 'Setup', 'question' => ['en' => 'Hidden Q'], 'answer' => ['en' => 'A'], 'is_published' => false, 'position' => 3]);

    $grouped = app(FrontFaq::class)->index()->getData()['grouped'];

    expect($grouped->keys()->all())->toBe(['Setup', 'After']); // canonical order, Costs/Regulation dropped (empty)
    expect($grouped['Setup']->pluck('question')->map->get('en')->all())->toBe(['Setup Q']); // hidden excluded
});
