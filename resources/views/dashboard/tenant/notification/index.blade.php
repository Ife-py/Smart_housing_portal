@extends('Layout.tenant_dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary mb-0"><i class="fa fa-bell me-2"></i> Notifications</h2>
    <small class="text-muted">You have <strong>{{ isset($unreadItems) ? $unreadItems->count() : 0 }}</strong> new notifications</small>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">New Notifications</h5>
                @if(!isset($unreadItems) || $unreadItems->isEmpty())
                    <p class="text-muted">No new notifications.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($unreadItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-3">
                                    @if($item instanceof \Illuminate\Notifications\DatabaseNotification)
                                        @php $data = $item->data ?? []; @endphp
                                        <div class="fw-semibold">{{ $data['subject'] ?? Str::limit($data['message'] ?? 'Notification', 50) }}</div>
                                        @if(isset($data['complaint_id']))
                                            <div class="small text-muted">Complaint • {{ $data['subject'] ?? '' }}</div>
                                        @else
                                            <div class="small text-muted">{{ Str::limit($data['message'] ?? '', 80) }}</div>
                                        @endif
                                        <div class="small text-muted">{{ $item->created_at->format('M d, Y H:i') }}</div>
                                    @elseif($item instanceof \App\Models\Application || (isset($item->status) && isset($item->property_id) && isset($item->tenant_id)))
                                        {{-- application-like --}}
                                        <div class="fw-semibold">{{ optional($item->property)->title ?? 'Property' }}</div>
                                        <div class="small text-muted">Applied on: {{ $item->created_at->format('M d, Y H:i') }}</div>
                                        <div class="small mt-1 text-truncate" style="max-width:320px">{{ $item->message ?? '' }}</div>
                                    @else
                                        {{-- assume complaint-like --}}
                                        <div class="fw-semibold">Complaint: {{ $item->subject }}</div>
                                        <div class="small text-muted">Submitted: {{ $item->created_at->format('M d, Y H:i') }}</div>
                                        <div class="small mt-1 text-truncate" style="max-width:320px">{{ Str::limit($item->description, 120) }}</div>
                                    @endif
                                </div>
                                <div class="text-end">
                                    @if($item instanceof \Illuminate\Notifications\DatabaseNotification)
                                        <a href="{{ route('dashboard.tenant.notifications.show', $item->id) }}" class="btn btn-sm btn-primary">Open</a>
                                    @else
                                        <a href="#" class="btn btn-sm btn-primary">View</a>
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
                @if(!isset($processedItems) || $processedItems->isEmpty())
                    <p class="text-muted">No recent notifications.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($processedItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    @if(isset($item->subject) && isset($item->description))
                                        <div class="fw-semibold">Complaint - {{ $item->subject }}</div>
                                        <div class="small text-muted">Submitted: {{ $item->created_at->diffForHumans() }}</div>
                                    @else
                                        <div class="fw-semibold">{{ ucfirst($item->status) }} - {{ optional($item->property)->title ?? '-' }}</div>
                                        <div class="small text-muted">Updated: {{ $item->updated_at->diffForHumans() }}</div>
                                    @endif
                                </div>
                                <div class="text-end">
                                    <a href="#" class="btn btn-sm btn-outline-info">View</a>
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
