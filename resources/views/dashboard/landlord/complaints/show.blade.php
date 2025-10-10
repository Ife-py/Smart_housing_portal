@extends('Layout.landlord_dashboard')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Complaint #{{ $complaint->id }}</h3>
        <a href="{{ route('dashboard.landlord.complaints.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
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
                @if(strtolower($complaint->status) !== 'resolved')
                <form action="{{ route('dashboard.landlord.complaints.resolve', $complaint->id) }}" method="post">
                    @csrf
                    <button class="btn btn-success">Mark as Resolved</button>
                </form>
                @else
                <span class="badge bg-success">Resolved</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
