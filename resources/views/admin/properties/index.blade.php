@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary"><i class="bi bi-house-door"></i> Manage Properties</h2>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow property-highlight">
                <div class="card-body">
                    <h5 class="card-title mb-1">Total Properties</h5>
                    <h2 class="fw-bold text-success">89</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow property-highlight">
                <div class="card-body">
                    <h5 class="card-title mb-1">Active</h5>
                    <h2 class="fw-bold text-primary">72</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow property-highlight">
                <div class="card-body">
                    <h5 class="card-title mb-1">Inactive</h5>
                    <h2 class="fw-bold text-secondary">17</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3 align-items-end">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search by name, location, or landlord...">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100"><i class="bi bi-search"></i> Search</button>
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
                            <th>Location</th>
                            <th>Landlord</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Example static data, replace with @foreach($properties as $property) --}}
                        <tr>
                            <td>1</td>
                            <td><span class="fw-semibold text-primary">Sunset Villa</span></td>
                            <td><span class="badge bg-light text-dark border">Lekki, Lagos</span></td>
                            <td><span class="fw-semibold">Mary Johnson</span></td>
                            <td><span class="badge bg-success px-3 py-2">Active</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-info me-1"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><span class="fw-semibold text-primary">Green Estate</span></td>
                            <td><span class="badge bg-light text-dark border">Gwarinpa, Abuja</span></td>
                            <td><span class="fw-semibold">Ahmed Musa</span></td>
                            <td><span class="badge bg-secondary px-3 py-2">Inactive</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-info me-1"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></a>
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
    .property-highlight {
        background: linear-gradient(90deg, #e8f0fe 0%, #f8fafc 100%);
        border-left: 5px solid #0d6efd;
    }
    .btn-gradient {
        background: linear-gradient(90deg, #0d6efd 0%, #6dd5ed 100%);
        color: #fff;
        border: none;
        box-shadow: 0 2px 8px rgba(13,110,253,0.08);
        transition: background 0.2s;
    }
    .btn-gradient:hover {
        background: linear-gradient(90deg, #6dd5ed 0%, #0d6efd 100%);
        color: #fff;
    }
</style>
@endsection