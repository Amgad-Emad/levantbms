@extends('dashboard.layout')

@section('title', 'Analytics')

@section('content')

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <h4 class="fw-semibold mb-1">Traffic & Analytics</h4>
            <p class="text-muted mb-0">Self-hosted visitor analytics — your data, your dashboard.</p>
        </div>
        <div class="btn-group">
            @foreach ([7 => '7 days', 30 => '30 days', 90 => '90 days'] as $d => $label)
                <a href="{{ route('dashboard.analytics', ['days' => $d]) }}" class="btn btn-sm {{ $days === $d ? 'btn-primary' : 'btn-soft-primary' }}">{{ $label }}</a>
            @endforeach
        </div>
    </div>

    @php
        $cards = [
            ['label' => 'Page Views', 'value' => $totals['views'], 'icon' => 'ti-eye', 'bg' => 'bg-primary'],
            ['label' => 'Sessions', 'value' => $totals['sessions'], 'icon' => 'ti-users', 'bg' => 'bg-info'],
            ['label' => 'Leads', 'value' => $totals['leads'], 'icon' => 'ti-inbox', 'bg' => 'bg-success'],
            ['label' => 'Conversion', 'value' => $totals['conversion'].'%', 'icon' => 'ti-percentage', 'bg' => 'bg-warning'],
        ];
    @endphp
    <div class="row">
        @foreach ($cards as $card)
            <div class="col-6 col-xl-3">
                <div class="card"><div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar-md flex-shrink-0">
                        <span class="avatar-title {{ $card['bg'] }} text-white rounded-circle fs-22"><i class="ti {{ $card['icon'] }}"></i></span>
                    </div>
                    <div><p class="text-uppercase fs-12 text-muted mb-1">{{ $card['label'] }}</p><h3 class="mb-0 fw-bold">{{ is_numeric($card['value']) ? number_format($card['value']) : $card['value'] }}</h3></div>
                </div></div>
            </div>
        @endforeach
    </div>

    <div class="card">
        <div class="card-header"><h5 class="card-title mb-0">Page views — last {{ $days }} days</h5></div>
        <div class="card-body"><canvas id="views-chart" style="max-height:320px"></canvas></div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Top pages</h5></div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <tbody>
                            @forelse ($topPages as $path => $count)
                                <tr><td class="font-monospace fs-13" dir="ltr">{{ rawurldecode($path) }}</td><td class="text-end fw-medium">{{ number_format($count) }}</td></tr>
                            @empty
                                <tr><td class="text-center text-muted py-4">No data yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card h-100"><div class="card-header"><h5 class="card-title mb-0">Devices</h5></div>
                <div class="card-body">
                    @forelse ($devices as $device => $count)
                        <div class="d-flex justify-content-between py-1"><span class="text-capitalize"><i class="ti ti-device-{{ $device === 'mobile' ? 'mobile' : ($device === 'tablet' ? 'tablet' : 'desktop') }} me-1"></i>{{ $device }}</span><span class="fw-medium">{{ $count }}</span></div>
                    @empty
                        <p class="text-muted mb-0">No data yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card h-100"><div class="card-header"><h5 class="card-title mb-0">Top sources</h5></div>
                <div class="card-body">
                    @forelse ($referrers as $host => $count)
                        <div class="d-flex justify-content-between py-1"><span class="text-truncate">{{ $host }}</span><span class="fw-medium">{{ $count }}</span></div>
                    @empty
                        <p class="text-muted mb-0">Mostly direct traffic.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    (function () {
        if (typeof CustomChartJs === 'undefined') return;
        var labels = @json($series->pluck('label'));
        var values = @json($series->pluck('value'));
        new CustomChartJs({
            selector: '#views-chart',
            options: function () {
                return {
                    type: 'bar',
                    data: { labels: labels, datasets: [{ label: 'Views', data: values, backgroundColor: ins('chart-primary'), borderRadius: 4, maxBarThickness: 22 }] },
                    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } },
                };
            },
        });
    })();
</script>
@endpush
