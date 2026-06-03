@extends('dashboard.layout')

@section('title', $post->exists ? 'Edit post' : 'New post')

@push('styles')
<link href="{{ asset('dashboard/assets/plugins/quill/quill.snow.css') }}" rel="stylesheet" />
<style>.ql-editor{min-height:240px}.ql-editor[dir=rtl]{text-align:right}</style>
@endpush

@section('content')

<form method="POST" action="{{ $post->exists ? route('dashboard.posts.update', $post) : route('dashboard.posts.store') }}" enctype="multipart/form-data">
    @csrf
    @if ($post->exists) @method('PUT') @endif

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <nav class="fs-13 text-muted mb-1"><a href="{{ route('dashboard.posts.index') }}" class="text-muted text-decoration-none">Blog</a> <i class="ti ti-chevron-right fs-12"></i> {{ $post->exists ? 'Edit' : 'New' }}</nav>
            <h4 class="fw-semibold mb-0">{{ $post->exists ? 'Edit post' : 'New post' }}</h4>
        </div>
        <button class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Save post</button>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="row">
        {{-- Main column --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-en" type="button">English</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-ar" type="button">العربية</button></li>
                    </ul>
                    <div class="tab-content pt-3">
                        @foreach (['en' => ['English', 'ltr'], 'ar' => ['العربية', 'rtl']] as $loc => $meta)
                            <div class="tab-pane fade {{ $loc === 'en' ? 'show active' : '' }}" id="tab-{{ $loc }}">
                                <div class="mb-3">
                                    <label class="form-label">Title ({{ $meta[0] }}) @if($loc==='en')<span class="text-danger">*</span>@endif</label>
                                    <input type="text" name="title[{{ $loc }}]" dir="{{ $meta[1] }}" class="form-control"
                                           value="{{ old('title.'.$loc, $post->title[$loc] ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Excerpt ({{ $meta[0] }})</label>
                                    <textarea name="excerpt[{{ $loc }}]" dir="{{ $meta[1] }}" rows="2" class="form-control">{{ old('excerpt.'.$loc, $post->excerpt[$loc] ?? '') }}</textarea>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Body ({{ $meta[0] }})</label>
                                    <div class="quill-editor" data-locale="{{ $loc }}" data-dir="{{ $meta[1] }}"></div>
                                    <input type="hidden" name="body[{{ $loc }}]" id="body-{{ $loc }}" value="{{ old('body.'.$loc, $post->body[$loc] ?? '') }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Publish</h5></div>
                <div class="card-body d-flex flex-column gap-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">Published (visible on site)</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Featured (top of blog)</label>
                    </div>
                    <div>
                        <label class="form-label">Publish date</label>
                        <input type="datetime-local" name="published_at" class="form-control"
                               value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}">
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Organize</h5></div>
                <div class="card-body d-flex flex-column gap-3">
                    <div>
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select" data-choices>
                            <option value="">— none —</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category', $post->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Read time (minutes)</label>
                        <input type="number" name="read_minutes" min="1" max="120" class="form-control" value="{{ old('read_minutes', $post->read_minutes ?? 5) }}">
                    </div>
                    <div>
                        <label class="form-label">Slug <span class="text-muted fs-12">(auto if blank)</span></label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $post->slug) }}" placeholder="my-post-url">
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">SEO <span class="text-muted fs-12 fw-normal">(optional — defaults to title/excerpt)</span></h5></div>
                <div class="card-body d-flex flex-column gap-2">
                    <div><label class="form-label fs-13">Meta title (EN)</label><input type="text" name="meta_title[en]" maxlength="70" class="form-control form-control-sm" value="{{ old('meta_title.en', $post->meta_title['en'] ?? '') }}"></div>
                    <div><label class="form-label fs-13">Meta title (AR)</label><input type="text" name="meta_title[ar]" dir="rtl" maxlength="70" class="form-control form-control-sm" value="{{ old('meta_title.ar', $post->meta_title['ar'] ?? '') }}"></div>
                    <div><label class="form-label fs-13">Meta description (EN)</label><textarea name="meta_description[en]" rows="2" maxlength="320" class="form-control form-control-sm">{{ old('meta_description.en', $post->meta_description['en'] ?? '') }}</textarea></div>
                    <div><label class="form-label fs-13">Meta description (AR)</label><textarea name="meta_description[ar]" dir="rtl" rows="2" maxlength="320" class="form-control form-control-sm">{{ old('meta_description.ar', $post->meta_description['ar'] ?? '') }}</textarea></div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Cover image</h5></div>
                <div class="card-body">
                    @if ($post->exists && $post->coverUrl())
                        <img src="{{ $post->coverUrl() }}" class="img-fluid rounded mb-2" alt="cover">
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" id="remove_cover" name="remove_cover" value="1">
                            <label class="form-check-label text-danger small" for="remove_cover">Remove current cover</label>
                        </div>
                    @endif
                    <input type="file" name="cover" accept="image/*" class="form-control">
                    <small class="text-muted">JPG/PNG/WebP, up to 5 MB.</small>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script src="{{ asset('dashboard/assets/plugins/quill/quill.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/choices/choices.min.js') }}"></script>
<script>
    document.querySelectorAll('[data-choices]').forEach(function (el) {
        if (window.Choices) new Choices(el, { searchEnabled: false, itemSelectText: '' });
    });

    var editors = {};
    document.querySelectorAll('.quill-editor').forEach(function (el) {
        var loc = el.dataset.locale;
        var hidden = document.getElementById('body-' + loc);
        var q = new Quill(el, {
            theme: 'snow',
            modules: { toolbar: [
                [{ header: [2, 3, false] }], ['bold', 'italic', 'underline', 'link'],
                [{ list: 'ordered' }, { list: 'bullet' }], ['blockquote'], ['clean'],
            ] },
        });
        if (el.dataset.dir === 'rtl') q.root.setAttribute('dir', 'rtl');
        if (hidden.value) q.clipboard.dangerouslyPasteHTML(hidden.value);
        editors[loc] = { quill: q, hidden: hidden };
    });

    document.querySelector('form').addEventListener('submit', function () {
        Object.values(editors).forEach(function (e) {
            var html = e.quill.root.innerHTML;
            e.hidden.value = (e.quill.getText().trim() === '') ? '' : html;
        });
    });
</script>
@endpush
