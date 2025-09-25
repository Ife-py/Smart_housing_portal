@extends('Layout.home')

@section('title', $property->title)

@section('content')
    <div class="container py-5">
        {{-- Flash Messages for application status --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i>{{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <!-- Property Title and Price -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="fw-bold mb-0">{{ $property->title }}</h1>
                    <span class="badge bg-primary fs-4">₦{{ number_format($property->price) }}/year</span>
                </div>

                <!-- Location -->
                <div class="text-muted mb-4 fs-5">
                    <i class="bi bi-geo-alt-fill me-1"></i>
                    {{ $property->address }}, {{ $property->city }}, {{ $property->state }}
                </div>

                <!-- Image Carousel -->
                @if ($property->images && count($property->images) > 0)
                    <div id="propertyCarousel" class="carousel slide shadow rounded mb-4" data-bs-ride="carousel">
                        <div class="carousel-inner rounded">
                            @foreach ($property->images as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image) }}" class="d-block w-100"
                                        alt="Property Image {{ $key + 1 }}" style="height: 450px; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>
                        @if (count($property->images) > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                @elseif($property->cover_image)
                    <img src="{{ asset('storage/' . $property->cover_image) }}" class="img-fluid rounded shadow mb-4"
                        alt="Cover Image" style="width: 100%; height: 450px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/800x450.png?text=No+Image+Available"
                        class="img-fluid rounded shadow mb-4" alt="No Image">
                @endif

                <!-- Description -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">Description</h4>
                        <p class="text-secondary" style="white-space: pre-wrap;">{{ $property->description }}</p>
                    </div>
                </div>

                <!-- Features -->
                @if ($property->features)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Features</h4>
                            <div class="row">
                                @foreach (explode(',', $property->features) as $feature)
                                    <div class="col-md-6">
                                        <p><i class="bi bi-check-circle-fill text-success me-2"></i>{{ trim($feature) }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Sidebar with Landlord Info -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-light">
                        <h4 class="fw-bold mb-0">Landlord Information</h4>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ $property->landlord->profile_photo ? asset('storage/' . $property->landlord->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($property->landlord->name) . '&background=random' }}"
                            class="rounded-circle mb-3" width="100" height="100" alt="Landlord">
                        <h5 class="card-title">{{ $property->landlord->name }}</h5>
                        <p class="card-text text-muted">Member since {{ $property->landlord->created_at->format('M Y') }}
                        </p>
                        <a href="mailto:{{ $property->landlord->email }}" class="btn btn-primary w-100 mb-2"><i
                                class="bi bi-envelope-fill me-2"></i> Email Landlord</a>
                        <a href="tel:{{ $property->landlord->phone }}" class="btn btn-outline-secondary w-100"><i
                                class="bi bi-telephone-fill me-2"></i> Call Landlord</a>

                        @auth('tenant')
                            @if ($hasApplied)
                                <button type="button" class="btn btn-secondary w-100 fw-bold" disabled>
                                    <i class="bi bi-check-all me-2"></i> Application Sent
                                </button>
                            @else
                                <form action="{{ route('property.apply', $property->id) }}" method="POST">
                                    @csrf
                                    <!-- optional message -->
                                    <div class="mb-2">
                                        <textarea name="message" class="form-control" rows="3"
                                            placeholder="Optional message to landlord (e.g. move-in date, brief intro)"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-success w-100 fw-bold">
                                        <i class="bi bi-check2-circle me-2"></i> Apply Now
                                    </button>
                                </form>
                            @endif
                        @else
                            <!-- Not a tenant (guest or other guard) -->
                            <a href="{{ route('auth.login', ['redirect' => url()->current()]) }}"
                                class="btn btn-success w-100 fw-bold">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Login to Apply
                            </a>
                            <small class="d-block text-muted mt-2">You must be logged in as a tenant to apply.</small>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @endsection
