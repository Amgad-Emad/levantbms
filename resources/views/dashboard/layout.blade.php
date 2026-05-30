<!DOCTYPE html>
<html lang="en"
      data-skin="shadcn"
      data-bs-theme="light"
      data-sidenav-color="light"
      data-sidenav-size="default"
      data-topbar-color="light"
      data-layout-position="fixed">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Dashboard') · LevantBMS</title>
    <link rel="shortcut icon" href="{{ asset('dashboard/assets/images/favicon.ico') }}" />

    {{-- Reads data-* attributes + sessionStorage and applies the theme. Must run before paint. --}}
    <script src="{{ asset('dashboard/assets/js/config.js') }}"></script>

    <link href="{{ asset('dashboard/assets/css/vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard/assets/css/app.min.css') }}" rel="stylesheet" />
    @stack('styles')
</head>

<body>
<div class="wrapper">

    @include('dashboard.partials.topbar')
    @include('dashboard.partials.sidebar')

    <div class="content-page">
        <div class="container-fluid">

            @hasSection('page-title')
                <div class="d-flex align-items-center justify-content-between gap-2 my-3">
                    <h4 class="fs-18 fw-semibold mb-0">@yield('page-title')</h4>
                    <div>@yield('page-actions')</div>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        {{ date('Y') }} © LevantBMS — Business Management Services
                    </div>
                </div>
            </div>
        </footer>
    </div>

</div>

<script src="{{ asset('dashboard/assets/js/vendors.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/app.js') }}"></script>

{{-- Theme toggle: flips data-bs-theme and persists via the template's config store. --}}
<script>
    (function () {
        var btn = document.getElementById('theme-toggle');
        if (!btn) return;
        btn.addEventListener('click', function () {
            var html = document.documentElement;
            var next = html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-bs-theme', next);
            try {
                var cfg = JSON.parse(sessionStorage.getItem('__SIMPLE_CONFIG__') || '{}');
                cfg.theme = next;
                sessionStorage.setItem('__SIMPLE_CONFIG__', JSON.stringify(cfg));
            } catch (e) {}
        });
    })();
</script>
@stack('scripts')
</body>
</html>
