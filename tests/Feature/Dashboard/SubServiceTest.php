<?php

use App\Http\Controllers\Front\ServiceController;
use App\Models\Service;
use App\Models\SubService;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN, 'email_verified_at' => now()]);
    $this->service = Service::create([
        'code' => '01',
        'category' => 'moic',
        'title' => ['en' => 'Ministry of Industry & Commerce', 'ar' => 'وزارة الصناعة والتجارة'],
        'is_published' => true,
        'position' => 1,
    ]);
});

test('an admin can create a sub-service under a parent service', function () {
    $this->actingAs($this->admin)->post(route('dashboard.sub-services.store'), [
        'service_id' => $this->service->id,
        'code' => 'S1',
        'title' => ['en' => 'Trade Name Reservation', 'ar' => 'حجز الاسم التجاري'],
        'tag' => ['en' => 'Add-on', 'ar' => 'إضافة'],
        'description' => ['en' => 'Reserve a commercial name.', 'ar' => 'حجز الاسم التجاري.'],
        'timeline' => ['en' => '2–3 days', 'ar' => '٢-٣ أيام'],
        'fee_from' => ['en' => 'BD 120', 'ar' => 'د.ب ١٢٠'],
        'scope_en' => "Name availability check\nMOIC reservation\n\nClearance",
        'scope_ar' => "فحص توفر الاسم\nالحجز",
        'is_published' => '1',
    ])->assertRedirect(route('dashboard.sub-services.index'));

    $sub = SubService::first();
    expect($sub->service_id)->toBe($this->service->id);
    expect((string) $sub->title)->toBe('Trade Name Reservation');
    expect($sub->scopeLinesFor('en'))->toBe(['Name availability check', 'MOIC reservation', 'Clearance']); // blank line dropped
    expect($sub->scopeLinesFor('ar'))->toBe(['فحص توفر الاسم', 'الحجز']);
    expect((string) $sub->fee_from)->toBe('BD 120');
});

test('creating a sub-service requires a valid parent service', function () {
    $this->actingAs($this->admin)->post(route('dashboard.sub-services.store'), [
        'title' => ['en' => 'Orphan'],
    ])->assertSessionHasErrors('service_id');

    $this->actingAs($this->admin)->post(route('dashboard.sub-services.store'), [
        'service_id' => 9999, // does not exist
        'title' => ['en' => 'Orphan'],
    ])->assertSessionHasErrors('service_id');

    expect(SubService::count())->toBe(0);
});

test('creating a sub-service requires an english title', function () {
    $this->actingAs($this->admin)->post(route('dashboard.sub-services.store'), [
        'service_id' => $this->service->id,
        'title' => ['ar' => 'بدون عنوان إنجليزي'],
    ])->assertSessionHasErrors('title.en');

    expect(SubService::count())->toBe(0);
});

test('an admin can update a sub-service', function () {
    $sub = SubService::create([
        'service_id' => $this->service->id,
        'title' => ['en' => 'Old Title'],
        'is_published' => true,
        'position' => 0,
    ]);

    $this->actingAs($this->admin)->put(route('dashboard.sub-services.update', $sub), [
        'service_id' => $this->service->id,
        'title' => ['en' => 'New Title', 'ar' => 'عنوان جديد'],
        'scope_en' => "One\nTwo",
        'is_published' => '1',
    ])->assertRedirect(route('dashboard.sub-services.index'));

    $sub->refresh();
    expect((string) $sub->title)->toBe('New Title');
    expect($sub->scopeLinesFor('en'))->toBe(['One', 'Two']);
});

test('an admin can delete a sub-service', function () {
    $sub = SubService::create(['service_id' => $this->service->id, 'title' => ['en' => 'X'], 'is_published' => true]);

    $this->actingAs($this->admin)->delete(route('dashboard.sub-services.destroy', $sub))
        ->assertRedirect(route('dashboard.sub-services.index'));

    expect(SubService::count())->toBe(0);
});

test('deleting a service cascade-deletes its sub-services', function () {
    SubService::create(['service_id' => $this->service->id, 'title' => ['en' => 'A'], 'is_published' => true]);
    SubService::create(['service_id' => $this->service->id, 'title' => ['en' => 'B'], 'is_published' => true]);

    expect($this->service->subServices()->count())->toBe(2);

    $this->service->delete();

    expect(SubService::count())->toBe(0);
});

test('a service has many sub-services and a sub-service belongs to a service', function () {
    $sub = SubService::create(['service_id' => $this->service->id, 'title' => ['en' => 'Child'], 'is_published' => true]);

    expect($this->service->subServices->pluck('id')->all())->toContain($sub->id);
    expect($sub->service->id)->toBe($this->service->id);
});

test('the public services page loads only published sub-services under their parent', function () {
    SubService::create(['service_id' => $this->service->id, 'title' => ['en' => 'Shown'], 'is_published' => true, 'position' => 1]);
    SubService::create(['service_id' => $this->service->id, 'title' => ['en' => 'Hidden'], 'is_published' => false, 'position' => 2]);

    $services = app(ServiceController::class)->index()->getData()['services'];
    $loaded = $services->firstWhere('id', $this->service->id)->subServices;

    expect($loaded->pluck('title')->map->get('en')->all())
        ->toContain('Shown')
        ->not->toContain('Hidden');
});

test('the dashboard sub-services index shows sub-services with their parent service', function () {
    SubService::create(['service_id' => $this->service->id, 'title' => ['en' => 'Trade Name Reservation'], 'is_published' => true]);

    $this->actingAs($this->admin)->get(route('dashboard.sub-services.index'))
        ->assertOk()
        ->assertSee('Trade Name Reservation')
        ->assertSee('Ministry of Industry & Commerce');
});

test('guests cannot manage sub-services', function () {
    $this->get(route('dashboard.sub-services.index'))->assertRedirect();
    $this->post(route('dashboard.sub-services.store'), [])->assertRedirect();
});
