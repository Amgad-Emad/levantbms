<x-auth-layout title="Sign in">
<div class="min-h-screen grid lg:grid-cols-[1.05fr_1fr]">

    {{-- ============ Brand panel ============ --}}
    <div class="relative hidden lg:flex flex-col justify-between overflow-hidden bg-navy-900 text-cream p-12 xl:p-16">
        <div class="absolute inset-0 dotgrid text-white/10" style="mask-image:radial-gradient(80% 70% at 30% 30%, #000 20%, transparent 80%); -webkit-mask-image:radial-gradient(80% 70% at 30% 30%, #000 20%, transparent 80%);" aria-hidden="true"></div>
        <div class="absolute top-16 -end-10 w-72 h-72 stripe-motif text-orange-500/30" style="mask-image:linear-gradient(225deg,#000,transparent 70%); -webkit-mask-image:linear-gradient(225deg,#000,transparent 70%);" aria-hidden="true"></div>

        {{-- harbour skyline --}}
        <svg viewBox="0 0 1200 400" preserveAspectRatio="xMidYMax slice" class="absolute bottom-0 inset-x-0 w-full h-2/5 opacity-60" aria-hidden="true">
            <g fill="rgba(255,255,255,.05)" stroke="rgba(255,255,255,.10)">
                <rect x="40" y="180" width="70" height="220"/><rect x="120" y="120" width="55" height="280"/>
                <rect x="185" y="220" width="80" height="180"/><rect x="280" y="80" width="60" height="320"/>
                <rect x="355" y="200" width="75" height="200"/><rect x="445" y="140" width="65" height="260"/>
                <rect x="700" y="100" width="70" height="300"/><rect x="785" y="210" width="60" height="190"/>
                <rect x="860" y="60" width="85" height="340"/><rect x="960" y="200" width="60" height="200"/>
                <rect x="1035" y="150" width="75" height="250"/>
            </g>
        </svg>

        <div class="relative">
            <a href="{{ url('/') }}" class="inline-flex items-baseline gap-2">
                <span class="font-display font-extrabold text-2xl tracking-tight">LevantBMS</span>
            </a>
            <div class="font-mono text-[10px] uppercase tracking-[.22em] text-cream/50 mt-1">Business Management Services</div>
        </div>

        <div class="relative max-w-[460px]">
            <div class="eyebrow text-orange-400 mb-6">Bahrain · Professional Body · مكتب معتمد</div>
            <h1 class="font-display font-medium text-[clamp(34px,4vw,52px)] leading-[1.08] tracking-tight">
                Manage your firm’s
                <span class="font-serif italic font-light text-orange-400">online presence</span>
                from one place.
            </h1>
            <p class="mt-6 text-cream/60 leading-relaxed">Sign in to update content, publish articles, manage leads and track traffic — all from the LevantBMS control center.</p>
        </div>

        <div class="relative flex flex-wrap gap-2.5">
            @foreach (['23+ Years', 'MOIC-Approved', 'Bahrain Financial Harbour'] as $chip)
                <span class="inline-flex items-center gap-2 px-3.5 py-2 rounded-full border border-white/15 bg-white/5 text-xs font-medium">
                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>{{ $chip }}
                </span>
            @endforeach
        </div>
    </div>

    {{-- ============ Form panel ============ --}}
    <div class="flex items-center justify-center p-6 sm:p-10">
        <div class="w-full max-w-[420px]">
            {{-- mobile brand --}}
            <a href="{{ url('/') }}" class="lg:hidden inline-flex items-baseline gap-2 mb-10">
                <span class="font-display font-extrabold text-xl tracking-tight">LevantBMS</span>
            </a>

            <div class="eyebrow mb-4">Control center</div>
            <h2 class="font-display font-medium text-[clamp(28px,3.4vw,40px)] tracking-tight leading-tight">Welcome back.</h2>
            <p class="mt-3 text-mute leading-relaxed">Sign in to your dashboard to continue.</p>

            @if (session('status'))
                <div class="mt-6 px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-green-800 text-sm">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="mt-6 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="mt-8 flex flex-col gap-5">
                @csrf

                <label class="block">
                    <span class="font-mono text-[10px] tracking-[.12em] uppercase text-orange-500 mb-1.5 block">Email</span>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="w-full px-4 py-3.5 bg-white border border-ink/15 rounded-lg outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition" />
                </label>

                <label class="block">
                    <span class="font-mono text-[10px] tracking-[.12em] uppercase text-orange-500 mb-1.5 block">Password</span>
                    <div class="relative">
                        <input type="password" name="password" required autocomplete="current-password" data-password-input
                               class="w-full px-4 py-3.5 pe-12 bg-white border border-ink/15 rounded-lg outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition" />
                        <button type="button" data-toggle-password aria-label="Show password"
                                class="absolute inset-y-0 end-2 my-auto h-9 w-9 inline-flex items-center justify-center text-mute hover:text-orange-500 transition">
                            <svg data-eye width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg data-eye-off class="hidden" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-6.5 0-10-7-10-7a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c6.5 0 10 7 10 7a18.5 18.5 0 0 1-2.16 3.19M1 1l22 22"/><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/></svg>
                        </button>
                    </div>
                </label>

                <button type="submit" class="btn-link inline-flex items-center justify-center gap-2.5 mt-2 px-6 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm shadow-md-soft transition">
                    <span>Sign in</span><span class="btn-arrow">→</span>
                </button>
            </form>

            <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 mt-10 text-sm text-mute hover:text-orange-500 transition">
                <span>←</span> Back to website
            </a>
        </div>
    </div>

</div>

<script>
    document.querySelectorAll('[data-toggle-password]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = btn.closest('.relative').querySelector('[data-password-input]');
            var hidden = input.type === 'password';
            input.type = hidden ? 'text' : 'password';
            btn.querySelector('[data-eye]').classList.toggle('hidden', hidden);
            btn.querySelector('[data-eye-off]').classList.toggle('hidden', !hidden);
            btn.setAttribute('aria-label', hidden ? 'Hide password' : 'Show password');
        });
    });
</script>
</x-auth-layout>
