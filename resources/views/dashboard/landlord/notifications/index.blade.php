@extends('Layout.landlord_dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-success mb-0"><i class="fa fa-bell me-2"></i> Notifications</h2>
    <small class="text-muted">You have <strong>{{ isset($unreadApplications) ? $unreadApplications->count() : 0 }}</strong> new notifications</small>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">New Applications</h5>
                @if(!isset($unreadApplications) || $unreadApplications->isEmpty())
                    <p class="text-muted">No new notifications.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($unreadApplications as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-3">
                                    @if($item instanceof \Illuminate\Notifications\DatabaseNotification)
                                        @php $data = $item->data ?? []; @endphp
                                        <div class="fw-semibold">{{ $data['subject'] ?? Str::limit($data['message'] ?? 'Notification', 50) }}</div>
                                        @if(isset($data['complaint_id']))
                                            <div class="small text-muted">Complaint • {{ $data['subject'] ?? '' }}</div>
                                        @elseif(isset($data['message']))
                                            <div class="small text-muted">{{ Str::limit($data['message'], 80) }}</div>
                                        @endif
                                        <div class="small text-muted">{{ $item->created_at->diffForHumans() }}</div>
                                    @else
                                        {{-- legacy model objects (Application/Complaint) --}}
                                        @if(isset($item->subject) && isset($item->description))
                                            <div class="fw-semibold">Complaint from {{ optional($item->tenant)->name ?? 'Tenant' }}</div>
                                            <div class="small text-muted">Property: {{ optional($item->property)->title ?? '-' }}</div>
                                            <div class="small mt-1 text-truncate" style="max-width:320px">{{ Str::limit($item->description, 120) }}</div>
                                        @else
                                            <div class="fw-semibold">{{ $item->tenant->name ?? 'Guest' }}</div>
                                            <div class="small text-muted">Applied for: {{ $item->property->title ?? '-' }}</div>
                                            <div class="small mt-1 text-truncate" style="max-width:320px">{{ $item->message }}</div>
                                        @endif
                                    @endif
                                </div>
                                <div class="text-end">
                                    @if($item instanceof \Illuminate\Notifications\DatabaseNotification)
                                        @php $url = $item->data['url'] ?? route('dashboard.landlord.notifications.index'); @endphp
                                        <a href="{{ route('dashboard.landlord.notifications.show', $item->id) }}" class="btn btn-sm btn-outline-info">Open</a>
                                    @else
                                        @if(isset($item->subject) && isset($item->description))
                                            <a href="{{ route('dashboard.landlord.complaints.show', $item->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                        @else
                                            <div class="mb-2">
                                                <form action="{{ route('dashboard.landlord.application.accept', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-sm btn-success">Accept</button>
                                                </form>
                                                <form action="{{ route('dashboard.landlord.application.decline', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-sm btn-outline-secondary">Decline</button>
                                                </form>
                                            </div>
                                            <a href="{{ route('dashboard.landlord.application.show', $item->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                        @endif
                                    @endif
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
                @if(!isset($applications) || $applications->isEmpty())
                    <p class="text-muted">No recent notifications.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($applications as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    @if(isset($item->subject) && isset($item->description))
                                        <div class="fw-semibold">Complaint - {{ $item->subject }}</div>
                                        <div class="small text-muted">Submitted: {{ $item->created_at->diffForHumans() }}</div>
                                    @else
                                        <div class="fw-semibold">{{ $item->tenant->name ?? 'Guest' }}</div>
                                        <div class="small text-muted">{{ ucfirst($item->status) }} - {{ $item->property->title ?? '-' }}</div>
                                    @endif
                                </div>
                                <div class="text-end">
                                    @if(isset($item->subject) && isset($item->description))
                                        <a href="{{ route('dashboard.landlord.complaints.show', $item->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                    @else
                                        <a href="{{ route('dashboard.landlord.application.show', $item->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                    @endif
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
