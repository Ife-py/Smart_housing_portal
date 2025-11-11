@extends('Layout.admin')

@section('content')
    <div class="container-fluid">
        <h2 class="fw-bold mb-4">Reports & Analytics</h2>
        <div class="row g-4 mb-4">
            <!-- Total Users -->
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center py-4">
                        <div class="mb-2 text-primary">
                            <i class="bi bi-people-fill fs-2"></i>
                        </div>
                        <h6 class="text-muted fw-semibold">Total Users</h6>
                        <h3 class="fw-bold text-primary mb-0">{{ $users }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Properties -->
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center py-4">
                        <div class="mb-2 text-success">
                            <i class="bi bi-house-door-fill fs-2"></i>
                        </div>
                        <h6 class="text-muted fw-semibold">Total Properties</h6>
                        <h3 class="fw-bold text-success mb-0">{{ $totalProperties }}</h3>
                    </div>
                </div>
            </div>

            {{-- <!-- Payments This Month -->
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center py-4">
                        <div class="mb-2 text-info">
                            <i class="bi bi-cash-stack fs-2"></i>
                        </div>
                        <h6 class="text-muted fw-semibold">Payments (This Month)</h6>
                        <h3 class="fw-bold text-info mb-0">₦2,500,000</h3>
                    </div>
                </div>
            </div> --}}

            <!-- Open Complaints -->
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center py-4">
                        <div class="mb-2 text-danger">
                            <i class="bi bi-exclamation-triangle-fill fs-2"></i>
                        </div>
                        <h6 class="text-muted fw-semibold">Open Complaints</h6>
                        <h3 class="fw-bold text-danger mb-0">{{ $openComplaints }}</h3>
                    </div>
                </div>
            </div>

            <!-- Resolved Complaints -->
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center py-4">
                        <div class="mb-2 text-success">
                            <i class="bi bi-check-circle-fill fs-2"></i>
                        </div>
                        <h6 class="text-muted fw-semibold">Resolved Complaints</h6>
                        <h3 class="fw-bold text-success mb-0">{{ $resolvedComplaints }}</h3>
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
                            @forelse ($recentReports as $index => $report)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $report['type'] }}</td>
                                    <td>{{ $report['description'] }}</td>
                                    <td>{{ $report['date']->format('Y-m-d') }}</td>
                                    <td>
                                        @if ($report['status'] === 'Resolved' || $report['status'] === 'Completed')
                                            <span class="badge bg-success">{{ $report['status'] }}</span>
                                        @elseif ($report['status'] === 'Pending')
                                            <span class="badge bg-warning text-dark">{{ $report['status'] }}</span>
                                        @else
                                            <span class="badge bg-info">{{ $report['status'] }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        No recent reports found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
