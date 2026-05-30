@extends('dashboard.layout')

@section('title', 'My Profile')

@section('content')

    <div class="my-3">
        <h4 class="fw-semibold mb-1">My Profile</h4>
        <p class="text-muted mb-0">Manage your account details and password.</p>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">Profile updated.</div>
    @endif
    @if (session('status') === 'password-updated')
        <div class="alert alert-success">Password updated.</div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Account information</h5></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" class="d-flex flex-column gap-3">
                        @csrf @method('PATCH')
                        <div>
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="form-label">Role</label>
                            <input type="text" class="form-control text-capitalize" value="{{ $user->role }}" disabled>
                        </div>
                        <div><button class="btn btn-primary">Save</button></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Change password</h5></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}" class="d-flex flex-column gap-3">
                        @csrf @method('PUT')
                        <div>
                            <label class="form-label">Current password</label>
                            <input type="password" name="current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
                            @error('current_password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="form-label">New password</label>
                            <input type="password" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                            @error('password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="form-label">Confirm new password</label>
                            <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                        </div>
                        <div><button class="btn btn-primary">Update password</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
