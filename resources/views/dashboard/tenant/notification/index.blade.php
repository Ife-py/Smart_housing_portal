@extends('Layout.tenant_dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary mb-0"><i class="fa fa-bell me-2"></i> Notifications</h2>
    <small class="text-muted">You have <strong>{{ isset($unreadApplications) ? $unreadApplications->count() : 0 }}</strong> new notifications</small>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">New Notifications</h5>
                @if(!isset($unreadApplications) || $unreadApplications->isEmpty())
                    <p class="text-muted">No new notifications.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($unreadApplications as $app)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-3">
                                    <div class="fw-semibold">{{ $app->property->title ?? 'Property' }}</div>
                                    <div class="small text-muted">Applied on: {{ $app->created_at->format('M d, Y H:i') }}</div>
                                    <div class="small mt-1 text-truncate" style="max-width:320px">{{ $app->message }}</div>
                                </div>
                                <div class="text-end">
                                    <a href="{{ route('dashboard.tenant.my_properties.index') }}" class="btn btn-sm btn-primary">View Property</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Recent Notifications</h5>
                @if(!isset($processedApplications) || $processedApplications->isEmpty())
                    <p class="text-muted">No recent notifications.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($processedApplications as $app)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-semibold">{{ ucfirst($app->status) }} - {{ $app->property->title ?? '-' }}</div>
                                    <div class="small text-muted">Updated: {{ $app->updated_at->diffForHumans() }}</div>
                                </div>
                                <div class="text-end">
                                    <a href="{{ route('dashboard.landlord.application.show', $app->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
