@extends('dashboard.layout')

@section('title', $pageName.' content')

@section('content')

    <form method="POST" action="{{ route('dashboard.content.update', $slug) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="d-flex align-items-center justify-content-between gap-2 py-3 mb-3 position-sticky border-bottom shadow-sm"
             style="top: var(--ins-topbar-height, 70px); z-index:10; background: var(--ins-secondary-bg, #f3f3f5); margin-inline:-12px; padding-inline:12px;">
            <div>
                <nav class="fs-13 text-muted mb-1">
                    <a href="{{ route('dashboard.content.index') }}" class="text-muted text-decoration-none">Pages</a>
                    <i class="ti ti-chevron-right fs-12"></i> {{ $pageName }}
                </nav>
                <h4 class="fw-semibold mb-0">{{ $pageName }} content</h4>
            </div>
            <div class="d-flex align-items-center gap-2">
                @if (Route::has($frontRoute))
                    <a href="{{ route($frontRoute) }}" target="_blank" class="btn btn-soft-secondary"><i class="ti ti-external-link me-1"></i> View page</a>
                @endif
                <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Save changes</button>
            </div>
        </div>

        {{-- Image slots --}}
        @if (!empty($slots))
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="ti ti-photo text-primary"></i>
                    <h5 class="card-title mb-0">Images</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        @foreach ($slots as $slot => $meta)
                            @php $current = $images->get($slot); @endphp
                            <div class="col-md-6">
                                <label class="form-label fw-medium mb-1">{{ $meta[0] }}</label>
                                <div class="d-flex gap-3 align-items-start">
                                    <div class="flex-shrink-0 rounded border bg-light d-flex align-items-center justify-content-center overflow-hidden" style="width:96px;height:120px">
                                        @if ($current && $current->imageUrl('thumb'))
                                            <img src="{{ $current->imageUrl('thumb') }}" style="width:100%;height:100%;object-fit:cover" alt="">
                                        @else
                                            <i class="ti ti-photo fs-28 text-muted"></i>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <input type="file" name="images[{{ $slot }}]" accept="image/*" class="form-control form-control-sm mb-1">
                                        @if ($current && $current->imageUrl('thumb'))
                                            <div class="form-check mb-1">
                                                <input type="checkbox" class="form-check-input" id="remove-img-{{ $slot }}" name="remove_images[{{ $slot }}]" value="1">
                                                <label class="form-check-label text-danger small" for="remove-img-{{ $slot }}">Remove current image</label>
                                            </div>
                                        @endif
                                        <small class="text-muted">{{ $meta[1] }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @foreach ($sections as $section => $rows)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-capitalize">{{ Str::headline($section) }}</h5>
                </div>
                <div class="card-body d-flex flex-column gap-3">
                    @foreach ($rows as $row)
                        @php
                            $hint = \App\Translation\ListContent::hint($row->key);
                            $textareaRows = $hint ? 8 : 2;
                        @endphp
                        <div class="row align-items-start">
                            <div class="col-lg-3">
                                <label class="form-label fw-medium mb-0">{{ Str::headline(Str::afterLast($row->key, '.')) }}</label>
                                <div class="fs-11 text-muted font-monospace">{{ $row->key }}</div>
                                @if ($hint)
                                    <div class="fs-11 text-info mt-1"><i class="ti ti-list-details me-1"></i>{{ $hint }}</div>
                                @endif
                            </div>
                            <div class="col-lg-9">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text fw-semibold">EN</span>
                                            @if ($row->type === 'textarea')
                                                <textarea name="values[{{ $row->id }}][en]" rows="{{ $textareaRows }}" class="form-control">{{ $row->values['en'] ?? '' }}</textarea>
                                            @else
                                                <input type="text" name="values[{{ $row->id }}][en]" value="{{ $row->values['en'] ?? '' }}" class="form-control" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text fw-semibold">AR</span>
                                            @if ($row->type === 'textarea')
                                                <textarea name="values[{{ $row->id }}][ar]" rows="{{ $textareaRows }}" dir="rtl" class="form-control">{{ $row->values['ar'] ?? '' }}</textarea>
                                            @else
                                                <input type="text" name="values[{{ $row->id }}][ar]" value="{{ $row->values['ar'] ?? '' }}" dir="rtl" class="form-control" />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-end mb-5">
            <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Save changes</button>
        </div>
    </form>

@endsection
