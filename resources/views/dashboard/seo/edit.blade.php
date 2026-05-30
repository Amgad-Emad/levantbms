@extends('dashboard.layout')

@section('title', $label.' SEO')

@section('content')

<form method="POST" action="{{ route('dashboard.seo.update', $page) }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <nav class="fs-13 text-muted mb-1"><a href="{{ route('dashboard.seo.index') }}" class="text-muted text-decoration-none">SEO</a> <i class="ti ti-chevron-right fs-12"></i> {{ $label }}</nav>
            <h4 class="fw-semibold mb-0">{{ $label }} — SEO</h4>
        </div>
        <button class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Save SEO</button>
    </div>

    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card"><div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#seo-en" type="button">English</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#seo-ar" type="button">العربية</button></li>
                </ul>
                <div class="tab-content pt-3">
                    @foreach (['en' => ['English', 'ltr'], 'ar' => ['العربية', 'rtl']] as $loc => $meta)
                        <div class="tab-pane fade {{ $loc === 'en' ? 'show active' : '' }}" id="seo-{{ $loc }}">
                            <div class="mb-3">
                                <label class="form-label d-flex justify-content-between">Meta title ({{ $meta[0] }}) <span class="text-muted fs-12" data-count-for="title-{{ $loc }}"></span></label>
                                <input type="text" name="title[{{ $loc }}]" dir="{{ $meta[1] }}" class="form-control" maxlength="70" data-count="title-{{ $loc }}" value="{{ old('title.'.$loc, $seo->title[$loc] ?? '') }}">
                                <small class="text-muted">Aim for ≤ 60 characters. Lead with the credential, e.g. “MOIC Professional Body”.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-flex justify-content-between">Meta description ({{ $meta[0] }}) <span class="text-muted fs-12" data-count-for="desc-{{ $loc }}"></span></label>
                                <textarea name="description[{{ $loc }}]" dir="{{ $meta[1] }}" rows="3" class="form-control" maxlength="320" data-count="desc-{{ $loc }}">{{ old('description.'.$loc, $seo->description[$loc] ?? '') }}</textarea>
                                <small class="text-muted">Aim for ≤ 155 characters. Include location + a trust signal.</small>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Keywords ({{ $meta[0] }})</label>
                                <textarea name="keywords[{{ $loc }}]" dir="{{ $meta[1] }}" rows="2" class="form-control">{{ old('keywords.'.$loc, $seo->keywords[$loc] ?? '') }}</textarea>
                                <small class="text-muted">Comma-separated. Used for internal reference + AEO context.</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div></div>

            {{-- Live Google-style preview --}}
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Search preview</h5></div>
                <div class="card-body">
                    <div class="border rounded p-3" style="max-width:600px">
                        <div class="text-muted fs-12">levantbms.com{{ $page === 'home' ? '' : '/'.$page }}</div>
                        <div style="color:#1a0dab;font-size:18px;line-height:1.3" data-preview="title">{{ $seo->title->get('en') ?: 'LevantBMS — Licensed Business Setup in Bahrain' }}</div>
                        <div class="text-muted fs-13" data-preview="desc">{{ $seo->description->get('en') ?: 'Add a meta description to control how this page appears in search results.' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card"><div class="card-header"><h5 class="card-title mb-0">Indexing</h5></div>
                <div class="card-body d-flex flex-column gap-3">
                    <div>
                        <label class="form-label">Robots</label>
                        <select name="robots" class="form-select">
                            @foreach (['index, follow' => 'Index & follow (default)', 'noindex, follow' => 'No-index, follow', 'noindex, nofollow' => 'No-index, no-follow'] as $val => $txt)
                                <option value="{{ $val }}" {{ old('robots', $seo->robots) === $val ? 'selected' : '' }}>{{ $txt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Canonical URL <span class="text-muted fs-12">(optional)</span></label>
                        <input type="url" name="canonical" class="form-control" value="{{ old('canonical', $seo->canonical) }}" placeholder="https://levantbms.com/...">
                    </div>
                </div>
            </div>

            <div class="card"><div class="card-header"><h5 class="card-title mb-0">Social share image</h5></div>
                <div class="card-body">
                    @if ($seo->ogImageUrl())<img src="{{ $seo->ogImageUrl() }}" class="img-fluid rounded mb-2" alt="OG image">@endif
                    <input type="file" name="og_image" accept="image/*" class="form-control">
                    <small class="text-muted">Recommended 1200×630px. Show the MOIC badge, “20+ Years”, and the BFH address.</small>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    function bind(name, prev) {
        document.querySelectorAll('[data-count="' + name + '"]').forEach(function (el) {
            var label = document.querySelector('[data-count-for="' + name + '"]');
            var preview = prev ? document.querySelector('[data-preview="' + prev + '"]') : null;
            var upd = function () {
                if (label) label.textContent = el.value.length + ' chars';
                if (preview && el.value) preview.textContent = el.value;
            };
            el.addEventListener('input', upd); upd();
        });
    }
    bind('title-en', 'title'); bind('title-ar', null);
    bind('desc-en', 'desc'); bind('desc-ar', null);
</script>
@endpush
