/* ui.js — shared UI primitives + helpers (vanilla)
   Exposes window.LB = { esc, html, icons, Logo, Header, Footer, FloatCTA,
                         PageBanner, SkylineSvg, ScrollProgress,
                         openServiceModal, closeServiceModal,
                         setupReveal, animateCounter, scrollToTop }
*/
(function () {
  /* ── helpers ──────────────────────────────────────────────────────────── */
  const esc = (s) => String(s == null ? "" : s)
    .replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;").replace(/'/g, "&#39;");

  // Template-literal tag: passes strings through verbatim, escapes interpolations.
  // Arrays are joined without separator (use .join('') inside if needed).
  const html = (strings, ...vals) => {
    let out = "";
    strings.forEach((s, i) => {
      out += s;
      if (i < vals.length) {
        const v = vals[i];
        if (v === null || v === undefined || v === false) out += "";
        else if (Array.isArray(v)) out += v.join("");
        else if (typeof v === "object" && v.__raw) out += v.__raw;
        else out += esc(v);
      }
    });
    return out;
  };
  const raw = (s) => ({ __raw: s });

  /* ── SVG icons ────────────────────────────────────────────────────────── */
  const icons = {
    sun: '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>',
    moon:'<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"/></svg>',
    burger:'<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>',
    close:'<svg width="14" height="14" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg>',
    arrowRight:'<svg width="22" height="22" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6" fill="none" stroke-linecap="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>',
    phone:'<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.37 1.9.72 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.35 1.85.59 2.81.72A2 2 0 0 1 22 16.92z"/></svg>',
    mail:'<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
    wa:'<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>',
    mapPin:'<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
    plus:'<svg width="14" height="14" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>',
    check:'<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="M5 12l5 5L20 7"/></svg>',
    chevron:'<svg width="14" height="14" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"><path d="M6 9l6 6 6-6"/></svg>',
  };

  /* ── Logo (skewed bars echoing the brand) ─────────────────────────────── */
  function Logo(size) {
    size = size || 28;
    const w = size * 1.6;
    return `<svg width="${w}" height="${size}" viewBox="0 0 56 36" fill="none" aria-hidden="true">
      <g>
        <rect x="2"  y="6"  width="12" height="3" rx="1.5" fill="var(--accent)" transform="skewX(-22)"/>
        <rect x="16" y="6"  width="12" height="3" rx="1.5" fill="var(--brand)"  transform="skewX(-22)"/>
        <rect x="6"  y="14" width="12" height="3" rx="1.5" fill="var(--brand)"  transform="skewX(-22)"/>
        <rect x="20" y="14" width="12" height="3" rx="1.5" fill="var(--accent)" transform="skewX(-22)"/>
        <rect x="2"  y="22" width="12" height="3" rx="1.5" fill="var(--brand)"  transform="skewX(-22)"/>
        <rect x="16" y="22" width="12" height="3" rx="1.5" fill="var(--accent)" transform="skewX(-22)"/>
      </g>
    </svg>`;
  }

  /* ── Header ───────────────────────────────────────────────────────────── */
  function Header(t, page, lang, theme) {
    const navItems = [
      ["home", t.nav.home],
      ["about", t.nav.about],
      ["services", t.nav.services],
      ["partners", t.nav.partners],
      ["gallery", t.nav.gallery],
      ["faqs", t.nav.faqs],
      ["blog", t.nav.blog],
      ["contact", t.nav.contact],
    ];
    const subTitle = lang === "ar" ? "خدمات إدارة الأعمال" : "Business Management Services";
    return `
      <div class="topbar">
        <div class="container topbar-inner">
          <a data-nav="about" style="cursor:pointer">${esc(t.top.welcome)}</a>
          <a href="https://www.google.com/maps/place/Levant+Business+Management+Services,+Bahrain.+Professional+Body/" target="_blank" rel="noreferrer">${esc(t.top.findMap)} →</a>
        </div>
      </div>
      <header class="nav">
        <div class="container nav-inner">
          <a class="nav-logo" data-nav="home" style="cursor:pointer">
            ${Logo(28)}
            <div>
              <div class="nav-logo-name">Levant<span>BMS</span></div>
              <div class="nav-logo-sub">${esc(subTitle)}</div>
            </div>
          </a>
          <nav class="nav-links" data-nav-menu>
            ${navItems.map(([k, label]) => `
              <a class="nav-link${page === k ? " active" : ""}" data-nav="${k}">${esc(label)}</a>
            `).join("")}
          </nav>
          <div class="nav-cta">
            <div class="lang-toggle" role="group" aria-label="Language">
              <button class="${lang === "en" ? "on" : ""}" data-lang="en">EN</button>
              <button class="${lang === "ar" ? "on" : ""}" data-lang="ar">ع</button>
            </div>
            <button class="nav-icon-btn" data-toggle-theme aria-label="Toggle theme">
              ${theme === "light" ? icons.moon : icons.sun}
            </button>
            <button class="btn btn-primary" data-nav="contact">
              ${esc(t.nav.bookCall)}<span class="arrow">→</span>
            </button>
            <button class="nav-icon-btn nav-burger" data-toggle-menu aria-label="Menu">${icons.burger}</button>
          </div>
        </div>
      </header>
    `;
  }

  /* ── Footer ───────────────────────────────────────────────────────────── */
  function Footer(t, lang) {
    const sub = lang === "ar" ? "خدمات إدارة الأعمال" : "Business Management Services";
    const yr = new Date().getFullYear();
    const pages1 = [["home", t.nav.home],["about", t.nav.about],["services", t.nav.services],["blog", t.nav.blog]];
    const pages2 = [["partners", t.nav.partners],["gallery", t.nav.gallery],["faqs", t.nav.faqs],["contact", t.nav.contact]];
    return `
      <footer class="footer">
        <div class="container">
          <div class="footer-grid">
            <div>
              <div style="display:flex;align-items:center;gap:12px;margin-bottom:18px">
                ${Logo(32)}
                <div>
                  <div class="nav-logo-name" style="color:var(--on-brand)">Levant<span>BMS</span></div>
                  <div class="nav-logo-sub" style="color:rgba(255,255,255,.5)">${esc(sub)}</div>
                </div>
              </div>
              <p style="color:rgba(255,255,255,.7);font-size:14px;max-width:340px;margin-bottom:24px">${esc(t.common.address)}</p>
              <h5>${esc(t.common.newsletter)}</h5>
              <form class="footer-newsletter" data-newsletter>
                <input type="email" placeholder="${esc(t.common.yourEmail)}" />
                <button type="submit">${esc(t.common.subscribe)}</button>
              </form>
            </div>
            <div>
              <h5>${lang === "ar" ? "روابط" : "Pages"}</h5>
              <ul>${pages1.map(([k,l]) => `<li><a data-nav="${k}" style="cursor:pointer">${esc(l)}</a></li>`).join("")}</ul>
            </div>
            <div>
              <h5>${lang === "ar" ? "المزيد" : "More"}</h5>
              <ul>${pages2.map(([k,l]) => `<li><a data-nav="${k}" style="cursor:pointer">${esc(l)}</a></li>`).join("")}</ul>
            </div>
            <div>
              <h5>${lang === "ar" ? "تواصل" : "Contact"}</h5>
              <ul>
                <li><a href="tel:${esc(t.common.phone)}">${esc(t.common.phone)}</a></li>
                <li><a href="tel:${esc(t.common.phone2)}">${esc(t.common.phone2)}</a></li>
                <li><a href="mailto:${esc(t.common.email)}">${esc(t.common.email)}</a></li>
              </ul>
            </div>
          </div>
          <div class="footer-bottom">
            <span>© 2003–${yr} Levant Business Management Services W.L.L.</span>
            <span>${lang === "ar" ? "مكتب معتمد · المنامة، البحرين" : "Professional Body · Manama, Bahrain"}</span>
          </div>
        </div>
      </footer>
    `;
  }

  /* ── Floating contact (WhatsApp + phone) ─────────────────────────────── */
  function FloatCTA(lang) {
    return `
      <div class="float-cta ${lang === "ar" ? "float-cta-rtl" : "float-cta-ltr"}">
        <a class="float-btn wa" href="https://wa.me/97336314567" target="_blank" rel="noreferrer" aria-label="WhatsApp">${icons.wa}</a>
        <a class="float-btn" href="tel:+97336314567" aria-label="Call">${icons.phone}</a>
      </div>
    `;
  }

  /* ── Scroll progress bar ─────────────────────────────────────────────── */
  function ScrollProgress() {
    return `<div class="scroll-progress" aria-hidden="true"><span></span></div>`;
  }

  /* ── Page banner (used by all interior pages) ─────────────────────────── */
  function PageBanner(crumb, h1, sub, lang, t) {
    const cornerSide = lang === "ar" ? "left" : "right";
    return `
      <section class="page-banner">
        <div class="container page-banner-inner">
          <div class="crumb reveal in">
            <a data-nav="home" style="cursor:pointer">${esc(t.common.home)}</a> / <span style="color:var(--accent)">${esc(crumb)}</span>
          </div>
          <h1 class="reveal in" style="max-width:900px">${esc(h1)}</h1>
          ${sub ? `<p class="reveal in reveal-delay-1" style="max-width:680px;margin-top:24px;font-size:18px;color:var(--fg-mute)">${esc(sub)}</p>` : ""}
        </div>
        <div class="dotgrid" style="position:absolute;inset:auto 0 0 0;height:60%;-webkit-mask-image:linear-gradient(180deg,transparent,#000);mask-image:linear-gradient(180deg,transparent,#000)" aria-hidden="true"></div>
        <div class="stripe-motif" style="position:absolute;top:0;${cornerSide}:0;width:220px;height:220px;-webkit-mask-image:linear-gradient(225deg,#000,transparent 70%);mask-image:linear-gradient(225deg,#000,transparent 70%)" aria-hidden="true"></div>
      </section>
    `;
  }

  /* ── Skyline SVG ──────────────────────────────────────────────────────── */
  function SkylineSvg(height) {
    height = height || 260;
    // pre-build deterministic stars + windows
    let stars = "";
    for (let i = 0; i < 36; i++) {
      const cx = (i * 73) % 1200;
      const cy = (i * 17) % 140 + 18;
      const r = (i % 3 === 0) ? 1.5 : 0.8;
      stars += `<circle cx="${cx}" cy="${cy}" r="${r}" fill="rgba(255,255,255,.5)"/>`;
    }
    let windows = "";
    for (let i = 0; i < 160; i++) {
      const x = 80 + (i * 23) % 1080;
      const y = 200 + ((i * 17) % 110);
      const op = (i % 4 === 0) ? 0.8 : 0.3;
      windows += `<rect x="${x}" y="${y}" width="3" height="5" opacity="${op}"/>`;
    }
    return `<svg viewBox="0 0 1200 320" width="100%" height="${typeof height === "string" ? height : height + "px"}" preserveAspectRatio="xMidYMax slice" style="display:block">
      <defs>
        <linearGradient id="sky" x1="0" x2="0" y1="0" y2="1">
          <stop offset="0%" stop-color="var(--navy-900)"/>
          <stop offset="60%" stop-color="var(--navy-700)"/>
          <stop offset="100%" stop-color="var(--navy-600)"/>
        </linearGradient>
        <linearGradient id="bldFade" x1="0" x2="0" y1="0" y2="1">
          <stop offset="0%" stop-color="rgba(245,130,32,.5)"/>
          <stop offset="100%" stop-color="rgba(245,130,32,0)"/>
        </linearGradient>
      </defs>
      <rect width="1200" height="320" fill="url(#sky)"/>
      ${stars}
      <g fill="rgba(255,255,255,.06)" stroke="rgba(255,255,255,.18)" stroke-width="1">
        <path d="M520,300 L520,90 Q550,40 580,90 L580,300 Z"/>
        <path d="M620,300 L620,90 Q650,40 680,90 L680,300 Z"/>
      </g>
      <g fill="rgba(10,18,36,.55)" stroke="rgba(255,255,255,.12)">
        <rect x="60" y="200" width="80" height="120"/>
        <rect x="150" y="160" width="60" height="160"/>
        <rect x="220" y="180" width="100" height="140"/>
        <rect x="330" y="140" width="70" height="180"/>
        <rect x="410" y="170" width="90" height="150"/>
        <rect x="710" y="150" width="80" height="170"/>
        <rect x="800" y="180" width="70" height="140"/>
        <rect x="880" y="130" width="100" height="190"/>
        <rect x="990" y="170" width="70" height="150"/>
        <rect x="1070" y="190" width="80" height="130"/>
      </g>
      <g fill="rgba(255,200,140,.55)">${windows}</g>
      <rect x="0" y="290" width="1200" height="30" fill="url(#bldFade)" opacity=".4"/>
    </svg>`;
  }

  /* ── Service modal ────────────────────────────────────────────────────── */
  function ServiceModalShell() {
    return `<div class="modal-overlay" id="svc-modal" data-modal-overlay>
      <div class="modal" data-modal-content></div>
    </div>`;
  }
  function renderServiceModalBody(svc, t, lang) {
    if (!svc) return "";
    const labels = {
      timeline: t.services.detailTimeline,
      fee: t.services.detailFee,
      practice: lang === "ar" ? "النموذج" : "Practice",
    };
    return `
      <div class="modal-head">
        <div>
          <div class="eyebrow">${esc(svc.tag)}</div>
          <h2 style="margin-top:14px;font-size:32px;letter-spacing:-0.02em">${esc(svc.title)}</h2>
        </div>
        <button class="modal-close" data-modal-close aria-label="Close">${icons.close}</button>
      </div>
      <div class="modal-body">
        <p style="font-size:16px;margin-bottom:24px;color:var(--fg-2)">${esc(svc.desc)}</p>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:28px;padding-block:20px;border-top:1px solid var(--border);border-bottom:1px solid var(--border)" data-modal-stats>
          <div>
            <div style="font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:var(--fg-mute);font-family:var(--font-mono);margin-bottom:6px">${esc(labels.timeline)}</div>
            <div style="font-weight:600;font-size:15px">${esc(t.services.timelineWeeks)}</div>
          </div>
          <div>
            <div style="font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:var(--fg-mute);font-family:var(--font-mono);margin-bottom:6px">${esc(labels.fee)}</div>
            <div style="font-weight:600;font-size:15px;color:var(--accent)">${esc(t.services.feeFrom)}</div>
          </div>
          <div>
            <div style="font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:var(--fg-mute);font-family:var(--font-mono);margin-bottom:6px">${esc(labels.practice)}</div>
            <div style="font-weight:600;font-size:15px">${esc(svc.n)}</div>
          </div>
        </div>
        <div style="font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:var(--fg-mute);font-family:var(--font-mono);margin-bottom:12px">${esc(t.services.detailLabel)}</div>
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px">
          ${(svc.items||[]).map((it, i) => `
            <li style="display:flex;align-items:start;gap:12px;padding:10px 0;border-bottom:1px solid var(--border)">
              <span style="flex:0 0 auto;font-family:var(--font-mono);font-size:11px;color:var(--accent);letter-spacing:.1em;padding-top:3px">${String(i+1).padStart(2,"0")}</span>
              <span style="color:var(--fg-2);font-size:15px">${esc(it)}</span>
            </li>
          `).join("")}
        </ul>
        <div style="margin-top:28px">
          <button class="btn btn-primary" data-modal-close>${esc(t.services.ctaTalk)}<span class="arrow">→</span></button>
        </div>
      </div>
    `;
  }
  function openServiceModal(svc, t, lang) {
    const overlay = document.getElementById("svc-modal");
    if (!overlay) return;
    overlay.querySelector("[data-modal-content]").innerHTML = renderServiceModalBody(svc, t, lang);
    overlay.classList.add("open");
    document.body.style.overflow = "hidden";
  }
  function closeServiceModal() {
    const overlay = document.getElementById("svc-modal");
    if (!overlay) return;
    overlay.classList.remove("open");
    document.body.style.overflow = "";
  }

  /* ── Reveal observer (bidirectional, smooth) ──────────────────────────── */
  let _io = null;
  let _scrollHandlerAttached = false;
  function setupReveal() {
    // (Re)build observer over current .reveal elements every render.
    if (_io) _io.disconnect();
    const els = document.querySelectorAll(".reveal");
    if (!_scrollHandlerAttached) {
      let lastY = window.scrollY;
      let ticking = false;
      const tick = () => {
        const y = window.scrollY;
        document.documentElement.setAttribute("data-scroll-dir", y > lastY ? "down" : "up");
        document.documentElement.setAttribute("data-scrolled", y > 12 ? "yes" : "no");
        const max = document.documentElement.scrollHeight - window.innerHeight;
        const pct = max > 0 ? Math.min(1, Math.max(0, y / max)) : 0;
        document.documentElement.style.setProperty("--scroll-pct", pct.toFixed(4));
        lastY = y;
        ticking = false;
      };
      window.addEventListener("scroll", () => {
        if (!ticking) { requestAnimationFrame(tick); ticking = true; }
      }, { passive: true });
      tick();
      _scrollHandlerAttached = true;
    }
    if (!("IntersectionObserver" in window)) {
      els.forEach((e) => e.classList.add("in"));
      return;
    }
    _io = new IntersectionObserver((entries) => {
      entries.forEach((en) => {
        const el = en.target;
        if (en.isIntersecting) {
          el.classList.add("in");
          el.classList.remove("out-up", "out-down");
        } else {
          el.classList.remove("in");
          const r = en.boundingClientRect;
          if (r.top < 0) { el.classList.add("out-up"); el.classList.remove("out-down"); }
          else { el.classList.add("out-down"); el.classList.remove("out-up"); }
        }
      });
    }, { rootMargin: "0px 0px -6% 0px", threshold: [0, 0.06, 0.5] });
    els.forEach((e) => _io.observe(e));
  }

  /* ── Stat counter animation ───────────────────────────────────────────── */
  function animateCounter(el, target, durationMs) {
    durationMs = durationMs || 1400;
    if (el.dataset.counted === "1") return;
    el.dataset.counted = "1";
    const t0 = performance.now();
    const unit = el.dataset.unit || "";
    const tick = (t) => {
      const p = Math.min(1, (t - t0) / durationMs);
      const eased = 1 - Math.pow(1 - p, 3);
      const n = Math.round(eased * target);
      el.innerHTML = `${n}<span class="unit">${esc(unit)}</span>`;
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  }
  function setupCounters() {
    document.querySelectorAll(".stat-num[data-target]").forEach((el) => {
      const target = Number(el.dataset.target) || 0;
      if (!("IntersectionObserver" in window)) { animateCounter(el, target); return; }
      const io = new IntersectionObserver(([e]) => {
        if (e.isIntersecting) { animateCounter(el, target); io.disconnect(); }
      }, { threshold: 0.4 });
      io.observe(el);
    });
  }

  function scrollToTop() { window.scrollTo({ top: 0, behavior: "smooth" }); }

  window.LB = {
    esc, html, raw, icons,
    Logo, Header, Footer, FloatCTA, PageBanner, SkylineSvg, ScrollProgress,
    ServiceModalShell, openServiceModal, closeServiceModal,
    setupReveal, setupCounters, scrollToTop,
  };
})();
