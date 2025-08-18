@extends('Layout.tenant_dashboard')

@section('content')
<style>
	.property-card {
		border-radius: 1.2rem;
		background: #fff;
		box-shadow: 0 2px 16px 0 rgba(37,117,252,0.07);
		transition: box-shadow 0.18s, transform 0.18s;
	}
	.property-card:hover {
		transform: translateY(-6px) scale(1.03);
		box-shadow: 0 8px 32px rgba(37,117,252,0.13), 0 2px 8px rgba(0,0,0,0.10);
	}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h2 class="fw-bold text-info mb-0"><i class="fa-solid fa-key me-2"></i> My Rented Properties</h2>
	<span class="text-muted d-none d-md-inline">View details, lease info, and manage your current rentals</span>
</div>

<div class="property-card mb-4 p-3">
	<form class="row g-3 align-items-end">
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Search by property name, address, or landlord...">
		</div>
		<div class="col-md-3">
			<select class="form-select">
				<option value="">All Lease Status</option>
				<option value="active">Active</option>
				<option value="expiring">Expiring Soon</option>
				<option value="ended">Ended</option>
			</select>
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-outline-info w-100"><i class="fa fa-search me-1"></i> Search</button>
		</div>
	</form>
</div>

<div class="table-responsive">
	<table class="table table-hover align-middle">
		<thead class="table-light">
			<tr>
				<th>#</th>
				<th>Property</th>
				<th>Address</th>
				<th>Landlord</th>
				<th>Lease Status</th>
				<th>Lease End</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ([
				[
					'name' => 'Sunset Villa',
					'address' => '123 Palm Street, Lekki',
					'landlord' => 'Mr. Adewale',
					'status' => 'Active',
					'lease_end' => '2026-07-10',
				],
				[
					'name' => 'Greenwood Apartments',
					'address' => '45 Oak Avenue, Ikeja',
					'landlord' => 'Mrs. Okafor',
					'status' => 'Expiring',
					'lease_end' => '2025-09-01',
				],
				[
					'name' => 'Oceanview Flats',
					'address' => '9 Marine Road, Victoria Island',
					'landlord' => 'Mr. Bello',
					'status' => 'Ended',
					'lease_end' => '2025-06-22',
				],
			] as $i => $property)
			<tr>
				<td>{{ $i+1 }}</td>
				<td class="fw-semibold">{{ $property['name'] }}</td>
				<td class="text-truncate" style="max-width: 200px;">{{ $property['address'] }}</td>
				<td>{{ $property['landlord'] }}</td>
				<td>
					@php
						$badge = 'secondary';
						if(strtolower($property['status']) == 'active') $badge = 'success';
						elseif(strtolower($property['status']) == 'expiring') $badge = 'warning';
						elseif(strtolower($property['status']) == 'ended') $badge = 'danger';
					@endphp
					<span class="badge bg-{{ $badge }}">{{ ucfirst($property['status']) }}</span>
				</td>
				<td>{{ $property['lease_end'] }}</td>
				<td>
					<a href="#" class="btn btn-sm btn-outline-info me-1" title="View Lease"><i class="fa fa-file-contract"></i></a>
					<a href="#" class="btn btn-sm btn-outline-primary me-1" title="Contact Landlord"><i class="fa fa-envelope"></i></a>
					<a href="#" class="btn btn-sm btn-outline-warning" title="Request Maintenance"><i class="fa fa-tools"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection