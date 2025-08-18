@extends('Layout.landlord_dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
	<h2 class="fw-bold text-success mb-0"><i class="fa-solid fa-users me-2"></i> Tenants</h2>
	<a href="#" class="btn btn-primary"><i class="fa fa-plus me-1"></i> Add Tenant</a>
</div>

<div class="card mb-4">
	<div class="card-body">
		<form class="row g-3 align-items-end">
			<div class="col-md-4">
				<input type="text" class="form-control" placeholder="Search by name, email, or property...">
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
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Property</th>
				<th>Status</th>
				<th>Move-in Date</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ([
				[
					'name' => 'Emeka O.',
					'email' => 'emeka.o@example.com',
					'phone' => '08012345678',
					'property' => 'Modern 2 Bedroom Apartment',
					'status' => 'Active',
					'movein' => '2025-08-01',
				],
				[
					'name' => 'Aisha B.',
					'email' => 'aisha.b@example.com',
					'phone' => '08087654321',
					'property' => 'Luxury Duplex',
					'status' => 'Inactive',
					'movein' => '2025-07-15',
				],
				[
					'name' => 'Chinedu K.',
					'email' => 'chinedu.k@example.com',
					'phone' => '08023456789',
					'property' => 'Family Bungalow',
					'status' => 'Active',
					'movein' => '2025-06-20',
				],
			] as $i => $tenant)
			<tr>
				<td>{{ $i+1 }}</td>
				<td class="fw-semibold">{{ $tenant['name'] }}</td>
				<td>{{ $tenant['email'] }}</td>
				<td>{{ $tenant['phone'] }}</td>
				<td>{{ $tenant['property'] }}</td>
				<td>
					<span class="badge bg-{{ strtolower($tenant['status']) == 'active' ? 'success' : 'secondary' }}">{{ $tenant['status'] }}</span>
				</td>
				<td>{{ $tenant['movein'] }}</td>
				<td>
					<a href="#" class="btn btn-sm btn-outline-info me-1" title="View"><i class="fa fa-eye"></i></a>
					<a href="#" class="btn btn-sm btn-outline-warning me-1" title="Edit"><i class="fa fa-edit"></i></a>
					<a href="#" class="btn btn-sm btn-outline-danger" title="Remove"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection
