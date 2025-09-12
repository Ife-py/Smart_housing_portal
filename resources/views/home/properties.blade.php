@extends('Layout.home')

@section('content')
<style>
    .property-card {
        border-radius: 1.2rem;
        background: #fff;
        box-shadow: 0 2px 16px 0 rgba(37,117,252,0.07);
        transition: box-shadow 0.18s, transform 0.18s;
        overflow: hidden;
    }
    .property-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 8px 32px rgba(37,117,252,0.13), 0 2px 8px rgba(0,0,0,0.10);
    }
    .property-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 1.2rem 1.2rem 0 0;
    }
</style>

<div class="container py-4">
    <h2 class="fw-bold mb-4 text-info"><i class="fa fa-building me-2"></i>Available Properties</h2>
    <div class="row g-4">
        @forelse ($properties as $property)
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="property-card h-100 border-0">
                <a href="{{ route('home.property.show', $property) }}">
                    <img src="{{ $property->cover_image ? asset('storage/' . $property->cover_image) : (is_array($property->images) && count($property->images) > 0 ? asset('storage/' . $property->images[0]) : 'https://via.placeholder.com/400x180.png?text=No+Image') }}" class="property-img" alt="{{ $property->title }}">
                </a>
                <div class="p-3">
                    <h5 class="fw-bold mb-1"><a href="{{ route('home.property.show', $property) }}" class="text-decoration-none text-dark">{{ $property->title }}</a></h5>
                    <div class="text-muted small mb-2"><i class="fa fa-map-marker-alt me-1"></i>{{ $property->city }}, {{ $property->state }}</div>
                    <div class="fw-semibold text-primary mb-2">₦{{ number_format($property->price) }}/year</div>
                    <a href="{{ route('home.property.show', $property) }}" class="btn btn-outline-info btn-sm w-100">View Details</a>
                </div>
            </div>
        </div>
        @empty
            <div class="col">
                <p class="text-center text-muted">No properties found.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $properties->links() }}
    </div>
</div>
@endsection
