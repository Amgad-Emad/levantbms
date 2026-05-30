@extends('dashboard.layout')

@section('title', $user->exists ? 'Edit user' : 'New user')

@section('content')

<form method="POST" action="{{ $user->exists ? route('dashboard.users.update', $user) : route('dashboard.users.store') }}">
    @csrf
    @if ($user->exists) @method('PUT') @endif

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <nav class="fs-13 text-muted mb-1"><a href="{{ route('dashboard.users.index') }}" class="text-muted text-decoration-none">Users</a> <i class="ti ti-chevron-right fs-12"></i> {{ $user->exists ? 'Edit' : 'New' }}</nav>
            <h4 class="fw-semibold mb-0">{{ $user->exists ? 'Edit user' : 'New user' }}</h4>
        </div>
        <button class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Save user</button>
    </div>

    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card"><div class="card-body d-flex flex-column gap-3">
                <div><label class="form-label">Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}"></div>
                <div><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"></div>
                <div><label class="form-label">Role</label>
                    <select name="role" class="form-select">
                        <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>Editor — manage content</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin — full access incl. users</option>
                    </select>
                </div>
                <hr class="my-1">
                <div class="row g-2">
                    <div class="col-md-6"><label class="form-label">Password {{ $user->exists ? '(leave blank to keep)' : '' }}</label><input type="password" name="password" class="form-control" autocomplete="new-password"></div>
                    <div class="col-md-6"><label class="form-label">Confirm password</label><input type="password" name="password_confirmation" class="form-control" autocomplete="new-password"></div>
                </div>
            </div></div>
        </div>
    </div>
</form>

@endsection
