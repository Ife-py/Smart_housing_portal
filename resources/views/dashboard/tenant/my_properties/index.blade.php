@extends('Layout.tenant_dashboard')

@section('content')
<style>
    .property-card {
        border-radius: 1.2rem;
        background: #fff;
        box-shadow: 0 2px 16px 0 rgba(37,117,252,0.07);
        transition: box-shadow 0.18s, transform 0.18s;
    }
    .property-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 8px 32px rgba(37,117,252,0.13), 0 2px 8px rgba(0,0,0,0.10);
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-info mb-0"><i class="fa-solid fa-key me-2"></i> My Rented Properties</h2>
    <span class="text-muted d-none d-md-inline">View details, lease info, and manage your current rentals</span>
</div>

<div class="property-card mb-4 p-3">
    <form class="row g-3 align-items-end">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Search by property name, address, or landlord...">
        </div>
        <div class="col-md-3">
            <select class="form-select">
                <option value="">All Application Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-info w-100"><i class="fa fa-search me-1"></i> Search</button>
        </div>
    </form>
</div>

@php
// Dummy data for visualization
$dummyApplications = [
    (object)[
        'property' => (object)['title' => 'Luxury Apartment', 'address' => '123 Main St'],
        'landlord' => (object)['name' => 'John Doe'],
        'status' => 'pending',
        'lease_end' => null,
    ],
    (object)[
        'property' => (object)['title' => 'Cozy Studio', 'address' => '456 Elm St'],
        'landlord' => (object)['name' => 'Jane Smith'],
        'status' => 'accepted',
        'lease_end' => '2025-12-31',
    ],
    (object)[
        'property' => (object)['title' => 'Modern Flat', 'address' => '789 Oak Ave'],
        'landlord' => (object)['name' => 'Mike Johnson'],
        'status' => 'cancelled',
        'lease_end' => null,
    ],
];

// Merge live and dummy data
$allApplications = [];
if(isset($applications) && count($applications)) {
    foreach($applications as $application) {
        $allApplications[] = $application;
    }
}
foreach($dummyApplications as $dummy) {
    $allApplications[] = $dummy;
}
@endphp

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Property</th>
                <th>Address</th>
                <th>Landlord</th>
                <th>Application Status</th>
                <th>Lease End</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($allApplications as $i => $application)
            <tr>
                <td>{{ $i+1 }}</td>
                <td class="fw-semibold">{{ $application->property->title ?? '-' }}</td>
                <td class="text-truncate" style="max-width: 200px;">{{ $application->property->address ?? '-' }}</td>
                <td>{{ $application->landlord->name ?? '-' }}</td>
                <td>
                    @php
                        $badge = 'secondary';
                        if(strtolower($application->status) == 'accepted') $badge = 'success';
                        elseif(strtolower($application->status) == 'pending') $badge = 'warning';
                        elseif(strtolower($application->status) == 'cancelled') $badge = 'danger';
                    @endphp
                    <span class="badge bg-{{ $badge }}">{{ ucfirst($application->status) }}</span>
                </td>
                <td>{{ $application->lease_end ?? '-' }}</td>
                <td>
                    @if(strtolower($application->status) == 'pending')
                        <span class="text-muted">Awaiting landlord approval</span>
                        <a href="#" class="btn btn-sm btn-outline-danger ms-2" title="Withdraw Application">
                            <i class="fa fa-times"></i> Withdraw
                        </a>
                    @elseif(strtolower($application->status) == 'accepted')
                        <a href="#" class="btn btn-sm btn-outline-info me-1" title="View Lease"><i class="fa fa-file-contract"></i> Lease</a>
                        <a href="#" class="btn btn-sm btn-outline-primary me-1" title="Contact Landlord"><i class="fa fa-envelope"></i> Contact</a>
                        <a href="#" class="btn btn-sm btn-outline-warning" title="Request Maintenance"><i class="fa fa-tools"></i> Maintenance</a>
                    @elseif(strtolower($application->status) == 'cancelled')
                        <span class="text-danger">Application Rejected</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted">You have not applied for any properties yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection