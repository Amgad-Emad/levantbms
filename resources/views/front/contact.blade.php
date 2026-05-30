@extends('front.layout', ['page' => 'contact'])

@section('title', __('front.contact.crumb').' · LevantBMS')

@php
    $services = \App\Models\Service::where('is_published', true)->orderBy('position')->orderBy('id')->get();
@endphp

@section('content')
<section class="relative overflow-hidden pt-28 pb-20 bg-white dark:bg-navy-800 border-b border-ink/10 dark:border-white/10">
  <div class="absolute bottom-0 inset-x-0 h-3/5 dotgrid text-mute" style="mask-image:linear-gradient(180deg,transparent,#000);-webkit-mask-image:linear-gradient(180deg,transparent,#000);" aria-hidden="true"></div>
  <div class="absolute top-0 end-0 w-56 h-56 stripe-motif" style="mask-image:linear-gradient(225deg,#000,transparent 70%);-webkit-mask-image:linear-gradient(225deg,#000,transparent 70%);" aria-hidden="true"></div>
  <div class="relative max-w-container mx-auto px-5 sm:px-10">
    <div class="font-mono text-[11px] tracking-[.16em] uppercase text-mute mb-5"><a href="{{ route('front.home') }}" class="hover:text-orange-500">{{ __('front.c.home') }}</a> / <span class="text-orange-500">{{ __('front.contact.crumb') }}</span></div>
    <h1 class="font-display font-medium text-[clamp(40px,6.4vw,84px)] leading-[1.02] tracking-tight max-w-[900px] reveal in">{{ __('front.contact.h1') }}</h1>
    <p class="mt-6 max-w-[680px] text-lg text-mute dark:text-cream/60 reveal in delay-1">{{ __('front.contact.sub') }}</p>
  </div>
</section>

<section class="py-12 md:py-20">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="grid lg:grid-cols-[1.2fr_1fr] gap-12 items-start">
      <!-- Form -->
      <div class="bg-white dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-3xl p-8 md:p-12 shadow-sm-soft reveal">
        <div class="eyebrow mb-4">{{ __('front.contact.formTitle') }}</div>
        <h2 class="font-display font-medium text-[clamp(26px,2.8vw,36px)] mb-8 tracking-tight">{{ __('front.contact.heading') }}</h2>

        <form data-contact-form data-form-wrap method="POST" action="{{ route('front.contact.store') }}" class="flex flex-col gap-5">
          @csrf
          {{-- Bot protection: honeypot (hidden from humans) + encrypted render timestamp --}}
          <div aria-hidden="true" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden" tabindex="-1">
            <label>Website<input type="text" name="website" tabindex="-1" autocomplete="off" /></label>
          </div>
          <input type="hidden" name="_ts" value="{{ \Illuminate\Support\Facades\Crypt::encryptString((string) time()) }}" />
          <div class="grid sm:grid-cols-2 gap-5">
            <label class="block">
              <span class="font-mono text-[10px] tracking-[.12em] uppercase text-orange-500 mb-1.5 block">{{ __('front.contact.f.name') }}</span>
              <input type="text" name="name" required class="w-full px-4 py-3.5 bg-transparent border border-ink/15 dark:border-white/15 rounded-lg outline-none focus:border-orange-500 transition" />
            </label>
            <label class="block">
              <span class="font-mono text-[10px] tracking-[.12em] uppercase text-orange-500 mb-1.5 block">{{ __('front.contact.f.email') }}</span>
              <input type="email" name="email" required class="w-full px-4 py-3.5 bg-transparent border border-ink/15 dark:border-white/15 rounded-lg outline-none focus:border-orange-500 transition" />
            </label>
          </div>
          <div class="grid sm:grid-cols-2 gap-5">
            <label class="block">
              <span class="font-mono text-[10px] tracking-[.12em] uppercase text-orange-500 mb-1.5 block">{{ __('front.contact.f.phone') }}</span>
              <input type="tel" name="phone" class="w-full px-4 py-3.5 bg-transparent border border-ink/15 dark:border-white/15 rounded-lg outline-none focus:border-orange-500 transition" />
            </label>
            <label class="block">
              <span class="font-mono text-[10px] tracking-[.12em] uppercase text-orange-500 mb-1.5 block">{{ __('front.contact.f.company') }}</span>
              <input type="text" name="company" class="w-full px-4 py-3.5 bg-transparent border border-ink/15 dark:border-white/15 rounded-lg outline-none focus:border-orange-500 transition" />
            </label>
          </div>
          <label class="block">
            <span class="font-mono text-[10px] tracking-[.12em] uppercase text-orange-500 mb-1.5 block">{{ __('front.contact.f.topic') }}</span>
            <select name="topic" class="w-full px-4 py-3.5 bg-transparent border border-ink/15 dark:border-white/15 rounded-lg outline-none focus:border-orange-500 transition appearance-none">
              @foreach ($services as $service)
                <option value="{{ $service->title }}">{{ $service->title }}</option>
              @endforeach
              <option value="{{ __('front.svc.other') }}">{{ __('front.svc.other') }}</option>
            </select>
          </label>
          <label class="block">
            <span class="font-mono text-[10px] tracking-[.12em] uppercase text-orange-500 mb-1.5 block">{{ __('front.contact.f.msg') }}</span>
            <textarea name="message" rows="5" class="w-full px-4 py-3.5 bg-transparent border border-ink/15 dark:border-white/15 rounded-lg outline-none focus:border-orange-500 transition"></textarea>
          </label>
          <button type="submit" class="btn-link self-start inline-flex items-center gap-2.5 mt-2 px-6 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm transition"><span>{{ __('front.contact.send') }}</span><span class="btn-arrow">→</span></button>
        </form>

        <div data-form-success class="hidden p-10 border border-orange-500 rounded-2xl bg-cream dark:bg-navy-700 text-center">
          <div class="w-14 h-14 rounded-full bg-orange-500 mx-auto mb-5 flex items-center justify-center text-white">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="M5 12l5 5L20 7"/></svg>
          </div>
          <h3 class="font-semibold mb-2">{{ __('front.contact.success') }}</h3>
          <button data-form-reset class="btn-link inline-flex items-center gap-2 mt-3 px-5 py-2.5 rounded-full border border-ink/15 dark:border-white/20 hover:border-orange-500 hover:text-orange-500 text-sm font-semibold transition">{{ __('front.contact.sendAnother') }}</button>
        </div>
      </div>

      <!-- Info column -->
      <div class="flex flex-col gap-4 reveal delay-1">
        @php
            $sPhone1 = \App\Models\Setting::get('contact.phone_primary', '+973 36314567');
            $sPhone2 = \App\Models\Setting::get('contact.phone_secondary', '+973 66303050');
            $sEmail = \App\Models\Setting::get('contact.email', 'info@levantbms.com');
            $sWa = \App\Models\Setting::get('contact.whatsapp', '97336314567');
            $sMap = \App\Models\Setting::get('contact.map_url', '#');
        @endphp
        <a href="tel:{{ preg_replace('/\s+/', '', $sPhone1) }}"  class="grid grid-cols-[56px_1fr_auto] gap-5 items-center p-7 bg-white dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-2xl hover:border-orange-500 hover:translate-x-1 transition">
          <div class="w-12 h-12 rounded-xl bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 flex items-center justify-center text-orange-500">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.37 1.9.72 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.35 1.85.59 2.81.72A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <div>
            <div class="font-mono text-[10px] tracking-[.18em] uppercase text-mute mb-1.5">{{ __('front.contact.callUs') }}</div>
            <div class="font-semibold text-sm" dir="ltr" style="unicode-bidi:plaintext">{{ $sPhone1 }}</div>
            <div class="text-xs text-mute mt-0.5" dir="ltr" style="unicode-bidi:plaintext">{{ $sPhone2 }}</div>
          </div>
          <div class="text-mute btn-arrow">→</div>
        </a>
        <a href="mailto:{{ $sEmail }}"  class="grid grid-cols-[56px_1fr_auto] gap-5 items-center p-7 bg-white dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-2xl hover:border-orange-500 hover:translate-x-1 transition">
          <div class="w-12 h-12 rounded-xl bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 flex items-center justify-center text-orange-500">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <div>
            <div class="font-mono text-[10px] tracking-[.18em] uppercase text-mute mb-1.5">{{ __('front.contact.writeUs') }}</div>
            <div class="font-semibold text-sm">{{ $sEmail }}</div>
          </div>
          <div class="text-mute btn-arrow">→</div>
        </a>
        <a href="https://wa.me/{{ $sWa }}" target="_blank" rel="noreferrer" class="grid grid-cols-[56px_1fr_auto] gap-5 items-center p-7 bg-white dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-2xl hover:border-orange-500 hover:translate-x-1 transition">
          <div class="w-12 h-12 rounded-xl bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 flex items-center justify-center text-orange-500">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448L.057 24z"/></svg>
          </div>
          <div>
            <div class="font-mono text-[10px] tracking-[.18em] uppercase text-mute mb-1.5">{{ __('front.contact.whatsapp') }}</div>
            <div class="font-semibold text-sm" dir="ltr" style="unicode-bidi:plaintext">{{ $sPhone1 }}</div>
          </div>
          <div class="text-mute btn-arrow">→</div>
        </a>
        <a href="{{ $sMap }}" target="_blank" rel="noreferrer" class="grid grid-cols-[56px_1fr_auto] gap-5 items-center p-7 bg-white dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-2xl hover:border-orange-500 hover:translate-x-1 transition">
          <div class="w-12 h-12 rounded-xl bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 flex items-center justify-center text-orange-500">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <div>
            <div class="font-mono text-[10px] tracking-[.18em] uppercase text-mute mb-1.5">{{ __('front.contact.visitUs') }}</div>
            <div class="font-semibold text-sm">{{ __('front.contact.locationShort') }}</div>
          </div>
          <div class="text-mute btn-arrow">→</div>
        </a>

        <div class="p-7 bg-navy-800 dark:bg-navy-900 text-cream rounded-2xl">
          <div class="font-mono text-[11px] tracking-[.18em] uppercase text-orange-500 mb-2.5">{{ __('front.contact.hours') }}</div>
          <div class="font-semibold text-white">{{ __('front.contact.hoursVal') }}</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="relative border-t border-ink/10 dark:border-white/10">
  <div class="relative h-[420px]">
    <svg viewBox="0 0 1200 420" preserveAspectRatio="xMidYMid slice" class="w-full h-full" aria-hidden="true">
      <defs><linearGradient id="map-sky" x1="0" x2="0" y1="0" y2="1"><stop offset="0%" stop-color="#06182F"/><stop offset="100%" stop-color="#14315A"/></linearGradient></defs>
      <rect width="1200" height="420" fill="url(#map-sky)"/>
      <g fill="rgba(10,18,36,.55)" stroke="rgba(255,255,255,.12)">
        <rect x="60" y="240" width="80" height="180"/><rect x="150" y="200" width="60" height="220"/>
        <rect x="220" y="220" width="100" height="200"/><rect x="330" y="180" width="70" height="240"/>
        <rect x="710" y="190" width="80" height="230"/><rect x="800" y="220" width="70" height="200"/>
        <rect x="880" y="170" width="100" height="250"/><rect x="990" y="210" width="70" height="210"/>
      </g>
    </svg>
    <div class="absolute inset-0 bg-gradient-to-b from-navy-900/30 to-navy-900/70"></div>
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-5">
      <div class="w-16 h-16 rounded-full bg-orange-500 flex items-center justify-center shadow-[0_0_0_8px_rgba(245,130,32,.25),0_0_0_20px_rgba(245,130,32,.12)]">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      </div>
      <div class="font-mono text-[11px] tracking-[.18em] uppercase text-orange-400 mt-5 mb-2">{{ __('front.contact.ourLocation') }}</div>
      <div class="font-display font-medium text-2xl">{{ __('front.contact.locationShort') }}</div>
      <a href="https://www.google.com/maps/place/Levant+Business+Management+Services,+Bahrain.+Professional+Body/" target="_blank" rel="noreferrer" class="btn-link mt-5 inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm transition">
        <span>{{ __('front.contact.directions') }}</span><span class="btn-arrow">→</span>
      </a>
    </div>
  </div>
</section>
@endsection
