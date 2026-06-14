@extends('dashboard.layout')

@section('title', 'Services')

@section('content')

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <h4 class="fw-semibold mb-1">Services & Pricing</h4>
            <p class="text-muted mb-0">Edit the practice areas, their scope, timelines and starting fees.</p>
        </div>
        <a href="{{ route('dashboard.services.create') }}" class="btn btn-primary"><i class="ti ti-plus me-1"></i> New Service</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light bg-opacity-50">
                        <tr><th style="width:60px">#</th><th>Title</th><th>Sub-services</th><th>Timeline</th><th>Starting fee</th><th>Status</th><th class="text-end">Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr>
                                <td class="font-monospace text-orange">{{ $service->code }}</td>
                                <td>
                                    <div class="fw-medium">{{ $service->title->get('en') }}</div>
                                    <div class="fs-12 text-muted">{{ $service->tag->get('en') }}</div>
                                </td>
                                <td><a href="{{ route('dashboard.sub-services.index') }}" class="badge badge-soft-primary text-decoration-none">{{ $service->sub_services_count }} <i class="ti ti-list-details ms-1"></i></a></td>
                                <td>{{ $service->timeline->get('en') ?: '—' }}</td>
                                <td class="fw-medium text-success">{{ $service->fee_from->get('en') ?: '—' }}</td>
                                <td><span class="badge badge-soft-{{ $service->is_published ? 'success' : 'secondary' }}">{{ $service->is_published ? 'Published' : 'Hidden' }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('dashboard.services.edit', $service) }}" class="btn btn-sm btn-icon btn-soft-primary"><i class="ti ti-edit"></i></a>
                                    <form action="{{ route('dashboard.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this service?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-icon btn-soft-danger"><i class="ti ti-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted py-5">No services yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
