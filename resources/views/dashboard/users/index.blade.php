@extends('dashboard.layout')

@section('title', 'Users')

@section('content')

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <h4 class="fw-semibold mb-1">Team & Users</h4>
            <p class="text-muted mb-0">People who can sign in and manage the website.</p>
        </div>
        <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"><i class="ti ti-user-plus me-1"></i> New User</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light bg-opacity-50"><tr><th>Name</th><th>Email</th><th>Role</th><th class="text-end">Actions</th></tr></thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="fw-medium d-flex align-items-center gap-2">
                                    <span class="avatar avatar-sm rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center fw-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    {{ $user->name }}
                                    @if ($user->id === auth()->id())<span class="badge badge-soft-info">You</span>@endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge badge-soft-{{ $user->isAdmin() ? 'primary' : 'secondary' }} text-capitalize">{{ $user->role }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-sm btn-icon btn-soft-primary"><i class="ti ti-edit"></i></a>
                                    @unless ($user->id === auth()->id())
                                        <form action="{{ route('dashboard.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-icon btn-soft-danger"><i class="ti ti-trash"></i></button>
                                        </form>
                                    @endunless
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
