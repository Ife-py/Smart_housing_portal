@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Tenant Complaints</h2>
        <p class="text-muted mb-0">View all tenant complaints and their status. Only landlords can resolve complaints.</p>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search by tenant, subject, or status...">
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
                        <th>Tenant Name</th>
                        <th>Complaint Subject</th>
                        <th>Complaint Description</th>
                        <th>Status</th>
                        <th>Date Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Example static data, replace with @foreach($complaints as $complaint) --}}
                    <tr>
                        <td>1</td>
                        <td>Samuel Okoro</td>
                        <td>Leaking Roof</td>
                        <td>There is a leak in the master bedroom roof.</td>
                        <td><span class="badge bg-warning text-dark">Pending (Landlord)</span></td>
                        <td>2025-07-20</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#complaintModal1">
                                <i class="bi bi-eye"></i> View
                            </button>
                        </td>
                    </tr>

                    <!-- Modal for Complaint 1 -->
                    <div class="modal fade" id="complaintModal1" tabindex="-1" aria-labelledby="complaintModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="complaintModalLabel1">Complaint Details: Leaking Roof</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Tenant Name:</strong> Samuel Okoro</p>
                                    <p><strong>Subject:</strong> Leaking Roof</p>
                                    <p><strong>Description:</strong> There is a leak in the master bedroom roof that causes water to drip during rain.</p>
                                    <p><strong>Status:</strong> Pending (Landlord)</p>
                                    <p><strong>Date Submitted:</strong> 2025-07-20</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-success">Mark as Resolved</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <tr>
                        <td>2</td>
                        <td>Fatima Bello</td>
                        <td>No Water</td>
                        <td>Water supply has been off for 2 days.</td>
                        <td><span class="badge bg-success">Resolved (Landlord)</span></td>
                        <td>2025-07-18</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#complaintModal2">
                                <i class="bi bi-eye"></i> View
                            </button>
                        </td>
                    </tr>

                    <!-- Modal for Complaint 2 -->
                    <div class="modal fade" id="complaintModal2" tabindex="-1" aria-labelledby="complaintModalLabel2" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="complaintModalLabel2">Complaint Details: No Water</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Tenant Name:</strong> Fatima Bello</p>
                                    <p><strong>Subject:</strong> No Water</p>
                                    <p><strong>Description:</strong> Water supply has been off for 2 days and needs urgent attention.</p>
                                    <p><strong>Status:</strong> Resolved (Landlord)</p>
                                    <p><strong>Date Submitted:</strong> 2025-07-18</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
@endsection
