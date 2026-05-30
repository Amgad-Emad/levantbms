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

<!-- Stats strip -->
<section class="py-10 bg-white dark:bg-navy-800 border-b border-ink/10 dark:border-white/10">
  <div class="max-w-container mx-auto px-5 sm:px-10 grid grid-cols-2 lg:grid-cols-4 gap-8 reveal">
    @foreach ([1,2,3,4] as $n)
      <div>
        <div class="font-display font-bold text-[clamp(28px,3.4vw,44px)] leading-none text-orange-500">{{ __('front.about.stat'.$n.'.n') }}<span class="text-ink dark:text-cream">{{ __('front.about.stat'.$n.'.unit') }}</span></div>
        <div class="mt-2 text-sm text-mute dark:text-cream/60 leading-snug">{{ __('front.about.stat'.$n.'.l') }}</div>
      </div>
    @endforeach
  </div>
</section>

<!-- Story: About / Think advice / Think growth -->
<section class="py-20 md:py-28">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="grid lg:grid-cols-2 gap-16 items-start">
      @php $harbour = \App\Models\PageImage::url('about', 'harbour'); @endphp
      <div class="reveal">
        @if ($harbour)
          <div class="aspect-[4/5] rounded-2xl sticky top-28 bg-cover bg-center" style="background-image:url('{{ $harbour }}')"></div>
        @else
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
            <span class="ph-label absolute bottom-6 start-6">Bahrain Financial Harbour · Level 2</span>
          </div>
        @endif
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

<!-- Why clients choose us -->
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

<!-- Ministry of Industry & Commerce services -->
<section class="py-20 md:py-28">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="grid lg:grid-cols-[1fr_1.4fr] gap-12 items-end mb-12">
      <div>
        <div class="eyebrow mb-6 reveal">{{ __('front.about.moicEyebrow') }}</div>
        <h2 class="font-display font-medium text-[clamp(30px,3.6vw,48px)] leading-[1.05] tracking-tight reveal delay-1">{{ __('front.about.moicTitle') }}</h2>
      </div>
      <div class="reveal delay-2">
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-500/10 text-orange-600 dark:text-orange-400 border border-orange-500/30 font-mono text-xs tracking-[.12em] uppercase">
          <span class="w-2 h-2 rounded-full bg-orange-500"></span> مكتب معتمد · Approved Office
        </span>
      </div>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-1 reveal">
      @foreach ((array) __('front.about.moicServices') as $svc)
        <div class="flex items-start gap-3 py-3.5 border-b border-ink/10 dark:border-white/10">
          <span class="text-orange-500 mt-0.5 shrink-0">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
          </span>
          <span class="text-sm text-ink2 dark:text-cream/80 leading-snug">{{ $svc }}</span>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Corporate services + CBB -->
<section class="py-20 md:py-28 bg-white dark:bg-navy-800 border-y border-ink/10 dark:border-white/10">
  <div class="max-w-container mx-auto px-5 sm:px-10 grid lg:grid-cols-2 gap-16">
    <div class="reveal">
      <div class="eyebrow mb-6">{{ __('front.about.corpEyebrow') }}</div>
      <h2 class="font-display font-medium text-[clamp(28px,3.2vw,40px)] tracking-tight mb-8">{{ __('front.about.corpTitle') }}</h2>
      <ul class="flex flex-col">
        @foreach ((array) __('front.about.corpServices') as $i => $svc)
          <li class="flex gap-3.5 items-baseline py-3 border-b border-ink/10 dark:border-white/10">
            <span class="font-mono text-[10px] text-orange-500 tracking-[.14em] shrink-0">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
            <span class="text-sm text-ink2 dark:text-cream/80 leading-snug">{{ $svc }}</span>
          </li>
        @endforeach
      </ul>
    </div>
    <div class="reveal delay-1">
      <div class="eyebrow mb-6">{{ __('front.about.cbbEyebrow') }}</div>
      <h2 class="font-display font-medium text-[clamp(28px,3.2vw,40px)] tracking-tight mb-5">{{ __('front.about.cbbTitle') }}</h2>
      <p class="text-mute dark:text-cream/60 leading-relaxed mb-8">{{ __('front.about.cbbIntro') }}</p>
      <div class="flex flex-wrap gap-2.5">
        @foreach ((array) __('front.about.cbbServices') as $svc)
          <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 text-sm font-medium">
            <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>{{ $svc }}
          </span>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- Objective, mission & vision -->
<section class="py-20 md:py-28">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="eyebrow mb-10 reveal">{{ __('front.about.missionEyebrow') }}</div>
    <div class="grid md:grid-cols-2 gap-6 reveal delay-1">
      <div class="bg-gradient-to-br from-navy-800 to-navy-600 dark:from-navy-700 dark:to-navy-900 text-cream rounded-2xl p-9 md:p-12">
        <div class="font-mono text-[11px] tracking-[.18em] uppercase text-orange-400 mb-4">Objective</div>
        <p class="font-display font-medium text-xl md:text-2xl leading-snug">{{ __('front.about.objective') }}</p>
      </div>
      <div class="bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 rounded-2xl p-9 md:p-12">
        <div class="font-mono text-[11px] tracking-[.18em] uppercase text-orange-500 mb-4">Mission &amp; vision</div>
        <p class="font-display font-medium text-xl md:text-2xl leading-snug text-ink dark:text-cream">{{ __('front.about.mission') }}</p>
      </div>
    </div>
  </div>
</section>

<!-- Leadership -->
<section class="py-20 md:py-28 bg-white dark:bg-navy-800 border-y border-ink/10 dark:border-white/10">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="grid lg:grid-cols-[1fr_1.4fr] gap-16 mb-12 items-end">
      <div>
        <div class="eyebrow mb-6 reveal">{{ __('front.about.teamEyebrow') }}</div>
        <h2 class="font-display font-medium text-[clamp(32px,4vw,56px)] leading-[1.05] tracking-tight reveal delay-1">{{ __('front.about.teamTitle') }}</h2>
      </div>
      <p class="text-lg text-mute dark:text-cream/60 reveal delay-2">{{ __('front.about.teamSub') }}</p>
    </div>
    <div class="grid lg:grid-cols-[0.8fr_1.2fr] gap-10 items-start reveal">
      @php $mdPortrait = \App\Models\PageImage::url('about', 'md_portrait'); @endphp
      <div class="bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 rounded-2xl overflow-hidden">
        @if ($mdPortrait)
          <div class="aspect-[4/5] bg-cover bg-center" style="background-image:url('{{ $mdPortrait }}')"></div>
        @else
          <div class="img-ph aspect-[4/5]"><span class="ph-label">Managing Director</span></div>
        @endif
        <div class="p-6">
          <h4 class="font-display font-semibold text-lg">{{ __('front.about.mdName') }}</h4>
          <div class="text-sm text-mute dark:text-cream/60">{{ __('front.about.mdTitle') }}</div>
          <div class="font-mono text-[11px] tracking-[.1em] text-orange-500 mt-1">{{ __('front.about.mdRole') }}</div>
        </div>
      </div>
      <div>
        <p class="text-lg leading-relaxed text-ink2 dark:text-cream/80 mb-6">{{ __('front.about.mdBio') }}</p>
        <ul class="grid sm:grid-cols-2 gap-3 mb-8">
          @foreach ((array) __('front.about.mdCreds') as $cred)
            <li class="flex items-start gap-3 bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 rounded-xl p-4">
              <span class="text-orange-500 mt-0.5 shrink-0">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              </span>
              <span class="text-sm text-ink2 dark:text-cream/80 leading-snug">{{ $cred }}</span>
            </li>
          @endforeach
        </ul>
        <p class="text-base leading-relaxed text-ink2 dark:text-cream/80 ps-4 border-s-2 border-orange-500">{{ __('front.about.mdFocus') }}</p>
      </div>
    </div>

    {{-- Areas of legal expertise --}}
    @php $expertise = (array) __('front.about.mdExpertise'); @endphp
    @if (!empty($expertise))
      <div class="mt-20">
        <div class="eyebrow mb-4 reveal">{{ __('front.about.mdExpertiseEyebrow') }}</div>
        <h3 class="font-display font-medium text-[clamp(26px,3vw,38px)] tracking-tight max-w-[640px] mb-10 reveal delay-1">{{ __('front.about.mdExpertiseTitle') }}</h3>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 reveal">
          @foreach ($expertise as $i => $area)
            <div class="bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 rounded-2xl p-6 flex flex-col gap-3">
              <div class="flex items-center gap-2.5">
                <span class="font-mono text-[11px] tracking-[.16em] text-orange-500">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <h4 class="font-display font-semibold text-base tracking-tight">{{ $area['t'] ?? '' }}</h4>
              </div>
              <p class="text-sm leading-relaxed text-mute dark:text-cream/60">{{ $area['d'] ?? '' }}</p>
            </div>
          @endforeach
        </div>
      </div>
    @endif

    {{-- Setup process (rendered only when filled in the CMS) --}}
    @php
      $moicBody = __('front.about.processMoicBody');
      $cbbBody  = __('front.about.processCbbBody');
    @endphp
    @if (filled($moicBody) || filled($cbbBody))
      <div class="mt-20">
        <div class="eyebrow mb-8 reveal">{{ __('front.about.processEyebrow') }}</div>
        <div class="grid md:grid-cols-2 gap-6 reveal delay-1">
          @if (filled($moicBody))
            <div class="bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 rounded-2xl p-8">
              <h4 class="font-display font-semibold text-xl tracking-tight mb-4">{{ __('front.about.processMoicTitle') }}</h4>
              <div class="text-ink2 dark:text-cream/80 leading-relaxed whitespace-pre-line">{{ $moicBody }}</div>
            </div>
          @endif
          @if (filled($cbbBody))
            <div class="bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 rounded-2xl p-8">
              <h4 class="font-display font-semibold text-xl tracking-tight mb-4">{{ __('front.about.processCbbTitle') }}</h4>
              <div class="text-ink2 dark:text-cream/80 leading-relaxed whitespace-pre-line">{{ $cbbBody }}</div>
            </div>
          @endif
        </div>
      </div>
    @endif
  </div>
</section>

<!-- Recently registered companies -->
<section class="py-20 md:py-28">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="mb-10">
      <div class="eyebrow mb-6 reveal">{{ __('front.about.companiesEyebrow') }}</div>
      <h2 class="font-display font-medium text-[clamp(30px,3.6vw,48px)] leading-[1.05] tracking-tight reveal delay-1">{{ __('front.about.companiesTitle') }}</h2>
      <p class="mt-5 max-w-[640px] text-lg text-mute dark:text-cream/60 reveal delay-2">{{ __('front.about.companiesSub') }}</p>
    </div>
    <div class="flex flex-wrap gap-2.5 reveal">
      @foreach ((array) __('front.about.companies') as $company)
        <span class="inline-flex items-center px-3.5 py-2 rounded-full bg-white dark:bg-navy-700 border border-ink/10 dark:border-white/10 text-[12.5px] font-medium text-ink2 dark:text-cream/80 hover:border-orange-500 hover:text-orange-500 transition">{{ $company }}</span>
      @endforeach
    </div>
  </div>
</section>

@include('front.partials.final-cta')
@endsection
