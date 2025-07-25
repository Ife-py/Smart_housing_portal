@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manage Landlords</h2>
        <a href="#" class="btn btn-primary">Add New Landlord</a>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search by name, email, or property...">
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Properties</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Example static data, replace with @foreach($landlords as $landlord) --}}
                        <tr>
                            <td>1</td>
                            <td>Mary Johnson</td>
                            <td>mary.johnson@example.com</td>
                            <td>0803-123-4567</td>
                            <td>3</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">View</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Ahmed Musa</td>
                            <td>ahmed.musa@example.com</td>
                            <td>0802-987-6543</td>
                            <td>5</td>
                            <td><span class="badge bg-secondary">Inactive</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">View</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
