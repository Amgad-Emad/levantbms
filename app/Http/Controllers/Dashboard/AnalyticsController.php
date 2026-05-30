<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\PageView;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    public function index(Request $request): View
    {
        $days = (int) $request->query('days', 30);
        $days = in_array($days, [7, 30, 90], true) ? $days : 30;
        $since = now()->subDays($days - 1)->startOfDay();

        $views = PageView::where('created_at', '>=', $since)->get();

        // Views per day.
        $byDay = $views->groupBy(fn ($v) => $v->created_at->format('Y-m-d'))->map->count();
        $series = collect(range($days - 1, 0))->map(function ($ago) use ($byDay) {
            $date = now()->subDays($ago);

            return ['label' => $date->format('M j'), 'value' => $byDay[$date->format('Y-m-d')] ?? 0];
        });

        $totals = [
            'views' => $views->count(),
            'sessions' => $views->pluck('session_id')->filter()->unique()->count(),
            'leads' => Lead::where('created_at', '>=', $since)->count(),
            'conversion' => 0,
        ];
        $totals['conversion'] = $totals['sessions'] > 0
            ? round($totals['leads'] / $totals['sessions'] * 100, 1)
            : 0;

        $topPages = $views->groupBy('path')->map->count()->sortDesc()->take(8);
        $devices = $views->groupBy('device')->map->count();
        $locales = $views->groupBy('locale')->map->count();
        $referrers = $views->pluck('referrer')->filter()
            ->map(fn ($r) => parse_url($r, PHP_URL_HOST) ?: 'direct')
            ->countBy()->sortDesc()->take(6);

        return view('dashboard.analytics.index', compact('days', 'series', 'totals', 'topPages', 'devices', 'locales', 'referrers'));
    }
}
