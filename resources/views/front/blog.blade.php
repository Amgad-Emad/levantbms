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
    // Posts come from the database (App\Models\Post via Front\BlogController).
    // $featured, $posts and $catKeys are injected by the controller.
    $catLabel = fn ($cat) => isset($catKeys[$cat]) ? __('front.'.$catKeys[$cat]) : $cat;
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
    @if ($featured)
    <a href="{{ route('front.article', ['slug' => $featured->slug]) }}" data-bcat="{{ $featured->category }}" class="reveal in grid lg:grid-cols-[1.2fr_1fr] gap-12 items-center cursor-pointer mb-20 group">
      @if ($featured->coverUrl())
        <div class="aspect-[4/3] rounded-2xl bg-cover bg-center overflow-hidden" style="background-image:url('{{ $featured->coverUrl() }}')"></div>
      @else
        <div class="img-ph aspect-[4/3] rounded-2xl"><span class="ph-label">featured · {{ $catLabel($featured->category) }}</span></div>
      @endif
      <div>
        <div class="eyebrow mb-4"><span>{{ __('front.blog.latest') }}</span> · {{ $catLabel($featured->category) }}</div>
        <h2 class="font-display font-medium text-[clamp(28px,3.6vw,44px)] tracking-tight leading-tight mb-5 group-hover:text-orange-500 transition">{{ $featured->title }}</h2>
        <p class="text-lg text-mute dark:text-cream/60 leading-relaxed mb-6">{{ $featured->excerpt }}</p>
        <div class="flex gap-3.5 items-center font-mono text-xs text-mute tracking-wider"><span>{{ optional($featured->published_at)->translatedFormat('F j, Y') }}</span><span>·</span><span>{{ $featured->read_minutes }} {{ __('front.c.minread') }}</span></div>
        <button class="btn-link inline-flex items-center gap-2.5 mt-6 px-6 py-3.5 rounded-full bg-navy-800 dark:bg-orange-500 hover:bg-navy-700 dark:hover:bg-orange-600 text-cream dark:text-navy-900 font-semibold text-sm transition"><span>{{ __('front.c.readMore') }}</span><span class="btn-arrow">→</span></button>
      </div>
    </a>
    @endif

    <div data-blog-grid class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 reveal">
      @foreach ($posts as $post)
        <a href="{{ route('front.article', ['slug' => $post->slug]) }}" data-bcat="{{ $post->category }}" class="bg-white dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-2xl overflow-hidden hover:border-orange-500 transition group">
          @if ($post->coverUrl('thumb'))
            <div class="aspect-[4/3] bg-cover bg-center" style="background-image:url('{{ $post->coverUrl('thumb') }}')"></div>
          @else
            <div class="img-ph aspect-[4/3]"><span class="ph-label">{{ $catLabel($post->category) }}</span></div>
          @endif
          <div class="p-7">
            <div class="flex gap-2.5 items-center font-mono text-xs text-mute tracking-wider mb-3.5"><span class="text-orange-500">{{ $catLabel($post->category) }}</span><span>·</span><span>{{ $post->read_minutes }} {{ __('front.c.minread') }}</span></div>
            <h3 class="font-display font-semibold text-xl tracking-tight leading-snug mb-3.5 group-hover:text-orange-500 transition">{{ $post->title }}</h3>
            <p class="text-sm text-mute dark:text-cream/60 leading-relaxed">{{ $post->excerpt }}</p>
            <div class="mt-4 font-mono text-xs text-mute tracking-wider">{{ optional($post->published_at)->translatedFormat('F j, Y') }}</div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endsection
