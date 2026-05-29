@extends('front.layout', ['page' => 'faqs'])

@section('title', __('front.faqs.crumb').' · LevantBMS')

@php
    $cats = [
        ['key' => 'Setup',      'i18n' => 'faqs.catSetup',      'num' => '01', 'active' => true],
        ['key' => 'Costs',      'i18n' => 'faqs.catCosts',      'num' => '02'],
        ['key' => 'Regulation', 'i18n' => 'faqs.catRegulation', 'num' => '03'],
        ['key' => 'After',      'i18n' => 'faqs.catAfter',      'num' => '04'],
    ];
    $faqs = [
        'Setup' => [
            ['q' => 'How long does company formation take in Bahrain?',
             'a' => 'For a standard W.L.L., 2 to 4 weeks from name reservation to a live CR — assuming all shareholder documents are in order. Specialized activities (financial services, education, healthcare) require additional sectoral approvals and run 6 to 12 weeks.'],
            ['q' => 'Do I need to be physically present?',
             'a' => 'Not for most steps. We act under power of attorney for signings, ministry submissions, and bank account opening preliminaries. A short visit is typically required for biometrics or the final bank meeting.'],
        ],
        'Costs' => [
            ['q' => 'What does setup actually cost?',
             'a' => 'Government fees are fixed by activity. Our fees are flat — quoted before we begin, never billed by the hour. A simple W.L.L. starts at BD 750 plus government charges; capital-market work is scoped per engagement.'],
            ['q' => 'Are there ongoing costs after incorporation?',
             'a' => 'Annual CR renewal, audit if your activity requires it, EWA, GOSI for staff, and VAT registration above the threshold. We hand you a maintenance calendar at handover.'],
        ],
        'Regulation' => [
            ['q' => "What is a 'Professional Body' under MOIC?",
             'a' => 'A consultancy formally recognized by the Ministry of Industry & Commerce to submit, amend, and execute commercial registry matters on behalf of clients — مكتب معتمد. It means our submissions are treated as authorized rather than third-party.'],
            ['q' => 'Can foreigners own 100% of a Bahraini company?',
             'a' => 'For most activities, yes. A growing list of sectors permits full foreign ownership; a small list still requires a Bahraini partner. We confirm the answer for your specific activity before you commit.'],
        ],
        'After' => [
            ['q' => 'Do you help with bank account opening?',
             'a' => 'Yes. We prepare KYC packs, introduce you to relationship managers at banks we work with regularly, and accompany you to the account-opening meeting.'],
            ['q' => 'Can you handle ongoing corporate secretarial work?',
             'a' => 'Yes. Board minutes, AGM/EGM coordination, registry changes, annual returns, and CBB filings are part of our corporate services retainer.'],
        ],
    ];
@endphp

@section('content')
<section class="relative overflow-hidden pt-28 pb-20 bg-white dark:bg-navy-800 border-b border-ink/10 dark:border-white/10">
  <div class="absolute bottom-0 inset-x-0 h-3/5 dotgrid text-mute" style="mask-image:linear-gradient(180deg,transparent,#000);-webkit-mask-image:linear-gradient(180deg,transparent,#000);" aria-hidden="true"></div>
  <div class="absolute top-0 end-0 w-56 h-56 stripe-motif" style="mask-image:linear-gradient(225deg,#000,transparent 70%);-webkit-mask-image:linear-gradient(225deg,#000,transparent 70%);" aria-hidden="true"></div>
  <div class="relative max-w-container mx-auto px-5 sm:px-10">
    <div class="font-mono text-[11px] tracking-[.16em] uppercase text-mute mb-5"><a href="{{ route('front.home') }}" class="hover:text-orange-500">{{ __('front.c.home') }}</a> / <span class="text-orange-500">{{ __('front.faqs.crumb') }}</span></div>
    <h1 class="font-display font-medium text-[clamp(40px,6.4vw,84px)] leading-[1.02] tracking-tight max-w-[900px] reveal in">{{ __('front.faqs.h1') }}</h1>
    <p class="mt-6 max-w-[680px] text-lg text-mute dark:text-cream/60 reveal in delay-1">{{ __('front.faqs.sub') }}</p>
  </div>
</section>

<section class="py-12 md:py-16" data-faq-wrap>
  <div class="max-w-container mx-auto px-5 sm:px-10">
    <div class="grid lg:grid-cols-[1fr_2.4fr] gap-16 items-start">
      <div class="reveal lg:sticky lg:top-28">
        <div class="eyebrow mb-5">{{ __('front.faqs.topics') }}</div>
        <div class="flex flex-col">
          @foreach ($cats as $i => $cat)
            <button data-faq-cat="{{ $cat['key'] }}" @if(!empty($cat['active'])) data-active="true" @endif class="text-start py-4 border-b border-ink/10 dark:border-white/10 {{ $i === 0 ? 'border-t' : '' }} flex justify-between items-center text-lg data-[active=true]:text-orange-500 data-[active=true]:font-semibold text-ink2 dark:text-cream/80 font-medium transition">
              <span>{{ __('front.'.$cat['i18n']) }}</span>
              <span class="font-mono text-[11px] text-mute">{{ $cat['num'] }}</span>
            </button>
          @endforeach
        </div>
        <div class="mt-10 p-6 bg-white dark:bg-navy-800 border border-ink/10 dark:border-white/10 rounded-2xl">
          <h4 class="font-semibold text-base mb-2">{{ __('front.faqs.notHere') }}</h4>
          <p class="text-sm text-mute dark:text-cream/60 mb-4">{{ __('front.faqs.notHereSub') }}</p>
          <a href="{{ route('front.contact') }}" class="btn-link inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-xs transition"><span>{{ __('front.faqs.ask') }}</span><span class="btn-arrow">→</span></a>
        </div>
      </div>

      <div class="reveal">
        <div class="mb-8">
          <div class="font-mono text-[11px] tracking-[.18em] text-orange-500 mb-2" data-faq-head>{{ __('front.faqs.catSetup') }}</div>
          <h2 class="font-display font-medium text-[clamp(28px,3.2vw,40px)] tracking-tight"><span data-faq-count>{{ count($faqs['Setup']) }}</span> {{ __('front.faqs.questions') }}</h2>
        </div>

        @foreach ($faqs as $cat => $rows)
          <div data-faq-group="{{ $cat }}" @if($cat !== 'Setup') class="hidden" @endif>
            @foreach ($rows as $i => $row)
              <div class="acc-item border-b border-ink/10 dark:border-white/10 cursor-pointer" data-open="{{ $i === 0 ? 'true' : 'false' }}">
                <div class="flex justify-between items-center py-6 gap-5">
                  <h3 class="font-display font-semibold text-lg">{{ $row['q'] }}</h3>
                  <div class="acc-toggle shrink-0 w-9 h-9 rounded-full border border-ink/20 dark:border-white/20 inline-flex items-center justify-center text-ink2 dark:text-cream/70 transition">
                    <svg width="14" height="14" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
                  </div>
                </div>
                <div class="acc-a">
                  <p class="text-mute dark:text-cream/70 max-w-[760px] leading-relaxed">{{ $row['a'] }}</p>
                </div>
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

@include('front.partials.final-cta')
@endsection
