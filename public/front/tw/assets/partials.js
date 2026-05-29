// tw/assets/partials.js — Header + Footer + Floating buttons.
// Injects chrome into [data-chrome-header] and [data-chrome-footer] containers.
// In Laravel, port these to resources/views/partials/header.blade.php etc.

(function () {
  const HEADER_HTML = (active) => `
<div class="bg-navy-800 dark:bg-navy-900 text-cream text-xs py-2.5 border-b border-white/5">
  <div class="max-w-container mx-auto px-5 sm:px-10 flex items-center justify-between gap-6">
    <a href="about.html" class="text-orange-500 hover:text-cream transition" data-i18n="top.welcome">Welcome to LevantBMS</a>
    <a href="https://www.google.com/maps/place/Levant+Business+Management+Services,+Bahrain.+Professional+Body/" target="_blank" rel="noreferrer" class="text-orange-500 hover:text-cream transition" data-i18n="top.findMap">Find us on map →</a>
  </div>
</div>
<header class="sticky top-0 z-50 backdrop-blur-xl bg-cream/85 dark:bg-navy-900/85 border-b border-ink/10 dark:border-white/10">
  <div class="max-w-container mx-auto px-5 sm:px-10 flex items-center justify-between gap-8 py-4">
    <a href="index.html" class="flex items-center gap-3 shrink-0">
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
        <div class="font-mono text-[9px] uppercase tracking-[.16em] text-mute mt-1" data-i18n="logo.sub">Business Management Services</div>
      </div>
    </a>
    <nav class="hidden lg:flex items-center gap-1">
      ${[
        ["index.html","home","Home"],
        ["about.html","about","About Us"],
        ["services.html","services","Services"],
        ["partners.html","partners","Global Partners"],
        ["gallery.html","gallery","Gallery"],
        ["faqs.html","faqs","FAQs"],
        ["blog.html","blog","Blog"],
        ["contact.html","contact","Contact"],
      ].map(([href, key, label]) => `<a href="${href}" class="nav-link px-3.5 py-2 rounded-lg text-sm font-medium text-ink2 dark:text-cream/80 hover:text-ink dark:hover:text-cream transition" ${active === key ? 'aria-current="page"' : ""} data-i18n="nav.${key}">${label}</a>`).join("")}
    </nav>
    <div class="flex items-center gap-2.5">
      <div class="flex items-center gap-0 border border-ink/15 dark:border-white/15 rounded-full p-0.5 font-mono text-[11px] font-semibold">
        <button data-lang-btn="en" class="px-3 py-1.5 rounded-full tracking-wider transition">EN</button>
        <button data-lang-btn="ar" class="px-3 py-1.5 rounded-full tracking-wider transition">ع</button>
      </div>
      <button data-theme-toggle class="w-9 h-9 rounded-lg border border-ink/15 dark:border-white/15 inline-flex items-center justify-center text-ink2 dark:text-cream/80 hover:text-orange-500 hover:border-orange-500 transition" aria-label="Toggle theme">
        <svg data-theme-moon width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"/></svg>
        <svg data-theme-sun class="hidden" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>
      </button>
      <a href="contact.html" class="hidden xl:inline-flex btn-link items-center gap-2 px-5 py-3 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm shadow-md-soft transition">
        <span data-i18n="nav.cta">Book a consultation</span><span class="btn-arrow">→</span>
      </a>
      <button data-burger class="lg:hidden w-9 h-9 rounded-lg border border-ink/15 dark:border-white/15 inline-flex items-center justify-center" aria-label="Menu">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
      </button>
    </div>
  </div>
  <div data-mobile-menu data-open="false" class="lg:hidden absolute inset-x-0 top-full bg-cream dark:bg-navy-900 border-b border-ink/10 dark:border-white/10 hidden transition-transform duration-300 px-5 sm:px-10 py-4">
    <div class="flex flex-col">
      ${[
        ["index.html","home","Home"], ["about.html","about","About Us"],
        ["services.html","services","Services"], ["partners.html","partners","Global Partners"],
        ["gallery.html","gallery","Gallery"], ["faqs.html","faqs","FAQs"],
        ["blog.html","blog","Blog"], ["contact.html","contact","Contact"],
      ].map(([href, key, label], i, arr) => `<a href="${href}" class="py-3 text-base font-medium ${i < arr.length - 1 ? 'border-b border-ink/5 dark:border-white/5' : ''}" data-i18n="nav.${key}">${label}</a>`).join("")}
    </div>
  </div>
</header>`;

  const FOOTER_HTML = `
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
            <div class="font-mono text-[9px] uppercase tracking-[.16em] text-cream/50 mt-1" data-i18n="logo.sub">Business Management Services</div>
          </div>
        </div>
        <p class="text-cream/70 text-sm max-w-[340px] mb-6" data-i18n="c.address">Suite 2131, Bahrain Financial Harbour, Harbour Gate, 2nd Floor, Manama</p>
        <h5 class="font-mono text-[11px] tracking-[.18em] uppercase text-orange-500 mb-4" data-i18n="c.newsletter">Subscribe to our newsletter</h5>
        <form class="flex border border-white/20 rounded-full overflow-hidden bg-white/5">
          <input type="email" placeholder="Your email" data-i18n-attr="placeholder:c.yourEmail" class="flex-1 bg-transparent border-0 px-4 py-3.5 text-cream text-sm outline-none placeholder:text-cream/50" />
          <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-5 font-semibold text-xs tracking-wider" data-i18n="c.subscribe">Subscribe</button>
        </form>
      </div>
      <div>
        <h5 class="font-mono text-[11px] tracking-[.18em] uppercase text-orange-500 mb-4" data-i18n="c.pagesHead">Pages</h5>
        <ul class="space-y-2.5">
          <li><a href="index.html"    class="text-cream/75 hover:text-orange-500 text-sm transition" data-i18n="nav.home">Home</a></li>
          <li><a href="about.html"    class="text-cream/75 hover:text-orange-500 text-sm transition" data-i18n="nav.about">About Us</a></li>
          <li><a href="services.html" class="text-cream/75 hover:text-orange-500 text-sm transition" data-i18n="nav.services">Services</a></li>
          <li><a href="blog.html"     class="text-cream/75 hover:text-orange-500 text-sm transition" data-i18n="nav.blog">Blog</a></li>
        </ul>
      </div>
      <div>
        <h5 class="font-mono text-[11px] tracking-[.18em] uppercase text-orange-500 mb-4" data-i18n="c.moreHead">More</h5>
        <ul class="space-y-2.5">
          <li><a href="partners.html" class="text-cream/75 hover:text-orange-500 text-sm transition" data-i18n="nav.partners">Global Partners</a></li>
          <li><a href="gallery.html"  class="text-cream/75 hover:text-orange-500 text-sm transition" data-i18n="nav.gallery">Gallery</a></li>
          <li><a href="faqs.html"     class="text-cream/75 hover:text-orange-500 text-sm transition" data-i18n="nav.faqs">FAQs</a></li>
          <li><a href="contact.html"  class="text-cream/75 hover:text-orange-500 text-sm transition" data-i18n="nav.contact">Contact</a></li>
        </ul>
      </div>
      <div>
        <h5 class="font-mono text-[11px] tracking-[.18em] uppercase text-orange-500 mb-4" data-i18n="c.contactHead">Contact</h5>
        <ul class="space-y-2.5">
          <li><a href="tel:+97336314567" class="text-cream/75 hover:text-orange-500 text-sm transition">+973 36314567</a></li>
          <li><a href="tel:+97366303050" class="text-cream/75 hover:text-orange-500 text-sm transition">+973 66303050</a></li>
          <li><a href="mailto:info@levantbms.com" class="text-cream/75 hover:text-orange-500 text-sm transition">info@levantbms.com</a></li>
        </ul>
      </div>
    </div>
    <div class="border-t border-white/10 pt-6 flex flex-wrap justify-between gap-3 text-xs text-cream/50">
      <span data-i18n="c.copyright">© 2003–2026 Levant Business Management Services W.L.L.</span>
      <span data-i18n="c.profBody">Professional Body · Manama, Bahrain</span>
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
</div>`;

  // Inject at first opportunity (header right after <body>, footer at end)
  function inject() {
    const headerSlot = document.querySelector("[data-chrome-header]");
    const footerSlot = document.querySelector("[data-chrome-footer]");
    const active = document.documentElement.getAttribute("data-page") || "";
    if (headerSlot) headerSlot.innerHTML = HEADER_HTML(active);
    if (footerSlot) footerSlot.innerHTML = FOOTER_HTML;
  }
  // Run immediately (script is loaded synchronously before app.js)
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", inject, { once: true });
  } else inject();
})();
