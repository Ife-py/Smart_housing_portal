@extends('Layout.admin')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Tenant Complaints</h2>
        <p class="text-muted mb-0">View all tenant complaints and their status. Only landlords can resolve complaints.</p>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3" method="GET" action="{{ route('admin.complaints.index') }}">
                <div class="col-md-4">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search by tenant, subject, or status...">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="open" {{ request('status')=='open' ? 'selected' : '' }}>Open</option>
                        <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="resolved" {{ request('status')=='resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="closed" {{ request('status')=='closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tenant</th>
                        <th>Property</th>
                        <th>Subject</th>
                        <th>Verification</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($complaints as $i => $complaint)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ optional($complaint->tenant)->name ?? optional($complaint->tenant)->email ?? '—' }}</td>
                        <td>{{ optional($complaint->property)->title ?? optional($complaint->property)->address ?? '—' }}</td>
                        <td class="text-truncate" style="max-width:320px;">{{ $complaint->subject }}</td>
                        <td>
                            @php
                                $conflict = false;
                                $tenantResp = strtolower($complaint->tenant_response ?? '');
                                $landlordAck = (bool) $complaint->landlord_acknowledged;
                                if (($landlordAck && $tenantResp === 'disapproved') || ($tenantResp === 'acknowledged' && ! $landlordAck)) {
                                    $conflict = true;
                                }
                            @endphp
                            @if($conflict)
                                <span class="badge bg-danger">Conflict</span>
                            @elseif(strtolower($complaint->status) === 'closed' && $tenantResp === 'acknowledged')
                                <span class="badge bg-success">Verified</span>
                            @elseif($tenantResp === 'acknowledged')
                                <span class="badge bg-info">Tenant acknowledged</span>
                            @elseif($tenantResp === 'disapproved')
                                <span class="badge bg-warning text-dark">Tenant disagrees</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($complaint->status ?? '—') }}</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#complaintModal{{ $complaint->id }}">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="complaintModal{{ $complaint->id }}" tabindex="-1" aria-labelledby="complaintModalLabel{{ $complaint->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="complaintModalLabel{{ $complaint->id }}">Complaint Details: {{ $complaint->subject }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Tenant Name:</strong> {{ optional($complaint->tenant)->name ?? '—' }}</p>
                                    <p><strong>Property:</strong> {{ optional($complaint->property)->title ?? optional($complaint->property)->address ?? '—' }}</p>
                                    <p><strong>Subject:</strong> {{ $complaint->subject }}</p>
                                    <p><strong>Description:</strong> {{ $complaint->description }}</p>
                                    <p><strong>Status:</strong> {{ ucfirst($complaint->status ?? 'Open') }}</p>
                                    <p><strong>Date Submitted:</strong> {{ $complaint->created_at ? $complaint->created_at->format('Y-m-d H:i') : '-' }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('admin.complaints.resolve', $complaint->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Mark as Resolved</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No complaints found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0">
        <div class="d-flex justify-content-end">
            {{ $complaints->links() }}
        </div>
    </div>
</div>

</div>
@endsection
