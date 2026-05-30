@extends('dashboard.layout')

@section('title', 'Media Library')

@section('content')

    <div class="my-3">
        <h4 class="fw-semibold mb-1">Media Library</h4>
        <p class="text-muted mb-0">Every photo and document uploaded across the site. Upload new files below.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('dashboard.media.store') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-wrap align-items-end gap-2">
                @csrf
                <div class="flex-grow-1">
                    <label class="form-label">Upload files</label>
                    <input type="file" name="files[]" multiple class="form-control" required>
                    <small class="text-muted">Images, PDF, Word, Excel — up to 10 MB each.</small>
                </div>
                <button class="btn btn-primary"><i class="ti ti-upload me-1"></i> Upload</button>
            </form>
        </div>
    </div>

    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <div class="row">
        @forelse ($media as $m)
            @php $isImage = str_starts_with($m->mime_type, 'image/'); @endphp
            <div class="col-6 col-md-4 col-xl-3">
                <div class="card">
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height:150px;overflow:hidden">
                        @if ($isImage)<img src="{{ $m->getUrl() }}" style="width:100%;height:100%;object-fit:cover" alt="">
                        @else<i class="ti ti-file-text fs-40 text-muted"></i>@endif
                    </div>
                    <div class="card-body py-2">
                        <div class="fs-13 text-truncate fw-medium" title="{{ $m->file_name }}">{{ $m->file_name }}</div>
                        <div class="fs-11 text-muted mb-2">{{ $m->human_readable_size }} · {{ class_basename($m->model_type) }}</div>
                        <div class="d-flex gap-1">
                            <input type="text" class="form-control form-control-sm fs-11" value="{{ $m->getUrl() }}" readonly onclick="this.select()">
                            <form action="{{ route('dashboard.media.destroy', $m) }}" method="POST" onsubmit="return confirm('Delete this file?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-icon btn-soft-danger"><i class="ti ti-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><div class="card"><div class="card-body text-center text-muted py-5"><i class="ti ti-folder-open fs-32 d-block mb-2 opacity-50"></i> No files yet. Upload your first above.</div></div></div>
        @endforelse
    </div>

    <div class="mt-2">{{ $media->links() }}</div>

@endsection
