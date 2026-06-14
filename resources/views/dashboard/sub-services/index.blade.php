@extends('dashboard.layout')

@section('title', 'Sub-services')

@section('content')

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <h4 class="fw-semibold mb-1">Sub-services</h4>
            <p class="text-muted mb-0">Detailed offerings nested under a parent service — same fields, with scope, timelines and starting fees.</p>
        </div>
        <a href="{{ route('dashboard.sub-services.create') }}" class="btn btn-primary"><i class="ti ti-plus me-1"></i> New Sub-service</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light bg-opacity-50">
                        <tr><th style="width:60px">#</th><th>Title</th><th>Parent service</th><th>Timeline</th><th>Starting fee</th><th>Status</th><th class="text-end">Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($subServices as $subService)
                            <tr>
                                <td class="font-monospace text-orange">{{ $subService->code }}</td>
                                <td>
                                    <div class="fw-medium">{{ $subService->title->get('en') }}</div>
                                    <div class="fs-12 text-muted">{{ $subService->tag->get('en') }}</div>
                                </td>
                                <td><span class="badge badge-soft-primary">{{ optional($subService->service)->title?->get('en') ?: '—' }}</span></td>
                                <td>{{ $subService->timeline->get('en') ?: '—' }}</td>
                                <td class="fw-medium text-success">{{ $subService->fee_from->get('en') ?: '—' }}</td>
                                <td><span class="badge badge-soft-{{ $subService->is_published ? 'success' : 'secondary' }}">{{ $subService->is_published ? 'Published' : 'Hidden' }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('dashboard.sub-services.edit', $subService) }}" class="btn btn-sm btn-icon btn-soft-primary"><i class="ti ti-edit"></i></a>
                                    <form action="{{ route('dashboard.sub-services.destroy', $subService) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this sub-service?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-icon btn-soft-danger"><i class="ti ti-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted py-5">No sub-services yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
