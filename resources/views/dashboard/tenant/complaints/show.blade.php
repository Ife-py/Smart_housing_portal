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
        <div class="mt-3">
            @if(strtolower($complaint->status) === 'resolved' && !$complaint->tenant_response)
                <div class="d-flex gap-2">
                    <form action="{{ route('dashboard.tenant.complaints.acknowledge', $complaint->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="response" value="acknowledged">
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fa fa-check me-1"></i> Acknowledge
                        </button>
                    </form>
                    <form action="{{ route('dashboard.tenant.complaints.acknowledge', $complaint->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="response" value="disapproved">
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa fa-times me-1"></i> Disapprove
                        </button>
                    </form>
                </div>
            @elseif($complaint->tenant_response)
                <div class="mt-2 d-flex gap-2">
                    <form action="{{ route('dashboard.tenant.complaints.response.revert', $complaint->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa fa-undo me-1"></i> Revert</button>
                    </form>
                </div>
            @elseif($complaint->tenant_response === 'acknowledged' && strtolower($complaint->status) === 'closed')
                <div class="mt-2"><span class="badge bg-success">Verified by tenant</span></div>
            @elseif($complaint->tenant_response === 'acknowledged')
                <div class="mt-2"><span class="badge bg-info">Tenant acknowledged</span></div>
            @elseif($complaint->tenant_response === 'disapproved')
                <div class="mt-2"><span class="badge bg-danger">Tenant disagrees</span></div>
            @endif
        </div>
    </div>
</div>
@endsection
