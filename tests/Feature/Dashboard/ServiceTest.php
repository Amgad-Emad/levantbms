<?php

use App\Http\Controllers\Front\ServiceController;
use App\Models\Service;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN, 'email_verified_at' => now()]);
});

test('an admin can create a service with bilingual scope and pricing', function () {
    $this->actingAs($this->admin)->post(route('dashboard.services.store'), [
        'code' => '01',
        'title' => ['en' => 'Company Formation', 'ar' => 'تأسيس الشركات'],
        'tag' => ['en' => 'Ministry of Commerce', 'ar' => 'وزارة التجارة'],
        'description' => ['en' => 'We incorporate.', 'ar' => 'نحن نؤسس.'],
        'timeline' => ['en' => '2–6 weeks', 'ar' => '٢-٦ أسابيع'],
        'fee_from' => ['en' => 'BD 750', 'ar' => 'د.ب ٧٥٠'],
        'scope_en' => "Incorporate a company\nChange CR\n\nAmend capital",
        'scope_ar' => "تأسيس شركة\nتعديل السجل",
        'is_published' => '1',
    ])->assertRedirect(route('dashboard.services.index'));

    $service = Service::first();
    expect($service->scopeLinesFor('en'))->toBe(['Incorporate a company', 'Change CR', 'Amend capital']); // blank line dropped
    expect($service->scopeLinesFor('ar'))->toBe(['تأسيس شركة', 'تعديل السجل']);
    expect((string) $service->fee_from)->toBe('BD 750');
});

test('a service created without a category falls back to moic', function () {
    $this->actingAs($this->admin)->post(route('dashboard.services.store'), [
        'title' => ['en' => 'No Category Service'],
        'is_published' => '1',
    ])->assertRedirect(route('dashboard.services.index'));

    expect(Service::latest('id')->first()->category)->toBe('moic');
});

test('editing a service preserves its category (category is not editable on the main service)', function () {
    $service = Service::create(['title' => ['en' => 'CBB Main'], 'category' => 'cbb', 'is_published' => true]);

    $this->actingAs($this->admin)->put(route('dashboard.services.update', $service), [
        'title' => ['en' => 'CBB Main Renamed'],
        'is_published' => '1',
    ])->assertRedirect(route('dashboard.services.index'));

    $service->refresh();
    expect((string) $service->title)->toBe('CBB Main Renamed');
    expect($service->category)->toBe('cbb');
});

test('the services index counts each service\'s sub-services', function () {
    $service = Service::create(['title' => ['en' => 'Parent'], 'category' => 'moic', 'is_published' => true]);
    \App\Models\SubService::create(['service_id' => $service->id, 'title' => ['en' => 'Kid'], 'is_published' => true]);

    $services = app(\App\Http\Controllers\Dashboard\ServiceController::class)->index()->getData()['services'];

    expect($services->firstWhere('id', $service->id)->sub_services_count)->toBe(1);
});

test('only published services render on the public services page', function () {
    Service::create(['code' => '01', 'title' => ['en' => 'Visible Service'], 'is_published' => true, 'position' => 1]);
    Service::create(['code' => '02', 'title' => ['en' => 'Hidden Service'], 'is_published' => false, 'position' => 2]);

    $services = app(ServiceController::class)->index()->getData()['services'];

    expect($services->pluck('title')->map->get('en')->all())
        ->toContain('Visible Service')
        ->not->toContain('Hidden Service');
});
