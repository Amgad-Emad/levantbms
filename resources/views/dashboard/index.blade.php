@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content')

    <div class="text-center my-4">
        <span class="badge badge-soft-primary mb-2"><i class="ti ti-sparkles me-1"></i> LevantBMS Control Center</span>
        <h3 class="fw-bold mb-1">Welcome back, {{ auth()->user()->name }}</h3>
        <p class="text-muted mb-0">Manage your website content, leads, and traffic — all in one place.</p>
    </div>

    {{-- Stat cards --}}
    @php
        $cards = [
            ['label' => 'Blog Posts',  'value' => $stats['posts'],       'icon' => 'ti-article',     'bg' => 'bg-dark',    'sub' => 'published & drafts'],
            ['label' => 'Leads',       'value' => $stats['leads_month'], 'icon' => 'ti-inbox',       'bg' => 'bg-primary', 'sub' => 'this month'],
            ['label' => 'Page Views',  'value' => $stats['views_30d'],   'icon' => 'ti-eye',         'bg' => 'bg-success', 'sub' => 'last 30 days'],
            ['label' => 'Services',    'value' => $stats['services'],    'icon' => 'ti-briefcase',   'bg' => 'bg-warning', 'sub' => 'active'],
        ];
    @endphp
    <div class="row">
        @foreach ($cards as $card)
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="avatar-md flex-shrink-0">
                            <span class="avatar-title {{ $card['bg'] }} text-white rounded-circle fs-22">
                                <i class="ti {{ $card['icon'] }}"></i>
                            </span>
                        </div>
                        <div>
                            <p class="text-uppercase fs-12 fw-medium text-muted mb-1">{{ $card['label'] }}</p>
                            <h3 class="mb-0 fw-bold">{{ number_format($card['value']) }}</h3>
                            <p class="text-muted fs-12 mb-0">{{ $card['sub'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        {{-- Traffic chart --}}
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Traffic — last 14 days</h5>
                    @if (Route::has('dashboard.analytics'))
                        <a href="{{ route('dashboard.analytics') }}" class="btn btn-sm btn-soft-primary">View analytics <i class="ti ti-arrow-right"></i></a>
                    @endif
                </div>
                <div class="card-body">
                    <canvas id="traffic-chart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        {{-- Quick actions --}}
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Quick Actions</h5></div>
                <div class="card-body d-flex flex-column gap-2">
                    @php
                        $actions = [
                            ['label' => 'Add New Post',     'icon' => 'ti-pencil-plus', 'route' => 'dashboard.posts.create',   'class' => 'btn-dark'],
                            ['label' => 'Edit Page Content','icon' => 'ti-file-text',   'route' => 'dashboard.content.index',  'class' => 'btn-primary'],
                            ['label' => 'View Leads',       'icon' => 'ti-inbox',       'route' => 'dashboard.leads.index',    'class' => 'btn-success'],
                            ['label' => 'Site Settings',    'icon' => 'ti-settings',    'route' => 'dashboard.settings.index', 'class' => 'btn-warning'],
                        ];
                    @endphp
                    @foreach ($actions as $a)
                        <a href="{{ Route::has($a['route']) ? route($a['route']) : '#' }}"
                           class="btn {{ $a['class'] }} d-flex align-items-center justify-content-center gap-2 {{ Route::has($a['route']) ? '' : 'disabled' }}">
                            <i class="ti {{ $a['icon'] }}"></i> {{ $a['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Recent leads --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Recent Leads</h5>
            @if (Route::has('dashboard.leads.index'))
                <a href="{{ route('dashboard.leads.index') }}" class="btn btn-sm btn-soft-primary">All leads</a>
            @endif
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th>Name</th><th>Email</th><th>Topic</th><th>Received</th><th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentLeads as $lead)
                            <tr>
                                <td class="fw-medium">{{ $lead->name }}</td>
                                <td>{{ $lead->email }}</td>
                                <td>{{ $lead->topic ?: '—' }}</td>
                                <td>{{ $lead->created_at->diffForHumans() }}</td>
                                <td><span class="badge badge-soft-{{ $lead->status === 'new' ? 'success' : 'secondary' }} text-capitalize">{{ $lead->status }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="ti ti-inbox fs-32 d-block mb-2 opacity-50"></i>
                                    No leads yet — they’ll appear here once visitors use the contact form.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    (function () {
        if (typeof CustomChartJs === 'undefined') return;
        var labels = @json($chart->pluck('label'));
        var values = @json($chart->pluck('value'));
        new CustomChartJs({
            selector: '#traffic-chart',
            options: function () {
                return {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Page views',
                            data: values,
                            backgroundColor: ins('chart-primary-rgb', 0.25),
                            borderColor: ins('chart-primary'),
                            fill: true, tension: 0.35, pointRadius: 0, borderWidth: 2,
                        }],
                    },
                    options: {
                        interaction: { mode: 'index', intersect: false },
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
                    },
                };
            },
        });
    })();
</script>
@endpush
