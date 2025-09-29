@extends('Layout.tenant_dashboard')

@section('content')
    <style>
        .tenant-welcome {
            background: linear-gradient(120deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #2c3e50;
            /* Dark slate text for contrast */
            border-radius: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 2.2rem 2rem 2rem 2rem;
            margin-bottom: 2.2rem;
            position: relative;
            overflow: hidden;
        }

        .tenant-welcome h2,
        .tenant-welcome .fs-5 {
            color: #2c3e50;
            /* Ensure headings and subtext are readable */
        }

        .tenant-welcome .profile-img {
            border: 3px solid #fff;
            box-shadow: 0 2px 8px rgba(37, 117, 252, 0.15);
        }


        .dashboard-card {
            border-radius: 1.2rem;
            background: #fff;
            box-shadow: 0 2px 16px 0 rgba(37, 117, 252, 0.07);
            transition: box-shadow 0.18s, transform 0.18s;
        }

        .dashboard-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 32px rgba(37, 117, 252, 0.13), 0 2px 8px rgba(0, 0, 0, 0.10);
        }

        .quick-action-btn {
            border-radius: 2rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            box-shadow: 0 1px 6px rgba(37, 117, 252, 0.07);
            transition: background 0.18s, color 0.18s, transform 0.18s;
        }

        .quick-action-btn:hover {
            transform: translateY(-2px) scale(1.03);
            background: #2575fc !important;
            color: #fff !important;
        }

        /* Fix recent properties container */
        .recent-properties .dashboard-card {
            padding: 2rem;
        }

        /* Ensure property cards look consistent */
        .property-card {
            border-radius: 1.2rem;
            overflow: hidden;
            /* keeps rounded corners */
            display: flex;
            flex-direction: column;
        }

        /* Property image */
        .property-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 1.2rem 1.2rem 0 0;
        }

        /* Property details */
        .property-card .card-body {
            padding: 1rem 1.2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Title & text spacing */
        .property-card .card-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.4rem;
        }

        /* Price highlight */
        .property-card .fw-semibold {
            font-size: 0.95rem;
        }

        /* Button cleanup */
        .property-card .btn {
            border-radius: 0.75rem;
            font-size: 0.875rem;
            padding: 0.4rem 0.75rem;
        }
    </style>

    <!-- Welcome Banner -->
    <div class="tenant-welcome mb-4">
        <div class="row align-items-center">
            <div class="col-md-8 d-flex align-items-center">
                {{-- Profile Image --}}
                <div class="me-4">
                    @if ($tenant->image_path)
                        <a href="{{ asset('storage/' . $tenant->image_path) }}" data-lightbox="tenant-{{ $tenant->id }}"
                            data-title="{{ $tenant->name }}">
                            <img src="{{ asset('storage/' . $tenant->image_path) }}" alt="{{ $tenant->name }}"
                                class="rounded-circle shadow profile-img-lg"
                                style="cursor: pointer; width: 100px; height: 100px; object-fit: cover;">
                        </a>
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($tenant->name) }}" alt="{{ $tenant->name }}"
                            class="rounded-circle shadow profile-img-lg"
                            style="width: 100px; height: 100px; object-fit: cover;">
                    @endif
                </div>

                {{-- Tenant Info --}}
                <div>
                    <h2 class="fw-bold mb-1">Welcome, {{ Auth::guard('tenant')->user()->name ?? 'Tenant' }}!</h2>
                    <div class="fs-5 text-muted">Your personalized tenant dashboard</div>
                </div>
            </div>

            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('dashboard.tenant.maintenance.index') }}" class="btn btn-light quick-action-btn me-2"><i
                        class="fa fa-building me-1"></i> My Properties</a>
                <a href="{{ route('dashboard.tenant.payments.index') }}" class="btn btn-outline-light quick-action-btn"><i
                        class="fa fa-money-bill-wave me-1"></i> Make Payment</a>
            </div>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="dashboard-card border-0 p-4 text-center">
                <div class="mb-2">
                    <i class="fa-solid fa-building fa-2x text-primary"></i>
                </div>
                <div class="fw-semibold text-secondary">My Properties</div>
                <div class="fs-3 fw-bold">2</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card border-0 p-4 text-center">
                <div class="mb-2">
                    <i class="fa-solid fa-money-bill-wave fa-2x text-success"></i>
                </div>
                <div class="fw-semibold text-secondary">Payments</div>
                <div class="fs-3 fw-bold">₦1.2M</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card border-0 p-4 text-center">
                <div class="mb-2">
                    <i class="fa-solid fa-wrench fa-2x text-warning"></i>
                </div>
                <div class="fw-semibold text-secondary">Maintenance</div>
                <div class="fs-3 fw-bold">1</div>
            </div>
        </div>
    </div>

    <!-- Recent Payments & Quick Actions -->
    <div class="row g-4">
        <div class="col-md-7">
            <div class="dashboard-card border-0 h-100 p-4">
                <div class="fw-bold mb-3 fs-5"><i class="fa fa-credit-card me-2 text-primary"></i>Recent Payments</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-transparent">
                        <strong>₦600,000</strong> - Rent for Modern 2 Bedroom Apartment
                        <span class="badge bg-success float-end">Paid</span>
                    </li>
                    <li class="list-group-item bg-transparent">
                        <strong>₦600,000</strong> - Rent for Cozy Studio Flat
                        <span class="badge bg-warning float-end">Pending</span>
                    </li>
                </ul>
                <a href="#" class="btn btn-link mt-2 p-0 text-primary">View all payments <i
                        class="fa fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-md-5">
            <div class="dashboard-card border-0 h-100 p-4">
                <div class="fw-bold mb-3 fs-5"><i class="fa fa-bolt me-2 text-warning"></i>Quick Actions</div>
                <a href="{{ route('dashboard.tenant.properties.index') }}"
                    class="btn btn-primary mb-2 w-100 quick-action-btn"><i class="fa fa-building me-1"></i> View My
                    Properties</a>
                <a href="{{ route('dashboard.tenant.payments.index') }}"
                    class="btn btn-outline-success mb-2 w-100 quick-action-btn"><i class="fa fa-money-bill-wave me-1"></i>
                    Make Payment</a>
                <a href="{{ route('dashboard.tenant.maintenance.index') }}"
                    class="btn btn-outline-warning w-100 quick-action-btn"><i class="fa fa-wrench me-1"></i> Request
                    Maintenance</a>
            </div>
        </div>
    </div>

    <!-- Recently Listed Properties -->
    <div class="row mt-5 recent-properties">
        <div class="col-12">
            <div class="dashboard-card border-0">
                <div class="fw-bold mb-3 fs-5 d-flex justify-content-between align-items-center">
                    <span><i class="fa-solid fa-building me-2 text-primary"></i>Recently Listed Properties</span>
                    <a href="{{ route('home.properties') }}"
                        class="btn btn-outline-primary btn-sm quick-action-btn">
                        Browse All
                    </a>
                </div>

                <div class="row g-4">
                    @forelse ($properties as $property)
                        <div class="col-md-6 col-lg-3">
                            <div class="property-card border-0 h-100">
                                {{-- Property Image --}}
                                @if (!empty($property->cover_image))
                                    <img src="{{ asset('storage/' . $property->cover_image) }}"
                                        alt="{{ $property->title }}">
                                @else
                                    <img src="{{ asset('no-image.jpg') }}" alt="No Image">
                                @endif

                                {{-- Property Details --}}
                                <div class="card-body">
                                    <div>
                                        <h5 class="card-title">{{ $property->title }}</h5>
                                        <div class="text-muted small mb-2">
                                            <i class="fa fa-map-marker-alt me-1"></i>
                                            {{ $property->address }}, {{ $property->city }}, {{ $property->state }}
                                        </div>
                                        <div class="fw-semibold text-primary mb-2">
                                            ₦{{ number_format($property->price, 2) }}
                                        </div>
                                    </div>
                                    <a href="{{ route('home.property.show', $property->id) }}"
                                        class="btn btn-outline-primary btn-sm w-100 quick-action-btn mt-2">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted">
                            <p>No properties listed yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
