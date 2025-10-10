@extends('Layout.tenant_dashboard')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Complaint #{{ $complaint->id }}</h3>
        <a href="{{ route('dashboard.tenant.complaints.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card p-3">
        <h5>{{ $complaint->subject }}</h5>
        <p class="text-muted">Property: {{ optional($complaint->property)->title ?? '—' }}</p>
        <p>{{ $complaint->description }}</p>

        @if(!empty($complaint->attachments))
            <div class="mt-3">
                <h6>Attachments</h6>
                <ul>
                    @foreach($complaint->attachments as $att)
                        <li><a href="{{ asset('storage/' . $att) }}" target="_blank">{{ basename($att) }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-3">
            <span class="badge bg-{{ strtolower($complaint->status) == 'resolved' ? 'success' : 'warning' }}">{{ ucfirst($complaint->status) }}</span>
        </div>
    </div>
</div>
@endsection
