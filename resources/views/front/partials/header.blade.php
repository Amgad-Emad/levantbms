@php
    $page = $page ?? '';
    $navItems = [
        ['route' => 'front.home',     'key' => 'home'],
        ['route' => 'front.about',    'key' => 'about'],
        ['route' => 'front.services', 'key' => 'services'],
        ['route' => 'front.partners', 'key' => 'partners'],
        ['route' => 'front.gallery',  'key' => 'gallery'],
        ['route' => 'front.faqs',     'key' => 'faqs'],
        ['route' => 'front.blog',     'key' => 'blog'],
        ['route' => 'front.contact',  'key' => 'contact'],
    ];
    $currentLocale = app()->getLocale();
@endphp
<div class="bg-navy-800 dark:bg-navy-900 text-cream text-xs py-2.5 border-b border-white/5">
  <div class="max-w-container mx-auto px-5 sm:px-10 flex items-center justify-between gap-6">
    <a href="{{ route('front.about') }}" class="text-orange-500 hover:text-cream transition">{{ __('front.top.welcome') }}</a>
    <a href="https://www.google.com/maps/place/Levant+Business+Management+Services,+Bahrain.+Professional+Body/" target="_blank" rel="noreferrer" class="text-orange-500 hover:text-cream transition">{{ __('front.top.findMap') }}</a>
  </div>
</div>
<header class="sticky top-0 z-50 backdrop-blur-xl bg-cream/85 dark:bg-navy-900/85 border-b border-ink/10 dark:border-white/10">
  <div class="max-w-container mx-auto px-5 sm:px-10 flex items-center justify-between gap-8 py-4">
    <a href="{{ route('front.home') }}" class="flex items-center gap-3 shrink-0">
      <svg width="44" height="28" viewBox="0 0 56 36" fill="none" aria-hidden="true">
        <rect x="2"  y="6"  width="12" height="3" rx="1.5" fill="#F58220" transform="skewX(-22)"/>
        <rect x="16" y="6"  width="12" height="3" rx="1.5" fill="currentColor" class="text-navy-800 dark:text-cream" transform="skewX(-22)"/>
        <rect x="6"  y="14" width="12" height="3" rx="1.5" fill="currentColor" class="text-navy-800 dark:text-cream" transform="skewX(-22)"/>
        <rect x="20" y="14" width="12" height="3" rx="1.5" fill="#F58220" transform="skewX(-22)"/>
        <rect x="2"  y="22" width="12" height="3" rx="1.5" fill="currentColor" class="text-navy-800 dark:text-cream" transform="skewX(-22)"/>
        <rect x="16" y="22" width="12" height="3" rx="1.5" fill="#F58220" transform="skewX(-22)"/>
      </svg>
      <div>
        <div class="font-display font-bold text-lg leading-none tracking-tight">Levant<span class="text-orange-500">BMS</span></div>
        <div class="font-mono text-[9px] uppercase tracking-[.16em] text-mute mt-1">{{ __('front.logo.sub') }}</div>
      </div>
    </a>
    <nav class="hidden lg:flex items-center gap-1">
      @foreach ($navItems as $item)
        <a href="{{ route($item['route']) }}"
           class="nav-link px-3.5 py-2 rounded-lg text-sm font-medium text-ink2 dark:text-cream/80 hover:text-ink dark:hover:text-cream transition"
           @if($page === $item['key']) aria-current="page" @endif>{{ __('front.nav.'.$item['key']) }}</a>
      @endforeach
    </nav>
    <div class="flex items-center gap-2.5">
      <div class="flex items-center gap-0 border border-ink/15 dark:border-white/15 rounded-full p-0.5 font-mono text-[11px] font-semibold">
        @foreach (LaravelLocalization::getSupportedLocales() as $code => $props)
          @php
              $isActive = $code === $currentLocale;
              $label    = $code === 'ar' ? 'ع' : strtoupper($code);
          @endphp
          <a rel="alternate" hreflang="{{ $code }}"
             href="{{ LaravelLocalization::getLocalizedURL($code, null, [], true) }}"
             class="px-3 py-1.5 rounded-full tracking-wider transition {{ $isActive ? 'bg-navy-800 dark:bg-orange-500 text-cream dark:text-navy-900' : 'text-ink/50 dark:text-cream/50 hover:text-ink dark:hover:text-cream' }}"
             aria-label="{{ $props['native'] }}">{{ $label }}</a>
        @endforeach
      </div>
      <button data-theme-toggle class="w-9 h-9 rounded-lg border border-ink/15 dark:border-white/15 inline-flex items-center justify-center text-ink2 dark:text-cream/80 hover:text-orange-500 hover:border-orange-500 transition" aria-label="Toggle theme">
        <svg data-theme-moon width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"/></svg>
        <svg data-theme-sun class="hidden" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>
      </button>
      <a href="{{ route('front.contact') }}" class="hidden xl:inline-flex btn-link items-center gap-2 px-5 py-3 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm shadow-md-soft transition">
        <span>{{ __('front.nav.cta') }}</span><span class="btn-arrow">→</span>
      </a>
      <button data-burger class="lg:hidden w-9 h-9 rounded-lg border border-ink/15 dark:border-white/15 inline-flex items-center justify-center" aria-label="Menu">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
      </button>
    </div>
  </div>
  <div data-mobile-menu data-open="false" class="lg:hidden absolute inset-x-0 top-full bg-cream dark:bg-navy-900 border-b border-ink/10 dark:border-white/10 hidden transition-transform duration-300 px-5 sm:px-10 py-4">
    <div class="flex flex-col">
      @foreach ($navItems as $i => $item)
        <a href="{{ route($item['route']) }}"
           class="py-3 text-base font-medium {{ $i < count($navItems) - 1 ? 'border-b border-ink/5 dark:border-white/5' : '' }}">{{ __('front.nav.'.$item['key']) }}</a>
      @endforeach
    </div>
  </div>
</header>
