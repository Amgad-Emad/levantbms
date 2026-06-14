@extends('dashboard.layout')

@section('title', $subService->exists ? 'Edit sub-service' : 'New sub-service')

@section('content')

<form method="POST" action="{{ $subService->exists ? route('dashboard.sub-services.update', $subService) : route('dashboard.sub-services.store') }}">
    @csrf
    @if ($subService->exists) @method('PUT') @endif

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <nav class="fs-13 text-muted mb-1"><a href="{{ route('dashboard.sub-services.index') }}" class="text-muted text-decoration-none">Sub-services</a> <i class="ti ti-chevron-right fs-12"></i> {{ $subService->exists ? 'Edit' : 'New' }}</nav>
            <h4 class="fw-semibold mb-0">{{ $subService->exists ? 'Edit sub-service' : 'New sub-service' }}</h4>
        </div>
        <button class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Save sub-service</button>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#s-en" type="button">English</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#s-ar" type="button">العربية</button></li>
                    </ul>
                    <div class="tab-content pt-3">
                        @foreach (['en' => ['English', 'ltr'], 'ar' => ['العربية', 'rtl']] as $loc => $meta)
                            <div class="tab-pane fade {{ $loc === 'en' ? 'show active' : '' }}" id="s-{{ $loc }}">
                                <div class="mb-3">
                                    <label class="form-label">Tag ({{ $meta[0] }})</label>
                                    <input type="text" name="tag[{{ $loc }}]" dir="{{ $meta[1] }}" class="form-control" value="{{ old('tag.'.$loc, $subService->tag[$loc] ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Title ({{ $meta[0] }}) @if($loc==='en')<span class="text-danger">*</span>@endif</label>
                                    <input type="text" name="title[{{ $loc }}]" dir="{{ $meta[1] }}" class="form-control" value="{{ old('title.'.$loc, $subService->title[$loc] ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description ({{ $meta[0] }})</label>
                                    <textarea name="description[{{ $loc }}]" dir="{{ $meta[1] }}" rows="3" class="form-control">{{ old('description.'.$loc, $subService->description[$loc] ?? '') }}</textarea>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">Scope of work ({{ $meta[0] }}) <span class="text-muted fs-12">— one item per line</span></label>
                                    <textarea name="scope_{{ $loc }}" dir="{{ $meta[1] }}" rows="9" class="form-control font-monospace fs-13">{{ old('scope_'.$loc, implode("\n", $subService->scopeLinesFor($loc) ?? [])) }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Parent, pricing & display</h5></div>
                <div class="card-body d-flex flex-column gap-3">
                    <div>
                        <label class="form-label">Parent service <span class="text-danger">*</span></label>
                        <select name="service_id" class="form-select" required>
                            <option value="">— Select a service —</option>
                            @foreach ($services as $id => $title)
                                <option value="{{ $id }}" {{ (string) old('service_id', $subService->service_id) === (string) $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-2">
                        <div class="col-6"><label class="form-label">Timeline (EN)</label><input type="text" name="timeline[en]" class="form-control" value="{{ old('timeline.en', $subService->timeline['en'] ?? '') }}" placeholder="2–6 weeks"></div>
                        <div class="col-6"><label class="form-label">Timeline (AR)</label><input type="text" name="timeline[ar]" dir="rtl" class="form-control" value="{{ old('timeline.ar', $subService->timeline['ar'] ?? '') }}"></div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6"><label class="form-label">Fee from (EN)</label><input type="text" name="fee_from[en]" class="form-control" value="{{ old('fee_from.en', $subService->fee_from['en'] ?? '') }}" placeholder="BD 750"></div>
                        <div class="col-6"><label class="form-label">Fee from (AR)</label><input type="text" name="fee_from[ar]" dir="rtl" class="form-control" value="{{ old('fee_from.ar', $subService->fee_from['ar'] ?? '') }}"></div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6"><label class="form-label">Code</label><input type="text" name="code" class="form-control" value="{{ old('code', $subService->code) }}" placeholder="01"></div>
                        <div class="col-6"><label class="form-label">Order</label><input type="number" name="position" min="0" class="form-control" value="{{ old('position', $subService->position ?? 0) }}"></div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="subsvc_pub" {{ old('is_published', $subService->is_published ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="subsvc_pub">Published (visible on site)</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
