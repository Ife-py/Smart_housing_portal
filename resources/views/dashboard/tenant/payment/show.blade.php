@extends('Layout.tenant_dashboard')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Payment</h3>
        <small class="text-muted">Reference: {{ $payment->reference }}</small>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $payment->property->title ?? 'Property' }}</h5>
            <p class="mb-1"><strong>Amount:</strong> ₦{{ number_format($payment->amount, 2) }}</p>
            <p class="mb-1"><strong>Status:</strong> <span class="badge bg-{{ $payment->status == 'paid' ? 'success' : 'warning' }}">{{ ucfirst($payment->status) }}</span></p>
            <p class="text-muted">Created: {{ $payment->created_at->diffForHumans() }}</p>

            @if($payment->status != 'paid')
                <form method="POST" action="{{ route('dashboard.tenant.payments.pay', $payment->id) }}">
                    @csrf
                    <button class="btn btn-primary">Pay Now (Dummy)</button>
                </form>
            @else
                <a href="{{ route('dashboard.tenant.payments.index') }}" class="btn btn-outline-secondary">Back to payments</a>
            @endif
        </div>
    </div>
</div>
@endsection
