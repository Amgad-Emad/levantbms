@extends('dashboard.layout')

@section('title', $faq->exists ? 'Edit FAQ' : 'New FAQ')

@section('content')

<form method="POST" action="{{ $faq->exists ? route('dashboard.faqs.update', $faq) : route('dashboard.faqs.store') }}">
    @csrf
    @if ($faq->exists) @method('PUT') @endif

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <nav class="fs-13 text-muted mb-1"><a href="{{ route('dashboard.faqs.index') }}" class="text-muted text-decoration-none">FAQs</a> <i class="ti ti-chevron-right fs-12"></i> {{ $faq->exists ? 'Edit' : 'New' }}</nav>
            <h4 class="fw-semibold mb-0">{{ $faq->exists ? 'Edit FAQ' : 'New FAQ' }}</h4>
        </div>
        <button class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Save FAQ</button>
    </div>

    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card"><div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#f-en" type="button">English</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#f-ar" type="button">العربية</button></li>
                </ul>
                <div class="tab-content pt-3">
                    @foreach (['en' => ['English', 'ltr'], 'ar' => ['العربية', 'rtl']] as $loc => $meta)
                        <div class="tab-pane fade {{ $loc === 'en' ? 'show active' : '' }}" id="f-{{ $loc }}">
                            <div class="mb-3"><label class="form-label">Question ({{ $meta[0] }}) @if($loc==='en')<span class="text-danger">*</span>@endif</label><input type="text" name="question[{{ $loc }}]" dir="{{ $meta[1] }}" class="form-control" value="{{ old('question.'.$loc, $faq->question[$loc] ?? '') }}"></div>
                            <div class="mb-1"><label class="form-label">Answer ({{ $meta[0] }}) @if($loc==='en')<span class="text-danger">*</span>@endif</label><textarea name="answer[{{ $loc }}]" dir="{{ $meta[1] }}" rows="5" class="form-control">{{ old('answer.'.$loc, $faq->answer[$loc] ?? '') }}</textarea></div>
                        </div>
                    @endforeach
                </div>
            </div></div>
        </div>
        <div class="col-lg-4">
            <div class="card"><div class="card-header"><h5 class="card-title mb-0">Settings</h5></div>
                <div class="card-body d-flex flex-column gap-3">
                    <div><label class="form-label">Topic</label>
                        <select name="category" class="form-select">
                            @foreach ($categories as $cat)<option value="{{ $cat }}" {{ old('category', $faq->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>@endforeach
                        </select>
                    </div>
                    <div><label class="form-label">Order</label><input type="number" name="position" min="0" class="form-control" value="{{ old('position', $faq->position ?? 0) }}"></div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="f_pub" {{ old('is_published', $faq->is_published ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="f_pub">Published</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
