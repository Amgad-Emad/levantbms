/* app.js — entry point, state, routing, event delegation (vanilla) */
(function () {
  const LB = window.LB;
  const PAGES = window.LB_PAGES;
  const CONTENT = window.CONTENT;

  /* ── Persisted defaults (host can rewrite the JSON between markers) ─── */
  const TWEAK_DEFAULTS = /*EDITMODE-BEGIN*/{
    "theme": "light",
    "lang": "en",
    "hero": "default",
    "palette": "navy-orange",
    "motion": 1,
    "fontPair": "sora-manrope"
  }/*EDITMODE-END*/;

  const PALETTES = {
    "navy-orange":     { "--brand":"#0A1F3D","--on-brand":"#FAF7F2","--accent":"#F58220","--accent-strong":"#E5701F","--on-accent":"#FFFFFF" },
    "graphite-orange": { "--brand":"#1A1A1A","--on-brand":"#FAFAF7","--accent":"#F58220","--accent-strong":"#D8721C","--on-accent":"#FFFFFF" },
    "navy-gold":       { "--brand":"#0B2B3A","--on-brand":"#F4EFE6","--accent":"#C9A55C","--accent-strong":"#A6873F","--on-accent":"#0B2B3A" },
    "forest-clay":     { "--brand":"#0F3D2E","--on-brand":"#E6DCC8","--accent":"#C9633A","--accent-strong":"#A24F2D","--on-accent":"#FAFAF7" },
  };
  const PALETTE_OPTIONS = [
    ["#0A1F3D","#F58220","#FAF7F2"],
    ["#1A1A1A","#F58220","#FAFAF7"],
    ["#0B2B3A","#C9A55C","#F4EFE6"],
    ["#0F3D2E","#C9633A","#E6DCC8"],
  ];
  const PALETTE_KEYS = ["navy-orange","graphite-orange","navy-gold","forest-clay"];

  const FONT_PAIRS = {
    "sora-manrope":     { display: "Sora",         body: "Manrope", serif: "Fraunces" },
    "grotesk-manrope":  { display: "Space Grotesk",body: "Manrope", serif: "Fraunces" },
    "fraunces-manrope": { display: "Fraunces",     body: "Manrope", serif: "Fraunces" },
    "sora-sora":        { display: "Sora",         body: "Sora",    serif: "Fraunces" },
  };

  /* ── Runtime state ────────────────────────────────────────────────── */
  const state = {
    page: "home",
    contactSent: false,
    galleryCat: null,
    faqCat: null,
    faqOpen: 0,
    blogCat: null,
  };
  let tweaks = Object.assign({}, TWEAK_DEFAULTS);

  function tContent() {
    return CONTENT[tweaks.lang] || CONTENT.en;
  }

  /* ── Apply tweak side effects ──────────────────────────────────────── */
  function applyTweaks() {
    const root = document.documentElement;
    const t = tContent();
    root.setAttribute("data-theme", tweaks.theme);
    root.setAttribute("dir", t.dir);
    root.setAttribute("lang", tweaks.lang);
    root.style.setProperty("--motion", tweaks.motion);

    const pal = PALETTES[tweaks.palette] || PALETTES["navy-orange"];
    Object.entries(pal).forEach(([k,v]) => root.style.setProperty(k, v));

    const fp = FONT_PAIRS[tweaks.fontPair] || FONT_PAIRS["sora-manrope"];
    if (t.dir === "ltr") {
      root.style.setProperty("--font-display", `"${fp.display}", ui-sans-serif, system-ui, sans-serif`);
      root.style.setProperty("--font-body",    `"${fp.body}", ui-sans-serif, system-ui, sans-serif`);
      root.style.setProperty("--font-serif",   `"${fp.serif}", ui-serif, Georgia, serif`);
    } else {
      root.style.setProperty("--font-display", `"IBM Plex Sans Arabic","Tajawal", system-ui, sans-serif`);
      root.style.setProperty("--font-body",    `"IBM Plex Sans Arabic","Tajawal", system-ui, sans-serif`);
      root.style.setProperty("--font-serif",   `"IBM Plex Sans Arabic","Tajawal", system-ui, serif`);
    }
  }

  /* ── Render ───────────────────────────────────────────────────────── */
  function render() {
    const t = tContent();
    const lang = tweaks.lang;
    const page = state.page;
    const pageFn = PAGES[page] || PAGES.home;
    const view = pageFn(t, lang, { ...state, hero: tweaks.hero });

    const host = document.getElementById("root");
    host.innerHTML =
      LB.Header(t, page, lang, tweaks.theme)
      + LB.ScrollProgress()
      + `<div class="nav-backdrop" data-nav-backdrop></div>`
      + view
      + LB.Footer(t, lang)
      + LB.FloatCTA(lang)
      + LB.ServiceModalShell();

    LB.setupReveal();
    LB.setupCounters();
  }

  /* ── Mobile menu helpers ─────────────────────────────────────────── */
  function toggleMobileMenu() {
    const open = document.querySelector("[data-nav-menu]")?.classList.contains("open");
    if (open) closeMobileMenu(); else openMobileMenu();
  }
  function openMobileMenu() {
    document.querySelector("[data-nav-menu]")?.classList.add("open");
    document.querySelector("[data-nav-backdrop]")?.classList.add("open");
    document.querySelector("[data-toggle-menu]")?.setAttribute("data-open","1");
    document.body.classList.add("no-scroll");
  }
  function closeMobileMenu() {
    document.querySelector("[data-nav-menu]")?.classList.remove("open");
    document.querySelector("[data-nav-backdrop]")?.classList.remove("open");
    document.querySelector("[data-toggle-menu]")?.removeAttribute("data-open");
    document.body.classList.remove("no-scroll");
  }

  /* ── Navigation ──────────────────────────────────────────────────── */
  function goTo(page) {
    if (state.page === page) return;
    state.page = page;
    render();
    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  /* ── Event delegation ────────────────────────────────────────────── */
  function bindEvents() {
    const root = document.getElementById("root");

    root.addEventListener("click", (e) => {
      // Nav
      const navBtn = e.target.closest("[data-nav]");
      if (navBtn) {
        e.preventDefault();
        const page = navBtn.getAttribute("data-nav");
        goTo(page);
        closeMobileMenu();
        return;
      }
      // Language toggle
      const langBtn = e.target.closest("[data-lang]");
      if (langBtn) {
        e.preventDefault();
        const lang = langBtn.getAttribute("data-lang");
        tweaks.lang = lang;
        applyTweaks();
        render();
        if (window.LB_TWEAKS_INSTANCE) window.LB_TWEAKS_INSTANCE.setTweak("lang", lang);
        return;
      }
      // Theme toggle
      if (e.target.closest("[data-toggle-theme]")) {
        e.preventDefault();
        tweaks.theme = tweaks.theme === "light" ? "dark" : "light";
        applyTweaks();
        // re-render so the icon swaps
        render();
        if (window.LB_TWEAKS_INSTANCE) window.LB_TWEAKS_INSTANCE.setTweak("theme", tweaks.theme);
        return;
      }
      // Mobile menu toggle
      if (e.target.closest("[data-toggle-menu]")) {
        e.preventDefault();
        toggleMobileMenu();
        return;
      }
      // Backdrop click closes menu
      if (e.target.closest("[data-nav-backdrop]")) {
        e.preventDefault();
        closeMobileMenu();
        return;
      }
      // Service modal
      const svcBtn = e.target.closest("[data-open-svc]");
      if (svcBtn) {
        e.preventDefault();
        const i = Number(svcBtn.getAttribute("data-open-svc"));
        const svc = tContent().home.services[i];
        if (svc) LB.openServiceModal(svc, tContent(), tweaks.lang);
        return;
      }
      if (e.target.closest("[data-modal-close]") || e.target.matches("[data-modal-overlay]")) {
        LB.closeServiceModal();
        return;
      }
      // Gallery category
      const galCat = e.target.closest("[data-gallery-cat]");
      if (galCat) {
        e.preventDefault();
        state.galleryCat = galCat.getAttribute("data-gallery-cat");
        render();
        return;
      }
      // FAQ category
      const faqCat = e.target.closest("[data-faq-cat]");
      if (faqCat) {
        e.preventDefault();
        state.faqCat = faqCat.getAttribute("data-faq-cat");
        state.faqOpen = 0;
        render();
        return;
      }
      // Accordion item
      const acc = e.target.closest("[data-acc-toggle]");
      if (acc) {
        e.preventDefault();
        const idx = Number(acc.getAttribute("data-acc-toggle"));
        state.faqOpen = state.faqOpen === idx ? -1 : idx;
        render();
        return;
      }
      // Blog category
      const blogCat = e.target.closest("[data-blog-cat]");
      if (blogCat) {
        e.preventDefault();
        state.blogCat = blogCat.getAttribute("data-blog-cat");
        render();
        return;
      }
      // Contact reset
      if (e.target.closest("[data-contact-reset]")) {
        e.preventDefault();
        state.contactSent = false;
        render();
        return;
      }
    });

    // Forms
    root.addEventListener("submit", (e) => {
      if (e.target.matches("[data-contact-form]")) {
        e.preventDefault();
        state.contactSent = true;
        render();
        return;
      }
      if (e.target.matches("[data-newsletter]")) {
        e.preventDefault();
        const inp = e.target.querySelector('input[type="email"]');
        const btn = e.target.querySelector("button");
        if (inp && inp.value) {
          const old = btn.textContent;
          btn.textContent = tweaks.lang === "ar" ? "✓ مشترك" : "✓ Subscribed";
          btn.disabled = true;
          inp.value = "";
          setTimeout(() => { btn.textContent = old; btn.disabled = false; }, 2500);
        }
        return;
      }
    });

    // Escape closes modal
    window.addEventListener("keydown", (e) => {
      if (e.key === "Escape") { LB.closeServiceModal(); closeMobileMenu(); }
    });

    // Close mobile menu on resize past breakpoint
    let lastW = window.innerWidth;
    window.addEventListener("resize", () => {
      if (window.innerWidth > 1000 && lastW <= 1000) closeMobileMenu();
      lastW = window.innerWidth;
    });
  }

  /* ── Tweaks panel wiring ─────────────────────────────────────────── */
  function buildTweaksPanel() {
    const tk = window.LB_TWEAKS;
    if (!tk) return;
    const lang = tweaks.lang;
    const ar = lang === "ar";

    const schema = [
      { kind: "section", label: ar ? "السمة" : "Theme" },
      { kind: "radio", key: "theme", label: ar ? "الوضع" : "Mode",
        options: [{value:"light",label:ar?"فاتح":"Light"},{value:"dark",label:ar?"داكن":"Dark"}] },
      { kind: "radio", key: "lang", label: ar ? "اللغة" : "Language",
        options: [{value:"en",label:"EN"},{value:"ar",label:"ع"}] },

      { kind: "section", label: ar ? "لوحة الألوان" : "Palette" },
      { kind: "select", key: "palette", label: ar ? "اللوحة" : "Palette",
        options: [
          { value: "navy-orange",     label: "Navy · Orange" },
          { value: "graphite-orange", label: "Graphite · Orange" },
          { value: "navy-gold",       label: "Navy · Gold" },
          { value: "forest-clay",     label: "Forest · Clay" },
        ]},

      { kind: "section", label: ar ? "الطباعة" : "Typography" },
      { kind: "select", key: "fontPair", label: ar ? "اقتران الخط" : "Font pair",
        options: [
          {value:"sora-manrope", label:"Sora · Manrope"},
          {value:"grotesk-manrope", label:"Space Grotesk · Manrope"},
          {value:"fraunces-manrope", label:"Fraunces · Manrope"},
          {value:"sora-sora", label:"Sora · Sora"},
        ]},

      { kind: "section", label: ar ? "الصفحة الرئيسية" : "Home hero" },
      { kind: "radio", key: "hero", label: ar ? "النوع" : "Variant",
        options: [
          {value:"default", label:"Split"},
          {value:"editorial", label:"Editorial"},
          {value:"skyline", label:"Skyline"},
        ]},

      { kind: "section", label: ar ? "الحركة" : "Motion" },
      { kind: "slider", key: "motion", label: ar ? "الكثافة" : "Intensity", min: 0, max: 1.5, step: 0.1 },
    ];

    if (window.LB_TWEAKS_INSTANCE) {
      // Rebuild panel when language changes (labels are localized)
      document.querySelector(".twk-panel")?.remove();
    }

    window.LB_TWEAKS_INSTANCE = tk.init(tweaks, { schema }, (values, edits) => {
      Object.assign(tweaks, values);
      applyTweaks();
      // Re-render if changes affect the DOM
      if ("lang" in edits || "hero" in edits || "theme" in edits) {
        render();
        if ("lang" in edits) {
          // Rebuild localized panel after render
          buildTweaksPanel();
          window.LB_TWEAKS_INSTANCE?.open();
        }
      }
    });
  }

  /* ── Boot ────────────────────────────────────────────────────────── */
  function boot() {
    applyTweaks();
    render();
    bindEvents();
    buildTweaksPanel();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", boot);
  } else {
    boot();
  }
})();
