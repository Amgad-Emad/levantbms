<?php

use App\Models\Post;
use App\Models\SeoMeta;
use App\Models\User;
use App\View\Composers\SeoComposer;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN, 'email_verified_at' => now()]);
});

test('an admin can edit per-page SEO metadata bilingually', function () {
    $this->actingAs($this->admin)->put(route('dashboard.seo.update', 'home'), [
        'title' => ['en' => 'Licensed Setup in Bahrain', 'ar' => 'تأسيس مرخّص في البحرين'],
        'description' => ['en' => 'MOIC Professional Body.', 'ar' => 'مكتب معتمد.'],
        'keywords' => ['en' => 'business setup bahrain', 'ar' => 'تأسيس الأعمال'],
        'robots' => 'index, follow',
    ])->assertRedirect(route('dashboard.seo.edit', 'home'));

    $seo = SeoMeta::forPage('home');
    expect($seo->title->get('en'))->toBe('Licensed Setup in Bahrain');
    app()->setLocale('ar');
    expect($seo->title->get('ar'))->toBe('تأسيس مرخّص في البحرين');
});

test('the SEO index and editor screens render', function () {
    $this->actingAs($this->admin)->get(route('dashboard.seo.index'))->assertOk()->assertSee('Per-page titles');
    $this->actingAs($this->admin)->get(route('dashboard.seo.edit', 'services'))->assertOk()->assertSee('Search preview');
});

test('editing SEO for an unknown page 404s', function () {
    $this->actingAs($this->admin)->get(route('dashboard.seo.edit', 'not-a-page'))->assertNotFound();
});

test('blog posts store their own SEO meta', function () {
    $this->actingAs($this->admin)->post(route('dashboard.posts.store'), [
        'title' => ['en' => 'A Post'],
        'meta_title' => ['en' => 'Custom SEO Title'],
        'meta_description' => ['en' => 'Custom SEO description.'],
        'read_minutes' => 5,
        'is_published' => '1',
    ])->assertRedirect(route('dashboard.posts.index'));

    $post = Post::where('slug', 'a-post')->first();
    expect($post->meta_title->get('en'))->toBe('Custom SEO Title');
});

test('the SEO composer builds title and the MOIC credential schema', function () {
    \App\Models\Setting::updateOrCreate(['key' => 'seo.credential_authority'], ['value' => 'Ministry of Industry & Commerce, Kingdom of Bahrain', 'group' => 'seo']);
    SeoMeta::create(['page' => 'default', 'title' => ['en' => 'Default Title'], 'description' => ['en' => 'd']]);

    app()->setLocale('en');

    $view = app('view')->make('front.layout', ['page' => 'home'])->with([]);
    (new SeoComposer())->compose($view);
    $data = $view->getData();

    expect($data)->toHaveKeys(['seoTitle', 'seoDescription', 'seoAlternates', 'seoJsonLd']);

    $org = $data['seoJsonLd']['@graph'][0];
    expect($org['@type'])->toBe('ProfessionalService');
    expect($org)->toHaveKey('hasCredential');
    expect($org['hasCredential']['recognizedBy']['name'])->toContain('Ministry of Industry');
});
