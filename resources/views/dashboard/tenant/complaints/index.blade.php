@extends('Layout.tenant_dashboard')

@section('content')
<style>
	.complaint-card {
		border-radius: 1.2rem;
		background: #fff;
		box-shadow: 0 2px 16px 0 rgba(37,117,252,0.07);
		transition: box-shadow 0.18s, transform 0.18s;
	}
	.complaint-card:hover {
		transform: translateY(-6px) scale(1.03);
		box-shadow: 0 8px 32px rgba(37,117,252,0.13), 0 2px 8px rgba(0,0,0,0.10);
	}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h2 class="fw-bold text-primary mb-0"><i class="fa-solid fa-triangle-exclamation me-2"></i> My Complaints</h2>
	<a href="#" class="btn btn-primary"><i class="fa fa-plus me-1"></i> New Complaint</a>
</div>

<div class="complaint-card mb-4 p-3">
	<form class="row g-3 align-items-end">
		<div class="col-md-5">
			<input type="text" class="form-control" placeholder="Search by subject or status...">
		</div>
		<div class="col-md-3">
			<select class="form-select">
				<option value="">All Status</option>
				<option value="open">Open</option>
				<option value="resolved">Resolved</option>
			</select>
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-outline-primary w-100"><i class="fa fa-search me-1"></i> Search</button>
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
					'subject' => 'Leaking Roof',
					'desc' => 'There is a leak in the master bedroom roof.',
					'status' => 'Open',
					'date' => '2025-08-15',
				],
				[
					'subject' => 'No Water Supply',
					'desc' => 'Water supply has been inconsistent for 3 days.',
					'status' => 'Resolved',
					'date' => '2025-08-10',
				],
				[
					'subject' => 'Broken Window',
					'desc' => 'The kitchen window is broken and needs repair.',
					'status' => 'Open',
					'date' => '2025-08-05',
				],
			] as $i => $complaint)
			<tr>
				<td>{{ $i+1 }}</td>
				<td class="fw-semibold">{{ $complaint['subject'] }}</td>
				<td class="text-truncate" style="max-width: 200px;">{{ $complaint['desc'] }}</td>
				<td>
					<span class="badge bg-{{ strtolower($complaint['status']) == 'open' ? 'primary' : 'success' }}">{{ $complaint['status'] }}</span>
				</td>
				<td>{{ $complaint['date'] }}</td>
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