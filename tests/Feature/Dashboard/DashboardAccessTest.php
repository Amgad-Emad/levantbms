<?php

use App\Models\User;

test('an admin can view the dashboard', function () {
    $admin = User::factory()->create(['role' => User::ROLE_ADMIN, 'email_verified_at' => now()]);

    $this->actingAs($admin)
        ->get('/dashboard')
        ->assertOk()
        ->assertSee('Welcome back')
        ->assertSee('Quick Actions');
});

test('an editor can view the dashboard', function () {
    $editor = User::factory()->create(['role' => User::ROLE_EDITOR, 'email_verified_at' => now()]);

    $this->actingAs($editor)->get('/dashboard')->assertOk();
});

test('guests are redirected to login', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});

test('database content overrides the lang file for front translations', function () {
    \App\Models\Content::create([
        'group' => 'front',
        'key' => 'nav.home',
        'values' => ['en' => 'OVERRIDDEN', 'ar' => 'مُتجاوَز'],
    ]);

    app()->setLocale('en');
    expect(__('front.nav.home'))->toBe('OVERRIDDEN');

    app()->setLocale('ar');
    expect(__('front.nav.home'))->toBe('مُتجاوَز');

    // A key with no DB row falls back to the lang file.
    app()->setLocale('en');
    expect(__('front.nav.about'))->toBe('About Us');
});
