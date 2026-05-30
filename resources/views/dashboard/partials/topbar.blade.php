<header class="app-topbar">
    <div class="topbar-menu d-flex align-items-center justify-content-between">

        {{-- Left: brand + menu toggle + search --}}
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('dashboard') }}" class="logo-topbar logo d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('dashboard/assets/images/logo-sm.png') }}" alt="LevantBMS" height="26"
                     onerror="this.style.display='none'" />
                <span class="fs-18 fw-bold text-body">LevantBMS</span>
            </a>

            <div class="topbar-item">
                <button class="topbar-link button-collapse-toggle px-2" type="button" aria-label="Toggle menu">
                    <i class="ti ti-menu-2 fs-22"></i>
                </button>
            </div>

            {{-- <div class="topbar-search d-none d-lg-flex align-items-center ms-1">
                <i class="ti ti-search fs-18 text-muted"></i>
                <input type="search" class="form-control border-0 bg-transparent" placeholder="Search content…" />
            </div> --}}
        </div>

        {{-- Right: theme, view site, profile --}}
        <div class="d-flex align-items-center gap-1">
            <div class="topbar-item">
                <a href="{{ route('front.home') }}" target="_blank" class="topbar-link px-2" title="View site">
                    <i class="ti ti-external-link fs-20"></i>
                </a>
            </div>

            <div class="topbar-item">
                <button id="theme-toggle" type="button" class="topbar-link px-2" title="Toggle theme">
                    <i class="ti ti-brightness fs-20"></i>
                </button>
            </div>

            <div class="topbar-item dropdown">
                <button class="topbar-link btn d-flex align-items-center gap-2 border-0 bg-transparent" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="avatar avatar-sm rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center fw-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </span>
                    <span class="d-none d-md-block text-start lh-1">
                        <span class="fw-semibold fs-14 d-block">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <span class="text-muted fs-12 text-capitalize">{{ auth()->user()->role ?? 'editor' }}</span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="ti ti-user-circle me-2 fs-17"></i> My Profile
                    </a>
                    @if (Route::has('dashboard.settings.index'))
                        <a class="dropdown-item" href="{{ route('dashboard.settings.index') }}">
                            <i class="ti ti-settings me-2 fs-17"></i> Settings
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="ti ti-logout me-2 fs-17"></i> Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
