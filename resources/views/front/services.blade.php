@extends('front.layout', ['page' => 'services'])

@section('title', __('front.services.crumb').' · LevantBMS')

@section('content')
<section class="relative overflow-hidden pt-28 pb-20 bg-white dark:bg-navy-800 border-b border-ink/10 dark:border-white/10">
  <div class="absolute bottom-0 inset-x-0 h-3/5 dotgrid text-mute" style="mask-image:linear-gradient(180deg,transparent,#000);-webkit-mask-image:linear-gradient(180deg,transparent,#000);" aria-hidden="true"></div>
  <div class="absolute top-0 end-0 w-56 h-56 stripe-motif" style="mask-image:linear-gradient(225deg,#000,transparent 70%);-webkit-mask-image:linear-gradient(225deg,#000,transparent 70%);" aria-hidden="true"></div>
  <div class="relative max-w-container mx-auto px-5 sm:px-10">
    <div class="font-mono text-[11px] tracking-[.16em] uppercase text-mute mb-5"><a href="{{ route('front.home') }}" class="hover:text-orange-500">{{ __('front.c.home') }}</a> / <span class="text-orange-500">{{ __('front.services.crumb') }}</span></div>
    <h1 class="font-display font-medium text-[clamp(40px,6.4vw,84px)] leading-[1.02] tracking-tight max-w-[900px] reveal in">{{ __('front.services.h1') }}</h1>
    <p class="mt-6 max-w-[680px] text-lg text-mute dark:text-cream/60 reveal in delay-1">{{ __('front.services.sub') }}</p>
  </div>
</section>

@php $defaultCat = optional($services->first())->category ?? 'moic'; @endphp

<!-- =============== MAIN SERVICES SELECTOR =============== -->
<section class="py-14 md:py-20" id="service-categories">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="eyebrow mb-5 reveal">{{ __('front.services.catEyebrow') }}</div>
    <h2 class="font-display font-medium text-[clamp(30px,4vw,52px)] leading-[1.06] tracking-tight max-w-[760px] mb-4 reveal delay-1">{{ __('front.services.catTitle') }}</h2>
    <p class="text-lg text-mute dark:text-cream/60 max-w-[640px] mb-10 reveal delay-2">{{ __('front.services.catSub') }}</p>

    <div class="grid md:grid-cols-2 gap-5 reveal">
      @foreach ($services as $main)
        <button type="button" data-service-cat="{{ $main->category }}" data-active="false"
          class="group text-start rounded-3xl border border-ink/10 dark:border-white/10 bg-white dark:bg-navy-800 p-7 md:p-9 transition hover:border-orange-500 data-[active=true]:border-orange-500 data-[active=true]:ring-2 data-[active=true]:ring-orange-500/30">
          <div class="flex items-start justify-between gap-4">
            <div class="w-12 h-12 rounded-xl bg-cream dark:bg-navy-700 border border-ink/10 dark:border-white/10 flex items-center justify-center text-orange-500 shrink-0">
              @if ($main->category === 'moic')
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-3"/><path d="M9 9v.01M9 12v.01M9 15v.01M9 18v.01"/></svg>
              @else
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11M20 10v11M8 14v3M12 14v3M16 14v3"/></svg>
              @endif
            </div>
            <span class="font-mono text-[11px] tracking-[.16em] uppercase text-mute group-data-[active=true]:text-orange-500">{{ $main->subServices->count() }} {{ __('front.services.catCount') }}</span>
          </div>
          <h3 class="font-display font-semibold text-2xl tracking-tight mt-6 mb-2">{{ $main->title }}</h3>
          <p class="text-mute dark:text-cream/60 leading-relaxed mb-5">{{ $main->description }}</p>
          <span class="btn-link inline-flex items-center gap-2 text-sm font-semibold text-orange-500"><span>{{ __('front.services.catView') }}</span><span class="btn-arrow">→</span></span>
        </button>
      @endforeach
    </div>
  </div>
</section>

<!-- =============== SUB-SERVICES LIST (filtered by main service) =============== -->
<section class="pb-6 md:pb-10 scroll-mt-24" id="service-list">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    @foreach ($services as $main)
      @foreach ($main->subServices as $sub)
        @php $lines = $sub->scopeLinesFor(); @endphp
        <div data-service-item data-cat="{{ $main->category }}" class="service-row border-t border-ink/10 dark:border-white/10 py-14 grid lg:grid-cols-[120px_1.4fr_1fr] gap-12 items-start">
          <div class="font-serif italic font-light text-6xl text-orange-500 leading-none">{{ $sub->code ?: str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
          <div>
            <div class="eyebrow mb-4">{{ filled((string) $sub->tag) ? $sub->tag : $main->title }}</div>
            <h2 class="font-display font-medium text-[clamp(28px,3.4vw,44px)] tracking-tight mb-5">{{ $sub->title }}</h2>
            <p class="text-lg text-mute dark:text-cream/60 leading-relaxed max-w-[560px] mb-6">{{ $sub->description }}</p>
            <button data-modal-open="sub{{ $sub->id }}" class="btn-link inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full bg-navy-800 dark:bg-orange-500 hover:bg-navy-700 dark:hover:bg-orange-600 text-cream dark:text-navy-900 font-semibold text-sm transition"><span>{{ __('front.services.viewScope') }}</span><span class="btn-arrow">→</span></button>
          </div>
          <div>
            @foreach (array_slice($lines, 0, 5) as $i => $line)
              <div class="py-3.5 border-b border-ink/10 dark:border-white/10 flex gap-3.5 items-baseline">
                <span class="font-mono text-[10px] text-orange-500 tracking-[.14em] shrink-0">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="text-sm text-ink2 dark:text-cream/80">{{ $line }}</span>
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    @endforeach
  </div>
</section>

@push('scripts')
<script>
  (function () {
    var cards = document.querySelectorAll('[data-service-cat]');
    var items = document.querySelectorAll('[data-service-item]');
    function activate(cat, scroll) {
      cards.forEach(function (c) { c.setAttribute('data-active', c.getAttribute('data-service-cat') === cat ? 'true' : 'false'); });
      items.forEach(function (it) { it.style.display = (it.getAttribute('data-cat') === cat) ? '' : 'none'; });
      if (scroll) { var el = document.getElementById('service-list'); if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
    }
    cards.forEach(function (c) { c.addEventListener('click', function () { activate(c.getAttribute('data-service-cat'), true); }); });
    activate(@json($defaultCat), false); // first main service shown on load
  })();
</script>
@endpush

<section class="py-20 md:py-28 bg-white dark:bg-navy-800 border-y border-ink/10 dark:border-white/10">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="eyebrow mb-6 reveal">{{ __('front.services.processEyebrow') }}</div>
    <h2 class="font-display font-medium text-[clamp(32px,4vw,56px)] leading-[1.05] tracking-tight max-w-[720px] mb-14 reveal delay-1">{{ __('front.services.processTitle') }}</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 reveal">
      @foreach ([1,2,3,4] as $n)
        <div class="border-t-2 border-orange-500 pt-7 flex flex-col gap-3 min-h-[200px]">
          <div class="font-mono text-[11px] tracking-[.18em] text-mute">STEP {{ str_pad($n, 2, '0', STR_PAD_LEFT) }}</div>
          <h4 class="font-display font-semibold">{{ __('front.process'.$n.'.t') }}</h4>
          <p class="text-sm text-mute dark:text-cream/60 leading-relaxed">{{ __('front.process'.$n.'.d') }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

@include('front.partials.final-cta')

<!-- Sub-service modal -->
<div data-modal data-open="false" class="modal-overlay fixed inset-0 z-[100] bg-navy-900/60 backdrop-blur-md flex items-center justify-center p-5">
  <div class="modal bg-cream dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-3xl max-w-[720px] w-full max-h-[88vh] overflow-auto shadow-lg-soft">
    @foreach ($services as $main)
      @foreach ($main->subServices as $sub)
        @php $lines = $sub->scopeLinesFor(); @endphp
        <div data-modal-content="sub{{ $sub->id }}" class="hidden">
          <div class="p-8 md:p-10">
            <div class="flex justify-between items-start gap-4 mb-6">
              <div>
                <div class="eyebrow mb-3">{{ filled((string) $sub->tag) ? $sub->tag : $main->title }}</div>
                <h2 class="font-display font-medium text-3xl tracking-tight">{{ $sub->title }}</h2>
              </div>
              <button data-modal-close class="w-9 h-9 rounded-full border border-ink/10 dark:border-white/10 inline-flex items-center justify-center hover:bg-orange-500 hover:text-white hover:border-orange-500 transition" aria-label="Close">
                <svg width="14" height="14" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
              </button>
            </div>
            @if (filled((string) $sub->description))<p class="text-ink2 dark:text-cream/80 mb-6">{{ $sub->description }}</p>@endif
            <div class="flex flex-wrap gap-x-12 border-ink/10 dark:border-white/10 mb-6">
              @if (filled((string) $sub->timeline))
                <div><div class="font-mono text-[10px] tracking-[.14em] uppercase text-mute mb-1.5">{{ __('front.services.detailTimeline') }}</div><div class="font-semibold text-sm">{{ $sub->timeline }}</div></div>
              @endif
              @if (filled((string) $sub->fee_from))
                <div><div class="font-mono text-[10px] tracking-[.14em] uppercase text-mute mb-1.5">{{ __('front.services.detailFee') }}</div><div class="font-semibold text-sm text-orange-500">{{ $sub->fee_from }}</div></div>
              @endif
            </div>
            @if (!empty($lines))
              <div class="font-mono text-[10px] tracking-[.14em] uppercase text-mute mb-3">{{ __('front.services.detailLabel') }}</div>
              <ul class="flex flex-col gap-2.5">
                @foreach ($lines as $i => $line)
                  <li class="flex items-start gap-3 py-2 border-b border-ink/10 dark:border-white/10">
                    <span class="font-mono text-[10px] text-orange-500 tracking-[.1em] pt-0.5">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="text-sm text-ink2 dark:text-cream/80">{{ $line }}</span>
                  </li>
                @endforeach
              </ul>
            @endif
            <div class="mt-7"><a href="{{ route('front.contact') }}" class="btn-link inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm transition"><span>{{ __('front.services.ctaTalk') }}</span><span class="btn-arrow">→</span></a></div>
          </div>
        </div>
      @endforeach
    @endforeach
  </div>
</div>
@endsection
