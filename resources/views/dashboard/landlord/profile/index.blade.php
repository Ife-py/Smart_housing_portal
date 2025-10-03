@extends('Layout.landlord_dashboard')

@section('content')
<div class="container py-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Profile Header -->
    <div class="d-flex align-items-center mb-4">
        <div class="me-4">
            @if ($landlord->profile_photo)
                <a href="{{ asset('storage/' . $landlord->profile_photo) }}" 
                   data-lightbox="landlord-{{ $landlord->id }}" 
                   data-title="{{ $landlord->name }}">
                    <img src="{{ asset('storage/' . $landlord->profile_photo) }}" 
                         alt="{{ $landlord->name }}" 
                         class="rounded-circle" 
                         style="cursor:pointer; width:100px; height:100px; object-fit:cover;">
                </a>
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($landlord->name) }}" 
                     alt="{{ $landlord->name }}" 
                     class="rounded-circle"
                     style="width:100px; height:100px; object-fit:cover;">
            @endif
        </div>
        <div>
            <h2 class="fw-bold mb-1">{{ $landlord->name }}</h2>
            <p class="mb-0 text-muted">Landlord Profile</p>
        </div>
    </div>

    <!-- Profile Details -->
    <div class="card dashboard-card p-4">
        <h4 class="fw-bold mb-3">Personal Information</h4>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" value="{{ $landlord->name }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" value="{{ $landlord->username }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ $landlord->email }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" value="{{ $landlord->phone ?? 'Not Provided' }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Sex</label>
                <input type="text" class="form-control" value="{{ $landlord->sex ?? 'Not Provided' }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Date of Birth</label>
                <input type="text" class="form-control" value="{{ $landlord->date_of_birth ?? 'Not Provided' }}" readonly>
            </div>
        </div>

        <h4 class="fw-bold mt-4 mb-3">Address Information</h4>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" value="{{ $landlord->address ?? 'Not Provided' }}" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">City</label>
                <input type="text" class="form-control" value="{{ $landlord->city ?? 'Not Provided' }}" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">State</label>
                <input type="text" class="form-control" value="{{ $landlord->state ?? 'Not Provided' }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Country</label>
                <input type="text" class="form-control" value="{{ $landlord->country ?? 'Not Provided' }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Preferred Contact Method</label>
                <input type="text" class="form-control" value="{{ $landlord->contact_method ?? 'Not Provided' }}" readonly>
            </div>
        </div>

        <h4 class="fw-bold mt-4 mb-3">Professional Information</h4>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Company</label>
                <input type="text" class="form-control" value="{{ $landlord->company ?? 'Not Provided' }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Occupation</label>
                <input type="text" class="form-control" value="{{ $landlord->occupation ?? 'Not Provided' }}" readonly>
            </div>
        </div>

        <h4 class="fw-bold mt-4 mb-3">Identification</h4>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">ID Type</label>
                <input type="text" class="form-control" value="{{ $landlord->id_type ?? 'Not Provided' }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">ID Number</label>
                <input type="text" class="form-control" value="{{ $landlord->id_number ?? 'Not Provided' }}" readonly>
            </div>
        </div>

        <h4 class="fw-bold mt-4 mb-3">Other Information</h4>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Total Properties Managed</label>
                {{-- <input type="text" class="form-control" value="{{ $landlord->properties_count ?? 0 }}" readonly> --}}
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('dashboard.landlord.profile.edit'), $landlord->id }}" class="btn btn-primary me-2">
                <i class="fa fa-edit me-1"></i> Edit Profile
            </a>
            <a href="" class="btn btn-outline-secondary">
                <i class="fa fa-lock me-1"></i> Change Password
            </a>
        </div>
    </div>
</div>
@endsection
