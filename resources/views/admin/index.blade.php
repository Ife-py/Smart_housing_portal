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
                    <p class="card-text fs-4 fw-semibold">1,234</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Landlords</h5>
                    <p class="card-text fs-4 fw-semibold">312</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Tenants</h5>
                    <p class="card-text fs-4 fw-semibold">780</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Properties Listed</h5>
                    <p class="card-text fs-4 fw-semibold">98</p>
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
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Jane Doe</strong>: Water leakage in apartment 4B.
                            <span class="text-muted float-end">2 hours ago</span>
                        </li>
                        <li class="list-group-item">
                            <strong>John Smith</strong>: Broken window in Block C.
                            <span class="text-muted float-end">5 hours ago</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Mary Johnson</strong>: No electricity in room 12.
                            <span class="text-muted float-end">1 day ago</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Ahmed Musa</strong>: Internet connectivity issues.
                            <span class="text-muted float-end">2 days ago</span>
                        </li>
                    </ul>
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
