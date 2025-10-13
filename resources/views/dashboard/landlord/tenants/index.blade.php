@extends('Layout.landlord_dashboard')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success mb-0"><i class="fa-solid fa-users me-2"></i> Tenants</h2>
        <a href="#" class="btn btn-primary"><i class="fa fa-plus me-1"></i> Add Tenant</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search by name, email, or property...">
                </div>
                <div class="col-md-2">
                    <select class="form-select">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-success w-100"><i class="fa fa-search me-1"></i>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Property</th>
                    <th>Status</th>
                    <th>Move-in Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tenantApplications as $i => $app)
                    @php
                        $tenant = $app->tenant;
                        $property = $app->property;
                        // derive status and move-in (use application created_at as proxy for move-in if not present)
                        $status = $app->status ?? 'pending';
                        $moveIn = $app->created_at ? $app->created_at->toDateString() : '-';
                    @endphp
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold">{{ optional($tenant)->name ?? 'N/A' }}</td>
                        <td>{{ optional($tenant)->email ?? 'N/A' }}</td>
                        <td>{{ optional($tenant)->phone ?? 'N/A' }}</td>
                        <td>{{ optional($property)->title ?? '—' }}</td>
                        <td>
                            <span
                                class="badge bg-{{ strtolower($status) == 'accepted' || strtolower($status) == 'active' ? 'success' : (strtolower($status) == 'pending' ? 'warning' : 'secondary') }}">{{ ucfirst($status) }}</span>
                        </td>
                        <td>{{ $moveIn }}</td>
                        <td>
                            <a href="{{ route('dashboard.landlord.application.show', $app->id) }}"
                                class="btn btn-sm btn-outline-info me-1" title="View"><i class="fa fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-warning me-1" title="Edit"><i
                                    class="fa fa-edit"></i></a>
                            <form action="#" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No tenants found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
