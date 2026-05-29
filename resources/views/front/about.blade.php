@extends('front.layout', ['page' => 'about'])

@section('title', __('front.about.crumb').' · LevantBMS')

@section('content')
<section class="relative overflow-hidden pt-28 pb-20 bg-white dark:bg-navy-800 border-b border-ink/10 dark:border-white/10">
  <div class="absolute bottom-0 inset-x-0 h-3/5 dotgrid text-mute" style="mask-image:linear-gradient(180deg,transparent,#000);-webkit-mask-image:linear-gradient(180deg,transparent,#000);" aria-hidden="true"></div>
  <div class="absolute top-0 end-0 w-56 h-56 stripe-motif" style="mask-image:linear-gradient(225deg,#000,transparent 70%);-webkit-mask-image:linear-gradient(225deg,#000,transparent 70%);" aria-hidden="true"></div>
  <div class="relative max-w-container mx-auto px-5 sm:px-10">
    <div class="font-mono text-[11px] tracking-[.16em] uppercase text-mute mb-5"><a href="{{ route('front.home') }}" class="hover:text-orange-500">{{ __('front.c.home') }}</a> / <span class="text-orange-500">{{ __('front.about.crumb') }}</span></div>
    <h1 class="font-display font-medium text-[clamp(40px,6.4vw,84px)] leading-[1.02] tracking-tight max-w-[900px] reveal in">{{ __('front.about.h1') }}</h1>
    <p class="mt-6 max-w-[680px] text-lg text-mute dark:text-cream/60 reveal in delay-1">{{ __('front.about.sub') }}</p>
  </div>
</section>

<section class="py-20 md:py-28">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="grid lg:grid-cols-2 gap-16 items-start">
      <div class="reveal">
        <div class="img-ph aspect-[4/5] rounded-2xl sticky top-28">
          <svg viewBox="0 0 1200 1500" preserveAspectRatio="xMidYMid slice" class="absolute inset-0 w-full h-full" aria-hidden="true">
            <defs><linearGradient id="ab-sky" x1="0" x2="0" y1="0" y2="1"><stop offset="0%" stop-color="#06182F"/><stop offset="100%" stop-color="#14315A"/></linearGradient></defs>
            <rect width="1200" height="1500" fill="url(#ab-sky)"/>
            <g fill="rgba(10,18,36,.55)" stroke="rgba(255,255,255,.12)">
              <rect x="60" y="800" width="80" height="700"/><rect x="150" y="700" width="60" height="800"/>
              <rect x="220" y="600" width="100" height="900"/><rect x="330" y="500" width="70" height="1000"/>
              <rect x="410" y="650" width="90" height="850"/><rect x="710" y="450" width="80" height="1050"/>
              <rect x="800" y="600" width="70" height="900"/><rect x="880" y="350" width="100" height="1150"/>
              <rect x="990" y="600" width="70" height="900"/><rect x="1070" y="700" width="80" height="800"/>
            </g>
          </svg>
          <span class="ph-label absolute bottom-6 start-6">Bahrain Financial Harbour · dusk</span>
        </div>
      </div>
      <div class="flex flex-col gap-12">
        @foreach ([1,2,3] as $n)
          @php $delay = ($n - 1) * 0.08; @endphp
          <div class="reveal" style="transition-delay:{{ $delay }}s">
            <div class="flex items-center gap-3 mb-3">
              <span class="font-serif italic font-light text-4xl text-orange-500">{{ str_pad($n, 2, '0', STR_PAD_LEFT) }}</span>
              <h3 class="font-display font-semibold text-2xl tracking-tight">{{ __('front.about.s'.$n.'t') }}</h3>
            </div>
            <p class="text-lg leading-relaxed text-ink2 dark:text-cream/80">{{ __('front.about.s'.$n.'b') }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<section class="py-20 md:py-28 bg-white dark:bg-navy-800 border-y border-ink/10 dark:border-white/10">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="eyebrow mb-6 reveal">{{ __('front.about.valuesEyebrow') }}</div>
    <h2 class="font-display font-medium text-[clamp(32px,4vw,56px)] leading-[1.05] tracking-tight max-w-[680px] mb-16 reveal delay-1">{{ __('front.about.valuesTitle') }}</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 reveal">
      @foreach ([1,2,3,4] as $n)
        <div class="relative overflow-hidden bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 rounded-2xl p-7 flex flex-col gap-4 min-h-[220px]">
          <div class="font-mono text-[11px] tracking-[.18em] text-orange-500">{{ str_pad($n, 2, '0', STR_PAD_LEFT) }}</div>
          <h4 class="font-display font-semibold text-xl tracking-tight">{{ __('front.val'.$n.'.t') }}</h4>
          <p class="text-sm leading-relaxed text-mute dark:text-cream/60 mt-auto">{{ __('front.val'.$n.'.d') }}</p>
          <div class="stripe-motif absolute -bottom-7 -end-7 w-20 h-20" style="mask-image:radial-gradient(circle,#000,transparent 70%);-webkit-mask-image:radial-gradient(circle,#000,transparent 70%);opacity:.12" aria-hidden="true"></div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="py-20 md:py-28">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="grid lg:grid-cols-[1fr_1.4fr] gap-16 mb-12 items-end">
      <div>
        <div class="eyebrow mb-6 reveal">{{ __('front.about.teamEyebrow') }}</div>
        <h2 class="font-display font-medium text-[clamp(32px,4vw,56px)] leading-[1.05] tracking-tight reveal delay-1">{{ __('front.about.teamTitle') }}</h2>
      </div>
      <p class="text-lg text-mute dark:text-cream/60 reveal delay-2">{{ __('front.about.teamSub') }}</p>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 reveal">
      @foreach ([1,2,3,4] as $n)
        <div class="bg-white dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-2xl overflow-hidden">
          <div class="img-ph aspect-[3/4]"><span class="ph-label">portrait</span></div>
          <div class="p-5">
            <h4 class="font-display font-semibold text-base mb-1">{{ __('front.tm'.$n.'.n') }}</h4>
            <div class="text-sm text-mute dark:text-cream/60 mb-2">{{ __('front.tm'.$n.'.r') }}</div>
            <div class="font-mono text-[11px] tracking-[.1em] text-orange-500">{{ __('front.tm'.$n.'.y') }}</div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

@include('front.partials.final-cta')
@endsection
