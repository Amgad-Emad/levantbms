@extends('dashboard.layout')

@section('title', 'Pages')

@section('content')

    <div class="my-3">
        <h4 class="fw-semibold mb-1">Page Content</h4>
        <p class="text-muted mb-0">Edit any text on the public website. Changes go live immediately — in English and Arabic.</p>
    </div>

    <div class="row">
        @foreach ($pages as $page)
            <div class="col-md-6 col-xl-4">
                <a href="{{ route('dashboard.content.edit', $page['slug']) }}" class="card card-hovered text-decoration-none">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="avatar-md flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle text-primary rounded fs-22">
                                <i class="ti {{ $page['icon'] }}"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0 text-body">{{ $page['page'] }}</h5>
                            <p class="text-muted fs-13 mb-0">{{ $page['fields'] }} editable {{ Str::plural('field', $page['fields']) }}</p>
                        </div>
                        <i class="ti ti-chevron-right fs-20 text-muted"></i>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endsection
