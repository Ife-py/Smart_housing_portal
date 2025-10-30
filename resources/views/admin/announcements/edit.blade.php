@extends('Layout.admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary mb-0">
                    <i class="bi bi-pencil-square me-2"></i> Edit Announcement
                </h2>
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>
            </div>

            <!-- Edit Form Card -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Announcement Title</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                value="{{ old('title', $announcement->title) }}" 
                                class="form-control form-control-lg rounded-3 shadow-sm" 
                                placeholder="Edit announcement title" 
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label fw-semibold">Announcement Content</label>
                            <textarea 
                                name="content" 
                                id="content" 
                                rows="6" 
                                class="form-control rounded-3 shadow-sm" 
                                placeholder="Update the announcement details..." 
                                required>{{ old('content', $announcement->content) }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-outline-secondary btn-lg px-4">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-success btn-lg px-4 shadow-sm">
                                <i class="bi bi-check-circle me-2"></i> Update Announcement
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="text-center text-muted mt-4 small">
                <i class="bi bi-info-circle"></i> Changes made here will be visible immediately to all users.
            </div>
        </div>
    </div>
</div>
@endsection
