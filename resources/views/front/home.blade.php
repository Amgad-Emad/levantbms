@extends('front.layout', ['page' => 'home'])

@section('title', 'LevantBMS — Business Consultancy in Bahrain')

@section('content')
  <!-- =============== HERO =============== -->
  <section class="relative overflow-hidden pt-20 md:pt-28 pb-24 md:pb-32">
    <div class="absolute inset-0 dotgrid text-mute" style="mask-image:radial-gradient(70% 60% at 50% 30%, #000 30%, transparent 80%); -webkit-mask-image:radial-gradient(70% 60% at 50% 30%, #000 30%, transparent 80%);" aria-hidden="true"></div>
    <div class="absolute top-20 -end-10 w-60 h-60 stripe-motif" style="mask-image:linear-gradient(225deg,#000,transparent 70%); -webkit-mask-image:linear-gradient(225deg,#000,transparent 70%);" aria-hidden="true"></div>

    <div class="relative max-w-container mx-auto px-5 sm:px-10">
      <div class="grid lg:grid-cols-[1.4fr_1fr] gap-12 lg:gap-16 items-center">
        <div>
          <div class="eyebrow mb-7 reveal">{{ __('front.home.eyebrow') }}</div>
          <h1 class="font-display font-medium tracking-tight text-[clamp(40px,6.4vw,84px)] leading-[1.02] mb-7 reveal delay-1">
            <span>{{ __('front.home.h1a') }}</span>
            <span class="font-serif italic font-light text-orange-500"> {{ __('front.home.h1b') }}</span>
            <span>{{ __('front.home.h1c') }}</span>
          </h1>
          <p class="max-w-[520px] text-lg leading-relaxed text-mute dark:text-cream/60 mb-9 reveal delay-2">{{ __('front.home.sub') }}</p>
          <div class="flex flex-wrap gap-3.5 reveal delay-3">
            <a href="{{ route('front.contact') }}" class="btn-link inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm shadow-md-soft transition">
              <span>{{ __('front.home.ctaPrimary') }}</span><span class="btn-arrow">→</span>
            </a>
            <a href="{{ route('front.services') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full border border-ink/15 dark:border-white/20 hover:border-orange-500 hover:text-orange-500 font-semibold text-sm transition">
              <span>{{ __('front.home.ctaSecondary') }}</span>
            </a>
          </div>

          <div class="mt-12 pt-7 border-t border-ink/10 dark:border-white/10 flex flex-wrap gap-6 reveal delay-4">
            <div>
              <div class="font-mono text-[10px] uppercase tracking-[.18em] text-mute mb-1">{{ __('front.home.estLabel') }}</div>
              <div class="font-display font-bold text-xl">2003</div>
            </div>
            <div class="w-px bg-ink/10 dark:bg-white/10"></div>
            <div>
              <div class="font-mono text-[10px] uppercase tracking-[.18em] text-mute mb-1">{{ __('front.home.locLabel') }}</div>
              <div class="font-display font-bold text-xl">{{ __('front.home.locVal') }}</div>
            </div>
            <div class="w-px bg-ink/10 dark:bg-white/10"></div>
            <div>
              <div class="font-mono text-[10px] uppercase tracking-[.18em] text-mute mb-1">{{ __('front.home.statusLabel') }}</div>
              <div class="font-display font-bold text-xl text-orange-500">{{ __('front.home.statusVal') }}</div>
            </div>
          </div>
        </div>

        <!-- Stamp cards -->
        <div class="relative h-[520px] hidden lg:block reveal delay-2">
          <div class="absolute top-0 start-10 w-[300px] float-0 bg-white dark:bg-navy-700 border border-ink/10 dark:border-white/10 rounded-2xl p-5 shadow-md-soft">
            <div class="font-mono text-[10px] uppercase tracking-[.18em] text-orange-500 mb-1.5">{{ __('front.home.stamp1Tag') }}</div>
            <h4 class="font-display font-semibold text-base">{{ __('front.home.stamp1Title') }}</h4>
            <div class="flex justify-between mt-3 text-xs text-mute"><span>{{ __('front.home.stamp1m1') }}</span><span>{{ __('front.home.stamp1m2') }}</span></div>
            <div class="absolute -top-2 -end-2 w-4 h-4 border-2 border-orange-500 rounded-full bg-white dark:bg-navy-700"></div>
          </div>
          <div class="absolute top-40 start-32 w-[300px] float-1 bg-white dark:bg-navy-700 border border-ink/10 dark:border-white/10 rounded-2xl p-5 shadow-md-soft">
            <div class="font-mono text-[10px] uppercase tracking-[.18em] text-orange-500 mb-1.5">{{ __('front.home.stamp2Tag') }}</div>
            <h4 class="font-display font-semibold text-base">{{ __('front.home.stamp2Title') }}</h4>
            <div class="flex justify-between mt-3 text-xs text-mute"><span>{{ __('front.home.stamp2m1') }}</span><span>{{ __('front.home.stamp2m2') }}</span></div>
            <div class="absolute -top-2 -end-2 w-4 h-4 border-2 border-orange-500 rounded-full bg-white dark:bg-navy-700"></div>
          </div>
          <div class="absolute top-80 start-8 w-[300px] float-2 bg-white dark:bg-navy-700 border border-ink/10 dark:border-white/10 rounded-2xl p-5 shadow-md-soft">
            <div class="font-mono text-[10px] uppercase tracking-[.18em] text-orange-500 mb-1.5">{{ __('front.home.stamp3Tag') }}</div>
            <h4 class="font-display font-semibold text-base">{{ __('front.home.stamp3Title') }}</h4>
            <div class="flex justify-between mt-3 text-xs text-mute"><span>{{ __('front.home.stamp3m1') }}</span><span>{{ __('front.home.stamp3m2') }}</span></div>
            <div class="absolute -top-2 -end-2 w-4 h-4 border-2 border-orange-500 rounded-full bg-white dark:bg-navy-700"></div>
          </div>
          <div class="absolute top-36 end-0 w-36 h-36 rounded-full border border-dashed border-orange-500 flex items-center justify-center opacity-60">
            <div class="text-center">
              <div class="font-serif italic font-light text-3xl text-orange-500 leading-none">20+</div>
              <div class="font-mono text-[9px] uppercase tracking-[.18em] text-mute mt-1">{{ __('front.home.yearsLabel') }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =============== MARQUEE =============== -->
  <div class="border-y border-ink/10 dark:border-white/10 py-5 bg-white dark:bg-navy-800">
    <div class="marquee">
      <div class="marquee-track">
        @foreach (array_merge(__('front.home.marquee'), __('front.home.marquee')) as $item)
          <span class="inline-flex items-center gap-6 font-display text-xl md:text-2xl font-medium">{{ $item }}<span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span></span>
        @endforeach
      </div>
    </div>
  </div>

  <!-- =============== ABOUT STRIP =============== -->
  <section class="py-20 md:py-28">
    <div class="max-w-container mx-auto px-5 sm:px-10">
      <div class="grid lg:grid-cols-[1fr_1.2fr] gap-16 items-start">
        <div>
          <div class="eyebrow mb-7 reveal">{{ __('front.home.aboutEyebrow') }}</div>
          <h2 class="font-display font-medium text-[clamp(32px,4vw,56px)] leading-[1.05] tracking-tight mb-7 reveal delay-1">{{ __('front.home.aboutTitle') }}</h2>
          <p class="text-lg leading-relaxed text-ink2 dark:text-cream/80 mb-8 reveal delay-2">{{ __('front.home.aboutBody') }}</p>
          <a href="{{ route('front.about') }}" class="btn-link inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full bg-navy-800 dark:bg-orange-500 hover:bg-navy-700 dark:hover:bg-orange-600 text-cream dark:text-navy-900 font-semibold text-sm transition reveal delay-3">
            <span>{{ __('front.home.aboutMore') }}</span><span class="btn-arrow">→</span>
          </a>
        </div>
        <div class="grid grid-cols-2 gap-px bg-ink/10 dark:bg-white/10 border border-ink/10 dark:border-white/10 rounded-2xl overflow-hidden reveal">
          @foreach ([1,2,3,4] as $n)
            <div class="bg-white dark:bg-navy-800 p-8 lg:p-9 min-h-[200px] flex flex-col justify-between">
              <span class="font-display font-medium text-[clamp(48px,5.5vw,76px)] leading-none tracking-tight"><span data-counter="{{ __('front.stat'.$n.'.n') }}">0</span><span class="text-orange-500">{{ __('front.stat'.$n.'.unit') }}</span></span>
              <div class="text-sm text-mute dark:text-cream/60 mt-6">{{ __('front.stat'.$n.'.l') }}</div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <!-- =============== SERVICES LIST =============== -->
  <section class="py-20 md:py-28 bg-white dark:bg-navy-800 border-y border-ink/10 dark:border-white/10">
    <div class="max-w-container mx-auto px-5 sm:px-10">
      <div class="grid lg:grid-cols-[1fr_1.2fr] gap-12 mb-16 items-end">
        <div>
          <div class="eyebrow mb-6 reveal">{{ __('front.home.servicesEyebrow') }}</div>
          <h2 class="font-display font-medium text-[clamp(32px,4vw,56px)] leading-[1.05] tracking-tight reveal delay-1">{{ __('front.home.servicesTitle') }}</h2>
        </div>
        <p class="max-w-[480px] text-lg text-mute dark:text-cream/60 reveal delay-2">{{ __('front.home.servicesSub') }}</p>
      </div>

      @php $homeServices = \App\Models\Service::where('is_published', true)->orderBy('position')->orderBy('id')->get(); @endphp
      <div class="reveal">
        @foreach ($homeServices as $service)
          <a href="{{ route('front.services') }}" class="svc-item group grid grid-cols-[60px_1fr_auto] gap-6 items-center py-8 border-t border-ink/10 dark:border-white/10 cursor-pointer">
            <div class="font-serif italic font-light text-4xl text-orange-500">{{ $service->code ?: str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
            <div>
              <div class="font-mono text-[10px] uppercase tracking-[.18em] text-mute mb-2">{{ $service->tag }}</div>
              <div class="font-display text-[clamp(22px,2.2vw,32px)] font-medium tracking-tight group-hover:text-orange-500 transition">{{ $service->title }}</div>
            </div>
            <div class="text-mute group-hover:text-orange-500 transition btn-arrow"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M5 12h14M13 5l7 7-7 7"/></svg></div>
          </a>
        @endforeach
      </div>
    </div>
  </section>

  <!-- =============== PARTNERS =============== -->
  <section class="py-20 md:py-28">
    <div class="max-w-container mx-auto px-5 sm:px-10">
      <div class="eyebrow mb-6 reveal">{{ __('front.home.partnersEyebrow') }}</div>
      <h2 class="font-display font-medium text-[clamp(32px,4vw,56px)] leading-[1.05] tracking-tight max-w-[720px] mb-12 reveal delay-1">{{ __('front.home.partnersTitle') }}</h2>
      <div class="grid md:grid-cols-2 gap-6 reveal">
        @foreach ([['n' => 1, 'badge' => 'HR'], ['n' => 2, 'badge' => 'FIN']] as $p)
          @php $n = $p['n']; @endphp
          <div class="bg-white dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-2xl p-10 flex flex-col gap-4 hover:border-orange-500 transition">
            <div class="flex justify-between items-start mb-2">
              <div>
                <div class="font-mono text-[10px] uppercase tracking-[.18em] text-mute mb-1.5">{{ __('front.p'.$n.'.tag') }}</div>
                <h3 class="font-display text-3xl font-semibold tracking-tight">{{ __('front.p'.$n.'.name') }}</h3>
              </div>
              <div class="px-3 py-1.5 bg-cream dark:bg-navy-900 border border-ink/10 dark:border-white/10 rounded-full font-mono text-[11px] text-orange-500 tracking-wider">{{ $p['badge'] }}</div>
            </div>
            <p class="text-mute dark:text-cream/60 leading-relaxed">{{ __('front.p'.$n.'.body') }}</p>
            <a href="{{ route('front.partners') }}" class="btn-link mt-2 inline-flex items-center gap-2 text-sm font-semibold text-orange-500"><span>{{ __('front.c.learnMore') }}</span><span class="btn-arrow">→</span></a>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- =============== PILLARS =============== -->
  <section class="py-20 md:py-28 bg-navy-800 dark:bg-navy-900 text-cream relative overflow-hidden">
    <div class="absolute inset-0 dotgrid text-white opacity-[.06]" aria-hidden="true"></div>
    <div class="relative max-w-container mx-auto px-5 sm:px-10">
      <div class="eyebrow mb-6 reveal">{{ __('front.home.pillarsEyebrow') }}</div>
      <h2 class="font-display font-medium text-[clamp(32px,4vw,56px)] leading-[1.05] tracking-tight text-white max-w-[720px] mb-16 reveal delay-1">{{ __('front.home.pillarsTitle') }}</h2>
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-px bg-white/10 border-t border-white/10 reveal">
        @foreach ([1,2,3,4] as $n)
          <div class="bg-navy-800 dark:bg-navy-900 p-7 min-h-[240px] flex flex-col gap-4">
            <div class="font-serif italic font-light text-3xl text-orange-500">{{ str_pad($n, 2, '0', STR_PAD_LEFT) }}</div>
            <h4 class="font-display font-semibold text-white text-lg">{{ __('front.pi'.$n.'.t') }}</h4>
            <p class="text-white/70 text-sm leading-relaxed mt-auto">{{ __('front.pi'.$n.'.d') }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- =============== BLOG STRIP =============== -->
  <section class="py-20 md:py-28">
    <div class="max-w-container mx-auto px-5 sm:px-10">
      <div class="flex flex-wrap justify-between items-end mb-12 gap-6">
        <div>
          <div class="eyebrow mb-6 reveal">{{ __('front.home.blogEyebrow') }}</div>
          <h2 class="font-display font-medium text-[clamp(32px,4vw,56px)] leading-[1.05] tracking-tight reveal delay-1">{{ __('front.home.blogTitle') }}</h2>
        </div>
        <a href="{{ route('front.blog') }}" class="btn-link inline-flex items-center gap-2 px-6 py-3.5 rounded-full border border-ink/15 dark:border-white/20 hover:border-orange-500 hover:text-orange-500 font-semibold text-sm transition"><span>{{ __('front.c.viewAll') }}</span><span class="btn-arrow">→</span></a>
      </div>
      @php
        $homePosts = [
            ['slug' => 'top-business-management-consultancy-bahrain', 'catKey' => 'blog.catGuides', 'read' => 8],
            ['slug' => 'how-to-invest-in-bahrain-2025',               'catKey' => 'blog.catInvest', 'read' => 11],
            ['slug' => 'how-to-incorporate-a-company-bahrain-2025',   'catKey' => 'blog.catSetup',  'read' => 9],
        ];
      @endphp
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 reveal">
        @foreach ($homePosts as $post)
          <a href="{{ route('front.article', ['slug' => $post['slug']]) }}" class="bg-white dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-2xl overflow-hidden hover:border-orange-500 transition">
            <div class="img-ph aspect-[4/3]"><span class="ph-label">image · {{ __('front.'.$post['catKey']) }}</span></div>
            <div class="p-7">
              <div class="flex gap-2.5 items-center font-mono text-xs text-mute tracking-wider mb-3.5"><span class="text-orange-500">{{ __('front.'.$post['catKey']) }}</span><span>·</span><span>{{ $post['read'] }} {{ __('front.c.minread') }}</span></div>
              <h3 class="font-display font-semibold text-xl tracking-tight leading-snug mb-3.5">{{ __('front.posts.'.$post['slug'].'.title') }}</h3>
              <p class="text-sm text-mute dark:text-cream/60 leading-relaxed">{{ __('front.posts.'.$post['slug'].'.desc') }}</p>
              <div class="mt-4 font-mono text-xs text-mute tracking-wider">{{ __('front.posts.'.$post['slug'].'.date') }}</div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>

  <!-- =============== FINAL CTA (skyline) =============== -->
  <section class="relative overflow-hidden border-t border-ink/10 dark:border-white/10">
    <div class="absolute inset-0 z-0">
      <svg viewBox="0 0 1200 400" preserveAspectRatio="xMidYMax slice" class="w-full h-full" aria-hidden="true">
        <defs>
          <linearGradient id="sky-cta" x1="0" x2="0" y1="0" y2="1"><stop offset="0%" stop-color="#06182F"/><stop offset="60%" stop-color="#0B2545"/><stop offset="100%" stop-color="#14315A"/></linearGradient>
        </defs>
        <rect width="1200" height="400" fill="url(#sky-cta)"/>
        <g fill="rgba(255,255,255,.06)" stroke="rgba(255,255,255,.18)" stroke-width="1">
          <path d="M520,400 L520,140 Q550,80 580,140 L580,400 Z"/>
          <path d="M620,400 L620,140 Q650,80 680,140 L680,400 Z"/>
        </g>
        <g fill="rgba(10,18,36,.55)" stroke="rgba(255,255,255,.12)">
          <rect x="60" y="240" width="80" height="160"/><rect x="150" y="200" width="60" height="200"/>
          <rect x="220" y="220" width="100" height="180"/><rect x="330" y="180" width="70" height="220"/>
          <rect x="410" y="210" width="90" height="190"/><rect x="710" y="190" width="80" height="210"/>
          <rect x="800" y="220" width="70" height="180"/><rect x="880" y="170" width="100" height="230"/>
          <rect x="990" y="210" width="70" height="190"/><rect x="1070" y="230" width="80" height="170"/>
        </g>
      </svg>
      <div class="absolute inset-0 bg-gradient-to-b from-navy-900/65 to-navy-900/95"></div>
    </div>
    <div class="relative z-10 max-w-container mx-auto px-5 sm:px-10 py-24 md:py-32 text-center text-cream">
      <div class="eyebrow justify-center inline-flex text-orange-400 mb-6 reveal">{{ __('front.home.finalLabel') }}</div>
      <h2 class="font-display font-medium text-[clamp(32px,4vw,56px)] leading-[1.05] tracking-tight text-white max-w-[900px] mx-auto reveal delay-1">{{ __('front.home.finalCtaTitle') }}</h2>
      <p class="max-w-[600px] mx-auto mt-6 text-lg text-cream/80 reveal delay-2">{{ __('front.home.finalCtaBody') }}</p>
      <div class="mt-9 flex gap-3 justify-center flex-wrap reveal delay-3">
        <a href="{{ route('front.contact') }}" class="btn-link inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm shadow-md-soft transition"><span>{{ __('front.home.finalCtaBtn') }}</span><span class="btn-arrow">→</span></a>
        <a href="https://www.google.com/maps/place/Levant+Business+Management+Services,+Bahrain.+Professional+Body/" target="_blank" rel="noreferrer" class="btn-link inline-flex items-center gap-2 px-6 py-3.5 rounded-full border border-white/30 text-white hover:border-white/60 font-semibold text-sm transition"><span>{{ __('front.top.findMap') }}</span></a>
      </div>
    </div>
  </section>
@endsection
