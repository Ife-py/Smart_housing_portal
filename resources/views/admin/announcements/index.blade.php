@extends('Layout.admin')

@section('content')
    <div class="container-fluid py-4">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary mb-0">
                <i class="bi bi-megaphone-fill me-2"></i> Announcements
            </h2>
            <a href="{{ route('admin.announcements.create') }}" class="btn btn-success shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Create Announcement
            </a>
        </div>

        <!-- Announcements Table -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                @if ($announcements->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-bell-slash text-muted" style="font-size: 3rem;"></i>
                        <h5 class="mt-3 text-muted">No announcements available</h5>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($announcements as $announcement)
                                    <tr>
                                        <td class="fw-semibold">{{ $announcement->id }}</td>
                                        <td>{{ Str::limit($announcement->title, 40) }}</td>
                                        <td>{{ Str::limit($announcement->content, 60) }}</td>
                                        <td>{{ $announcement->created_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('admin.announcements.edit', $announcement->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.announcements.destroy', $announcement->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this announcement?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
