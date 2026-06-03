@extends('dashboard.layout')

@section('title', $item->exists ? 'Edit image' : 'Add image')

@section('content')

<form method="POST" action="{{ $item->exists ? route('dashboard.gallery.update', $item) : route('dashboard.gallery.store') }}" enctype="multipart/form-data">
    @csrf
    @if ($item->exists) @method('PUT') @endif

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <nav class="fs-13 text-muted mb-1"><a href="{{ route('dashboard.gallery.index') }}" class="text-muted text-decoration-none">Gallery</a> <i class="ti ti-chevron-right fs-12"></i> {{ $item->exists ? 'Edit' : 'Add' }}</nav>
            <h4 class="fw-semibold mb-0">{{ $item->exists ? 'Edit image' : 'Add image' }}</h4>
        </div>
        <button class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Save</button>
    </div>

    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <div class="row">
        <div class="col-lg-6">
            <div class="card"><div class="card-header"><h5 class="card-title mb-0">Image</h5></div>
                <div class="card-body">
                    @if ($item->exists && $item->imageUrl())
                        <img src="{{ $item->imageUrl() }}" class="img-fluid rounded mb-2" alt="">
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" id="remove_image" name="remove_image" value="1">
                            <label class="form-check-label text-danger small" for="remove_image">Remove current image</label>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="form-control" {{ $item->exists ? '' : 'required' }}>
                    <small class="text-muted">JPG/PNG/WebP, up to 5 MB.</small>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card"><div class="card-header"><h5 class="card-title mb-0">Details</h5></div>
                <div class="card-body d-flex flex-column gap-3">
                    <div class="row g-2">
                        <div class="col-6"><label class="form-label">Label (EN)</label><input type="text" name="label[en]" class="form-control" value="{{ old('label.en', $item->label['en'] ?? '') }}"></div>
                        <div class="col-6"><label class="form-label">Label (AR)</label><input type="text" name="label[ar]" dir="rtl" class="form-control" value="{{ old('label.ar', $item->label['ar'] ?? '') }}"></div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6"><label class="form-label">Category</label>
                            <select name="category" class="form-select">
                                <option value="">— none —</option>
                                @foreach ($categories as $cat)<option value="{{ $cat }}" {{ old('category', $item->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>@endforeach
                            </select>
                        </div>
                        <div class="col-6"><label class="form-label">Shape</label>
                            <select name="ratio" class="form-select">
                                @foreach ($ratios as $name => $val)<option value="{{ $val }}" {{ old('ratio', $item->ratio) === $val ? 'selected' : '' }}>{{ ucfirst($name) }} ({{ $val }})</option>@endforeach
                            </select>
                        </div>
                    </div>
                    <div><label class="form-label">Order</label><input type="number" name="position" min="0" class="form-control" value="{{ old('position', $item->position ?? 0) }}"></div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="g_pub" {{ old('is_published', $item->is_published ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="g_pub">Published</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
