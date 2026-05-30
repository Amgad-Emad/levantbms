<footer class="bg-navy-800 dark:bg-navy-900 text-cream pt-20 pb-8 relative overflow-hidden">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="grid md:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1.2fr] gap-12 mb-16">
      <div>
        <div class="flex items-center gap-3 mb-5">
          <svg width="48" height="32" viewBox="0 0 56 36" fill="none">
            <rect x="2"  y="6"  width="12" height="3" rx="1.5" fill="#F58220" transform="skewX(-22)"/>
            <rect x="16" y="6"  width="12" height="3" rx="1.5" fill="#FAF7F2" transform="skewX(-22)"/>
            <rect x="6"  y="14" width="12" height="3" rx="1.5" fill="#FAF7F2" transform="skewX(-22)"/>
            <rect x="20" y="14" width="12" height="3" rx="1.5" fill="#F58220" transform="skewX(-22)"/>
            <rect x="2"  y="22" width="12" height="3" rx="1.5" fill="#FAF7F2" transform="skewX(-22)"/>
            <rect x="16" y="22" width="12" height="3" rx="1.5" fill="#F58220" transform="skewX(-22)"/>
          </svg>
          <div>
            <div class="font-display font-bold text-lg leading-none">Levant<span class="text-orange-500">BMS</span></div>
            <div class="font-mono text-[9px] uppercase tracking-[.16em] text-cream/50 mt-1">{{ __('front.logo.sub') }}</div>
          </div>
        </div>
        <p class="text-cream/70 text-sm max-w-[340px] mb-6">{{ __('front.c.address') }}</p>
        <h5 class="font-mono text-[11px] tracking-[.18em] uppercase text-orange-500 mb-4">{{ __('front.c.newsletter') }}</h5>
        <form class="flex border border-white/20 rounded-full overflow-hidden bg-white/5">
          <input type="email" placeholder="{{ __('front.c.yourEmail') }}" class="flex-1 bg-transparent border-0 px-4 py-3.5 text-cream text-sm outline-none placeholder:text-cream/50" />
          <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-5 font-semibold text-xs tracking-wider">{{ __('front.c.subscribe') }}</button>
        </form>
      </div>
      <div>
        <h5 class="font-mono text-[11px] tracking-[.18em] uppercase text-orange-500 mb-4">{{ __('front.c.pagesHead') }}</h5>
        <ul class="space-y-2.5">
          <li><a href="{{ route('front.home') }}"     class="text-cream/75 hover:text-orange-500 text-sm transition">{{ __('front.nav.home') }}</a></li>
          <li><a href="{{ route('front.about') }}"    class="text-cream/75 hover:text-orange-500 text-sm transition">{{ __('front.nav.about') }}</a></li>
          <li><a href="{{ route('front.services') }}" class="text-cream/75 hover:text-orange-500 text-sm transition">{{ __('front.nav.services') }}</a></li>
          <li><a href="{{ route('front.blog') }}"     class="text-cream/75 hover:text-orange-500 text-sm transition">{{ __('front.nav.blog') }}</a></li>
        </ul>
      </div>
      <div>
        <h5 class="font-mono text-[11px] tracking-[.18em] uppercase text-orange-500 mb-4">{{ __('front.c.moreHead') }}</h5>
        <ul class="space-y-2.5">
          <li><a href="{{ route('front.partners') }}" class="text-cream/75 hover:text-orange-500 text-sm transition">{{ __('front.nav.partners') }}</a></li>
          <li><a href="{{ route('front.gallery') }}"  class="text-cream/75 hover:text-orange-500 text-sm transition">{{ __('front.nav.gallery') }}</a></li>
          <li><a href="{{ route('front.faqs') }}"     class="text-cream/75 hover:text-orange-500 text-sm transition">{{ __('front.nav.faqs') }}</a></li>
          <li><a href="{{ route('front.contact') }}"  class="text-cream/75 hover:text-orange-500 text-sm transition">{{ __('front.nav.contact') }}</a></li>
        </ul>
      </div>
      <div>
        <h5 class="font-mono text-[11px] tracking-[.18em] uppercase text-orange-500 mb-4">{{ __('front.c.contactHead') }}</h5>
        <ul class="space-y-2.5">
          <li><a href="tel:+97336314567" dir="ltr" style="unicode-bidi:plaintext" class="inline-block text-cream/75 hover:text-orange-500 text-sm transition">+973 36314567</a></li>
          <li><a href="tel:+97366303050" dir="ltr" style="unicode-bidi:plaintext" class="inline-block text-cream/75 hover:text-orange-500 text-sm transition">+973 66303050</a></li>
          <li><a href="mailto:info@levantbms.com" class="text-cream/75 hover:text-orange-500 text-sm transition">info@levantbms.com</a></li>
        </ul>
      </div>
    </div>
    <div class="border-t border-white/10 pt-6 flex flex-wrap justify-between gap-3 text-xs text-cream/50">
      <span>{{ __('front.c.copyright') }}</span>
      <span>{{ __('front.c.profBody') }}</span>
    </div>
  </div>
</footer>
<div class="fixed bottom-6 end-6 z-40 flex flex-col gap-3">
  <a href="https://wa.me/97336314567" target="_blank" rel="noreferrer" class="w-14 h-14 rounded-full bg-[#25D366] text-white shadow-md-soft inline-flex items-center justify-center hover:scale-110 transition" aria-label="WhatsApp">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
  </a>
  <a href="tel:+97336314567" class="w-14 h-14 rounded-full bg-orange-500 text-white shadow-md-soft inline-flex items-center justify-center hover:scale-110 transition" aria-label="Call">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.37 1.9.72 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.35 1.85.59 2.81.72A2 2 0 0 1 22 16.92z"/></svg>
  </a>
</div>
