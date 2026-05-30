@php
    $newLeads = \App\Models\Lead::where('status', 'new')->count();
    $groups = [
        'Main' => [
            ['label' => 'Dashboard', 'icon' => 'ti-layout-dashboard', 'route' => 'dashboard', 'active' => 'dashboard'],
        ],
        'Content' => [
            ['label' => 'Pages',    'icon' => 'ti-file-text',   'route' => 'dashboard.content.index',  'active' => 'dashboard.content.*'],
            ['label' => 'Blog',     'icon' => 'ti-article',     'route' => 'dashboard.posts.index',    'active' => 'dashboard.posts.*'],
            ['label' => 'Services', 'icon' => 'ti-briefcase',   'route' => 'dashboard.services.index', 'active' => 'dashboard.services.*'],
            ['label' => 'Partners', 'icon' => 'ti-building-store', 'route' => 'dashboard.partners.index', 'active' => 'dashboard.partners.*'],
            ['label' => 'Gallery',  'icon' => 'ti-photo',       'route' => 'dashboard.gallery.index',  'active' => 'dashboard.gallery.*'],
            ['label' => 'FAQs',     'icon' => 'ti-help-circle', 'route' => 'dashboard.faqs.index',     'active' => 'dashboard.faqs.*'],
            ['label' => 'SEO',      'icon' => 'ti-seo',         'route' => 'dashboard.seo.index',      'active' => 'dashboard.seo.*'],
        ],
        'Engagement' => [
            ['label' => 'Leads',   'icon' => 'ti-inbox',  'route' => 'dashboard.leads.index', 'active' => 'dashboard.leads.*'],
            ['label' => 'Media',   'icon' => 'ti-folder', 'route' => 'dashboard.media.index', 'active' => 'dashboard.media.*'],
        ],
        'Insights' => [
            ['label' => 'Analytics', 'icon' => 'ti-chart-bar', 'route' => 'dashboard.analytics', 'active' => 'dashboard.analytics'],
        ],
        'Settings' => [
            ['label' => 'Settings', 'icon' => 'ti-settings', 'route' => 'dashboard.settings.index', 'active' => 'dashboard.settings.*'],
            ['label' => 'Users',    'icon' => 'ti-users',    'route' => 'dashboard.users.index',    'active' => 'dashboard.users.*', 'gate' => 'manage-users'],
        ],
    ];
@endphp

<div class="sidenav-menu">

    <button class="button-close-offcanvas btn btn-icon d-xl-none">
        <i class="ti ti-x fs-22"></i>
    </button>

    <div data-simplebar>
        <ul class="side-nav">
            @foreach ($groups as $title => $items)
                <li class="side-nav-title">{{ $title }}</li>
                @foreach ($items as $item)
                    @continue(isset($item['gate']) && Gate::denies($item['gate']))
                    @php $exists = Route::has($item['route']); @endphp
                    <li class="side-nav-item">
                        <a href="{{ $exists ? route($item['route']) : '#' }}"
                           class="side-nav-link {{ request()->routeIs($item['active']) ? 'active' : '' }} {{ $exists ? '' : 'opacity-50' }}">
                            <span class="menu-icon"><i class="ti {{ $item['icon'] }}"></i></span>
                            <span class="menu-text">{{ $item['label'] }}</span>
                            @if ($item['route'] === 'dashboard.leads.index' && $newLeads > 0)
                                <span class="badge bg-primary rounded-circle ms-auto">{{ $newLeads }}</span>
                            @elseif (! $exists)
                                <span class="badge badge-soft-secondary ms-auto fs-10">soon</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            @endforeach
        </ul>
    </div>
</div>
