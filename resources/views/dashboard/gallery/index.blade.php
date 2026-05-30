@extends('dashboard.layout')

@section('title', 'Gallery')

@section('content')

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <h4 class="fw-semibold mb-1">Gallery</h4>
            <p class="text-muted mb-0">Photos shown on the public gallery page.</p>
        </div>
        <a href="{{ route('dashboard.gallery.create') }}" class="btn btn-primary"><i class="ti ti-photo-plus me-1"></i> Add Image</a>
    </div>

    <div class="row">
        @forelse ($items as $item)
            <div class="col-6 col-md-4 col-xl-3">
                <div class="card">
                    <div class="position-relative">
                        @if ($item->imageUrl('thumb'))
                            <img src="{{ $item->imageUrl('thumb') }}" class="card-img-top" style="aspect-ratio:{{ $item->ratio }};object-fit:cover" alt="">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="aspect-ratio:{{ $item->ratio }}"><i class="ti ti-photo fs-32"></i></div>
                        @endif
                        <span class="badge badge-soft-dark position-absolute top-0 start-0 m-2">{{ $item->category }}</span>
                        @unless ($item->is_published)<span class="badge badge-soft-secondary position-absolute top-0 end-0 m-2">Hidden</span>@endunless
                    </div>
                    <div class="card-body py-2 d-flex justify-content-between align-items-center">
                        <span class="fs-13 text-truncate">{{ $item->label->get('en') ?: '—' }}</span>
                        <span class="d-flex gap-1">
                            <a href="{{ route('dashboard.gallery.edit', $item) }}" class="btn btn-sm btn-icon btn-soft-primary"><i class="ti ti-edit"></i></a>
                            <form action="{{ route('dashboard.gallery.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-icon btn-soft-danger"><i class="ti ti-trash"></i></button>
                            </form>
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><div class="card"><div class="card-body text-center text-muted py-5">No images yet. <a href="{{ route('dashboard.gallery.create') }}">Add one</a>.</div></div></div>
        @endforelse
    </div>

@endsection
