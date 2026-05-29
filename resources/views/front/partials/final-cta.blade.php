<section class="relative overflow-hidden border-t border-ink/10 dark:border-white/10">
  <div class="absolute inset-0 z-0">
    <svg viewBox="0 0 1200 400" preserveAspectRatio="xMidYMax slice" class="w-full h-full" aria-hidden="true">
      <defs><linearGradient id="sky-cta" x1="0" x2="0" y1="0" y2="1"><stop offset="0%" stop-color="#06182F"/><stop offset="60%" stop-color="#0B2545"/><stop offset="100%" stop-color="#14315A"/></linearGradient></defs>
      <rect width="1200" height="400" fill="url(#sky-cta)"/>
      <g fill="rgba(255,255,255,.06)" stroke="rgba(255,255,255,.18)" stroke-width="1"><path d="M520,400 L520,140 Q550,80 580,140 L580,400 Z"/><path d="M620,400 L620,140 Q650,80 680,140 L680,400 Z"/></g>
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
    </div>
  </div>
</section>
