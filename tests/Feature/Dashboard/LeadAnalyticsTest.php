<?php

use App\Models\Lead;
use App\Models\PageView;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN, 'email_verified_at' => now()]);
});

/** A "human" submission: empty honeypot + a render timestamp older than the min fill time. */
function humanFields(array $extra = []): array
{
    return array_merge([
        'website' => '',
        '_ts' => Crypt::encryptString((string) (time() - 10)),
    ], $extra);
}

test('the contact form creates a lead and acknowledges via json', function () {
    app()->setLocale('en');

    $this->postJson(route('front.contact.store'), humanFields([
        'name' => 'Sara Khan',
        'email' => 'sara@example.com',
        'phone' => '+97333000111',
        'topic' => 'Company formation',
        'message' => 'I want to set up a W.L.L.',
    ]))->assertCreated()->assertJson(['ok' => true]);

    $lead = Lead::first();
    expect($lead->name)->toBe('Sara Khan');
    expect($lead->status)->toBe('new');
    expect($lead->locale)->toBe('en');
});

test('a filled honeypot is silently dropped without creating a lead', function () {
    app()->setLocale('en');

    $this->postJson(route('front.contact.store'), humanFields([
        'name' => 'Spam Bot',
        'email' => 'bot@example.com',
        'website' => 'http://spam.example',   // honeypot filled
    ]))->assertCreated()->assertJson(['ok' => true]);

    expect(Lead::count())->toBe(0);
});

test('a too-fast (or token-less) submission is treated as a bot', function () {
    app()->setLocale('en');

    // Submitted instantly (render timestamp = now) — faster than a human.
    $this->postJson(route('front.contact.store'), [
        'website' => '',
        '_ts' => Crypt::encryptString((string) time()),
        'name' => 'Fast Bot',
        'email' => 'fast@example.com',
    ])->assertCreated();
    expect(Lead::count())->toBe(0);

    // No time-trap token at all.
    $this->postJson(route('front.contact.store'), [
        'name' => 'No Token Bot',
        'email' => 'notoken@example.com',
    ])->assertCreated();
    expect(Lead::count())->toBe(0);
});

test('the contact form validates required fields', function () {
    app()->setLocale('en');

    $this->postJson(route('front.contact.store'), ['name' => '', 'email' => 'not-an-email'])
        ->assertStatus(422)
        ->assertJsonStructure(['errors' => ['name', 'email']]);
});

test('viewing a lead marks it as read', function () {
    $lead = Lead::create(['name' => 'A', 'email' => 'a@b.com', 'status' => 'new']);

    $this->actingAs($this->admin)->get(route('dashboard.leads.show', $lead))->assertOk();

    expect($lead->fresh()->status)->toBe('read');
});

test('an admin can filter leads and change status', function () {
    Lead::create(['name' => 'New One', 'email' => 'n@b.com', 'status' => 'new']);
    $archived = Lead::create(['name' => 'Old One', 'email' => 'o@b.com', 'status' => 'archived']);

    $this->actingAs($this->admin)->get(route('dashboard.leads.index', ['status' => 'new']))
        ->assertOk()->assertSee('New One')->assertDontSee('Old One');

    $this->actingAs($this->admin)->put(route('dashboard.leads.update', $archived), ['status' => 'read']);
    expect($archived->fresh()->status)->toBe('read');
});

test('the analytics page aggregates page views', function () {
    PageView::create(['path' => '/en', 'locale' => 'en', 'device' => 'mobile', 'session_id' => 's1', 'created_at' => now()]);
    PageView::create(['path' => '/en', 'locale' => 'en', 'device' => 'desktop', 'session_id' => 's2', 'created_at' => now()]);
    PageView::create(['path' => '/en/blog', 'locale' => 'en', 'device' => 'desktop', 'session_id' => 's2', 'created_at' => now()]);

    $this->actingAs($this->admin)->get(route('dashboard.analytics'))
        ->assertOk()
        ->assertSee('Page Views')
        ->assertSee('/en/blog');
});
