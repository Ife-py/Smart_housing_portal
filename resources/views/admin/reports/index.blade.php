@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-4">Reports & Analytics</h2>
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title">Total Users</h6>
                    <h3 class="fw-bold text-primary">1,234</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title">Total Properties</h6>
                    <h3 class="fw-bold text-success">87</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title">Payments (This Month)</h6>
                    <h3 class="fw-bold text-info">₦2,500,000</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title">Open Complaints</h6>
                    <h3 class="fw-bold text-danger">5</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="reportType" class="form-label">Report Type</label>
                    <select class="form-select" id="reportType">
                        <option selected>All</option>
                        <option>Users</option>
                        <option>Properties</option>
                        <option>Payments</option>
                        <option>Complaints</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dateFrom" class="form-label">From</label>
                    <input type="date" class="form-control" id="dateFrom">
                </div>
                <div class="col-md-3">
                    <label for="dateTo" class="form-label">To</label>
                    <input type="date" class="form-control" id="dateTo">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Recent Reports</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Payment</td>
                            <td>₦500,000 received from John Doe</td>
                            <td>2025-07-25</td>
                            <td><span class="badge bg-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Complaint</td>
                            <td>Leaking roof reported by Samuel Okoro</td>
                            <td>2025-07-24</td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>User</td>
                            <td>New user Fatima Bello registered</td>
                            <td>2025-07-23</td>
                            <td><span class="badge bg-info">Info</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
