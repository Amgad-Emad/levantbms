@extends('dashboard.layout')

@section('title', 'SEO')

@section('content')

    <div class="my-3">
        <h4 class="fw-semibold mb-1">SEO & Metadata</h4>
        <p class="text-muted mb-0">Per-page titles, descriptions, keywords and social cards. Defaults are tuned for ranking in Bahrain business-setup search.</p>
    </div>

    <div class="row">
        @foreach ($pages as $item)
            <div class="col-md-6 col-xl-4">
                <a href="{{ route('dashboard.seo.edit', $item['page']) }}" class="card card-hovered text-decoration-none">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-primary-subtle text-primary rounded fs-18"><i class="ti {{ $item['icon'] }}"></i></span>
                            </span>
                            <h5 class="mb-0 text-body">{{ $item['label'] }}</h5>
                            @if (optional($item['seo'])->title && $item['seo']->title->get('en'))
                                <span class="badge badge-soft-success ms-auto">Set</span>
                            @else
                                <span class="badge badge-soft-warning ms-auto">Default</span>
                            @endif
                        </div>
                        <div class="fs-13 text-primary text-truncate">{{ optional(optional($item['seo'])->title)->get('en') ?: '— inherits site default —' }}</div>
                        <div class="fs-12 text-muted" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">{{ optional(optional($item['seo'])->description)->get('en') }}</div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endsection
