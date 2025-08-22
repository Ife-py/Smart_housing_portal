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
        @foreach ([
            [
                'title' => 'Modern 2 Bedroom Apartment',
                'location' => 'Lekki, Lagos',
                'price' => '₦4,500,000/year',
                'img' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'title' => 'Cozy Studio Flat',
                'location' => 'Ikeja, Lagos',
                'price' => '₦2,800,000/year',
                'img' => 'https://images.unsplash.com/photo-1507089947368-19c1da9775ae?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'title' => 'Luxury Duplex',
                'location' => 'Abuja, FCT',
                'price' => '₦12,000,000/year',
                'img' => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'title' => 'Family Bungalow',
                'location' => 'Port Harcourt, Rivers',
                'price' => '₦6,500,000/year',
                'img' => 'https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'title' => 'Penthouse Suite',
                'location' => 'Victoria Island, Lagos',
                'price' => '₦18,000,000/year',
                'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'title' => 'Urban Loft',
                'location' => 'Yaba, Lagos',
                'price' => '₦3,200,000/year',
                'img' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'title' => 'Classic Mansion',
                'location' => 'GRA, Enugu',
                'price' => '₦9,500,000/year',
                'img' => 'https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'title' => 'Waterfront Villa',
                'location' => 'Banana Island, Lagos',
                'price' => '₦25,000,000/year',
                'img' => 'https://images.unsplash.com/photo-1460474647541-4edd0cd0c746?auto=format&fit=crop&w=400&q=80',
            ],
        ] as $property)
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="property-card h-100 border-0">
                <img src="{{ $property['img'] }}" class="property-img" alt="{{ $property['title'] }}">
                <div class="p-3">
                    <h5 class="fw-bold mb-1">{{ $property['title'] }}</h5>
                    <div class="text-muted small mb-2"><i class="fa fa-map-marker-alt me-1"></i>{{ $property['location'] }}</div>
                    <div class="fw-semibold text-primary mb-2">{{ $property['price'] }}</div>
                    <a href="#" class="btn btn-outline-info btn-sm w-100">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
<div>
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
</div>
