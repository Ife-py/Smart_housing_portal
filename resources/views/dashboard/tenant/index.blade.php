@extends('Layout.tenant_dashboard')

@section('content')
<style>
	.tenant-welcome {
		background: linear-gradient(120deg, #6a11cb 0%, #2575fc 100%);
		color: #fff;
		border-radius: 1.5rem;
		box-shadow: 0 2px 16px 0 rgba(37,117,252,0.10);
		padding: 2.2rem 2rem 2rem 2rem;
		margin-bottom: 2.2rem;
		position: relative;
		overflow: hidden;
	}
	.tenant-welcome .profile-img {
		border: 3px solid #fff;
		box-shadow: 0 2px 8px rgba(37,117,252,0.10);
	}
	.dashboard-card {
		border-radius: 1.2rem;
		background: #fff;
		box-shadow: 0 2px 16px 0 rgba(37,117,252,0.07);
		transition: box-shadow 0.18s, transform 0.18s;
	}
	.dashboard-card:hover {
		transform: translateY(-6px) scale(1.03);
		box-shadow: 0 8px 32px rgba(37,117,252,0.13), 0 2px 8px rgba(0,0,0,0.10);
	}
	.quick-action-btn {
		border-radius: 2rem;
		font-weight: 500;
		letter-spacing: 0.5px;
		box-shadow: 0 1px 6px rgba(37,117,252,0.07);
		transition: background 0.18s, color 0.18s, transform 0.18s;
	}
	.quick-action-btn:hover {
		transform: translateY(-2px) scale(1.03);
		background: #2575fc !important;
		color: #fff !important;
	}
	.property-card {
		border-radius: 1.2rem;
		transition: box-shadow 0.18s, transform 0.18s;
		box-shadow: 0 2px 12px 0 rgba(37,117,252,0.07);
		background: #fff;
	}
	.property-card:hover {
		box-shadow: 0 8px 32px rgba(37,117,252,0.13), 0 2px 8px rgba(0,0,0,0.10);
		transform: translateY(-6px) scale(1.03);
	}
</style>

<!-- Welcome Banner -->
<div class="tenant-welcome mb-4">
	<div class="row align-items-center">
		<div class="col-md-8 d-flex align-items-center">
			<img src="{{ Auth::user()->profile_photo ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'Tenant') }}" alt="Profile" class="rounded-circle profile-img me-3" style="width: 64px; height: 64px; object-fit: cover;">
			<div>
				<h2 class="fw-bold mb-1">Welcome, {{ Auth::user()->name ?? 'Tenant' }}!</h2>
				<div class="fs-5">Your personalized tenant dashboard</div>
			</div>
		</div>
		<div class="col-md-4 text-md-end mt-3 mt-md-0">
			<a href="#" class="btn btn-light quick-action-btn me-2"><i class="fa fa-building me-1"></i> My Properties</a>
			<a href="#" class="btn btn-outline-light quick-action-btn"><i class="fa fa-money-bill-wave me-1"></i> Make Payment</a>
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
			<a href="#" class="btn btn-link mt-2 p-0 text-primary">View all payments <i class="fa fa-arrow-right"></i></a>
		</div>
	</div>
	<div class="col-md-5">
		<div class="dashboard-card border-0 h-100 p-4">
			<div class="fw-bold mb-3 fs-5"><i class="fa fa-bolt me-2 text-warning"></i>Quick Actions</div>
			<a href="#" class="btn btn-primary mb-2 w-100 quick-action-btn"><i class="fa fa-building me-1"></i> View My Properties</a>
			<a href="#" class="btn btn-outline-success mb-2 w-100 quick-action-btn"><i class="fa fa-money-bill-wave me-1"></i> Make Payment</a>
			<a href="#" class="btn btn-outline-warning w-100 quick-action-btn"><i class="fa fa-wrench me-1"></i> Request Maintenance</a>
		</div>
	</div>
</div>

<!-- Recently Listed Properties -->
<div class="row mt-5">
	<div class="col-12">
		<div class="dashboard-card border-0 p-4">
			<div class="fw-bold mb-3 fs-5 d-flex justify-content-between align-items-center">
				<span><i class="fa-solid fa-building me-2 text-primary"></i>Recently Listed Properties</span>
				<a href="#" class="btn btn-outline-primary btn-sm quick-action-btn">Browse All</a>
			</div>
			<div class="row g-4">
				@foreach ([
					[
						'title' => 'Modern 2 Bedroom Apartment',
						'location' => 'Lekki, Lagos',
						'price' => '₦1,200,000/year',
						'img' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=400&q=80',
					],
					[
						'title' => 'Cozy Studio Flat',
						'location' => 'Ikeja, Lagos',
						'price' => '₦600,000/year',
						'img' => 'https://images.unsplash.com/photo-1507089947368-19c1da9775ae?auto=format&fit=crop&w=400&q=80',
					],
					[
						'title' => 'Luxury Duplex',
						'location' => 'Abuja, FCT',
						'price' => '₦3,500,000/year',
						'img' => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=400&q=80',
					],
					[
						'title' => 'Family Bungalow',
						'location' => 'Port Harcourt, Rivers',
						'price' => '₦2,000,000/year',
						'img' => 'https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=400&q=80',
					],
				] as $property)
				<div class="col-md-6 col-lg-3">
					<div class="property-card h-100 border-0">
						<img src="{{ $property['img'] }}" class="card-img-top" alt="{{ $property['title'] }}" style="height: 140px; object-fit: cover; border-radius: 1.2rem 1.2rem 0 0;">
						<div class="card-body">
							<h5 class="card-title mb-1">{{ $property['title'] }}</h5>
							<div class="text-muted small mb-2"><i class="fa fa-map-marker-alt me-1"></i>{{ $property['location'] }}</div>
							<div class="fw-semibold text-primary mb-2">{{ $property['price'] }}</div>
							<a href="#" class="btn btn-outline-primary btn-sm w-100 quick-action-btn">View Details</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

@endsection