@extends('Layout.landlord_dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="fw-bold text-danger mb-0"><i class="fa-solid fa-triangle-exclamation me-2"></i> Complaints</h2>
        {{-- landlord-initiated complaint creation not implemented yet --}}
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search by tenant, subject, or status...">
                </div>
                <div class="col-md-2">
                    <select class="form-select">
                        <option value="">All Status</option>
                        <option value="open">Open</option>
                        <option value="resolved">Resolved</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-danger w-100"><i class="fa fa-search me-1"></i>
                        Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Tenant</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($complaints as $i => $complaint)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold">
                            {{ optional($complaint->tenant)->name ?? 'Tenant #' . ($complaint->tenant_id ?? '') }}</td>
                        <td>{{ $complaint->subject }}</td>
                        <td class="text-truncate" style="max-width: 200px;">{{ Str::limit($complaint->description, 80) }}
                        </td>
                        <td>
                            <span
                                class="badge bg-{{ strtolower($complaint->status) == 'open' ? 'danger' : 'success' }}">{{ ucfirst($complaint->status) }}</span>
                        </td>
                        <td>{{ $complaint->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('dashboard.landlord.complaints.show', $complaint->id) }}"
                                class="btn btn-sm btn-outline-info me-1" title="View"><i class="fa fa-eye"></i></a>
                            @if (strtolower($complaint->status) !== 'resolved')
                                <form action="{{ route('dashboard.landlord.complaints.resolve', $complaint->id) }}"
                                    method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success me-1"
                                        title="Mark as Resolved"><i class="fa fa-check"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No complaints have been submitted yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
