@extends('front.layout', ['page' => 'blog'])

@section('title', __('front.blog.crumb').' · LevantBMS')

@php
    $cats = [
        ['key' => 'all',           'i18n' => 'blog.allCats',   'active' => true],
        ['key' => 'Company Setup', 'i18n' => 'blog.catSetup'],
        ['key' => 'Investment',    'i18n' => 'blog.catInvest'],
        ['key' => 'Regulation',    'i18n' => 'blog.catReg'],
        ['key' => 'Guides',        'i18n' => 'blog.catGuides'],
    ];
    // Post structure (slug, category, read time). Title / excerpt / date come from lang/<locale>/front.php (front.posts.<slug>.*)
    $featured = [
        'slug'   => 'top-business-management-consultancy-bahrain',
        'cat'    => 'Guides',
        'catKey' => 'blog.catGuides',
        'read'   => 8,
    ];
    $posts = [
        ['slug' => 'how-to-invest-in-bahrain-2025',            'cat' => 'Investment',    'catKey' => 'blog.catInvest', 'read' => 11],
        ['slug' => 'how-to-incorporate-a-company-bahrain-2025', 'cat' => 'Company Setup', 'catKey' => 'blog.catSetup',  'read' => 9],
        ['slug' => 'how-to-start-a-business-in-bahrain-2025',  'cat' => 'Company Setup', 'catKey' => 'blog.catSetup',  'read' => 12],
        ['slug' => 'company-setup-bahrain-steps-costs',        'cat' => 'Company Setup', 'catKey' => 'blog.catSetup',  'read' => 7],
        ['slug' => 'company-registration-bahrain-requirements','cat' => 'Regulation',    'catKey' => 'blog.catReg',    'read' => 10],
    ];
@endphp

@section('content')
<section class="relative overflow-hidden pt-28 pb-20 bg-white dark:bg-navy-800 border-b border-ink/10 dark:border-white/10">
  <div class="absolute bottom-0 inset-x-0 h-3/5 dotgrid text-mute" style="mask-image:linear-gradient(180deg,transparent,#000);-webkit-mask-image:linear-gradient(180deg,transparent,#000);" aria-hidden="true"></div>
  <div class="absolute top-0 end-0 w-56 h-56 stripe-motif" style="mask-image:linear-gradient(225deg,#000,transparent 70%);-webkit-mask-image:linear-gradient(225deg,#000,transparent 70%);" aria-hidden="true"></div>
  <div class="relative max-w-container mx-auto px-5 sm:px-10">
    <div class="font-mono text-[11px] tracking-[.16em] uppercase text-mute mb-5"><a href="{{ route('front.home') }}" class="hover:text-orange-500">{{ __('front.c.home') }}</a> / <span class="text-orange-500">{{ __('front.blog.crumb') }}</span></div>
    <h1 class="font-display font-medium text-[clamp(40px,6.4vw,84px)] leading-[1.02] tracking-tight max-w-[900px] reveal in">{{ __('front.blog.h1') }}</h1>
    <p class="mt-6 max-w-[680px] text-lg text-mute dark:text-cream/60 reveal in delay-1">{{ __('front.blog.sub') }}</p>
  </div>
</section>

<section class="py-10 border-b border-ink/10 dark:border-white/10">
  <div class="max-w-container mx-auto px-5 sm:px-10 flex flex-wrap gap-2">
    @foreach ($cats as $cat)
      <button data-blog-cat="{{ $cat['key'] }}" @if(!empty($cat['active'])) data-active="true" @endif class="px-5 py-2.5 rounded-full text-sm font-medium border border-ink/15 dark:border-white/15 data-[active=true]:bg-orange-500 data-[active=true]:border-orange-500 data-[active=true]:text-white text-ink2 dark:text-cream/80 transition">{{ __('front.'.$cat['i18n']) }}</button>
    @endforeach
  </div>
</section>

<section class="py-20 md:py-28">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <a href="{{ route('front.article', ['slug' => $featured['slug']]) }}" data-bcat="{{ $featured['cat'] }}" class="reveal in grid lg:grid-cols-[1.2fr_1fr] gap-12 items-center cursor-pointer mb-20 group">
      <div class="img-ph aspect-[4/3] rounded-2xl"><span class="ph-label">featured · {{ __('front.'.$featured['catKey']) }}</span></div>
      <div>
        <div class="eyebrow mb-4"><span>{{ __('front.blog.latest') }}</span> · {{ __('front.'.$featured['catKey']) }}</div>
        <h2 class="font-display font-medium text-[clamp(28px,3.6vw,44px)] tracking-tight leading-tight mb-5 group-hover:text-orange-500 transition">{{ __('front.posts.'.$featured['slug'].'.title') }}</h2>
        <p class="text-lg text-mute dark:text-cream/60 leading-relaxed mb-6">{{ __('front.posts.'.$featured['slug'].'.desc') }}</p>
        <div class="flex gap-3.5 items-center font-mono text-xs text-mute tracking-wider"><span>{{ __('front.posts.'.$featured['slug'].'.date') }}</span><span>·</span><span>{{ $featured['read'] }} {{ __('front.c.minread') }}</span></div>
        <button class="btn-link inline-flex items-center gap-2.5 mt-6 px-6 py-3.5 rounded-full bg-navy-800 dark:bg-orange-500 hover:bg-navy-700 dark:hover:bg-orange-600 text-cream dark:text-navy-900 font-semibold text-sm transition"><span>{{ __('front.c.readMore') }}</span><span class="btn-arrow">→</span></button>
      </div>
    </a>

    <div data-blog-grid class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 reveal">
      @foreach ($posts as $post)
        <a href="{{ route('front.article', ['slug' => $post['slug']]) }}" data-bcat="{{ $post['cat'] }}" class="bg-white dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-2xl overflow-hidden hover:border-orange-500 transition group">
          <div class="img-ph aspect-[4/3]"><span class="ph-label">{{ __('front.'.$post['catKey']) }}</span></div>
          <div class="p-7">
            <div class="flex gap-2.5 items-center font-mono text-xs text-mute tracking-wider mb-3.5"><span class="text-orange-500">{{ __('front.'.$post['catKey']) }}</span><span>·</span><span>{{ $post['read'] }} {{ __('front.c.minread') }}</span></div>
            <h3 class="font-display font-semibold text-xl tracking-tight leading-snug mb-3.5 group-hover:text-orange-500 transition">{{ __('front.posts.'.$post['slug'].'.title') }}</h3>
            <p class="text-sm text-mute dark:text-cream/60 leading-relaxed">{{ __('front.posts.'.$post['slug'].'.desc') }}</p>
            <div class="mt-4 font-mono text-xs text-mute tracking-wider">{{ __('front.posts.'.$post['slug'].'.date') }}</div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endsection
