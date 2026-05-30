@extends('dashboard.layout')

@section('title', $partner->exists ? 'Edit partner' : 'New partner')

@section('content')

<form method="POST" action="{{ $partner->exists ? route('dashboard.partners.update', $partner) : route('dashboard.partners.store') }}" enctype="multipart/form-data">
    @csrf
    @if ($partner->exists) @method('PUT') @endif

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <nav class="fs-13 text-muted mb-1"><a href="{{ route('dashboard.partners.index') }}" class="text-muted text-decoration-none">Partners</a> <i class="ti ti-chevron-right fs-12"></i> {{ $partner->exists ? 'Edit' : 'New' }}</nav>
            <h4 class="fw-semibold mb-0">{{ $partner->exists ? 'Edit partner' : 'New partner' }}</h4>
        </div>
        <button class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Save partner</button>
    </div>

    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card"><div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#p-en" type="button">English</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#p-ar" type="button">العربية</button></li>
                </ul>
                <div class="tab-content pt-3">
                    @foreach (['en' => ['English', 'ltr'], 'ar' => ['العربية', 'rtl']] as $loc => $meta)
                        <div class="tab-pane fade {{ $loc === 'en' ? 'show active' : '' }}" id="p-{{ $loc }}">
                            <div class="row g-2 mb-3">
                                <div class="col-md-6"><label class="form-label">Name ({{ $meta[0] }}) @if($loc==='en')<span class="text-danger">*</span>@endif</label><input type="text" name="name[{{ $loc }}]" dir="{{ $meta[1] }}" class="form-control" value="{{ old('name.'.$loc, $partner->name[$loc] ?? '') }}"></div>
                                <div class="col-md-6"><label class="form-label">Tag ({{ $meta[0] }})</label><input type="text" name="tag[{{ $loc }}]" dir="{{ $meta[1] }}" class="form-control" value="{{ old('tag.'.$loc, $partner->tag[$loc] ?? '') }}"></div>
                            </div>
                            <div class="mb-3"><label class="form-label">Region ({{ $meta[0] }})</label><input type="text" name="region[{{ $loc }}]" dir="{{ $meta[1] }}" class="form-control" value="{{ old('region.'.$loc, $partner->region[$loc] ?? '') }}"></div>
                            <div class="mb-3"><label class="form-label">Description ({{ $meta[0] }})</label><textarea name="body[{{ $loc }}]" dir="{{ $meta[1] }}" rows="4" class="form-control">{{ old('body.'.$loc, $partner->body[$loc] ?? '') }}</textarea></div>
                            <div class="mb-1"><label class="form-label">Services ({{ $meta[0] }}) <span class="text-muted fs-12">— one per line</span></label><textarea name="services_{{ $loc }}" dir="{{ $meta[1] }}" rows="5" class="form-control font-monospace fs-13">{{ old('services_'.$loc, implode("\n", $partner->servicesFor($loc) ?? [])) }}</textarea></div>
                        </div>
                    @endforeach
                </div>
            </div></div>
        </div>
        <div class="col-lg-4">
            <div class="card"><div class="card-header"><h5 class="card-title mb-0">Logo & display</h5></div>
                <div class="card-body d-flex flex-column gap-3">
                    @if ($partner->exists && $partner->logoUrl())<img src="{{ $partner->logoUrl() }}" class="img-fluid rounded border p-2 mb-1" alt="">@endif
                    <div><label class="form-label">Logo / brand asset</label><input type="file" name="logo" accept="image/*" class="form-control"></div>
                    <div><label class="form-label">Website</label><input type="url" name="website" class="form-control" value="{{ old('website', $partner->website) }}" placeholder="https://"></div>
                    <div><label class="form-label">Order</label><input type="number" name="position" min="0" class="form-control" value="{{ old('position', $partner->position ?? 0) }}"></div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="p_pub" {{ old('is_published', $partner->is_published ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="p_pub">Published</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
