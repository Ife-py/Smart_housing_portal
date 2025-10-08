@extends('Layout.landlord_dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-success mb-0"><i class="fa fa-user me-2"></i> Applicant Details</h2>
    <a href="{{ route('dashboard.landlord.application.index') }}" class="btn btn-outline-secondary">Back to Applications</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row g-3">
                <div class="col-md-4 text-center">
                <div class="avatar mb-3">
                    {{-- profile image: Tenant model uses image_path --}}
                    @php
                        $img = $application->tenant->image_path ?? null;
                    @endphp
                    <img src="{{ $img ? asset('storage/' . $img) : 'https://via.placeholder.com/120' }}" alt="avatar" class="rounded-circle" style="width:120px;height:120px;object-fit:cover;">
                </div>
                <h4 class="mb-0">{{ $application->tenant->name ?? 'Guest' }}</h4>
                <p class="text-muted">{{ $application->tenant->email ?? '-' }}</p>
                <p class="mb-0">
                    <strong>Sex:</strong> {{ ucfirst($application->tenant->sex ?? 'Not specified') }}
                </p>
                <p>
                    @php
                        $dob = $application->tenant->date_of_birth ?? null;
                        $age = null;
                        if($dob){
                            try { $age = \Carbon\Carbon::parse($dob)->age; } catch (Exception $e) { $age = null; }
                        }
                    @endphp
                    <strong>Age:</strong> {{ $age ?? 'N/A' }}
                </p>
                <p class="text-muted small">{{ $application->tenant->phone ?? '' }}</p>
            </div>
            <div class="col-md-8">
                <h5 class="mb-2">Application Info</h5>
                <dl class="row">
                    <dt class="col-sm-4">Property</dt>
                    <dd class="col-sm-8">{{ $application->property->title ?? '-' }}</dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">{{ ucfirst($application->status) }}</dd>

                    <dt class="col-sm-4">Submitted</dt>
                    <dd class="col-sm-8">{{ $application->created_at->format('Y-m-d H:i') }}</dd>
                </dl>

                <h5 class="mt-3">Personal Details</h5>
                <dl class="row">
                    <dt class="col-sm-4">Address</dt>
                    <dd class="col-sm-8">{{ $application->tenant->address ?? '-' }}</dd>

                    <dt class="col-sm-4">City / State</dt>
                    <dd class="col-sm-8">{{ $application->tenant->city ?? '-' }} / {{ $application->tenant->state ?? '-' }}</dd>

                    <dt class="col-sm-4">Country</dt>
                    <dd class="col-sm-8">{{ $application->tenant->country ?? '-' }}</dd>

                    <dt class="col-sm-4">Occupation</dt>
                    <dd class="col-sm-8">{{ $application->tenant->occupation ?? '-' }}</dd>
                </dl>

                <div class="mt-3">
                    @if($application->status == 'pending')
                        <form action="{{ route('dashboard.landlord.application.accept', $application->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success">Accept</button>
                        </form>

                        <form action="{{ route('dashboard.landlord.application.decline', $application->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-secondary">Decline</button>
                        </form>
                    @elseif($application->status == 'accepted')
                        <form action="{{ route('dashboard.landlord.application.cancel', $application->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger">Cancel</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
