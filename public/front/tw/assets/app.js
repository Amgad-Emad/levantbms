// tw/assets/app.js — theme + nav + reveals + accordion + modal + gallery/blog/faq filters + contact form
// i18n is now handled server-side by Laravel (mcamara/laravel-localization), so no JS dictionary or applyLang.

function applyTheme(theme) {
  document.documentElement.classList.toggle("dark", theme === "dark");
  document.documentElement.setAttribute("data-theme", theme);
  localStorage.setItem("levant-theme", theme);
  // Toggle icons
  document.querySelectorAll("[data-theme-sun]").forEach((el) => el.classList.toggle("hidden", theme === "light"));
  document.querySelectorAll("[data-theme-moon]").forEach((el) => el.classList.toggle("hidden", theme === "dark"));
}

/* =============================================================
   Init on DOM ready
   ============================================================= */
function initApp() {
  // Pre-mark already-visible reveals as `.in` BEFORE flipping reveal-hide on
  const _reveals = document.querySelectorAll(".reveal");
  _reveals.forEach((e) => {
    const r = e.getBoundingClientRect();
    if (r.top < window.innerHeight * 1.05 && r.bottom > -20) e.classList.add("in");
  });
  // Now opt into the reveal animation system (hides anything not yet `.in`)
  document.documentElement.classList.add("js-loaded");

  // Theme: persisted | default light
  const savedTheme = localStorage.getItem("levant-theme") || "light";
  applyTheme(savedTheme);

  // Theme toggle
  document.querySelectorAll("[data-theme-toggle]").forEach((b) =>
    b.addEventListener("click", () => applyTheme(document.documentElement.classList.contains("dark") ? "light" : "dark"))
  );

  // Mobile menu
  const burger = document.querySelector("[data-burger]");
  const mobile = document.querySelector("[data-mobile-menu]");
  if (burger && mobile) {
    burger.addEventListener("click", () => {
      const open = mobile.getAttribute("data-open") === "true";
      mobile.setAttribute("data-open", !open);
      mobile.classList.toggle("hidden", open);
    });
  }

  // Reveal observer — for elements scrolled into view
  if ("IntersectionObserver" in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((en) => { if (en.isIntersecting) { en.target.classList.add("in"); io.unobserve(en.target); } });
    }, { rootMargin: "0px 0px -8% 0px", threshold: 0.08 });
    _reveals.forEach((e) => { if (!e.classList.contains("in")) io.observe(e); });
  } else {
    _reveals.forEach((e) => e.classList.add("in"));
  }

  // Accordion (FAQ)
  document.querySelectorAll(".acc-item").forEach((it) => {
    it.addEventListener("click", () => {
      const open = it.getAttribute("data-open") === "true";
      const parent = it.parentElement;
      parent.querySelectorAll(".acc-item").forEach((s) => s.setAttribute("data-open", "false"));
      it.setAttribute("data-open", !open);
    });
  });

  // Stat counters (animate up)
  document.querySelectorAll("[data-counter]").forEach((el) => {
    const target = parseInt(el.getAttribute("data-counter"), 10);
    let started = false;
    const obs = new IntersectionObserver(([e]) => {
      if (e.isIntersecting && !started) {
        started = true;
        const t0 = performance.now();
        const dur = 1400;
        const tick = (t) => {
          const p = Math.min(1, (t - t0) / dur);
          const eased = 1 - Math.pow(1 - p, 3);
          el.textContent = Math.round(eased * target);
          if (p < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
        obs.disconnect();
      }
    }, { threshold: 0.4 });
    obs.observe(el);
  });

  // Service modal
  const modal = document.querySelector("[data-modal]");
  if (modal) {
    document.querySelectorAll("[data-modal-open]").forEach((b) =>
      b.addEventListener("click", () => {
        const key = b.getAttribute("data-modal-open");
        modal.querySelectorAll("[data-modal-content]").forEach((c) => {
          c.classList.toggle("hidden", c.getAttribute("data-modal-content") !== key);
        });
        modal.setAttribute("data-open", "true");
        document.body.style.overflow = "hidden";
      })
    );
    modal.addEventListener("click", (e) => {
      if (e.target === modal || e.target.closest("[data-modal-close]")) {
        modal.setAttribute("data-open", "false");
        document.body.style.overflow = "";
      }
    });
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        modal.setAttribute("data-open", "false");
        document.body.style.overflow = "";
      }
    });
  }

  // Gallery filter
  const galGrid = document.querySelector("[data-gallery-grid]");
  if (galGrid) {
    document.querySelectorAll("[data-gallery-cat]").forEach((b) =>
      b.addEventListener("click", () => {
        const c = b.getAttribute("data-gallery-cat");
        document.querySelectorAll("[data-gallery-cat]").forEach((x) => x.setAttribute("data-active", x === b));
        galGrid.querySelectorAll("[data-tag]").forEach((it) => {
          it.style.display = (c === "all" || it.getAttribute("data-tag") === c) ? "" : "none";
        });
      })
    );
  }

  // FAQ category switcher
  const faqWrap = document.querySelector("[data-faq-wrap]");
  if (faqWrap) {
    document.querySelectorAll("[data-faq-cat]").forEach((b) =>
      b.addEventListener("click", () => {
        const c = b.getAttribute("data-faq-cat");
        document.querySelectorAll("[data-faq-cat]").forEach((x) => x.setAttribute("data-active", x === b));
        faqWrap.querySelectorAll("[data-faq-group]").forEach((g) => g.classList.toggle("hidden", g.getAttribute("data-faq-group") !== c));
        // Set header
        const head = document.querySelector("[data-faq-head]");
        if (head) head.textContent = b.textContent.trim();
        const count = faqWrap.querySelector(`[data-faq-group="${c}"]`)?.children.length || 0;
        const cnt = document.querySelector("[data-faq-count]");
        if (cnt) cnt.textContent = count;
      })
    );
  }

  // Blog category filter
  const blogGrid = document.querySelector("[data-blog-grid]");
  if (blogGrid) {
    document.querySelectorAll("[data-blog-cat]").forEach((b) =>
      b.addEventListener("click", () => {
        const c = b.getAttribute("data-blog-cat");
        document.querySelectorAll("[data-blog-cat]").forEach((x) => x.setAttribute("data-active", x === b));
        blogGrid.querySelectorAll("[data-bcat]").forEach((it) => {
          it.style.display = (c === "all" || it.getAttribute("data-bcat") === c) ? "" : "none";
        });
      })
    );
  }

  // Contact form
  const form = document.querySelector("[data-contact-form]");
  if (form) {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      document.querySelector("[data-form-wrap]").classList.add("hidden");
      document.querySelector("[data-form-success]").classList.remove("hidden");
    });
    document.querySelectorAll("[data-form-reset]").forEach((b) =>
      b.addEventListener("click", () => {
        document.querySelector("[data-form-wrap]").classList.remove("hidden");
        document.querySelector("[data-form-success]").classList.add("hidden");
        form.reset();
      })
    );
  }
}

if (document.readyState === "loading") document.addEventListener("DOMContentLoaded", initApp);
else initApp();
