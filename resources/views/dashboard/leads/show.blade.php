@extends('dashboard.layout')

@section('title', 'Lead · '.$lead->name)

@section('content')

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <nav class="fs-13 text-muted mb-1"><a href="{{ route('dashboard.leads.index') }}" class="text-muted text-decoration-none">Leads</a> <i class="ti ti-chevron-right fs-12"></i> {{ $lead->name }}</nav>
            <h4 class="fw-semibold mb-0">{{ $lead->name }}</h4>
        </div>
        <div class="d-flex gap-2">
            <form action="{{ route('dashboard.leads.update', $lead) }}" method="POST" class="d-flex gap-2">
                @csrf @method('PUT')
                <select name="status" class="form-select form-select-sm" style="width:auto" onchange="this.form.submit()">
                    @foreach (['new' => 'New', 'read' => 'Read', 'archived' => 'Archived'] as $k => $v)
                        <option value="{{ $k }}" {{ $lead->status === $k ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Message</h5></div>
                <div class="card-body">
                    @if ($lead->message)
                        <p class="mb-0" style="white-space:pre-wrap">{{ $lead->message }}</p>
                    @else
                        <p class="text-muted mb-0">No message was included.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Details</h5></div>
                <div class="card-body">
                    <dl class="row mb-0 fs-14">
                        <dt class="col-4 text-muted">Email</dt><dd class="col-8"><a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a></dd>
                        <dt class="col-4 text-muted">Phone</dt><dd class="col-8">{{ $lead->phone ?: '—' }}</dd>
                        <dt class="col-4 text-muted">Company</dt><dd class="col-8">{{ $lead->company ?: '—' }}</dd>
                        <dt class="col-4 text-muted">Topic</dt><dd class="col-8">{{ $lead->topic ?: '—' }}</dd>
                        <dt class="col-4 text-muted">Language</dt><dd class="col-8 text-uppercase">{{ $lead->locale ?: '—' }}</dd>
                        <dt class="col-4 text-muted">Received</dt><dd class="col-8">{{ $lead->created_at->format('M j, Y · g:i a') }}</dd>
                    </dl>
                    <hr>
                    <a href="mailto:{{ $lead->email }}" class="btn btn-soft-primary w-100 mb-2"><i class="ti ti-mail me-1"></i> Reply by email</a>
                    @if ($lead->phone)
                        <a href="tel:{{ $lead->phone }}" class="btn btn-soft-secondary w-100"><i class="ti ti-phone me-1"></i> Call</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
