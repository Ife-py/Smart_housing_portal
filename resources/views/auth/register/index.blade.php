@extends('Layout.home')

@section('content')
<div class="min-vh-100 bg-light d-flex flex-column">
    <style>
        .hover-shadow {
            transition: box-shadow 0.25s cubic-bezier(.4,2,.6,1), transform 0.25s cubic-bezier(.4,2,.6,1);
        }
        .hover-shadow:hover {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18) !important;
            transform: translateY(-6px) scale(1.03);
            z-index: 2;
        }
    </style>
    <main class="flex-fill container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-gradient mb-3" style="background: linear-gradient(to right, #0d6efd, #198754); -webkit-background-clip: text; color: transparent;">
                Choose Your Portal
            </h2>
            <p class="text-muted fs-5">Select your role to access the appropriate dashboard and features tailored to your needs.</p>
        </div>

        <div class="row justify-content-center g-4">
            {{-- Tenant Card --}}
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0 hover-shadow">
                    <div class="card-body text-center">
                        <div class="mb-4 position-relative" style="height: 100px;">
                            <div class="position-absolute top-0 start-50 translate-middle-x" style="z-index:2;">
                                <i class="bi bi-stars text-warning" style="font-size: 2rem;"></i>
                            </div>
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center mx-auto mt-3" style="width: 80px; height: 80px;">
                                <i class="bi bi-people-fill fs-3"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold">Tenant Portal</h4>
                        <p class="text-muted">Find your perfect home and manage your tenancy with ease.</p>
                        <ul class="list-unstyled text-muted mb-4">
                            <li><i class="bi bi-dot text-primary"></i> Property Search & Browse</li>
                            <li><i class="bi bi-dot text-primary"></i> Lease Management</li>
                            <li><i class="bi bi-dot text-primary"></i> Maintenance Requests</li>
                            <li><i class="bi bi-dot text-primary"></i> Payment Processing</li>
                            <a href="" class="btn btn-primary w-100 py-2">Enter Tenant Portal</a>
                    </div>
                </div>
            </div>

            {{-- Landlord Card --}}
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0 hover-shadow">
                    <div class="card-body text-center">
                        <div class="mb-4 position-relative" style="height: 100px;">
                            <div class="position-absolute top-0 start-50 translate-middle-x" style="z-index:2;">
                                <i class="bi bi-gem text-success" style="font-size: 2rem;"></i>
                            </div>
                            <div class="bg-success text-white rounded-circle d-flex justify-content-center align-items-center mx-auto mt-3" style="width: 80px; height: 80px;">
                                <i class="bi bi-person-check-fill fs-3"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold">Landlord Portal</h4>
                        <p class="text-muted">Manage properties and maximize your investment returns.</p>
                        <ul class="list-unstyled text-muted mb-4">
                            <li><i class="bi bi-dot text-success"></i> Property Listings</li>
                            <li><i class="bi bi-dot text-success"></i> Tenant Management</li>
                            <li><i class="bi bi-dot text-success"></i> Financial Tracking</li>
                            <li><i class="bi bi-dot text-success"></i> Maintenance Oversight</li>
                      <a href="" class="btn btn-success w-100 py-2">Enter Landlord Portal</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <p class="text-muted">Secure • Reliable • Intelligent Property Management</p>
        </div>
    </main>
</div>
@endsection
