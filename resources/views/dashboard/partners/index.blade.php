@extends('dashboard.layout')

@section('title', 'Partners')

@section('content')

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <h4 class="fw-semibold mb-1">Global Partners</h4>
            <p class="text-muted mb-0">Vendors and platforms featured on the partners page.</p>
        </div>
        <a href="{{ route('dashboard.partners.create') }}" class="btn btn-primary"><i class="ti ti-plus me-1"></i> New Partner</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light bg-opacity-50"><tr><th style="width:64px">Logo</th><th>Name</th><th>Tag</th><th>Region</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
                    <tbody>
                        @forelse ($partners as $partner)
                            <tr>
                                <td>
                                    @if ($partner->logoUrl())<img src="{{ $partner->logoUrl() }}" width="48" height="36" style="object-fit:contain" alt="">
                                    @else<span class="avatar-sm rounded bg-light d-inline-flex align-items-center justify-content-center text-muted"><i class="ti ti-building-store"></i></span>@endif
                                </td>
                                <td class="fw-medium">{{ $partner->name->get('en') }}</td>
                                <td>{{ $partner->tag->get('en') ?: '—' }}</td>
                                <td>{{ $partner->region->get('en') ?: '—' }}</td>
                                <td><span class="badge badge-soft-{{ $partner->is_published ? 'success' : 'secondary' }}">{{ $partner->is_published ? 'Published' : 'Hidden' }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('dashboard.partners.edit', $partner) }}" class="btn btn-sm btn-icon btn-soft-primary"><i class="ti ti-edit"></i></a>
                                    <form action="{{ route('dashboard.partners.destroy', $partner) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this partner?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-icon btn-soft-danger"><i class="ti ti-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-5">No partners yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
