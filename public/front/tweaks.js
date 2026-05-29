/* tweaks.js — vanilla Tweaks panel
   Implements the host edit-mode protocol:
     - listens for __activate_edit_mode / __deactivate_edit_mode
     - posts __edit_mode_available / __edit_mode_dismissed / __edit_mode_set_keys
   Exposes: window.LB_TWEAKS.init(defaults, options, onChange)
     options.persist === false  → no postMessage (used for runtime-only changes)
   Returns: { setTweak(key, value), getValues(), open(), close() }
*/
(function () {
  const STYLE = `
    .twk-panel{position:fixed;right:16px;bottom:16px;z-index:2147483646;width:280px;
      max-height:calc(100vh - 32px);display:flex;flex-direction:column;
      background:rgba(250,249,247,.78);color:#29261b;
      -webkit-backdrop-filter:blur(24px) saturate(160%);backdrop-filter:blur(24px) saturate(160%);
      border:.5px solid rgba(255,255,255,.6);border-radius:14px;
      box-shadow:0 1px 0 rgba(255,255,255,.5) inset,0 12px 40px rgba(0,0,0,.18);
      font:11.5px/1.4 ui-sans-serif,system-ui,-apple-system,sans-serif;overflow:hidden}
    .twk-panel[hidden]{display:none !important}
    .twk-hd{display:flex;align-items:center;justify-content:space-between;
      padding:10px 8px 10px 14px;cursor:move;user-select:none}
    .twk-hd b{font-size:12px;font-weight:600;letter-spacing:.01em}
    .twk-x{appearance:none;border:0;background:transparent;color:rgba(41,38,27,.55);
      width:22px;height:22px;border-radius:6px;cursor:pointer;font-size:13px;line-height:1}
    .twk-x:hover{background:rgba(0,0,0,.06);color:#29261b}
    .twk-body{padding:2px 14px 14px;display:flex;flex-direction:column;gap:10px;overflow-y:auto;min-height:0;scrollbar-width:thin;scrollbar-color:rgba(0,0,0,.15) transparent}
    .twk-body::-webkit-scrollbar{width:8px}
    .twk-body::-webkit-scrollbar-thumb{background:rgba(0,0,0,.18);border-radius:4px;border:2px solid transparent;background-clip:content-box}
    .twk-row{display:flex;flex-direction:column;gap:5px}
    .twk-row-h{flex-direction:row;align-items:center;justify-content:space-between;gap:10px}
    .twk-lbl{display:flex;justify-content:space-between;align-items:baseline;color:rgba(41,38,27,.72)}
    .twk-lbl>span:first-child{font-weight:500}
    .twk-val{color:rgba(41,38,27,.5);font-variant-numeric:tabular-nums}
    .twk-sect{font-size:10px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:rgba(41,38,27,.45);padding:10px 0 0}
    .twk-sect:first-child{padding-top:0}
    .twk-field{appearance:none;box-sizing:border-box;width:100%;min-width:0;height:26px;padding:0 8px;border:.5px solid rgba(0,0,0,.1);border-radius:7px;background:rgba(255,255,255,.6);color:inherit;font:inherit;outline:none}
    .twk-field:focus{border-color:rgba(0,0,0,.25);background:rgba(255,255,255,.85)}
    select.twk-field{padding-right:22px;background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'><path fill='rgba(0,0,0,.5)' d='M0 0h10L5 6z'/></svg>");background-repeat:no-repeat;background-position:right 8px center}
    .twk-slider{appearance:none;-webkit-appearance:none;width:100%;height:4px;margin:6px 0;border-radius:999px;background:rgba(0,0,0,.12);outline:none}
    .twk-slider::-webkit-slider-thumb{-webkit-appearance:none;appearance:none;width:14px;height:14px;border-radius:50%;background:#fff;border:.5px solid rgba(0,0,0,.12);box-shadow:0 1px 3px rgba(0,0,0,.2);cursor:pointer}
    .twk-slider::-moz-range-thumb{width:14px;height:14px;border-radius:50%;background:#fff;border:.5px solid rgba(0,0,0,.12);box-shadow:0 1px 3px rgba(0,0,0,.2);cursor:pointer}
    .twk-seg{position:relative;display:flex;padding:2px;border-radius:8px;background:rgba(0,0,0,.06);user-select:none}
    .twk-seg-thumb{position:absolute;top:2px;bottom:2px;border-radius:6px;background:rgba(255,255,255,.9);box-shadow:0 1px 2px rgba(0,0,0,.12);transition:left .15s cubic-bezier(.3,.7,.4,1),width .15s}
    .twk-seg button{appearance:none;position:relative;z-index:1;flex:1;border:0;background:transparent;color:inherit;font:inherit;font-weight:500;min-height:22px;border-radius:6px;cursor:pointer;padding:4px 6px;line-height:1.2;overflow-wrap:anywhere}
    .twk-chips{display:flex;gap:6px}
    .twk-chip{position:relative;appearance:none;flex:1;min-width:0;height:46px;padding:0;border:0;border-radius:6px;overflow:hidden;cursor:pointer;box-shadow:0 0 0 .5px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.06);transition:transform .12s,box-shadow .12s}
    .twk-chip:hover{transform:translateY(-1px);box-shadow:0 0 0 .5px rgba(0,0,0,.18),0 4px 10px rgba(0,0,0,.12)}
    .twk-chip[data-on="1"]{box-shadow:0 0 0 1.5px rgba(0,0,0,.85),0 2px 6px rgba(0,0,0,.15)}
    .twk-chip>span{position:absolute;top:0;bottom:0;right:0;width:34%;display:flex;flex-direction:column;box-shadow:-1px 0 0 rgba(0,0,0,.1)}
    .twk-chip>span>i{flex:1;box-shadow:0 -1px 0 rgba(0,0,0,.1)}
    .twk-chip>span>i:first-child{box-shadow:none}
    .twk-chip svg{position:absolute;top:6px;left:6px;width:13px;height:13px;filter:drop-shadow(0 1px 1px rgba(0,0,0,.3))}
  `;

  function injectStyle() {
    if (document.getElementById("twk-style")) return;
    const s = document.createElement("style");
    s.id = "twk-style";
    s.textContent = STYLE;
    document.head.appendChild(s);
  }

  function isLight(hex) {
    const h = String(hex).replace("#", "");
    const x = h.length === 3 ? h.replace(/./g, (c) => c + c) : h.padEnd(6, "0");
    const n = parseInt(x.slice(0, 6), 16);
    if (Number.isNaN(n)) return true;
    const r = (n >> 16) & 255, g = (n >> 8) & 255, b = n & 255;
    return r * 299 + g * 587 + b * 114 > 148000;
  }

  function init(defaults, options, onChange) {
    options = options || {};
    injectStyle();
    const persist = options.persist !== false;
    const values = Object.assign({}, defaults);

    // Build panel
    const panel = document.createElement("div");
    panel.className = "twk-panel";
    panel.hidden = true;
    panel.setAttribute("data-omelette-chrome", "");
    panel.innerHTML = `
      <div class="twk-hd" data-drag>
        <b>Tweaks</b>
        <button class="twk-x" aria-label="Close" data-close>✕</button>
      </div>
      <div class="twk-body" data-body></div>
    `;
    document.body.appendChild(panel);

    const body = panel.querySelector("[data-body]");
    const closeBtn = panel.querySelector("[data-close]");
    const dragHd = panel.querySelector("[data-drag]");

    function setTweak(key, val) {
      const edits = typeof key === "object" ? key : { [key]: val };
      Object.assign(values, edits);
      if (persist) {
        try { window.parent.postMessage({ type: "__edit_mode_set_keys", edits }, "*"); } catch (e) {}
      }
      if (onChange) onChange(values, edits);
      // Refresh control values in DOM (for synced multi-controls)
      refreshControls();
    }

    /* ── Control builders ──────────────────────────────────────────────── */
    function row(label, valText) {
      const r = document.createElement("div");
      r.className = "twk-row";
      r.innerHTML = `<div class="twk-lbl"><span>${label}</span>${valText != null ? `<span class="twk-val" data-val>${valText}</span>` : ""}</div>`;
      return r;
    }

    function section(label) {
      const d = document.createElement("div");
      d.className = "twk-sect";
      d.textContent = label;
      body.appendChild(d);
    }

    function slider(key, label, opts) {
      opts = opts || {};
      const unit = opts.unit || "";
      const r = row(label, `${values[key]}${unit}`);
      const valNode = r.querySelector("[data-val]");
      const input = document.createElement("input");
      input.type = "range";
      input.className = "twk-slider";
      input.min = opts.min ?? 0;
      input.max = opts.max ?? 100;
      input.step = opts.step ?? 1;
      input.value = values[key];
      input.addEventListener("input", () => {
        const v = Number(input.value);
        values[key] = v;
        valNode.textContent = `${v}${unit}`;
        if (onChange) onChange(values, { [key]: v });
      });
      input.addEventListener("change", () => {
        if (persist) {
          try { window.parent.postMessage({ type: "__edit_mode_set_keys", edits: { [key]: values[key] } }, "*"); } catch (e) {}
        }
      });
      r.appendChild(input);
      r.__refresh = () => {
        if (document.activeElement !== input) input.value = values[key];
        valNode.textContent = `${values[key]}${unit}`;
      };
      body.appendChild(r);
    }

    function radio(key, label, options) {
      const opts = options.map((o) => (typeof o === "object" ? o : { value: o, label: o }));
      const n = opts.length;
      const r = row(label);
      const seg = document.createElement("div");
      seg.className = "twk-seg";
      seg.setAttribute("role", "radiogroup");
      const thumb = document.createElement("div");
      thumb.className = "twk-seg-thumb";
      seg.appendChild(thumb);
      opts.forEach((o, i) => {
        const b = document.createElement("button");
        b.type = "button";
        b.setAttribute("role", "radio");
        b.textContent = o.label;
        b.addEventListener("click", () => setTweak(key, o.value));
        seg.appendChild(b);
      });
      const position = () => {
        const idx = Math.max(0, opts.findIndex((o) => o.value === values[key]));
        thumb.style.left = `calc(2px + ${idx} * (100% - 4px) / ${n})`;
        thumb.style.width = `calc((100% - 4px) / ${n})`;
        opts.forEach((o, i) => {
          const btn = seg.querySelectorAll("button")[i];
          if (btn) btn.setAttribute("aria-checked", String(o.value === values[key]));
        });
      };
      position();
      r.appendChild(seg);
      r.__refresh = position;
      body.appendChild(r);
    }

    function select(key, label, options) {
      const opts = options.map((o) => (typeof o === "object" ? o : { value: o, label: o }));
      const r = row(label);
      const sel = document.createElement("select");
      sel.className = "twk-field";
      opts.forEach((o) => {
        const op = document.createElement("option");
        op.value = o.value;
        op.textContent = o.label;
        sel.appendChild(op);
      });
      sel.value = values[key];
      sel.addEventListener("change", () => setTweak(key, sel.value));
      r.appendChild(sel);
      r.__refresh = () => { if (document.activeElement !== sel) sel.value = values[key]; };
      body.appendChild(r);
    }

    function colorChips(key, label, options) {
      // options: array of arrays of hex colors (palettes), or array of hex strings
      const r = row(label);
      const wrap = document.createElement("div");
      wrap.className = "twk-chips";
      wrap.setAttribute("role", "radiogroup");
      const matchesCurrent = (opt) => {
        const cur = values[key];
        if (Array.isArray(opt) && Array.isArray(cur)) {
          if (opt.length !== cur.length) return false;
          return opt.every((c, i) => String(c).toLowerCase() === String(cur[i]).toLowerCase());
        }
        return String(opt).toLowerCase() === String(cur).toLowerCase();
      };
      options.forEach((opt) => {
        const colors = Array.isArray(opt) ? opt : [opt];
        const [hero, ...rest] = colors;
        const sup = rest.slice(0, 4);
        const b = document.createElement("button");
        b.type = "button";
        b.className = "twk-chip";
        b.setAttribute("role", "radio");
        b.title = colors.join(" · ");
        b.style.background = hero;
        if (sup.length) {
          const sp = document.createElement("span");
          sup.forEach((c) => {
            const ii = document.createElement("i");
            ii.style.background = c;
            sp.appendChild(ii);
          });
          b.appendChild(sp);
        }
        b.addEventListener("click", () => setTweak(key, opt));
        wrap.appendChild(b);
      });
      r.appendChild(wrap);
      r.__refresh = () => {
        const chips = wrap.querySelectorAll(".twk-chip");
        options.forEach((opt, i) => {
          const on = matchesCurrent(opt);
          chips[i].setAttribute("data-on", on ? "1" : "0");
          chips[i].setAttribute("aria-checked", String(on));
          chips[i].querySelectorAll("svg").forEach((s) => s.remove());
          if (on) {
            const hero = Array.isArray(opt) ? opt[0] : opt;
            const sv = document.createElementNS("http://www.w3.org/2000/svg", "svg");
            sv.setAttribute("viewBox", "0 0 14 14");
            const p = document.createElementNS("http://www.w3.org/2000/svg", "path");
            p.setAttribute("d", "M3 7.2 5.8 10 11 4.2");
            p.setAttribute("fill", "none");
            p.setAttribute("stroke-width", "2.2");
            p.setAttribute("stroke-linecap", "round");
            p.setAttribute("stroke-linejoin", "round");
            p.setAttribute("stroke", isLight(hero) ? "rgba(0,0,0,.78)" : "#fff");
            sv.appendChild(p);
            chips[i].appendChild(sv);
          }
        });
      };
      r.__refresh();
      body.appendChild(r);
    }

    /* ── Mount user controls from schema ───────────────────────────────── */
    const schema = options.schema || [];
    function build() {
      body.innerHTML = "";
      schema.forEach((s) => {
        if (s.kind === "section")   section(s.label);
        else if (s.kind === "slider")  slider(s.key, s.label, s);
        else if (s.kind === "radio")   radio(s.key, s.label, s.options);
        else if (s.kind === "select")  select(s.key, s.label, s.options);
        else if (s.kind === "color")   colorChips(s.key, s.label, s.options);
      });
    }

    function refreshControls() {
      body.querySelectorAll(".twk-row").forEach((r) => { if (r.__refresh) r.__refresh(); });
    }

    build();

    /* ── Host protocol ─────────────────────────────────────────────────── */
    function show() { panel.hidden = false; refreshControls(); }
    function hide() { panel.hidden = true; }

    window.addEventListener("message", (e) => {
      const t = e?.data?.type;
      if (t === "__activate_edit_mode") show();
      else if (t === "__deactivate_edit_mode") hide();
    });
    try { window.parent.postMessage({ type: "__edit_mode_available" }, "*"); } catch (e) {}

    closeBtn.addEventListener("click", () => {
      hide();
      try { window.parent.postMessage({ type: "__edit_mode_dismissed" }, "*"); } catch (e) {}
    });

    /* ── Drag ──────────────────────────────────────────────────────────── */
    let offset = { x: 16, y: 16 };
    const clamp = () => {
      const w = panel.offsetWidth, h = panel.offsetHeight;
      const maxR = Math.max(16, window.innerWidth - w - 16);
      const maxB = Math.max(16, window.innerHeight - h - 16);
      offset.x = Math.min(maxR, Math.max(16, offset.x));
      offset.y = Math.min(maxB, Math.max(16, offset.y));
      panel.style.right = offset.x + "px";
      panel.style.bottom = offset.y + "px";
    };
    dragHd.addEventListener("mousedown", (e) => {
      const r = panel.getBoundingClientRect();
      const sx = e.clientX, sy = e.clientY;
      const startR = window.innerWidth - r.right;
      const startB = window.innerHeight - r.bottom;
      const move = (ev) => {
        offset.x = startR - (ev.clientX - sx);
        offset.y = startB - (ev.clientY - sy);
        clamp();
      };
      const up = () => {
        window.removeEventListener("mousemove", move);
        window.removeEventListener("mouseup", up);
      };
      window.addEventListener("mousemove", move);
      window.addEventListener("mouseup", up);
    });
    window.addEventListener("resize", clamp);

    return {
      setTweak,
      getValues: () => Object.assign({}, values),
      open: show, close: hide,
    };
  }

  window.LB_TWEAKS = { init };
})();
