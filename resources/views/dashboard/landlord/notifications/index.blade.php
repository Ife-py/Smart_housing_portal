@extends('Layout.landlord_dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-success mb-0"><i class="fa fa-bell me-2"></i> Notifications</h2>
    <small class="text-muted">You have <strong>{{ $unreadApplications->count() }}</strong> new notifications</small>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">New Applications</h5>
                @if($unreadApplications->isEmpty())
                    <p class="text-muted">No new notifications.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($unreadApplications as $app)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-3">
                                    <div class="fw-semibold">{{ $app->tenant->name ?? 'Guest' }}</div>
                                    <div class="small text-muted">Applied for: {{ $app->property->title ?? '-' }}</div>
                                    <div class="small mt-1 text-truncate" style="max-width:320px">{{ $app->message }}</div>
                                </div>
                                <div class="text-end">
                                    <div class="mb-2">
                                        <form action="{{ route('dashboard.landlord.application.accept', $app->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-success">Accept</button>
                                        </form>
                                        <form action="{{ route('dashboard.landlord.application.decline', $app->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-secondary">Decline</button>
                                        </form>
                                    </div>
                                    <a href="{{ route('dashboard.landlord.application.show', $app->id) }}" class="btn btn-sm btn-outline-info">View</a>
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
                @if($applications->isEmpty())
                    <p class="text-muted">No recent notifications.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($applications as $app)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-semibold">{{ $app->tenant->name ?? 'Guest' }}</div>
                                    <div class="small text-muted">{{ ucfirst($app->status) }} - {{ $app->property->title ?? '-' }}</div>
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
