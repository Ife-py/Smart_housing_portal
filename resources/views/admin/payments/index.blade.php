@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-4 text-primary"><i class="bi bi-credit-card"></i> Payments</h2>
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow payment-highlight">
                <div class="card-body">
                    <h6 class="card-title mb-1">Total Payments</h6>
                    <h2 class="fw-bold text-success">₦3,200,000</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow payment-highlight">
                <div class="card-body">
                    <h6 class="card-title mb-1">Payments This Month</h6>
                    <h2 class="fw-bold text-primary">₦1,200,000</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow payment-highlight">
                <div class="card-body">
                    <h6 class="card-title mb-1">Pending Payments</h6>
                    <h2 class="fw-bold text-danger">₦200,000</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search by tenant, property, or ref...">
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
                    <button type="submit" class="btn btn-outline-primary w-100"><i class="bi bi-search"></i> Filter</button>
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
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Reference</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Example static data, replace with @foreach($payments as $payment) --}}
                        <tr>
                            <td>1</td>
                            <td>Samuel Okoro</td>
                            <td>Sunset Villa</td>
                            <td><span class="fw-bold text-success">₦500,000</span></td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>2025-07-25</td>
                            <td>PAY123456</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-info me-1"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Fatima Bello</td>
                            <td>Green Estate</td>
                            <td><span class="fw-bold text-success">₦250,000</span></td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                            <td>2025-07-24</td>
                            <td>PAY654321</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-info me-1"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    .payment-highlight {
        background: linear-gradient(90deg, #e8f0fe 0%, #f8fafc 100%);
        border-left: 5px solid #0d6efd;
    }
</style>
@endsection
