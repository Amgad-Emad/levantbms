@extends('dashboard.layout')

@section('title', 'Leads')

@section('content')

    <div class="my-3">
        <h4 class="fw-semibold mb-1">Leads Inbox</h4>
        <p class="text-muted mb-0">Enquiries submitted through the website contact form.</p>
    </div>

    @php
        $tabs = ['' => 'All', 'new' => 'New', 'read' => 'Read', 'archived' => 'Archived'];
    @endphp
    <ul class="nav nav-pills gap-1 mb-3">
        @foreach ($tabs as $key => $label)
            <li class="nav-item">
                <a class="nav-link {{ (string) $status === (string) $key ? 'active' : '' }}" href="{{ route('dashboard.leads.index', array_filter(['status' => $key])) }}">
                    {{ $label }} <span class="badge {{ (string) $status === (string) $key ? 'bg-white text-primary' : 'badge-soft-secondary' }} ms-1">{{ $counts[$key ?: 'all'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light bg-opacity-50">
                        <tr><th>Name</th><th>Email</th><th>Topic</th><th>Received</th><th>Status</th><th class="text-end">Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($leads as $lead)
                            <tr class="{{ $lead->status === 'new' ? 'fw-semibold' : '' }}">
                                <td>
                                    <a href="{{ route('dashboard.leads.show', $lead) }}" class="text-body text-decoration-none">
                                        @if ($lead->status === 'new')<span class="badge-circle bg-primary d-inline-block me-1" style="width:8px;height:8px;border-radius:50%"></span>@endif
                                        {{ $lead->name }}
                                    </a>
                                </td>
                                <td>{{ $lead->email }}</td>
                                <td>{{ $lead->topic ?: '—' }}</td>
                                <td>{{ $lead->created_at->diffForHumans() }}</td>
                                <td><span class="badge badge-soft-{{ ['new' => 'success', 'read' => 'info', 'archived' => 'secondary'][$lead->status] ?? 'secondary' }} text-capitalize">{{ $lead->status }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('dashboard.leads.show', $lead) }}" class="btn btn-sm btn-icon btn-soft-primary"><i class="ti ti-eye"></i></a>
                                    <form action="{{ route('dashboard.leads.destroy', $lead) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this lead?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-icon btn-soft-danger"><i class="ti ti-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-5"><i class="ti ti-inbox fs-32 d-block mb-2 opacity-50"></i> No leads here yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-2">{{ $leads->links() }}</div>

@endsection
