@extends('Layout.landlord_dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
	<h2 class="fw-bold text-success mb-0"><i class="fa-solid fa-building me-2"></i> My Properties</h2>
	<a href="{{ route('dashboard.landlord.properties.create') }}" class="btn btn-primary"><i class="fa fa-plus me-1"></i> Add New Property</a>
</div>

<div class="card mb-4">
	<div class="card-body">
		<form class="row g-3 align-items-end">
			<div class="col-md-4">
				<input type="text" class="form-control" placeholder="Search by name, location, or status...">
			</div>
			<div class="col-md-2">
				<select class="form-select">
					<option value="">All Status</option>
					<option value="active">Active</option>
					<option value="inactive">Inactive</option>
				</select>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-outline-success w-100"><i class="fa fa-search me-1"></i> Search</button>
			</div>
		</form>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-hover align-middle">
		<thead class="table-light">
			<tr>
				<th>#</th>
				<th>Image</th>
				<th>Title</th>
				<th>Location</th>
				<th>Status</th>
				<th>Price</th>
				<th>Date Added</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ([
				[
					'img' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=80&q=80',
					'title' => 'Modern 2 Bedroom Apartment',
					'location' => 'Lekki, Lagos',
					'status' => 'Active',
					'price' => '₦1,200,000/year',
					'date' => '2025-08-01',
				],
				[
					'img' => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=80&q=80',
					'title' => 'Luxury Duplex',
					'location' => 'Abuja, FCT',
					'status' => 'Inactive',
					'price' => '₦3,500,000/year',
					'date' => '2025-07-15',
				],
				[
					'img' => 'https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=80&q=80',
					'title' => 'Family Bungalow',
					'location' => 'Port Harcourt, Rivers',
					'status' => 'Active',
					'price' => '₦2,000,000/year',
					'date' => '2025-06-20',
				],
			] as $i => $property)
			<tr>
				<td>{{ $i+1 }}</td>
				<td><img src="{{ $property['img'] }}" alt="Property" class="rounded" style="width: 56px; height: 40px; object-fit: cover;"></td>
				<td class="fw-semibold">{{ $property['title'] }}</td>
				<td>{{ $property['location'] }}</td>
				<td>
					<span class="badge bg-{{ strtolower($property['status']) == 'active' ? 'success' : 'secondary' }}">{{ $property['status'] }}</span>
				</td>
				<td class="text-primary fw-semibold">{{ $property['price'] }}</td>
				<td>{{ $property['date'] }}</td>
				<td>
					<a href="" class="btn btn-sm btn-outline-info me-1" title="View"><i class="fa fa-eye"></i></a>
					<a href="" class="btn btn-sm btn-outline-warning me-1" title="Edit"><i class="fa fa-edit"></i></a>
					<a href="#" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection
