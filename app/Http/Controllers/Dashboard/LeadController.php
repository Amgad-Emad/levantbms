<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeadController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');

        $leads = Lead::when(in_array($status, ['new', 'read', 'archived'], true), fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $counts = [
            'all' => Lead::count(),
            'new' => Lead::where('status', 'new')->count(),
            'read' => Lead::where('status', 'read')->count(),
            'archived' => Lead::where('status', 'archived')->count(),
        ];

        return view('dashboard.leads.index', compact('leads', 'counts', 'status'));
    }

    public function show(Lead $lead): View
    {
        if ($lead->status === 'new') {
            $lead->update(['status' => 'read']);
        }

        return view('dashboard.leads.show', compact('lead'));
    }

    public function update(Request $request, Lead $lead): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,read,archived'],
        ]);

        $lead->update($data);

        return back()->with('status', 'Lead marked as '.$data['status'].'.');
    }

    public function destroy(Lead $lead): RedirectResponse
    {
        $lead->delete();

        return redirect()->route('dashboard.leads.index')->with('status', 'Lead deleted.');
    }
}
