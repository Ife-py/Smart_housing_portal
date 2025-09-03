@extends('Layout.landlord_dashboard')

@section('title', $property->title . ' | Property Details')

@section('content')
<div class="container my-5">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('dashboard.landlord.properties.index') }}" class="btn btn-outline-warning btn-lg shadow-sm">
            <i class="bi bi-arrow-left-circle me-2"></i> Back to Properties
        </a>
    </div>
    {{-- Property Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <h2 class="fw-bold">{{ $property->title }}</h2>
        <span class="badge bg-success fs-5 px-3 py-2 mt-2 mt-md-0">
            ₦{{ number_format($property->price, 2) }}
        </span>
    </div>

    {{-- Cover Image --}}
    @if($property->cover_image)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $property->cover_image) }}" 
                 class="img-fluid rounded shadow w-100" 
                 style="max-height: 400px; object-fit: cover;" 
                 alt="Cover Image">
        </div>
    @endif

    {{-- Image Carousel --}}
    <div id="propertyCarousel" class="carousel slide shadow rounded mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            @if (!empty($property->images))
                @foreach ($property->images as $key => $image)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $image) }}" 
                             class="d-block w-100 rounded" 
                             style="max-height: 450px; object-fit: cover;"
                             alt="Property Image">
                    </div>
                @endforeach
            @else
                <div class="carousel-item active">
                    <img src="{{ asset('no-image.jpg') }}" 
                         class="d-block w-100 rounded" 
                         style="max-height: 450px; object-fit: cover;"
                         alt="No image available">
                </div>
            @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    {{-- Property Info --}}
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">Property Details</h5>

            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item">
                    <strong>Address:</strong> {{ $property->address }}, {{ $property->city }}, {{ $property->state }}
                </li>
                <li class="list-group-item">
                    <strong>Type:</strong> {{ $property->type }} 
                    @if($property->type === 'Other' && $property->custom_type)
                        ({{ $property->custom_type }})
                    @endif
                </li>
                <li class="list-group-item">
                    <strong>Status:</strong> 
                    @if($property->status === 'active')
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </li>
            </ul>

            {{-- Features --}}
            @if($property->features)
                <h5 class="fw-bold mb-2">Features</h5>
                <p class="text-muted">{{ $property->features }}</p>
            @endif

            {{-- Description --}}
            <h5 class="fw-bold mb-2">Description</h5>
            <p class="text-secondary">{{ $property->description }}</p>
        </div>
    </div>

    {{-- Landlord Info --}}
    <div class="card border-0 shadow-sm p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
            <div class="mb-3 mb-md-0">
                <h6 class="text-muted mb-1">Listed by</h6>
                <h5 class="fw-bold mb-0">{{ $property->landlord->name }}</h5>
                <small class="text-muted">{{ $property->landlord->email }}</small>
            </div>
            <a href="mailto:{{ $property->landlord->email }}" class="btn btn-primary btn-lg">
                <i class="bi bi-envelope-fill me-2"></i> Contact Landlord
            </a>
        </div>
    </div>

</div>
@endsection
