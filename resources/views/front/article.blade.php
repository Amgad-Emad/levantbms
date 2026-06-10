@extends('front.layout', ['page' => 'blog'])

@php
    $catLabel = isset($catKeys[$post->category]) ? __('front.'.$catKeys[$post->category]) : $post->category;
@endphp

@section('title', $post->title.' · LevantBMS')
@section('meta_description', $post->excerpt)

@push('head')
<style>
  .article-body { font-size: 1.125rem; line-height: 1.75; overflow-wrap: break-word; word-wrap: break-word; }
  .article-body p { margin-bottom: 1.25rem; }
  .article-body img { max-width: 100%; height: auto; border-radius: 12px; }
  .article-body h2, .article-body h3 { font-family: 'Tajawal', sans-serif; font-weight: 600; letter-spacing: -.01em; margin: 2.25rem 0 1.1rem; line-height: 1.2; }
  .article-body h2 { font-size: 1.75rem; }
  .article-body h3 { font-size: 1.4rem; }
  .article-body ul, .article-body ol { margin: 0 0 1.25rem 1.25rem; }
  .article-body li { margin-bottom: .4rem; }
  .article-body blockquote { margin: 2rem 0; padding-inline-start: 1.5rem; border-inline-start: 3px solid #F58220; font-family: 'Fraunces', serif; font-style: italic; font-weight: 300; font-size: 1.5rem; line-height: 1.4; }
  .article-body a { color: #F58220; text-decoration: underline; }
  /* Let wide tables scroll inside the article instead of stretching the whole page on mobile */
  .article-body table { display: block; width: 100%; max-width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; border-collapse: collapse; margin: 1.5rem 0; font-size: .95rem; }
  .article-body th, .article-body td { border: 1px solid rgba(10,18,36,.12); padding: .6rem .85rem; text-align: start; vertical-align: top; }
  .article-body thead th { background: rgba(31,66,117,.06); font-family: 'Tajawal', sans-serif; font-weight: 600; font-size: .8rem; text-transform: uppercase; letter-spacing: .04em; }
  .dark .article-body th, .dark .article-body td { border-color: rgba(255,255,255,.14); }
  .dark .article-body thead th { background: rgba(255,255,255,.06); }
  .article-body h2:first-child, .article-body h3:first-child { margin-top: 0; }
</style>
@endpush

@section('content')
<section class="pt-28 pb-12">
  <div class="max-w-[820px] mx-auto px-5 sm:px-10">
    <div class="font-mono text-[11px] tracking-[.16em] uppercase text-mute mb-8 reveal in"><a href="{{ route('front.blog') }}" class="hover:text-orange-500">{{ __('front.blog.crumb') }}</a> / <span class="text-orange-500">{{ $catLabel }}</span></div>
    <h1 class="font-display font-medium text-[clamp(36px,5vw,60px)] leading-[1.05] tracking-tight mb-8 reveal in delay-1">{{ $post->title }}</h1>
    <div class="flex flex-wrap gap-4 items-center pb-8 border-b border-ink/10 dark:border-white/10 font-mono text-xs text-mute tracking-wider reveal in delay-2">
      <span>{{ __('front.article.author') }}</span><span>·</span><span>{{ optional($post->published_at)->translatedFormat('F j, Y') }}</span><span>·</span><span>{{ $post->read_minutes }} {{ __('front.c.minread') }}</span>
    </div>
  </div>
</section>

<section class="pb-12">
  <div class="max-w-[1100px] mx-auto px-5 sm:px-10">
    @if ($post->coverUrl())
      <div class="aspect-[16/8] rounded-2xl bg-cover bg-center reveal" style="background-image:url('{{ $post->coverUrl() }}')"></div>
    @else
      <div class="img-ph aspect-[16/8] rounded-2xl reveal"><span class="ph-label">cover · {{ $catLabel }}</span></div>
    @endif
  </div>
</section>

<section class="pb-20">
  <div class="max-w-[720px] mx-auto px-5 sm:px-10">
    <div class="article-body reveal text-ink2 dark:text-cream/80">
      {!! $post->body !!}
    </div>
  </div>
</section>

<section class="py-12 md:py-16 border-t border-ink/10 dark:border-white/10">
  <div class="max-w-container mx-auto px-5 sm:px-10 flex flex-wrap justify-between items-center gap-6">
    <a href="{{ route('front.blog') }}" class="btn-link inline-flex items-center gap-2 px-6 py-3.5 rounded-full border border-ink/15 dark:border-white/20 hover:border-orange-500 hover:text-orange-500 font-semibold text-sm transition">{{ __('front.article.allArticles') }}</a>
    <a href="{{ route('front.contact') }}" class="btn-link inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm transition"><span>{{ __('front.article.cta') }}</span><span class="btn-arrow">→</span></a>
  </div>
</section>
@endsection
