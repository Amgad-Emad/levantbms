<?php

use App\Models\Setting;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN, 'email_verified_at' => now()]);
    $this->editor = User::factory()->create(['role' => User::ROLE_EDITOR, 'email_verified_at' => now()]);
});

test('an admin can update site settings', function () {
    $this->actingAs($this->admin)->put(route('dashboard.settings.update'), [
        'settings' => [
            'contact.email' => 'hello@levantbms.com',
            'contact.phone_primary' => '+973 99999999',
        ],
    ])->assertRedirect(route('dashboard.settings.index'));

    expect(Setting::get('contact.email'))->toBe('hello@levantbms.com');
    expect(Setting::get('contact.phone_primary'))->toBe('+973 99999999');
});

test('settings updates ignore unknown keys', function () {
    $this->actingAs($this->admin)->put(route('dashboard.settings.update'), [
        'settings' => ['evil.key' => 'nope'],
    ]);

    expect(Setting::where('key', 'evil.key')->exists())->toBeFalse();
});

test('an admin can create a user with a role', function () {
    $this->actingAs($this->admin)->post(route('dashboard.users.store'), [
        'name' => 'New Editor',
        'email' => 'editor2@levantbms.com',
        'role' => 'editor',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertRedirect(route('dashboard.users.index'));

    expect(User::where('email', 'editor2@levantbms.com')->first()->role)->toBe('editor');
});

test('editors cannot manage users', function () {
    $this->actingAs($this->editor)->get(route('dashboard.users.index'))->assertForbidden();
    $this->actingAs($this->editor)->post(route('dashboard.users.store'), [
        'name' => 'X', 'email' => 'x@y.com', 'role' => 'admin', 'password' => 'password123', 'password_confirmation' => 'password123',
    ])->assertForbidden();

    expect(User::where('email', 'x@y.com')->exists())->toBeFalse();
});

test('a user cannot delete their own account from the users screen', function () {
    $this->actingAs($this->admin)->delete(route('dashboard.users.destroy', $this->admin));

    expect(User::find($this->admin->id))->not->toBeNull();
});
