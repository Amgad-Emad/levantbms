@extends('front.layout', ['page' => 'gallery'])

@section('title', __('front.gallery.crumb').' · LevantBMS')

@php
    $cats = [
        ['key' => 'all',     'i18n' => 'gallery.catAll',     'active' => true],
        ['key' => 'Office',  'i18n' => 'gallery.catOffice'],
        ['key' => 'Events',  'i18n' => 'gallery.catEvents'],
        ['key' => 'Team',    'i18n' => 'gallery.catTeam'],
        ['key' => 'Bahrain', 'i18n' => 'gallery.catBahrain'],
    ];
    $items = [
        ['tag' => 'Office',  'label' => 'Reception, 2nd floor',     'ratio' => '3/4'],
        ['tag' => 'Bahrain', 'label' => 'Financial Harbour, dusk',  'ratio' => '4/3'],
        ['tag' => 'Events',  'label' => 'MOIC seminar, 2024',       'ratio' => '1/1'],
        ['tag' => 'Team',    'label' => 'Senior partners',          'ratio' => '3/4'],
        ['tag' => 'Office',  'label' => 'Boardroom',                'ratio' => '4/3'],
        ['tag' => 'Bahrain', 'label' => 'Harbour Gate entrance',    'ratio' => '1/1'],
        ['tag' => 'Events',  'label' => 'Client appreciation evening', 'ratio' => '3/4'],
        ['tag' => 'Team',    'label' => 'Consulting floor',         'ratio' => '4/3'],
        ['tag' => 'Bahrain', 'label' => 'Manama skyline',           'ratio' => '1/1'],
    ];
@endphp

@section('content')
<section class="relative overflow-hidden pt-28 pb-20 bg-white dark:bg-navy-800 border-b border-ink/10 dark:border-white/10">
  <div class="absolute bottom-0 inset-x-0 h-3/5 dotgrid text-mute" style="mask-image:linear-gradient(180deg,transparent,#000);-webkit-mask-image:linear-gradient(180deg,transparent,#000);" aria-hidden="true"></div>
  <div class="absolute top-0 end-0 w-56 h-56 stripe-motif" style="mask-image:linear-gradient(225deg,#000,transparent 70%);-webkit-mask-image:linear-gradient(225deg,#000,transparent 70%);" aria-hidden="true"></div>
  <div class="relative max-w-container mx-auto px-5 sm:px-10">
    <div class="font-mono text-[11px] tracking-[.16em] uppercase text-mute mb-5"><a href="{{ route('front.home') }}" class="hover:text-orange-500">{{ __('front.c.home') }}</a> / <span class="text-orange-500">{{ __('front.gallery.crumb') }}</span></div>
    <h1 class="font-display font-medium text-[clamp(40px,6.4vw,84px)] leading-[1.02] tracking-tight max-w-[900px] reveal in">{{ __('front.gallery.h1') }}</h1>
    <p class="mt-6 max-w-[680px] text-lg text-mute dark:text-cream/60 reveal in delay-1">{{ __('front.gallery.sub') }}</p>
  </div>
</section>

<section class="py-12 md:py-16">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="flex flex-wrap gap-2 mb-12 pb-6 border-b border-ink/10 dark:border-white/10 reveal in">
      @foreach ($cats as $cat)
        <button data-gallery-cat="{{ $cat['key'] }}" @if(!empty($cat['active'])) data-active="true" @endif class="px-5 py-2.5 rounded-full text-sm font-medium border border-ink/15 dark:border-white/15 data-[active=true]:bg-orange-500 data-[active=true]:border-orange-500 data-[active=true]:text-white text-ink2 dark:text-cream/80 transition">{{ __('front.'.$cat['i18n']) }}</button>
      @endforeach
    </div>
    <div data-gallery-grid class="grid grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($items as $item)
        <div data-tag="{{ $item['tag'] }}" class="reveal">
          <div class="img-ph rounded-2xl cursor-pointer transition hover:scale-[1.02]" style="aspect-ratio:{{ $item['ratio'] }}">
            <span class="ph-label">{{ $item['label'] }}</span>
            <div class="absolute bottom-3 start-3"><span class="px-3 py-1 rounded-full bg-black/40 backdrop-blur text-white text-[10px] font-mono tracking-[.18em] uppercase">{{ $item['tag'] }}</span></div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

@include('front.partials.final-cta')
@endsection
