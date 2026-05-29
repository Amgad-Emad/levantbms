@extends('front.layout', ['page' => 'blog'])

@php
    // Single demo article — tied to the featured guide slug.
    $articleSlug = 'top-business-management-consultancy-bahrain';
@endphp

@section('title', __('front.posts.'.$articleSlug.'.title').' · LevantBMS')

@section('content')
<section class="pt-28 pb-12">
  <div class="max-w-[820px] mx-auto px-5 sm:px-10">
    <div class="font-mono text-[11px] tracking-[.16em] uppercase text-mute mb-8 reveal in"><a href="{{ route('front.blog') }}" class="hover:text-orange-500">{{ __('front.blog.crumb') }}</a> / <span class="text-orange-500">{{ __('front.blog.catGuides') }}</span></div>
    <h1 class="font-display font-medium text-[clamp(36px,5vw,60px)] leading-[1.05] tracking-tight mb-8 reveal in delay-1">{{ __('front.posts.'.$articleSlug.'.title') }}</h1>
    <div class="flex flex-wrap gap-4 items-center pb-8 border-b border-ink/10 dark:border-white/10 font-mono text-xs text-mute tracking-wider reveal in delay-2">
      <span>{{ __('front.article.author') }}</span><span>·</span><span>{{ __('front.posts.'.$articleSlug.'.date') }}</span><span>·</span><span>8 {{ __('front.c.minread') }}</span>
    </div>
  </div>
</section>

<section class="pb-12">
  <div class="max-w-[1100px] mx-auto px-5 sm:px-10">
    <div class="img-ph aspect-[16/8] rounded-2xl reveal"><span class="ph-label">cover · {{ __('front.blog.catGuides') }}</span></div>
  </div>
</section>

<section class="pb-20">
  <div class="max-w-[720px] mx-auto px-5 sm:px-10">
    <p class="reveal text-2xl font-serif italic font-light leading-snug pb-9 mb-9 border-b border-ink/10 dark:border-white/10 text-ink dark:text-cream">{{ __('front.article.body.lead') }}</p>
    <p class="reveal text-lg leading-[1.75] text-ink2 dark:text-cream/80 mb-5">{{ __('front.article.body.p1') }}</p>
    <h3 class="reveal font-display font-semibold text-2xl tracking-tight mt-9 mb-5">{{ __('front.article.body.h1') }}</h3>
    <p class="reveal text-lg leading-[1.75] text-ink2 dark:text-cream/80 mb-5">{{ __('front.article.body.p2') }}</p>
    <h3 class="reveal font-display font-semibold text-2xl tracking-tight mt-9 mb-5">{{ __('front.article.body.h2') }}</h3>
    <p class="reveal text-lg leading-[1.75] text-ink2 dark:text-cream/80 mb-5">{{ __('front.article.body.p3') }}</p>
    <blockquote class="reveal my-9 ps-6 border-s-[3px] border-orange-500 font-serif italic font-light text-2xl leading-snug">{{ __('front.article.body.quote') }}</blockquote>
    <h3 class="reveal font-display font-semibold text-2xl tracking-tight mt-9 mb-5">{{ __('front.article.body.h3') }}</h3>
    <p class="reveal text-lg leading-[1.75] text-ink2 dark:text-cream/80 mb-5">{{ __('front.article.body.p4') }}</p>
    <h3 class="reveal font-display font-semibold text-2xl tracking-tight mt-9 mb-5">{{ __('front.article.body.h4') }}</h3>
    <p class="reveal text-lg leading-[1.75] text-ink2 dark:text-cream/80 mb-5">{{ __('front.article.body.p5') }}</p>
  </div>
</section>

<section class="py-12 md:py-16 border-t border-ink/10 dark:border-white/10">
  <div class="max-w-container mx-auto px-5 sm:px-10 flex flex-wrap justify-between items-center gap-6">
    <a href="{{ route('front.blog') }}" class="btn-link inline-flex items-center gap-2 px-6 py-3.5 rounded-full border border-ink/15 dark:border-white/20 hover:border-orange-500 hover:text-orange-500 font-semibold text-sm transition">{{ __('front.article.allArticles') }}</a>
    <a href="{{ route('front.contact') }}" class="btn-link inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm transition"><span>{{ __('front.article.cta') }}</span><span class="btn-arrow">→</span></a>
  </div>
</section>
@endsection
