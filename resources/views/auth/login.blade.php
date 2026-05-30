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
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="font-mono text-[10px] tracking-[.12em] uppercase text-orange-500">Password</span>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-mute hover:text-orange-500 transition">Forgot password?</a>
                        @endif
                    </div>
                    <input type="password" name="password" required autocomplete="current-password"
                           class="w-full px-4 py-3.5 bg-white border border-ink/15 rounded-lg outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition" />
                </label>

                <label class="inline-flex items-center gap-2.5 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-ink/25 text-orange-500 focus:ring-orange-500/30">
                    <span class="text-sm text-ink2">Keep me signed in</span>
                </label>

                <button type="submit" class="btn-link inline-flex items-center justify-center gap-2.5 mt-1 px-6 py-3.5 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm shadow-md-soft transition">
                    <span>Sign in</span><span class="btn-arrow">→</span>
                </button>
            </form>

            <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 mt-10 text-sm text-mute hover:text-orange-500 transition">
                <span>←</span> Back to website
            </a>
        </div>
    </div>

</div>
</x-auth-layout>
