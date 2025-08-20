@extends('Layout.admin')

@section('content')
<style>
    .landlord-card {
        background: linear-gradient(135deg, #e0f7fa 60%, #b2ebf2 100%);
        border-radius: 2.5rem;
        box-shadow: 0 8px 32px 0 rgba(0, 150, 136, 0.13);
        border: 1px solid #b2ebf2;
        padding: 2.5rem 2rem 2rem 2rem;
        margin-bottom: 2.2rem;
        position: relative;
        overflow: hidden;
        transition: box-shadow 0.2s;
    }
    .landlord-card:hover {
        box-shadow: 0 16px 48px 0 rgba(0, 150, 136, 0.18);
    }
    .profile-img-lg {
        border: 5px solid #b2ebf2;
        box-shadow: 0 4px 24px rgba(0,150,136,0.13);
        width: 130px;
        height: 130px;
        object-fit: cover;
        margin-bottom: 1.2rem;
        background: #e0f7fa;
    }
    .landlord-title {
        font-size: 2.1rem;
        font-weight: 700;
        color: #00796b;
        margin-bottom: 0.2rem;
    }
    .landlord-username {
        color: #0097a7;
        font-size: 1.1rem;
        margin-bottom: 0.7rem;
    }
    .badge-status {
        font-size: 1rem;
        padding: 0.5em 1.2em;
        border-radius: 2rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        background: linear-gradient(90deg, #4dd0e1 0%, #009688 100%);
        color: #fff;
        box-shadow: 0 2px 8px rgba(0,150,136,0.10);
    }
    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .info-list li {
        display: flex;
        align-items: center;
        padding: 0.7rem 0;
        border-bottom: 1px solid #b2ebf2;
    }
    .info-list li:last-child {
        border-bottom: none;
    }
    .info-label {
        min-width: 170px;
        color: #0097a7;
        font-weight: 600;
        margin-right: 1.2rem;
    }
    .info-value {
        color: #00796b;
        font-weight: 500;
        word-break: break-all;
    }
</style>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Landlord Details</h2>
        <div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary me-2">Back to Users</a>
        </div>
    </div>
    <div class="landlord-card mb-4 d-flex flex-column flex-md-row align-items-center align-items-md-start">
        <div class="text-center me-md-5 mb-4 mb-md-0">
            <img src="{{ $landlord->profile_photo ?? 'https://ui-avatars.com/api/?name='.urlencode($landlord->name) }}" alt="Profile Photo" class="rounded-circle profile-img-lg">
            <div class="landlord-title mt-2">{{ $landlord->name }}</div>
            <div class="landlord-username">{{ $landlord->username }}</div>
            <span class="badge badge-status mt-2">{{ $landlord->isActive() ? 'Active' : 'Inactive' }}</span>
        </div>
        <div class="flex-grow-1">
            <ul class="info-list">
                <li><span class="info-label">Email:</span><span class="info-value">{{ $landlord->email }}</span></li>
                <li><span class="info-label">Phone:</span><span class="info-value">{{ $landlord->phone }}</span></li>
                <li><span class="info-label">Address:</span><span class="info-value">{{ $landlord->address }}</span></li>
                <li><span class="info-label">City:</span><span class="info-value">{{ $landlord->city }}</span></li>
                <li><span class="info-label">State:</span><span class="info-value">{{ $landlord->state }}</span></li>
                <li><span class="info-label">Country:</span><span class="info-value">{{ $landlord->country }}</span></li>
                <li><span class="info-label">Company:</span><span class="info-value">{{ $landlord->company }}</span></li>
                <li><span class="info-label">Occupation:</span><span class="info-value">{{ $landlord->occupation }}</span></li>
                <li><span class="info-label">ID Number:</span><span class="info-value">{{ $landlord->id_number }}</span></li>
                <li><span class="info-label">ID Type:</span><span class="info-value">{{ $landlord->id_type }}</span></li>
                <li><span class="info-label">Properties Managed:</span><span class="info-value">{{ $landlord->properties_count }}</span></li>
                <li><span class="info-label">Preferred Contact:</span><span class="info-value">{{ $landlord->contact_method }}</span></li>
                <li><span class="info-label">Date of Birth:</span><span class="info-value">{{ $landlord->date_of_birth }}</span></li>
                <li><span class="info-label">Created At:</span><span class="info-value">{{ $landlord->created_at }}</span></li>
                <li><span class="info-label">Updated At:</span><span class="info-value">{{ $landlord->updated_at }}</span></li>
            </ul>
        </div>
    </div>
</div>
@endsection
<div>
    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
</div>
