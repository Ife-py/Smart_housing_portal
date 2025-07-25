@extends('Layout.admin')
@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Welcome Back, Admin 👋</h2>

    <!-- Dashboard Cards -->
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    {{-- <p class="card-text fs-4 fw-semibold">{{ $usersCount ?? '1,234' }}</p> --}}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Landlords</h5>
                    {{-- <p class="card-text fs-4 fw-semibold">{{ $landlordsCount ?? '312' }}</p> --}}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Tenants</h5>
                    {{-- <p class="card-text fs-4 fw-semibold">{{ $tenantsCount ?? '780' }}</p> --}}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Properties Listed</h5>
                    {{-- <p class="card-text fs-4 fw-semibold">{{ $propertiesCount ?? '98' }}</p> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Complaints and Announcements -->
    <div class="row mt-5 g-4">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">
                    Recent Complaints
                </div>
                <div class="card-body">
                    {{-- @if(isset($complaints) && count($complaints) > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($complaints as $complaint)
                                <li class="list-group-item">
                                    <strong>{{ $complaint->tenant_name }}</strong>: {{ Str::limit($complaint->message, 80) }}
                                    <span class="text-muted float-end">{{ $complaint->created_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No recent complaints.</p>
                    @endif --}}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">
                    Admin Announcements
                </div>
                <div class="card-body">
                    <p class="text-muted">📅 Monthly report is due on the 28th.</p>
                    <p class="text-muted">🚀 New complaint analytics dashboard launching soon.</p>
                    <p class="text-muted">🔐 Security patch scheduled for this weekend.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Placeholder -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">
                    System Overview (Coming Soon)
                </div>
                <div class="card-body">
                    <p class="text-muted">Interactive charts for complaints, listings, and user activity will appear here.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
