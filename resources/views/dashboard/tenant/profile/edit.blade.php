@extends('Layout.tenant_dashboard')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Edit Tenant Profile</h2>

    <div class="card p-4">
        <form action="{{ route('dashboard.tenant.profile.update', $tenant->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $tenant->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username', $tenant->username) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $tenant->email) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $tenant->phone) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Sex</label>
                    <select name="sex" class="form-select">
                        <option value="">Select</option>
                        <option value="Male" {{ old('sex', $tenant->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('sex', $tenant->sex) == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $tenant->date_of_birth) }}">
                </div>
            </div>

            <h5 class="fw-bold mt-4">Address</h5>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $tenant->address) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $tenant->city) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control" value="{{ old('state', $tenant->state) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="{{ old('country', $tenant->country) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Occupation</label>
                    <input type="text" name="occupation" class="form-control" value="{{ old('occupation', $tenant->occupation) }}">
                </div>
            </div>

            <h5 class="fw-bold mt-4">Identification</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">ID Type</label>
                    <input type="text" name="id_type" class="form-control" value="{{ old('id_type', $tenant->id_type) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">ID Number</label>
                    <input type="text" name="id_number" class="form-control" value="{{ old('id_number', $tenant->id_number) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Profile Photo</label>
                    <input type="file" name="image_path" class="form-control">
                    @if ($tenant->image_path)
                        <small class="text-muted">Current: {{ $tenant->image_path }}</small>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{route('dashboard.tenant.profile.index')}}" class="btn btn-outline-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-success">Update Profile</button>
            </div>
        </form>
    </div>
</div>
@endsection
<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
</div>
