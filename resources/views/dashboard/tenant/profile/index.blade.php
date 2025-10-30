@extends('Layout.tenant_dashboard')

@section('content')
    <div class="container py-4">
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

        <!-- Profile Header -->
        <div class="tenant-welcome d-flex align-items-center mb-4">
            <div class="me-4">
                @if ($tenant->image_path)
                    <a href="{{ asset('storage/' . $tenant->image_path) }}" data-lightbox="tenant-{{ $tenant->id }}"
                        data-title="{{ $tenant->name }}">
                        <img src="{{ asset('storage/' . $tenant->image_path) }}" alt="{{ $tenant->name }}"
                            class="rounded-circle profile-img-lg"
                            style="cursor: pointer; width: 100px; height: 100px; object-fit: cover;">
                    </a>
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($tenant->name) }}" alt="{{ $tenant->name }}"
                        class="rounded-circle profile-img-lg" style="width: 100px; height: 100px; object-fit: cover;">
                @endif
            </div>
            <div>
                <h2 class="fw-bold mb-1">{{ $tenant->name }}</h2>
                <p class="mb-0 text-muted">Tenant Profile Details</p>
            </div>
        </div>

        <!-- Profile Details Form -->
        <div class="card dashboard-card p-4">
            <h4 class="fw-bold mb-3">Personal Information</h4>
            <form>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" value="{{ $tenant->name }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $tenant->email }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" value="{{ $tenant->phone ?? 'Not Provided' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <input type="text" class="form-control" value="{{ $tenant->sex ?? 'Not Provided' }}" readonly>
                    </div>
                </div>

                <h4 class="fw-bold mt-4 mb-3">Address Information</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" value="{{ $tenant->address ?? 'Not Provided' }}"
                            readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" value="{{ $tenant->city ?? 'Not Provided' }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">State</label>
                        <input type="text" class="form-control" value="{{ $tenant->state ?? 'Not Provided' }}" readonly>
                    </div>
                </div>

                <h4 class="fw-bold mt-4 mb-3">Identification</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">ID Type</label>
                        <input type="text" class="form-control" value="{{ $tenant->id_type ?? 'Not Provided' }}"
                            readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">ID Number</label>
                        <input type="text" class="form-control" value="{{ $tenant->id_number ?? 'Not Provided' }}"
                            readonly>
                    </div>
                </div>

                <h4 class="fw-bold mt-4 mb-3">Other Information</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input type="text" class="form-control" value="{{ $tenant->dob ?? 'Not Provided' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Occupation</label>
                        <input type="text" class="form-control" value="{{ $tenant->occupation ?? 'Not Provided' }}"
                            readonly>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('dashboard.tenant.profile.edit') }}" class="btn btn-primary me-2">
                        <i class="fa fa-edit me-1"></i> Edit Profile
                    </a>
                    <a href="" class="btn btn-outline-secondary">
                        <i class="fa fa-lock me-1"></i> Change Password
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
