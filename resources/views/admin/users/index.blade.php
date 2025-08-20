
@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manage Users</h2>
        <a href="#" class="btn btn-primary">Add New User</a>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search by name, email, or role...">
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
                            <th>Usename</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Example static data, replace with @foreach($users as $user) --}}
                        {{-- <tr>
                            <td>1</td>
                            <td>Jane Doe</td>
                            <td>jane@example.com</td>
                            <td>Admin</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">View</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>John Smith</td>
                            <td>john@example.com</td>
                            <td>Tenant</td>
                            <td><span class="badge bg-secondary">Inactive</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">View</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr> --}}
                        @foreach ($tenants as $tenant)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tenant->name }}</td>
                            <td>{{ $tenant->email }}</td>
                            <td>{{ $tenant->username }}</td>
                            <td>Tenant</td> 
                            <td>
                                <span class="badge bg-{{ $tenant->isActive() ? 'success' : 'secondary' }}">
                                    {{ $tenant->isActive() ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.show', ['type'=>'tenant','id' =>$tenant->id]) }}" class="btn btn-sm btn-info">View</a>
                                <form action="" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE') 
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>  
                        </tr>
                        @endforeach
                        @foreach ($landlords as $landlord)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $landlord->name }}</td>
                            <td>{{ $landlord->email }}</td>
                            <td>{{ $landlord->username }}</td>
                            <td>Landlord</td>
                            <td>
                                <span class="badge bg-{{ $landlord->isActive() ? 'success' : 'secondary' }}">
                                    {{ $landlord->isActive() ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                    <a href="{{ route('admin.users.show', ['type'=>'landlord','id' =>$landlord->id]) }}" class="btn btn-sm btn-info">View</a>
                                <form action="" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
