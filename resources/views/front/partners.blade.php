@extends('front.layout', ['page' => 'partners'])

@section('title', __('front.partners.crumb').' · LevantBMS')

@section('content')
<section class="relative overflow-hidden pt-28 pb-20 bg-white dark:bg-navy-800 border-b border-ink/10 dark:border-white/10">
  <div class="absolute bottom-0 inset-x-0 h-3/5 dotgrid text-mute" style="mask-image:linear-gradient(180deg,transparent,#000);-webkit-mask-image:linear-gradient(180deg,transparent,#000);" aria-hidden="true"></div>
  <div class="absolute top-0 end-0 w-56 h-56 stripe-motif" style="mask-image:linear-gradient(225deg,#000,transparent 70%);-webkit-mask-image:linear-gradient(225deg,#000,transparent 70%);" aria-hidden="true"></div>
  <div class="relative max-w-container mx-auto px-5 sm:px-10">
    <div class="font-mono text-[11px] tracking-[.16em] uppercase text-mute mb-5"><a href="{{ route('front.home') }}" class="hover:text-orange-500">{{ __('front.c.home') }}</a> / <span class="text-orange-500">{{ __('front.partners.crumb') }}</span></div>
    <h1 class="font-display font-medium text-[clamp(40px,6.4vw,84px)] leading-[1.02] tracking-tight max-w-[900px] reveal in">{{ __('front.partners.h1') }}</h1>
    <p class="mt-6 max-w-[680px] text-lg text-mute dark:text-cream/60 reveal in delay-1">{{ __('front.partners.sub') }}</p>
  </div>
</section>

<section class="py-12 md:py-16">
  <div class="max-w-container mx-auto px-5 sm:px-10 flex flex-col gap-12">
    @foreach ($partners as $partner)
      @php $reversed = $loop->odd; @endphp
      <div class="grid lg:grid-cols-2 gap-12 items-center py-12 reveal @unless($loop->first) border-t border-ink/10 dark:border-white/10 @endunless">
        @php
          $media = '<div class="'.($partner->logoUrl() ? 'bg-cover bg-center' : 'img-ph').' aspect-[4/3] rounded-2xl" style="'.($partner->logoUrl() ? "background-image:url('".$partner->logoUrl()."');background-size:contain;background-repeat:no-repeat;" : '').'">'.($partner->logoUrl() ? '' : '<span class="ph-label">'.e($partner->name).' · brand asset</span>').'</div>';
          $text = '';
        @endphp
        @if ($reversed)
          <div class="order-2 lg:order-1">@include('front.partials.partner-text', ['partner' => $partner])</div>
          <div class="order-1 lg:order-2">{!! $media !!}</div>
        @else
          <div>{!! $media !!}</div>
          <div>@include('front.partials.partner-text', ['partner' => $partner])</div>
        @endif
      </div>
    @endforeach
  </div>
</section>

<section class="py-12 md:py-16 bg-navy-800 dark:bg-navy-900 text-cream">
  <div class="max-w-container mx-auto px-5 sm:px-10 flex flex-wrap justify-between items-center gap-6">
    <div>
      <h3 class="font-display font-medium text-2xl md:text-3xl text-white mb-2">{{ __('front.partners.findPartner') }}</h3>
      <p class="text-cream/70 max-w-[520px]">{{ __('front.partners.findPartnerSub') }}</p>
    </div>
    <a href="{{ route('front.contact') }}" class="btn-link inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm transition"><span>{{ __('front.partners.cta') }}</span><span class="btn-arrow">→</span></a>
  </div>
</section>
@endsection
