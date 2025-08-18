@extends('Layout.tenant_dashboard')

@section('content')
<style>
	.maintenance-card {
		border-radius: 1.2rem;
		background: #fff;
		box-shadow: 0 2px 16px 0 rgba(37,117,252,0.07);
		transition: box-shadow 0.18s, transform 0.18s;
	}
	.maintenance-card:hover {
		transform: translateY(-6px) scale(1.03);
		box-shadow: 0 8px 32px rgba(37,117,252,0.13), 0 2px 8px rgba(0,0,0,0.10);
	}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h2 class="fw-bold text-info mb-0"><i class="fa-solid fa-wrench me-2"></i> Maintenance Requests</h2>
	<a href="#" class="btn btn-primary"><i class="fa fa-plus me-1"></i> New Request</a>
</div>

<div class="maintenance-card mb-4 p-3">
	<form class="row g-3 align-items-end">
		<div class="col-md-5">
			<input type="text" class="form-control" placeholder="Search by subject or status...">
		</div>
		<div class="col-md-3">
			<select class="form-select">
				<option value="">All Status</option>
				<option value="pending">Pending</option>
				<option value="in_progress">In Progress</option>
				<option value="resolved">Resolved</option>
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
				<th>Subject</th>
				<th>Description</th>
				<th>Status</th>
				<th>Date</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ([
				[
					'subject' => 'Leaking Pipe',
					'desc' => 'Pipe under the kitchen sink is leaking.',
					'status' => 'Pending',
					'date' => '2025-08-17',
				],
				[
					'subject' => 'Broken AC',
					'desc' => 'The air conditioner in the living room is not working.',
					'status' => 'In Progress',
					'date' => '2025-08-15',
				],
				[
					'subject' => 'Faulty Light',
					'desc' => 'The corridor light keeps flickering.',
					'status' => 'Resolved',
					'date' => '2025-08-10',
				],
			] as $i => $request)
			<tr>
				<td>{{ $i+1 }}</td>
				<td class="fw-semibold">{{ $request['subject'] }}</td>
				<td class="text-truncate" style="max-width: 200px;">{{ $request['desc'] }}</td>
				<td>
					@php
						$badge = 'secondary';
						if(strtolower($request['status']) == 'pending') $badge = 'info';
						elseif(strtolower($request['status']) == 'in_progress') $badge = 'warning';
						elseif(strtolower($request['status']) == 'resolved') $badge = 'success';
					@endphp
					<span class="badge bg-{{ $badge }}">{{ ucfirst(str_replace('_',' ',$request['status'])) }}</span>
				</td>
				<td>{{ $request['date'] }}</td>
				<td>
					<a href="#" class="btn btn-sm btn-outline-info me-1" title="View"><i class="fa fa-eye"></i></a>
					<a href="#" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection