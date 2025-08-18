@extends('Layout.tenant_dashboard')

@section('content')
<style>
	.payment-card {
		border-radius: 1.2rem;
		background: #fff;
		box-shadow: 0 2px 16px 0 rgba(37,117,252,0.07);
		transition: box-shadow 0.18s, transform 0.18s;
	}
	.payment-card:hover {
		transform: translateY(-6px) scale(1.03);
		box-shadow: 0 8px 32px rgba(37,117,252,0.13), 0 2px 8px rgba(0,0,0,0.10);
	}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h2 class="fw-bold text-info mb-0"><i class="fa-solid fa-credit-card me-2"></i> Payment History</h2>
	<a href="#" class="btn btn-primary"><i class="fa fa-plus me-1"></i> Make Payment</a>
</div>

<div class="payment-card mb-4 p-3">
	<form class="row g-3 align-items-end">
		<div class="col-md-5">
			<input type="text" class="form-control" placeholder="Search by property, reference, or status...">
		</div>
		<div class="col-md-3">
			<select class="form-select">
				<option value="">All Status</option>
				<option value="paid">Paid</option>
				<option value="pending">Pending</option>
				<option value="overdue">Overdue</option>
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
				<th>Reference</th>
				<th>Amount</th>
				<th>Status</th>
				<th>Date</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ([
				[
					'property' => 'Sunset Villa',
					'reference' => 'INV-20250801-001',
					'amount' => '₦500,000',
					'status' => 'Paid',
					'date' => '2025-08-01',
				],
				[
					'property' => 'Greenwood Apartments',
					'reference' => 'INV-20250701-002',
					'amount' => '₦400,000',
					'status' => 'Pending',
					'date' => '2025-07-01',
				],
				[
					'property' => 'Oceanview Flats',
					'reference' => 'INV-20250601-003',
					'amount' => '₦350,000',
					'status' => 'Overdue',
					'date' => '2025-06-01',
				],
			] as $i => $payment)
			<tr>
				<td>{{ $i+1 }}</td>
				<td class="fw-semibold">{{ $payment['property'] }}</td>
				<td>{{ $payment['reference'] }}</td>
				<td>{{ $payment['amount'] }}</td>
				<td>
					@php
						$badge = 'secondary';
						if(strtolower($payment['status']) == 'paid') $badge = 'success';
						elseif(strtolower($payment['status']) == 'pending') $badge = 'warning';
						elseif(strtolower($payment['status']) == 'overdue') $badge = 'danger';
					@endphp
					<span class="badge bg-{{ $badge }}">{{ ucfirst($payment['status']) }}</span>
				</td>
				<td>{{ $payment['date'] }}</td>
				<td>
					<a href="#" class="btn btn-sm btn-outline-info me-1" title="View Receipt"><i class="fa fa-receipt"></i></a>
					@if(strtolower($payment['status']) != 'paid')
						<a href="#" class="btn btn-sm btn-outline-primary" title="Pay Now"><i class="fa fa-credit-card"></i></a>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection