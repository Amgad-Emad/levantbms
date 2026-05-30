@extends('dashboard.layout')

@section('title', 'FAQs')

@section('content')

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <h4 class="fw-semibold mb-1">FAQs</h4>
            <p class="text-muted mb-0">Questions shown on the public FAQ page, grouped by topic.</p>
        </div>
        <a href="{{ route('dashboard.faqs.create') }}" class="btn btn-primary"><i class="ti ti-plus me-1"></i> New FAQ</a>
    </div>

    @forelse ($faqs as $category => $rows)
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">{{ $category }} <span class="badge badge-soft-secondary ms-1">{{ $rows->count() }}</span></h5></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <tbody>
                            @foreach ($rows as $faq)
                                <tr>
                                    <td>
                                        <div class="fw-medium">{{ $faq->question->get('en') }}</div>
                                        <div class="fs-13 text-muted text-truncate" style="max-width:680px">{{ \Illuminate\Support\Str::limit($faq->answer->get('en'), 120) }}</div>
                                    </td>
                                    <td style="width:110px">
                                        <span class="badge badge-soft-{{ $faq->is_published ? 'success' : 'secondary' }}">{{ $faq->is_published ? 'Published' : 'Hidden' }}</span>
                                    </td>
                                    <td class="text-end" style="width:110px">
                                        <a href="{{ route('dashboard.faqs.edit', $faq) }}" class="btn btn-sm btn-icon btn-soft-primary"><i class="ti ti-edit"></i></a>
                                        <form action="{{ route('dashboard.faqs.destroy', $faq) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this FAQ?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-icon btn-soft-danger"><i class="ti ti-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="card"><div class="card-body text-center text-muted py-5">No FAQs yet. <a href="{{ route('dashboard.faqs.create') }}">Add one</a>.</div></div>
    @endforelse

@endsection
