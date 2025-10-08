@extends('Layout.landlord_dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-success mb-0"><i class="fa fa-inbox me-2"></i> Property Applications</h2>
    <a href="{{ route('dashboard.landlord.properties.index') }}" class="btn btn-outline-secondary">Back to Properties</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('info'))
    <div class="alert alert-info">{{ session('info') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-body">
        @if($applications->isEmpty())
            <p class="text-muted">No applications found.</p>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Property</th>
                            <th>Applicant</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $i => $app)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $app->property->title ?? '-' }}</td>
                                <td>{{ $app->tenant->name ?? 'Guest' }}</td>
                                <td class="text-truncate" style="max-width:300px">{{ $app->message }}</td>
                                <td>
                                    <span class="badge bg-{{ $app->status == 'pending' ? 'warning' : ($app->status == 'accepted' ? 'success' : 'secondary') }}">{{ ucfirst($app->status) }}</span>
                                </td>
                                <td>{{ $app->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if($app->status == 'pending')
                                        <form action="{{ route('dashboard.landlord.application.accept', $app->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-success">Accept</button>
                                        </form>
                                        <form action="{{ route('dashboard.landlord.application.decline', $app->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-secondary">Decline</button>
                                        </form>
                                    @elseif($app->status == 'accepted')
                                        <form action="{{ route('dashboard.landlord.application.cancel', $app->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-danger">Cancel</button>
                                        </form>
                                    @endif

                                    <a href="{{ route('dashboard.landlord.application.show', $app->id) }}" class="btn btn-sm btn-outline-info ms-1">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection
