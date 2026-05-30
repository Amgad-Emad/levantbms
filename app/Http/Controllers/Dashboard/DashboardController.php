<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\PageView;
use App\Models\Post;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'posts' => Post::count(),
            'leads_month' => Lead::whereBetween('created_at', [now()->startOfMonth(), now()])->count(),
            'views_30d' => PageView::where('created_at', '>=', now()->subDays(30))->count(),
            'services' => Service::where('is_published', true)->count(),
        ];

        // Page views per day for the last 14 days (chart).
        $views = PageView::where('created_at', '>=', now()->subDays(13)->startOfDay())
            ->get(['created_at'])
            ->groupBy(fn ($v) => $v->created_at->format('Y-m-d'))
            ->map->count();

        $chart = collect(range(13, 0))->map(function ($daysAgo) use ($views) {
            $date = now()->subDays($daysAgo)->format('Y-m-d');

            return [
                'label' => now()->subDays($daysAgo)->format('M j'),
                'value' => $views[$date] ?? 0,
            ];
        });

        $recentLeads = Lead::latest()->take(6)->get();

        return view('dashboard.index', compact('stats', 'chart', 'recentLeads'));
    }
}
