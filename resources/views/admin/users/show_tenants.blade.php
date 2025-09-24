<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
</div>

@extends('Layout.admin')

@section('content')
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 2rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 2.5rem 2rem 2rem 2rem;
            margin-bottom: 2.2rem;
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.2s;
        }

        .glass-card:hover {
            box-shadow: 0 16px 48px 0 rgba(31, 38, 135, 0.22);
        }

        .profile-img-lg {
            border: 5px solid #e3e6f0;
            box-shadow: 0 4px 24px rgba(37, 117, 252, 0.13);
            width: 130px;
            height: 130px;
            object-fit: cover;
            margin-bottom: 1.2rem;
            background: #f8f9fa;
        }

        .tenant-title {
            font-size: 2.1rem;
            font-weight: 700;
            color: #2d3a4a;
            margin-bottom: 0.2rem;
        }

        .tenant-username {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 0.7rem;
        }

        .badge-status {
            font-size: 1rem;
            padding: 0.5em 1.2em;
            border-radius: 2rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
            color: #fff;
            box-shadow: 0 2px 8px rgba(37, 117, 252, 0.10);
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
            border-bottom: 1px solid #f1f1f1;
        }

        .info-list li:last-child {
            border-bottom: none;
        }

        .info-label {
            min-width: 170px;
            color: #2575fc;
            font-weight: 600;
            margin-right: 1.2rem;
        }

        .info-value {
            color: #2d3a4a;
            font-weight: 500;
            word-break: break-all;
        }
    </style>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Tenant Details</h2>
            <div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary me-2">Back to Users</a>
            </div>
        </div>
        <div class="glass-card mb-4 d-flex flex-column flex-md-row align-items-center align-items-md-start">
            <div class="text-center me-md-5 mb-4 mb-md-0">
                @if ($tenant->image_path)
                    <a href="{{ asset('storage/' . $tenant->image_path) }}" data-lightbox="tenant-{{ $tenant->id }}"
                        data-title="{{ $tenant->name }}">
                        <img src="{{ asset('storage/' . $tenant->image_path) }}" alt="{{ $tenant->name }}"
                            class="rounded-circle profile-img-lg" style="cursor: pointer;">
                    </a>
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($tenant->name) }}" alt="{{ $tenant->name }}"
                        class="rounded-circle profile-img-lg">
                @endif
                <div class="tenant-title mt-2">{{ $tenant->name }}</div>
                <div class="tenant-username">{{ $tenant->username }}</div>
                <span class="badge badge-status mt-2">{{ $tenant->isActive() ? 'Active' : 'Inactive' }}</span>
            </div>
            <div class="flex-grow-1">
                <ul class="info-list">
                    <li><span class="info-label">Email:</span><span class="info-value">{{ $tenant->email }}</span></li>
                    <li><span class="info-label">Phone:</span><span class="info-value">{{ $tenant->phone }}</span></li>
                    <li><span class="info-label">Address:</span><span class="info-value">{{ $tenant->address }}</span></li>
                    <li><span class="info-label">City:</span><span class="info-value">{{ $tenant->city }}</span></li>
                    <li><span class="info-label">State:</span><span class="info-value">{{ $tenant->state }}</span></li>
                    <li><span class="info-label">Country:</span><span class="info-value">{{ $tenant->country }}</span></li>
                    <li><span class="info-label">Occupation:</span><span
                            class="info-value">{{ $tenant->occupation }}</span></li>
                    <li><span class="info-label">ID Number:</span><span class="info-value">{{ $tenant->id_number }}</span>
                    </li>
                    <li><span class="info-label">ID Type:</span><span class="info-value">{{ $tenant->id_type }}</span></li>
                    <li><span class="info-label">Date of Birth:</span><span
                            class="info-value">{{ $tenant->date_of_birth }}</span></li>
                    <li><span class="info-label">Created At:</span><span
                            class="info-value">{{ $tenant->created_at }}</span></li>
                    <li><span class="info-label">Updated At:</span><span
                            class="info-value">{{ $tenant->updated_at }}</span></li>
                </ul>
            </div>
        </div>
        <!-- Lightbox2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

    </div>
@endsection
