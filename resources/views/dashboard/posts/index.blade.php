@extends('dashboard.layout')

@section('title', 'Blog')

@section('content')

    <div class="d-flex align-items-center justify-content-between gap-2 my-3">
        <div>
            <h4 class="fw-semibold mb-1">Blog Posts</h4>
            <p class="text-muted mb-0">Write and publish articles. Changes appear on the website immediately.</p>
        </div>
        <a href="{{ route('dashboard.posts.create') }}" class="btn btn-primary"><i class="ti ti-pencil-plus me-1"></i> New Post</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th style="width:64px">Cover</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Published</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>
                                    @if ($post->coverUrl('thumb'))
                                        <img src="{{ $post->coverUrl('thumb') }}" class="rounded" width="48" height="36" style="object-fit:cover" alt="">
                                    @else
                                        <span class="avatar-sm rounded bg-light d-inline-flex align-items-center justify-content-center text-muted"><i class="ti ti-photo"></i></span>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-medium d-flex align-items-center gap-2">
                                        {{ $post->title->get('en') ?: $post->slug }}
                                        @if ($post->is_featured)<span class="badge badge-soft-warning"><i class="ti ti-star-filled fs-10"></i> Featured</span>@endif
                                    </div>
                                    <div class="fs-12 text-muted font-monospace">/{{ $post->slug }}</div>
                                </td>
                                <td>{{ $post->category ?: '—' }}</td>
                                <td>{{ optional($post->published_at)->format('M j, Y') ?: '—' }}</td>
                                <td>
                                    <span class="badge badge-soft-{{ $post->is_published ? 'success' : 'secondary' }}">
                                        {{ $post->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('dashboard.posts.edit', $post) }}" class="btn btn-sm btn-icon btn-soft-primary"><i class="ti ti-edit"></i></a>
                                    <form action="{{ route('dashboard.posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-icon btn-soft-danger"><i class="ti ti-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-5">No posts yet. <a href="{{ route('dashboard.posts.create') }}">Write your first one</a>.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
