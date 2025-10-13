@extends('Layout.landlord_dashboard')
@section('content')
    <style>
        .dashboard-card {
            transition: transform 0.18s cubic-bezier(.4, 2, .6, 1), box-shadow 0.18s cubic-bezier(.4, 2, .6, 1);
            border-radius: 1.2rem;
        }

        .dashboard-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 6px 24px rgba(25, 135, 84, 0.13), 0 1px 4px rgba(0, 0, 0, 0.08);
        }
    </style>

    <div class="card mb-4 shadow-sm border-0 bg-success bg-opacity-10">
        <div class="card-body d-flex align-items-center">
            @php
                // Determine profile photo URL: support storage path, absolute URL, or fallback to ui-avatars
                $profile = Auth::user()->profile_photo ?? null;
                if ($profile) {
                    // If stored with storage path (starts with 'storage' or 'uploads' or contains 'storage'), use asset
                    if (Str::startsWith($profile, ['http://', 'https://'])) {
                        $photoUrl = $profile;
                    } elseif (Str::startsWith($profile, ['storage/', 'uploads/', '/storage/'])) {
                        $photoUrl = asset($profile);
                    } else {
                        // Try storage helper for files stored via Storage::put('public/...') which are symlinked to storage
                        $photoUrl = asset('storage/' . ltrim($profile, '/'));
                    }
                } else {
                    $photoUrl = 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Landlord');
                }
            @endphp

            <img src="{{ $photoUrl }}" alt="Profile" class="rounded-circle me-3"
                style="width: 56px; height: 56px; object-fit: cover; border: 2px solid #198754;">
            <div>
                <h4 class="fw-bold mb-1 text-success">Welcome back, {{ Auth::user()->name ?? 'Landlord' }}!</h4>
                <div class="text-muted">Here's a quick overview of your properties and activities.</div>
            </div>
        </div>

    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card dashboard-card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                        <i class="fa-solid fa-building fa-2x text-success"></i>
                    </div>
                    <div>
                        <div class="fw-semibold text-muted">My Properties</div>
                        <div class="fs-4 fw-bold">{{ $property->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dashboard-card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                        <i class="fa-solid fa-users fa-2x text-info"></i>
                    </div>
                    <div>
                        <div class="fw-semibold text-muted">Tenants</div>
                        <div class="fs-4 fw-bold">{{ $tenantCount ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dashboard-card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                        <i class="fa-solid fa-triangle-exclamation fa-2x text-warning"></i>
                    </div>
                    <div>
                        <div class="fw-semibold text-muted">Complaints</div>
                        <div class="fs-4 fw-bold">{{ $complaintsCount ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dashboard-card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                        <i class="fa-solid fa-money-bill-wave fa-2x text-primary"></i>
                    </div>
                    <div>
                        <div class="fw-semibold text-muted">Payments</div>
                        <div class="fs-4 fw-bold">₦3.2M</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row g-4">
        <div class="col-md-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white fw-bold">
                    Recent Complaints
                </div>
                <div class="card-body">
                    @if(isset($recentComplaints) && $recentComplaints->isNotEmpty())
                        <ul class="list-group list-group-flush">
                            @foreach($recentComplaints as $c)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ optional($c->tenant)->name ?? 'Tenant' }}</strong>: {{ Str::limit($c->subject ?? $c->description, 80) }}
                                        <div class="small text-muted">{{ optional($c->property)->title ?? '' }} • {{ $c->created_at->diffForHumans() }}</div>
                                    </div>
                                    <span class="badge bg-{{ strtolower($c->status) === 'resolved' ? 'success' : 'danger' }}">{{ ucfirst($c->status) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No recent complaints.</p>
                    @endif
                    <a href="{{ route('dashboard.landlord.complaints.index') }}" class="btn btn-link mt-2 p-0">View all complaints <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white fw-bold">
                    Quick Actions
                </div>
                <div class="card-body">
                    <a href="{{ route('dashboard.landlord.properties.create') }}" class="btn btn-success mb-2 w-100"><i
                            class="fa fa-plus me-1"></i> Add New Property</a>
                    <a href="{{ route('dashboard.landlord.tenants.index') }}" class="btn btn-outline-info mb-2 w-100"><i
                            class="fa fa-users me-1"></i> View Tenants</a>
                    <a href="{{ route('dashboard.landlord.complaints.index') }}" class="btn btn-outline-warning w-100"><i
                            class="fa fa-triangle-exclamation me-1"></i> View Complaints</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Placeholder -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">
                    Property & Tenant Overview (Coming Soon)
                </div>
                <div class="card-body">
                    <p class="text-muted">Interactive charts for property occupancy, payments, and tenant activity will
                        appear here.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
