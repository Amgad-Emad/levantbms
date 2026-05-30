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

<section class="py-12 md:py-16">
  <div class="max-w-container mx-auto px-5 sm:px-10">
    @foreach ($services as $service)
      @php $code = $service->code ?: str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT); $lines = $service->scopeLinesFor(); @endphp
      <div class="border-t border-ink/10 dark:border-white/10 py-14 grid lg:grid-cols-[120px_1.4fr_1fr] gap-12 items-start reveal">
        <div class="font-serif italic font-light text-6xl text-orange-500 leading-none">{{ $code }}</div>
        <div>
          <div class="eyebrow mb-4">{{ $service->tag }}</div>
          <h2 class="font-display font-medium text-[clamp(28px,3.4vw,44px)] tracking-tight mb-5">{{ $service->title }}</h2>
          <p class="text-lg text-mute dark:text-cream/60 leading-relaxed max-w-[560px] mb-6">{{ $service->description }}</p>
          <button data-modal-open="svc{{ $service->id }}" class="btn-link inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full bg-navy-800 dark:bg-orange-500 hover:bg-navy-700 dark:hover:bg-orange-600 text-cream dark:text-navy-900 font-semibold text-sm transition"><span>{{ __('front.services.viewScope') }}</span><span class="btn-arrow">→</span></button>
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
  </div>
</section>

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

<!-- Service modal -->
<div data-modal data-open="false" class="modal-overlay fixed inset-0 z-[100] bg-navy-900/60 backdrop-blur-md flex items-center justify-center p-5">
  <div class="modal bg-cream dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-3xl max-w-[720px] w-full max-h-[88vh] overflow-auto shadow-lg-soft">
    @foreach ($services as $service)
      @php $code = $service->code ?: str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT); $lines = $service->scopeLinesFor(); @endphp
      <div data-modal-content="svc{{ $service->id }}" class="hidden">
        <div class="p-8 md:p-10">
          <div class="flex justify-between items-start gap-4 mb-6">
            <div>
              <div class="eyebrow mb-3">{{ $service->tag }}</div>
              <h2 class="font-display font-medium text-3xl tracking-tight">{{ $service->title }}</h2>
            </div>
            <button data-modal-close class="w-9 h-9 rounded-full border border-ink/10 dark:border-white/10 inline-flex items-center justify-center hover:bg-orange-500 hover:text-white hover:border-orange-500 transition" aria-label="Close">
              <svg width="14" height="14" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
          </div>
          <p class="text-ink2 dark:text-cream/80 mb-6">{{ $service->description }}</p>
          <div class="flex flex-wrap gap-x-12  border-ink/10 dark:border-white/10 mb-6">
            @if (filled((string) $service->timeline))
              <div><div class="font-mono text-[10px] tracking-[.14em] uppercase text-mute mb-1.5">{{ __('front.services.detailTimeline') }}</div><div class="font-semibold text-sm">{{ $service->timeline }}</div></div>
            @endif
            @if (filled((string) $service->fee_from))
              <div><div class="font-mono text-[10px] tracking-[.14em] uppercase text-mute mb-1.5">{{ __('front.services.detailFee') }}</div><div class="font-semibold text-sm text-orange-500">{{ $service->fee_from }}</div></div>
            @endif
            {{-- <div><div class="font-mono text-[10px] tracking-[.14em] uppercase text-mute mb-1.5">{{ __('front.services.practice') }}</div><div class="font-semibold text-sm">{{ $code }}</div></div> --}}
          </div>
          <div class="font-mono text-[10px] tracking-[.14em] uppercase text-mute mb-3">{{ __('front.services.detailLabel') }}</div>
          <ul class="flex flex-col gap-2.5">
            @foreach ($lines as $i => $line)
              <li class="flex items-start gap-3 py-2 border-b border-ink/10 dark:border-white/10">
                <span class="font-mono text-[10px] text-orange-500 tracking-[.1em] pt-0.5">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="text-sm text-ink2 dark:text-cream/80">{{ $line }}</span>
              </li>
            @endforeach
          </ul>
          <div class="mt-7"><a href="{{ route('front.contact') }}" class="btn-link inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm transition"><span>{{ __('front.services.ctaTalk') }}</span><span class="btn-arrow">→</span></a></div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
