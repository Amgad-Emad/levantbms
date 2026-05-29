/* pages.js — all 8 page renderers as plain functions returning HTML strings.
   Each one reads from t (i18n object), lang, and an optional state slice.
*/
(function () {
  const { esc, html, raw, icons, PageBanner, SkylineSvg, Logo } = window.LB;

  /* ── Common: Final CTA strip (used at the bottom of several pages) ───── */
  function FinalCTA(t, lang) {
    return `
      <section style="position:relative;overflow:hidden;border-top:1px solid var(--border)">
        <div style="position:absolute;inset:0;z-index:0">
          ${SkylineSvg("100%")}
          <div style="position:absolute;inset:0;background:linear-gradient(180deg, rgba(6,24,47,.65), rgba(6,24,47,.92))"></div>
        </div>
        <div class="container section" style="position:relative;z-index:2;color:#FAF7F2;text-align:center">
          <div class="eyebrow reveal" style="justify-content:center;color:var(--orange-400);margin-bottom:24px;display:inline-flex">${esc(lang === "ar" ? "الموقع" : "Location")}</div>
          <h2 class="reveal reveal-delay-1" style="max-width:900px;margin:0 auto;color:#FFFFFF">${esc(t.home.finalCtaTitle)}</h2>
          <p class="reveal reveal-delay-2" style="max-width:600px;margin:24px auto 0;color:rgba(250,247,242,.78);font-size:17px">${esc(t.home.finalCtaBody)}</p>
          <div class="reveal reveal-delay-3" style="margin-top:36px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
            <button class="btn btn-primary" data-nav="contact">${esc(t.home.finalCtaBtn)}<span class="arrow">→</span></button>
            <a class="btn" style="border:1px solid rgba(255,255,255,.3);color:#FFF" href="https://www.google.com/maps/place/Levant+Business+Management+Services,+Bahrain.+Professional+Body/" target="_blank" rel="noreferrer">
              ${esc(t.top.findMap)}<span class="arrow">→</span>
            </a>
          </div>
        </div>
      </section>
    `;
  }

  /* ── HOME ────────────────────────────────────────────────────────────── */
  function HeroDefault(t, lang) {
    const isRTL = lang === "ar";
    const sideKey = isRTL ? "right" : "left";
    const cornerKey = isRTL ? "left" : "right";
    const stampOffsets = [
      { top: 0,   side: 40,  rot: -2,   delay: ".1s" },
      { top: 160, side: 120, rot: 1.5,  delay: ".25s" },
      { top: 320, side: 30,  rot: -1.2, delay: ".4s" },
    ];
    const stampsHTML = t.home.stamps.map((s, i) => {
      const o = stampOffsets[i];
      return `
        <div class="stamp reveal in" style="position:absolute;width:300px;top:${o.top}px;${sideKey}:${o.side}px;transform:rotate(${o.rot}deg);animation:float${i} ${6+i}s ease-in-out infinite;transition-delay:${o.delay};box-shadow:var(--shadow-md)">
          <div class="stamp-tag">${esc(s.tag)}</div>
          <h4>${esc(s.title)}</h4>
          <div class="stamp-meta"><span>${esc(s.meta[0])}</span><span>${esc(s.meta[1])}</span></div>
          <div style="position:absolute;top:-8px;${cornerKey}:-8px;width:18px;height:18px;border:2px solid var(--accent);border-radius:50%;background:var(--bg-elev)"></div>
        </div>
      `;
    }).join("");
    return `
      <section style="position:relative;padding-block:clamp(72px,10vw,120px) clamp(80px,10vw,140px);overflow:hidden">
        <div class="dotgrid" style="position:absolute;inset:0;-webkit-mask-image:radial-gradient(70% 60% at 50% 30%, #000 30%, transparent 80%);mask-image:radial-gradient(70% 60% at 50% 30%, #000 30%, transparent 80%)" aria-hidden></div>
        <div class="stripe-motif" style="position:absolute;top:80px;${cornerKey}:-40px;width:260px;height:260px;-webkit-mask-image:linear-gradient(225deg,#000,transparent 70%);mask-image:linear-gradient(225deg,#000,transparent 70%)" aria-hidden></div>
        <div class="container" style="position:relative;z-index:2">
          <div class="hero-grid" style="display:grid;grid-template-columns:1.4fr 1fr;gap:60px;align-items:center">
            <div>
              <div class="eyebrow reveal in" style="margin-bottom:28px">${esc(t.home.eyebrow)}</div>
              <h1 class="reveal in reveal-delay-1" style="margin-bottom:28px">
                ${esc(t.home.h1a)} <span style="font-family:var(--font-serif);font-style:italic;font-weight:300;color:var(--accent)">${esc(t.home.h1b)}</span> <span style="display:inline-block">${esc(t.home.h1c)}</span>
              </h1>
              <p class="reveal in reveal-delay-2" style="max-width:520px;font-size:18px;line-height:1.6;color:var(--fg-mute);margin-bottom:36px">${esc(t.home.sub)}</p>
              <div class="reveal in reveal-delay-3" style="display:flex;gap:14px;flex-wrap:wrap">
                <button class="btn btn-primary" data-nav="contact">${esc(t.home.ctaPrimary)}<span class="arrow">→</span></button>
                <button class="btn btn-ghost" data-nav="services">${esc(t.home.ctaSecondary)}</button>
              </div>
              <div class="reveal in reveal-delay-4" style="display:flex;gap:24px;margin-top:48px;padding-top:28px;border-top:1px solid var(--border);flex-wrap:wrap">
                <div>
                  <div style="font-family:var(--font-mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;color:var(--fg-mute);margin-bottom:4px">${esc(lang === "ar" ? "تأسست" : "Established")}</div>
                  <div style="font-weight:700;font-family:var(--font-display);font-size:20px">2003</div>
                </div>
                <div style="width:1px;background:var(--border)"></div>
                <div>
                  <div style="font-family:var(--font-mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;color:var(--fg-mute);margin-bottom:4px">${esc(lang === "ar" ? "الموقع" : "Location")}</div>
                  <div style="font-weight:700;font-family:var(--font-display);font-size:20px">${esc(lang === "ar" ? "مرفأ البحرين" : "Bahrain Harbour")}</div>
                </div>
                <div style="width:1px;background:var(--border)"></div>
                <div>
                  <div style="font-family:var(--font-mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;color:var(--fg-mute);margin-bottom:4px">${esc(lang === "ar" ? "الصفة" : "Status")}</div>
                  <div style="font-weight:700;font-family:var(--font-display);font-size:20px;color:var(--accent)">${esc(lang === "ar" ? "مكتب معتمد" : "Professional Body")}</div>
                </div>
              </div>
            </div>
            <div class="hero-stamps" style="position:relative;height:520px">
              ${stampsHTML}
              <div style="position:absolute;top:140px;${cornerKey}:0;width:140px;height:140px;border-radius:50%;border:1px dashed var(--accent);display:flex;align-items:center;justify-content:center;opacity:.6">
                <div style="text-align:center">
                  <div style="font-family:var(--font-serif);font-style:italic;font-size:32px;color:var(--accent);line-height:1">20+</div>
                  <div style="font-family:var(--font-mono);font-size:9px;letter-spacing:.18em;text-transform:uppercase;color:var(--fg-mute);margin-top:4px">${esc(lang === "ar" ? "عامًا" : "Years")}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <style>
          @keyframes float0 { 0%,100% { transform: rotate(-2deg) translateY(0); } 50% { transform: rotate(-2deg) translateY(calc(-8px * var(--motion))); } }
          @keyframes float1 { 0%,100% { transform: rotate(1.5deg) translateY(0); } 50% { transform: rotate(1.5deg) translateY(calc(8px * var(--motion))); } }
          @keyframes float2 { 0%,100% { transform: rotate(-1.2deg) translateY(0); } 50% { transform: rotate(-1.2deg) translateY(calc(-6px * var(--motion))); } }
          @media (max-width:980px){
            .hero-grid{grid-template-columns:1fr !important;gap:48px !important;}
            .hero-stamps{height:auto !important;display:flex !important;flex-direction:column;gap:16px;align-items:stretch;}
            .hero-stamps > .stamp{position:relative !important;width:100% !important;top:auto !important;left:auto !important;right:auto !important;transform:none !important;animation:none !important;}
            .hero-stamps > div:last-child{display:none;}
          }
        </style>
      </section>
    `;
  }

  function HeroEditorial(t, lang) {
    return `
      <section style="position:relative;padding-block:clamp(120px,16vw,200px);border-bottom:1px solid var(--border)">
        <div class="container" style="text-align:center">
          <div class="eyebrow reveal in" style="margin-bottom:36px;justify-content:center;display:inline-flex">${esc(t.home.eyebrow)}</div>
          <h1 class="reveal in reveal-delay-1" style="font-size:clamp(48px,9vw,140px);line-height:.95;font-weight:400;letter-spacing:-0.04em;max-width:1200px;margin:0 auto">
            ${esc(t.home.h1a)} <span style="font-family:var(--font-serif);font-style:italic;font-weight:300;color:var(--accent)">${esc(t.home.h1b)}</span><br/>${esc(t.home.h1c)}
          </h1>
          <p class="reveal in reveal-delay-2" style="max-width:560px;margin:40px auto 0;font-size:19px;color:var(--fg-mute)">${esc(t.home.sub)}</p>
          <div class="reveal in reveal-delay-3" style="display:flex;gap:14px;justify-content:center;margin-top:40px;flex-wrap:wrap">
            <button class="btn btn-primary" data-nav="contact">${esc(t.home.ctaPrimary)}<span class="arrow">→</span></button>
            <button class="btn btn-ghost" data-nav="services">${esc(t.home.ctaSecondary)}</button>
          </div>
        </div>
      </section>
    `;
  }

  function HeroSkyline(t, lang) {
    return `
      <section style="position:relative;min-height:min(720px,100vh);display:flex;align-items:end;overflow:hidden;border-bottom:1px solid var(--border)">
        <div style="position:absolute;inset:0;z-index:0">
          ${SkylineSvg("100%")}
          <div style="position:absolute;inset:0;background:linear-gradient(180deg, rgba(6,24,47,.4) 0%, rgba(6,24,47,.85) 100%)"></div>
        </div>
        <div class="container" style="position:relative;z-index:2;padding-block:120px 100px;color:#FAF7F2">
          <div class="eyebrow reveal in" style="margin-bottom:28px;color:var(--orange-400)">${esc(t.home.eyebrow)}</div>
          <h1 class="reveal in reveal-delay-1" style="color:#FFFFFF;max-width:900px;margin-bottom:24px">
            ${esc(t.home.h1a)} <span style="font-family:var(--font-serif);font-style:italic;font-weight:300;color:var(--orange-400)">${esc(t.home.h1b)}</span> ${esc(t.home.h1c)}
          </h1>
          <p class="reveal in reveal-delay-2" style="max-width:540px;color:rgba(250,247,242,.78);font-size:18px;margin-bottom:36px">${esc(t.home.sub)}</p>
          <div class="reveal in reveal-delay-3" style="display:flex;gap:14px;flex-wrap:wrap">
            <button class="btn btn-primary" data-nav="contact">${esc(t.home.ctaPrimary)}<span class="arrow">→</span></button>
            <button class="btn" style="border:1px solid rgba(255,255,255,.3);color:#FFF" data-nav="services">${esc(t.home.ctaSecondary)}</button>
          </div>
        </div>
      </section>
    `;
  }

  function HomeMarquee(items) {
    const row = items.concat(items);
    return `
      <div style="border-block:1px solid var(--border);padding:22px 0;background:var(--bg-2)">
        <div class="marquee">
          <div class="marquee-track">
            ${row.map((s) => `
              <span style="display:inline-flex;align-items:center;gap:24px;font-family:var(--font-display);font-size:22px;font-weight:500;color:var(--fg-2)">
                ${esc(s)}
                <span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:var(--accent)"></span>
              </span>
            `).join("")}
          </div>
        </div>
      </div>
    `;
  }

  function HomeAbout(t, lang) {
    const moreLabel = lang === "ar" ? "تعرف أكثر" : "More about us";
    return `
      <section class="section">
        <div class="container">
          <div class="ha-grid" style="display:grid;grid-template-columns:1fr 1.2fr;gap:80px;align-items:start">
            <div>
              <div class="eyebrow reveal" style="margin-bottom:28px">${esc(t.home.aboutEyebrow)}</div>
              <h2 class="reveal reveal-delay-1" style="margin-bottom:28px">${esc(t.home.aboutTitle)}</h2>
              <p class="reveal reveal-delay-2" style="font-size:17px;line-height:1.65;margin-bottom:32px">${esc(t.home.aboutBody)}</p>
              <button class="btn btn-brand reveal reveal-delay-3" data-nav="about">${esc(moreLabel)}<span class="arrow">→</span></button>
            </div>
            <div>
              <div class="grid grid-2 reveal" style="gap:1px;background:var(--border);border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden">
                ${t.home.aboutStats.map((s) => `
                  <div style="background:var(--bg-elev);padding:36px 32px;min-height:200px;display:flex;flex-direction:column;justify-content:space-between">
                    <span class="stat-num" data-target="${s.n}" data-unit="${esc(s.unit||"")}">0<span class="unit"></span></span>
                    <div style="font-size:14px;color:var(--fg-mute);letter-spacing:.01em;margin-top:24px">${esc(s.l)}</div>
                  </div>
                `).join("")}
              </div>
            </div>
          </div>
        </div>
        <style>@media (max-width:980px){.ha-grid{grid-template-columns:1fr !important;gap:48px !important;}}</style>
      </section>
    `;
  }

  function HomeServices(t, lang) {
    return `
      <section class="section" style="background:var(--bg-2);border-block:1px solid var(--border)">
        <div class="container">
          <div class="hs-top" style="display:grid;grid-template-columns:1fr 1.2fr;gap:60px;margin-bottom:64px;align-items:end">
            <div>
              <div class="eyebrow reveal">${esc(t.home.servicesEyebrow)}</div>
              <h2 class="reveal reveal-delay-1" style="margin-top:28px">${esc(t.home.servicesTitle)}</h2>
            </div>
            <p class="reveal reveal-delay-2" style="max-width:480px;font-size:17px;color:var(--fg-mute)">${esc(t.home.servicesSub)}</p>
          </div>
          <div class="reveal">
            ${t.home.services.map((s, i) => `
              <div class="svc-item" data-open-svc="${i}">
                <div class="svc-num">${esc(s.n)}</div>
                <div>
                  <div style="font-family:var(--font-mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;color:var(--fg-mute);margin-bottom:8px">${esc(s.tag)}</div>
                  <div class="svc-title">${esc(s.title)}</div>
                </div>
                <div class="svc-arrow">${icons.arrowRight}</div>
              </div>
            `).join("")}
          </div>
        </div>
        <style>@media (max-width:880px){.hs-top{grid-template-columns:1fr !important;gap:24px !important;}}</style>
      </section>
    `;
  }

  function HomePartners(t, lang) {
    return `
      <section class="section">
        <div class="container">
          <div class="eyebrow reveal" style="margin-bottom:24px">${esc(t.home.partnersEyebrow)}</div>
          <h2 class="reveal reveal-delay-1" style="max-width:720px;margin-bottom:48px">${esc(t.home.partnersTitle)}</h2>
          <div class="grid grid-2 reveal">
            ${t.home.partners.map((p, i) => `
              <div class="card" style="padding:40px 36px;display:flex;flex-direction:column;gap:18px">
                <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:8px">
                  <div>
                    <div style="font-family:var(--font-mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;color:var(--fg-mute);margin-bottom:6px">${esc(p.tag)}</div>
                    <h3 style="font-size:28px;font-weight:600;letter-spacing:-0.02em">${esc(p.name)}</h3>
                  </div>
                  <div style="padding:6px 12px;background:var(--bg);border:1px solid var(--border);border-radius:999px;font-size:11px;font-family:var(--font-mono);color:var(--accent);letter-spacing:.1em">${i===0 ? "HR" : "FIN"}</div>
                </div>
                <p style="color:var(--fg-mute);line-height:1.6">${esc(p.body)}</p>
                <div style="margin-top:8px">
                  <a data-nav="partners" style="cursor:pointer;display:inline-flex;align-items:center;gap:8px;font-size:13px;font-weight:600;color:var(--accent)">${esc(t.common.learnMore)} <span class="arrow">→</span></a>
                </div>
              </div>
            `).join("")}
          </div>
        </div>
      </section>
    `;
  }

  function HomePillars(t, lang) {
    return `
      <section class="section" style="background:var(--brand);color:var(--on-brand);position:relative;overflow:hidden">
        <div class="dotgrid" style="position:absolute;inset:0;color:#FFFFFF;opacity:.06" aria-hidden></div>
        <div class="container" style="position:relative;z-index:2">
          <div class="eyebrow reveal" style="margin-bottom:24px">${esc(t.home.pillarsEyebrow)}</div>
          <h2 class="reveal reveal-delay-1" style="max-width:720px;margin-bottom:64px;color:#FFFFFF">${esc(t.home.pillarsTitle)}</h2>
          <div class="grid grid-4 reveal">
            ${t.home.pillars.map((p, i) => `
              <div style="padding:28px 0;border-top:1px solid rgba(255,255,255,.15);display:flex;flex-direction:column;gap:16px;min-height:240px">
                <div style="font-family:var(--font-serif);font-style:italic;font-weight:300;font-size:32px;color:var(--accent)">0${i+1}</div>
                <h4 style="color:#FFFFFF;font-weight:600">${esc(p.t)}</h4>
                <p style="color:rgba(255,255,255,.7);font-size:14px;line-height:1.6;margin-top:auto">${esc(p.d)}</p>
              </div>
            `).join("")}
          </div>
        </div>
      </section>
    `;
  }

  function HomeBlog(t, lang) {
    const top = t.blog.articles.slice(0, 3);
    return `
      <section class="section">
        <div class="container">
          <div style="display:flex;justify-content:space-between;align-items:end;margin-bottom:48px;flex-wrap:wrap;gap:24px">
            <div>
              <div class="eyebrow reveal">${esc(t.home.blogEyebrow)}</div>
              <h2 class="reveal reveal-delay-1" style="margin-top:24px">${esc(t.home.blogTitle)}</h2>
            </div>
            <button class="btn btn-ghost" data-nav="blog">${esc(t.common.viewAll)}<span class="arrow">→</span></button>
          </div>
          <div class="grid grid-3 reveal">
            ${top.map((a) => `
              <article class="card" style="padding:0;overflow:hidden;cursor:pointer" data-nav="article">
                <div class="img-ph" style="aspect-ratio:4/3;border-radius:0;border-bottom:1px solid var(--border)">
                  <span class="ph-label">${esc(lang === "ar" ? "صورة" : "image")} · ${esc(a.c)}</span>
                </div>
                <div style="padding:28px">
                  <div style="display:flex;gap:10px;align-items:center;font-size:12px;color:var(--fg-mute);font-family:var(--font-mono);letter-spacing:.1em;margin-bottom:14px">
                    <span style="color:var(--accent)">${esc(a.c)}</span><span>·</span><span>${esc(a.r)} ${esc(t.blog.readTime)}</span>
                  </div>
                  <h3 style="font-size:20px;font-weight:600;letter-spacing:-0.015em;line-height:1.25;margin-bottom:14px">${esc(a.t)}</h3>
                  <p style="font-size:14px;color:var(--fg-mute);line-height:1.55">${esc(a.e)}</p>
                  <div style="margin-top:18px;font-size:12px;color:var(--fg-mute);font-family:var(--font-mono);letter-spacing:.06em">${esc(a.d)}</div>
                </div>
              </article>
            `).join("")}
          </div>
        </div>
      </section>
    `;
  }

  function PageHome(t, lang, state) {
    const hero = state.hero === "editorial" ? HeroEditorial(t, lang)
               : state.hero === "skyline"   ? HeroSkyline(t, lang)
               : HeroDefault(t, lang);
    return `<main class="page" data-page="home">
      ${hero}
      ${HomeMarquee(t.home.marquee)}
      ${HomeAbout(t, lang)}
      ${HomeServices(t, lang)}
      ${HomePartners(t, lang)}
      ${HomePillars(t, lang)}
      ${HomeBlog(t, lang)}
      ${FinalCTA(t, lang)}
    </main>`;
  }

  /* ── ABOUT ───────────────────────────────────────────────────────────── */
  function PageAbout(t, lang) {
    const a = t.about;
    const isRTL = lang === "ar";
    return `<main class="page" data-page="about">
      ${PageBanner(a.crumb, a.h1, a.sub, lang, t)}

      <section class="section">
        <div class="container">
          <div class="ab-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:start">
            <div class="reveal">
              <div class="img-ph" style="aspect-ratio:4/5;position:sticky;top:120px">
                ${SkylineSvg(520)}
                <span class="ph-label" style="position:absolute;bottom:24px;left:24px;right:auto">Bahrain Financial Harbour · dusk</span>
              </div>
            </div>
            <div style="display:flex;flex-direction:column;gap:48px">
              ${a.sections.map((s, i) => `
                <div class="reveal" style="transition-delay:${i*.08}s">
                  <div style="display:flex;align-items:center;gap:14px;margin-bottom:14px">
                    <span style="font-family:var(--font-serif);font-style:italic;font-size:34px;color:var(--accent);font-weight:300">0${i+1}</span>
                    <h3 style="font-size:24px;font-weight:600;letter-spacing:-0.015em">${esc(s.t)}</h3>
                  </div>
                  <p style="font-size:17px;line-height:1.65;color:var(--fg-2)">${esc(s.b)}</p>
                </div>
              `).join("")}
            </div>
          </div>
        </div>
        <style>@media (max-width:880px){.ab-grid{grid-template-columns:1fr !important;gap:48px !important;} .ab-grid > div:first-child{display:none}}</style>
      </section>

      <section class="section" style="background:var(--bg-2);border-block:1px solid var(--border)">
        <div class="container">
          <div class="eyebrow reveal" style="margin-bottom:24px">${esc(a.valuesEyebrow)}</div>
          <h2 class="reveal reveal-delay-1" style="max-width:680px;margin-bottom:64px">${esc(a.valuesTitle)}</h2>
          <div class="grid grid-4 reveal">
            ${a.values.map((v, i) => `
              <div style="padding:32px 28px;background:var(--bg-elev);border:1px solid var(--border);border-radius:var(--radius-lg);display:flex;flex-direction:column;gap:16px;min-height:220px;position:relative;overflow:hidden">
                <div style="font-family:var(--font-mono);font-size:11px;letter-spacing:.18em;color:var(--accent)">0${i+1}</div>
                <h4 style="font-weight:600;font-size:20px;letter-spacing:-0.01em">${esc(v.t)}</h4>
                <p style="color:var(--fg-mute);font-size:14px;line-height:1.6;margin-top:auto">${esc(v.d)}</p>
                <div class="stripe-motif" style="position:absolute;bottom:-30px;${isRTL?"left":"right"}:-30px;width:80px;height:80px;opacity:.12;-webkit-mask-image:radial-gradient(circle,#000,transparent 70%);mask-image:radial-gradient(circle,#000,transparent 70%)" aria-hidden></div>
              </div>
            `).join("")}
          </div>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <div class="ab-team-top" style="display:grid;grid-template-columns:1fr 1.4fr;gap:80px;margin-bottom:48px;align-items:end">
            <div>
              <div class="eyebrow reveal">${esc(a.teamEyebrow)}</div>
              <h2 class="reveal reveal-delay-1" style="margin-top:24px">${esc(a.teamTitle)}</h2>
            </div>
            <p class="reveal reveal-delay-2" style="font-size:17px;color:var(--fg-mute)">${esc(a.teamSub)}</p>
          </div>
          <div class="grid grid-4 reveal">
            ${a.team.map((m) => `
              <div class="card" style="padding:0;overflow:hidden">
                <div class="img-ph" style="aspect-ratio:3/4;border-radius:0">
                  <span class="ph-label">${esc(lang === "ar" ? "صورة" : "portrait")}</span>
                </div>
                <div style="padding:22px 24px">
                  <h4 style="font-size:16px;font-weight:600;margin-bottom:4px">${esc(m.n)}</h4>
                  <div style="font-size:13px;color:var(--fg-mute);margin-bottom:8px">${esc(m.r)}</div>
                  <div style="font-family:var(--font-mono);font-size:11px;letter-spacing:.1em;color:var(--accent)">${esc(m.y)}</div>
                </div>
              </div>
            `).join("")}
          </div>
        </div>
        <style>@media (max-width:880px){.ab-team-top{grid-template-columns:1fr !important;gap:24px !important;}}</style>
      </section>

      ${FinalCTA(t, lang)}
    </main>`;
  }

  /* ── SERVICES ────────────────────────────────────────────────────────── */
  function PageServices(t, lang) {
    const s = t.services;
    const moreLabel = lang === "ar" ? "بنود إضافية" : "more items";
    return `<main class="page" data-page="services">
      ${PageBanner(s.crumb, s.h1, s.sub, lang, t)}
      <section class="section">
        <div class="container">
          ${t.home.services.map((svc, i) => `
            <div class="reveal" style="border-top:1px solid var(--border);padding:56px 0;display:grid;grid-template-columns:120px 1.4fr 1fr;gap:48px;align-items:start" data-svc-row="${i}">
              <div style="font-family:var(--font-serif);font-style:italic;font-weight:300;font-size:64px;color:var(--accent);line-height:1">${esc(svc.n)}</div>
              <div>
                <div class="eyebrow" style="margin-bottom:16px">${esc(svc.tag)}</div>
                <h2 style="font-size:clamp(28px,3.4vw,44px);margin-bottom:20px;letter-spacing:-0.02em;font-weight:500">${esc(svc.title)}</h2>
                <p style="font-size:17px;color:var(--fg-mute);line-height:1.65;max-width:560px;margin-bottom:24px">${esc(svc.desc)}</p>
                <button class="btn btn-brand" data-open-svc="${i}">${esc(lang === "ar" ? "تفاصيل النطاق" : "View full scope")}<span class="arrow">→</span></button>
              </div>
              <div style="display:grid;grid-template-columns:1fr;gap:0">
                ${svc.items.slice(0,5).map((it, j) => `
                  <div style="padding:14px 0;border-bottom:1px solid var(--border);display:flex;gap:14px;align-items:baseline">
                    <span style="font-family:var(--font-mono);font-size:10px;color:var(--accent);letter-spacing:.14em;flex:0 0 auto">${String(j+1).padStart(2,"0")}</span>
                    <span style="font-size:14px;color:var(--fg-2)">${esc(it)}</span>
                  </div>
                `).join("")}
                ${svc.items.length > 5 ? `<div style="padding:14px 0;font-size:13px;color:var(--accent);cursor:pointer" data-open-svc="${i}">+${svc.items.length-5} ${esc(moreLabel)} →</div>` : ""}
              </div>
            </div>
          `).join("")}
        </div>
        <style>@media (max-width:880px){[data-svc-row]{grid-template-columns:1fr !important;gap:24px !important;padding:36px 0 !important;} [data-svc-row] > div:first-child{font-size:42px !important;}}</style>
      </section>

      <section class="section" style="background:var(--bg-2);border-block:1px solid var(--border)">
        <div class="container">
          <div class="eyebrow reveal" style="margin-bottom:24px">${esc(lang === "ar" ? "كيف نعمل" : "How we work")}</div>
          <h2 class="reveal reveal-delay-1" style="max-width:720px;margin-bottom:60px">${esc(lang === "ar" ? "أربع خطوات من الفكرة إلى السجل التجاري." : "Four steps, idea to live CR.")}</h2>
          <div class="grid grid-4 reveal">
            ${[
              { t: lang === "ar" ? "محادثة استكشافية" : "Discovery call",  d: lang === "ar" ? "30 دقيقة. نفهم النشاط، الهيكل، الجدول." : "30 minutes. We understand the activity, structure, timeline." },
              { t: lang === "ar" ? "عرض ثابت" : "Fixed quote",              d: lang === "ar" ? "رسوم حكومية + أتعابنا. كل شيء مكتوب." : "Government fees + our flat fee. Everything in writing." },
              { t: lang === "ar" ? "التنفيذ" : "Execution",                  d: lang === "ar" ? "نتولى الوزارة والمصرف وفتح الحساب." : "We handle MOIC, CBB if needed, bank account opening." },
              { t: lang === "ar" ? "الاستمرارية" : "Continuity",             d: lang === "ar" ? "تقويم الصيانة، تحديثات السنة، الإقرارات." : "Annual maintenance calendar, renewals, filings." },
            ].map((p, i) => `
              <div style="padding:32px 0;border-top:2px solid var(--accent);display:flex;flex-direction:column;gap:14px;min-height:200px">
                <div style="font-family:var(--font-mono);font-size:11px;letter-spacing:.18em;color:var(--fg-mute)">STEP 0${i+1}</div>
                <h4 style="font-weight:600">${esc(p.t)}</h4>
                <p style="font-size:14px;color:var(--fg-mute);line-height:1.6">${esc(p.d)}</p>
              </div>
            `).join("")}
          </div>
        </div>
      </section>

      ${FinalCTA(t, lang)}
    </main>`;
  }

  /* ── PARTNERS ────────────────────────────────────────────────────────── */
  function PagePartners(t, lang) {
    const p = t.partners;
    return `<main class="page" data-page="partners">
      ${PageBanner(p.crumb, p.h1, p.sub, lang, t)}
      <section class="section">
        <div class="container" style="display:flex;flex-direction:column;gap:56px">
          ${p.detailedPartners.map((pp, i) => {
            const placeholder = `<div class="img-ph" style="aspect-ratio:4/3"><span class="ph-label">${esc(pp.name)} · brand asset</span></div>`;
            const text = `
              <div>
                <div class="eyebrow" style="margin-bottom:16px">${esc(pp.tag)} · ${esc(pp.region)}</div>
                <h2 style="font-size:clamp(32px,4vw,52px);margin-bottom:24px">${esc(pp.name)}</h2>
                <p style="font-size:17px;color:var(--fg-mute);line-height:1.65;margin-bottom:24px">${esc(pp.body)}</p>
                <div style="display:flex;flex-wrap:wrap;gap:8px">
                  ${pp.services.map((sv) => `<span class="chip"><span class="dot"></span>${esc(sv)}</span>`).join("")}
                </div>
              </div>`;
            const cols = i % 2 === 0 ? "1fr 1.2fr" : "1.2fr 1fr";
            const inner = i % 2 === 0 ? placeholder + text : text + placeholder;
            return `<div class="reveal partner-row" style="display:grid;grid-template-columns:${cols};gap:60px;align-items:center;padding:56px 0;${i===0 ? "" : "border-top:1px solid var(--border)"}">${inner}</div>`;
          }).join("")}
        </div>
        <style>@media (max-width:880px){.partner-row{grid-template-columns:1fr !important;gap:32px !important;}}</style>
      </section>
      <section class="section-sm" style="background:var(--brand);color:var(--on-brand)">
        <div class="container" style="display:flex;justify-content:space-between;align-items:center;gap:32px;flex-wrap:wrap">
          <div>
            <h3 style="color:#FFFFFF;margin-bottom:8px;font-weight:500">${esc(lang === "ar" ? "تبحث عن شريك؟" : "Looking for a partner?")}</h3>
            <p style="color:rgba(255,255,255,.7);max-width:520px">${esc(lang === "ar" ? "نوصلك بالأدوات التي نعرف ونثق بها." : "We'll connect you with platforms we know and trust.")}</p>
          </div>
          <button class="btn btn-primary" data-nav="contact">${esc(lang === "ar" ? "تواصل معنا" : "Get in touch")}<span class="arrow">→</span></button>
        </div>
      </section>
    </main>`;
  }

  /* ── GALLERY ─────────────────────────────────────────────────────────── */
  function PageGallery(t, lang, state) {
    const g = t.gallery;
    const cat = state.galleryCat && g.categories.includes(state.galleryCat) ? state.galleryCat : g.categories[0];
    const filtered = cat === g.categories[0] ? g.items : g.items.filter((it) => it.tag === cat);
    const ratios = ["3/4","4/3","1/1","3/4","4/3","1/1","3/4","4/3","1/1"];
    return `<main class="page" data-page="gallery">
      ${PageBanner(g.crumb, g.h1, g.sub, lang, t)}
      <section class="section">
        <div class="container">
          <div class="reveal" style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:48px;padding-bottom:24px;border-bottom:1px solid var(--border)">
            ${g.categories.map((c) => `
              <button data-gallery-cat="${esc(c)}" style="padding:10px 20px;border-radius:999px;border:1px solid ${cat===c?"var(--accent)":"var(--border)"};background:${cat===c?"var(--accent)":"transparent"};color:${cat===c?"var(--on-accent)":"var(--fg-2)"};font-weight:500;font-size:13px;letter-spacing:.01em;transition:all .25s var(--ease)">${esc(c)}</button>
            `).join("")}
          </div>
          <div class="gal-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;grid-auto-rows:minmax(220px,auto)">
            ${filtered.map((it, i) => `
              <div class="reveal" style="grid-row:${i%5===0?"span 2":"span 1"}">
                <div class="img-ph" style="aspect-ratio:${i%5===0?"3/4":ratios[i%ratios.length]};height:${i%5===0?"100%":"auto"};cursor:pointer;transition:transform .5s var(--ease-soft)">
                  <span class="ph-label">${esc(it.label)}</span>
                  <div style="position:absolute;bottom:14px;left:14px;right:14px;display:flex;justify-content:space-between;align-items:end">
                    <span style="font-family:var(--font-mono);font-size:10px;letter-spacing:.18em;color:rgba(255,255,255,.7);background:rgba(0,0,0,.4);padding:4px 10px;border-radius:999px;backdrop-filter:blur(4px)">${esc(it.tag)}</span>
                  </div>
                </div>
              </div>
            `).join("")}
          </div>
        </div>
        <style>@media (max-width:880px){.gal-grid{grid-template-columns:repeat(2,1fr) !important;} .gal-grid > div{grid-row:span 1 !important;}} @media (max-width:540px){.gal-grid{grid-template-columns:1fr !important;}}</style>
      </section>
      ${FinalCTA(t, lang)}
    </main>`;
  }

  /* ── FAQS ────────────────────────────────────────────────────────────── */
  function PageFaqs(t, lang, state) {
    const f = t.faqs;
    const cat = state.faqCat && f.categories.includes(state.faqCat) ? state.faqCat : f.categories[0];
    const items = f.items.filter((it) => it.c === cat);
    const open = state.faqOpen ?? 0;
    return `<main class="page" data-page="faqs">
      ${PageBanner(f.crumb, f.h1, f.sub, lang, t)}
      <section class="section">
        <div class="container">
          <div class="faq-grid" style="display:grid;grid-template-columns:1fr 2.4fr;gap:80px;align-items:start">
            <div class="reveal" style="position:sticky;top:120px">
              <div class="eyebrow" style="margin-bottom:20px">${esc(lang === "ar" ? "المواضيع" : "Topics")}</div>
              <div style="display:flex;flex-direction:column;gap:0">
                ${f.categories.map((c, i) => `
                  <button data-faq-cat="${esc(c)}" style="text-align:${lang === "ar" ? "right" : "left"};padding:18px 0;border-bottom:1px solid var(--border);${i===0?"border-top:1px solid var(--border);":""}color:${cat===c?"var(--accent)":"var(--fg-2)"};font-weight:${cat===c?600:500};font-size:18px;display:flex;justify-content:space-between;align-items:center;transition:color .25s var(--ease)">
                    <span>${esc(c)}</span>
                    <span style="font-family:var(--font-mono);font-size:11px;color:var(--fg-mute)">0${i+1}</span>
                  </button>
                `).join("")}
              </div>
              <div style="margin-top:48px;padding:24px;background:var(--bg-2);border:1px solid var(--border);border-radius:var(--radius-lg)">
                <h4 style="margin-bottom:10px;font-weight:600;font-size:16px">${esc(lang === "ar" ? "سؤالك ليس هنا؟" : "Question not here?")}</h4>
                <p style="font-size:13px;color:var(--fg-mute);margin-bottom:16px;line-height:1.5">${esc(lang === "ar" ? "اكتب إلينا — سيرد عليك مستشار أول." : "Write to us — a senior consultant will respond.")}</p>
                <button class="btn btn-primary" style="padding:10px 18px;font-size:13px" data-nav="contact">${esc(lang === "ar" ? "تواصل" : "Ask us")}<span class="arrow">→</span></button>
              </div>
            </div>
            <div class="reveal">
              <div style="margin-bottom:32px">
                <div style="font-family:var(--font-mono);font-size:11px;letter-spacing:.18em;color:var(--accent);margin-bottom:8px">${esc(cat)}</div>
                <h2 style="font-size:clamp(28px,3.2vw,40px)">${items.length} ${esc(lang === "ar" ? "أسئلة" : "questions")}</h2>
              </div>
              ${items.map((it, i) => `
                <div class="acc-item${i===open?" open":""}" data-acc-toggle="${i}">
                  <div class="acc-q">
                    <h3 style="font-size:20px">${esc(it.q)}</h3>
                    <div class="acc-toggle">${icons.plus}</div>
                  </div>
                  <div class="acc-a">
                    <p style="font-size:16px;line-height:1.65">${esc(it.a)}</p>
                  </div>
                </div>
              `).join("")}
            </div>
          </div>
        </div>
        <style>@media (max-width:880px){.faq-grid{grid-template-columns:1fr !important;gap:48px !important;} .faq-grid > div:first-child{position:static !important;}}</style>
      </section>
      ${FinalCTA(t, lang)}
    </main>`;
  }

  /* ── BLOG ────────────────────────────────────────────────────────────── */
  function PageBlogIndex(t, lang, state) {
    const b = t.blog;
    const cat = state.blogCat && b.categories.includes(state.blogCat) ? state.blogCat : b.categories[0];
    const filtered = cat === b.categories[0] ? b.articles : b.articles.filter((a) => a.c === cat);
    const featured = filtered[0];
    const rest = filtered.slice(1);
    return `<main class="page" data-page="blog">
      ${PageBanner(b.crumb, b.h1, b.sub, lang, t)}
      <section class="section-sm" style="border-bottom:1px solid var(--border)">
        <div class="container" style="display:flex;gap:8px;flex-wrap:wrap">
          ${b.categories.map((c) => `
            <button data-blog-cat="${esc(c)}" style="padding:10px 20px;border-radius:999px;border:1px solid ${cat===c?"var(--accent)":"var(--border)"};background:${cat===c?"var(--accent)":"transparent"};color:${cat===c?"var(--on-accent)":"var(--fg-2)"};font-weight:500;font-size:13px;transition:all .25s var(--ease)">${esc(c)}</button>
          `).join("")}
        </div>
      </section>
      ${featured ? `
      <section class="section">
        <div class="container">
          <div class="reveal blog-featured" data-nav="article" style="cursor:pointer;display:grid;grid-template-columns:1.2fr 1fr;gap:60px;align-items:center">
            <div class="img-ph" style="aspect-ratio:4/3"><span class="ph-label">${esc(lang === "ar" ? "مميز" : "featured")} · ${esc(featured.c)}</span></div>
            <div>
              <div class="eyebrow" style="margin-bottom:16px">${esc(b.latest)} · ${esc(featured.c)}</div>
              <h2 style="font-size:clamp(28px,3.6vw,44px);margin-bottom:18px;letter-spacing:-0.02em">${esc(featured.t)}</h2>
              <p style="font-size:17px;color:var(--fg-mute);line-height:1.65;margin-bottom:24px">${esc(featured.e)}</p>
              <div style="display:flex;gap:14px;align-items:center;font-size:13px;color:var(--fg-mute);font-family:var(--font-mono);letter-spacing:.06em">
                <span>${esc(featured.d)}</span><span>·</span><span>${esc(featured.r)} ${esc(b.readTime)}</span>
              </div>
              <button class="btn btn-brand" style="margin-top:24px" data-nav="article">${esc(t.common.readMore)}<span class="arrow">→</span></button>
            </div>
          </div>
        </div>
        <style>@media (max-width:880px){.blog-featured{grid-template-columns:1fr !important;gap:32px !important;}}</style>
      </section>` : ""}
      <section class="section" style="padding-top:0">
        <div class="container">
          <div class="grid grid-3 reveal">
            ${rest.map((a) => `
              <article class="card" style="padding:0;overflow:hidden;cursor:pointer" data-nav="article">
                <div class="img-ph" style="aspect-ratio:4/3;border-radius:0;border-bottom:1px solid var(--border)">
                  <span class="ph-label">${esc(a.c)}</span>
                </div>
                <div style="padding:28px">
                  <div style="display:flex;gap:10px;align-items:center;font-size:12px;color:var(--fg-mute);font-family:var(--font-mono);letter-spacing:.1em;margin-bottom:14px">
                    <span style="color:var(--accent)">${esc(a.c)}</span><span>·</span><span>${esc(a.r)} ${esc(b.readTime)}</span>
                  </div>
                  <h3 style="font-size:20px;font-weight:600;letter-spacing:-0.015em;line-height:1.25;margin-bottom:14px">${esc(a.t)}</h3>
                  <p style="font-size:14px;color:var(--fg-mute);line-height:1.55">${esc(a.e)}</p>
                  <div style="margin-top:18px;font-size:12px;color:var(--fg-mute);font-family:var(--font-mono);letter-spacing:.06em">${esc(a.d)}</div>
                </div>
              </article>
            `).join("")}
          </div>
        </div>
      </section>
    </main>`;
  }

  function PageArticle(t, lang) {
    const a = t.blog.article;
    return `<main class="page" data-page="article">
      <section class="section" style="padding-top:120px;padding-bottom:48px">
        <div class="container" style="max-width:820px">
          <div class="crumb reveal in" style="margin-bottom:32px">
            <a data-nav="blog" style="cursor:pointer">${esc(t.blog.crumb)}</a> / <span style="color:var(--accent)">${esc(a.category)}</span>
          </div>
          <h1 class="reveal in reveal-delay-1" style="font-size:clamp(36px,5vw,60px);line-height:1.05;margin-bottom:32px">${esc(a.title)}</h1>
          <div class="reveal in reveal-delay-2" style="display:flex;gap:24px;align-items:center;padding-bottom:32px;border-bottom:1px solid var(--border);font-family:var(--font-mono);font-size:12px;color:var(--fg-mute);letter-spacing:.06em;flex-wrap:wrap">
            <span>${esc(a.author)}</span><span>·</span><span>${esc(a.date)}</span><span>·</span><span>${esc(a.readTime)}</span>
          </div>
        </div>
      </section>
      <section style="padding-bottom:60px">
        <div class="container" style="max-width:1100px">
          <div class="img-ph reveal" style="aspect-ratio:16/8">
            <span class="ph-label">${esc(lang === "ar" ? "غلاف" : "cover")} · ${esc(a.category)}</span>
          </div>
        </div>
      </section>
      <section style="padding-bottom:80px">
        <div class="container" style="max-width:720px">
          <p class="reveal" style="font-size:22px;font-family:var(--font-serif);font-style:italic;font-weight:300;color:var(--fg);line-height:1.4;margin-bottom:36px;padding-bottom:36px;border-bottom:1px solid var(--border)">${esc(a.lede)}</p>
          ${a.body.map((blk) => {
            if (blk.k === "h") return `<h3 class="reveal" style="font-size:24px;font-weight:600;margin-top:36px;margin-bottom:18px;letter-spacing:-0.01em">${esc(blk.v)}</h3>`;
            if (blk.k === "q") return `<blockquote class="reveal" style="margin:36px 0;padding-inline-start:24px;border-inline-start:3px solid var(--accent);font-family:var(--font-serif);font-style:italic;font-weight:300;font-size:22px;color:var(--fg);line-height:1.45">&ldquo;${esc(blk.v)}&rdquo;</blockquote>`;
            return `<p class="reveal" style="font-size:17px;line-height:1.75;color:var(--fg-2);margin-bottom:18px">${esc(blk.v)}</p>`;
          }).join("")}
        </div>
      </section>
      <section class="section-sm" style="border-top:1px solid var(--border)">
        <div class="container" style="display:flex;justify-content:space-between;align-items:center;gap:24px;flex-wrap:wrap">
          <button class="btn btn-ghost" data-nav="blog">${esc(lang === "ar" ? "← كل المقالات" : "← All articles")}</button>
          <button class="btn btn-primary" data-nav="contact">${esc(lang === "ar" ? "تحدث مع مستشار" : "Talk to a consultant")}<span class="arrow">→</span></button>
        </div>
      </section>
    </main>`;
  }

  /* ── CONTACT ─────────────────────────────────────────────────────────── */
  function FieldFloat(label, name, type, required) {
    type = type || "text";
    return `<label class="ff-field" style="position:relative;display:block">
      <input class="ff-input" type="${type}" name="${esc(name)}" ${required ? "required" : ""} placeholder=" " />
      <span class="ff-label">${esc(label)}${required ? "*" : ""}</span>
    </label>`;
  }
  function FieldSelect(label, name, options) {
    return `<label style="display:block;position:relative">
      <span style="position:absolute;inset-inline-start:14px;top:-8px;font-size:11px;font-family:var(--font-mono);letter-spacing:.12em;text-transform:uppercase;color:var(--accent);background:var(--bg-elev);padding:0 6px;z-index:1">${esc(label)}</span>
      <select name="${esc(name)}" class="ff-select" style="width:100%;padding:16px 14px;background:transparent;border:1px solid var(--border-strong);border-radius:10px;outline:none;font-size:15px;appearance:none;cursor:pointer;color:inherit">
        <option value="" disabled selected></option>
        ${options.map((o) => `<option value="${esc(o)}">${esc(o)}</option>`).join("")}
      </select>
      <span style="position:absolute;inset-inline-end:14px;top:18px;color:var(--fg-mute);pointer-events:none">${icons.chevron}</span>
    </label>`;
  }
  function FieldTextarea(label, name) {
    return `<label class="ff-field" style="position:relative;display:block">
      <textarea class="ff-input ff-area" name="${esc(name)}" rows="5" placeholder=" "></textarea>
      <span class="ff-label">${esc(label)}</span>
    </label>`;
  }
  function InfoCard(icon, title, primary, secondary, action) {
    const external = String(action || "").startsWith("http");
    return `<a href="${esc(action)}" ${external ? 'target="_blank" rel="noreferrer"' : ""} class="info-card" style="display:grid;grid-template-columns:56px 1fr auto;gap:20px;align-items:center;padding:24px 28px;background:var(--bg-elev);border:1px solid var(--border);border-radius:var(--radius-lg);transition:all .3s var(--ease-soft)">
      <div style="width:48px;height:48px;border-radius:12px;background:var(--bg);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--accent)">${icons[icon] || ""}</div>
      <div>
        <div style="font-family:var(--font-mono);font-size:10px;letter-spacing:.18em;text-transform:uppercase;color:var(--fg-mute);margin-bottom:6px">${esc(title)}</div>
        <div style="font-weight:600;font-size:15px;${secondary?"margin-bottom:2px":""}">${esc(primary)}</div>
        ${secondary ? `<div style="font-size:13px;color:var(--fg-mute)">${esc(secondary)}</div>` : ""}
      </div>
      <div class="arrow" style="color:var(--fg-mute)">→</div>
    </a>`;
  }
  function PageContact(t, lang, state) {
    const c = t.contact;
    const sent = !!state.contactSent;
    return `<main class="page" data-page="contact">
      ${PageBanner(c.crumb, c.h1, c.sub, lang, t)}
      <section class="section">
        <div class="container">
          <div class="cnt-grid" style="display:grid;grid-template-columns:1.2fr 1fr;gap:80px;align-items:start">
            <div class="reveal" style="padding:40px;background:var(--bg-elev);border:1px solid var(--border);border-radius:var(--radius-xl);box-shadow:var(--shadow-sm)">
              <div class="eyebrow" style="margin-bottom:16px">${esc(c.formTitle)}</div>
              <h2 style="font-size:clamp(26px,2.8vw,36px);margin-bottom:32px;font-weight:500">${esc(lang === "ar" ? "نسعد بسماعك." : "We'd love to hear from you.")}</h2>
              ${sent ? `
                <div style="padding:40px 24px;border:1px solid var(--accent);border-radius:var(--radius-lg);background:var(--bg);text-align:center">
                  <div style="width:56px;height:56px;border-radius:50%;background:var(--accent);margin:0 auto 20px;display:flex;align-items:center;justify-content:center;color:var(--on-accent)">${icons.check}</div>
                  <h3 style="font-weight:600;margin-bottom:8px">${esc(c.success)}</h3>
                  <button class="btn btn-ghost" style="margin-top:16px" data-contact-reset>${esc(lang === "ar" ? "رسالة أخرى" : "Send another")}</button>
                </div>
              ` : `
                <form data-contact-form style="display:flex;flex-direction:column;gap:18px">
                  <div class="cnt-row" style="display:grid;grid-template-columns:1fr 1fr;gap:18px">
                    ${FieldFloat(c.fields.name, "name", "text", true)}
                    ${FieldFloat(c.fields.email, "email", "email", true)}
                  </div>
                  <div class="cnt-row" style="display:grid;grid-template-columns:1fr 1fr;gap:18px">
                    ${FieldFloat(c.fields.phone, "phone", "tel", false)}
                    ${FieldFloat(c.fields.company, "company", "text", false)}
                  </div>
                  ${FieldSelect(c.fields.topic, "topic", c.topics)}
                  ${FieldTextarea(c.fields.msg, "msg")}
                  <button class="btn btn-primary" type="submit" style="align-self:${lang === "ar" ? "flex-end" : "flex-start"};margin-top:8px">
                    ${esc(c.send)}<span class="arrow">→</span>
                  </button>
                </form>
              `}
              <style>@media (max-width:540px){.cnt-row{grid-template-columns:1fr !important;}}</style>
            </div>
            <div class="reveal reveal-delay-1" style="display:flex;flex-direction:column;gap:24px">
              ${InfoCard("phone", c.callUs, t.common.phone, t.common.phone2, "tel:" + t.common.phone)}
              ${InfoCard("mail", c.writeUs, t.common.email, null, "mailto:" + t.common.email)}
              ${InfoCard("wa", c.whatsapp, "+973 36314567", null, "https://wa.me/97336314567")}
              ${InfoCard("mapPin", c.visitUs, t.common.address, null, "https://www.google.com/maps/place/Levant+Business+Management+Services,+Bahrain.+Professional+Body/")}
              <div style="padding:24px 28px;background:var(--brand);color:var(--on-brand);border-radius:var(--radius-lg)">
                <div style="font-family:var(--font-mono);font-size:11px;letter-spacing:.18em;color:var(--accent);margin-bottom:10px">${esc(String(c.hours).toUpperCase())}</div>
                <div style="font-weight:600;font-size:16px;color:#FFFFFF">${esc(c.hoursValue)}</div>
              </div>
            </div>
          </div>
        </div>
        <style>@media (max-width:980px){.cnt-grid{grid-template-columns:1fr !important;gap:40px !important;}}</style>
      </section>
      <section style="border-top:1px solid var(--border)">
        <div class="img-ph" style="height:420px;border-radius:0;position:relative">
          ${SkylineSvg(420)}
          <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(6,24,47,.3),rgba(6,24,47,.7))"></div>
          <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:#FFFFFF">
            <div style="width:60px;height:60px;border-radius:50%;background:var(--accent);margin:0 auto 16px;display:flex;align-items:center;justify-content:center;box-shadow:0 0 0 8px rgba(245,130,32,.25), 0 0 0 20px rgba(245,130,32,.12)">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div style="font-family:var(--font-mono);font-size:11px;letter-spacing:.18em;color:var(--orange-400);margin-bottom:6px">${esc(lang === "ar" ? "موقعنا" : "Our location")}</div>
            <div style="font-family:var(--font-display);font-weight:500;font-size:24px">${esc(t.common.addressShort)}</div>
            <a class="btn btn-primary" style="margin-top:20px" href="https://www.google.com/maps/place/Levant+Business+Management+Services,+Bahrain.+Professional+Body/" target="_blank" rel="noreferrer">
              ${esc(lang === "ar" ? "الاتجاهات" : "Get directions")}<span class="arrow">→</span>
            </a>
          </div>
        </div>
      </section>
    </main>`;
  }

  window.LB_PAGES = {
    home:     PageHome,
    about:    PageAbout,
    services: PageServices,
    partners: PagePartners,
    gallery:  PageGallery,
    faqs:     PageFaqs,
    blog:     PageBlogIndex,
    article:  PageArticle,
    contact:  PageContact,
  };
})();
