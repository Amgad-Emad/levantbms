@extends('dashboard.layout')

@section('title', 'Settings')

@section('content')

<form method="POST" action="{{ route('dashboard.settings.update') }}">
    @csrf @method('PUT')

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <h4 class="fw-semibold mb-1">Site Settings</h4>
            <p class="text-muted mb-0">Contact details and social links used across the website.</p>
        </div>
        <button class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Save settings</button>
    </div>

    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <div class="row">
        @foreach ($groups as $group => $fields)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0">{{ $group }}</h5></div>
                    <div class="card-body d-flex flex-column gap-3">
                        @foreach ($fields as $field)
                            <div>
                                <label class="form-label">{{ $field['label'] }}</label>
                                @if ($field['type'] === 'textarea')
                                    <textarea name="settings[{{ $field['key'] }}]" rows="2" class="form-control">{{ $field['value'] }}</textarea>
                                @else
                                    <input type="{{ $field['type'] }}" name="settings[{{ $field['key'] }}]" class="form-control" value="{{ $field['value'] }}">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</form>

@endsection
