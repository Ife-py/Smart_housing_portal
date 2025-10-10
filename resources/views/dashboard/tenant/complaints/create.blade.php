@extends('Layout.tenant_dashboard')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>New Complaint</h3>
        <a href="{{ route('dashboard.tenant.complaints.index') }}" class="btn btn-secondary">Back to list</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.tenant.complaints.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Property</label>
            <select name="property_id" class="form-select" required>
                <option value="">Choose property</option>
                @foreach($properties as $p)
                    <option value="{{ $p->id }}">{{ $p->title ?? 'Property #' . $p->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" required maxlength="191">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="6" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Attachments (optional)</label>
            <input type="file" name="attachments[]" class="form-control" multiple>
        </div>

        <button class="btn btn-primary">Submit Complaint</button>
    </form>
</div>
@endsection
