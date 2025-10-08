@extends('Layout.landlord_dashboard')

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-triangle me-2"></i> Please fix the following errors:
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success mb-0"><i class="fa-solid fa-building me-2"></i> My Properties</h2>
        <a href="{{ route('dashboard.landlord.properties.create') }}" class="btn btn-primary"><i
                class="fa fa-plus me-1"></i> Add New Property</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.landlord.properties.search') }}" method="GET"
                class="row g-3 align-items-end">
                <div class="col-md-4">
                    <input type="text" name="query" class="form-control"
                        placeholder="Search by name, location, or status..." value="{{ request('query') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" @selected(request('status') == 'active')>Active</option>
                        <option value="inactive" @selected(request('status') == 'inactive')>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-success w-100">
                        <i class="fa fa-search me-1"></i> Search
                    </button>
                </div>
                @if (request('query') || request('status'))
                    <div class="col-md-2">
                        <a href="{{ route('dashboard.landlord.properties.index') }}"
                            class="btn btn-outline-secondary w-100">
                            <i class="fa fa-times me-1"></i> Cancel
                        </a>
                    </div>
                @endif
            </form>

        </div>
    </div>

    <div class="table-responsive">
        <style>
            /* Local styles for a cleaner properties table */
            .properties-table img.prop-thumb{ width:72px; height:48px; object-fit:cover; border-radius:6px; }
            .properties-table tbody tr{ transition: background .12s ease; }
            .properties-table tbody tr:hover{ background: rgba(0,0,0,0.02); }
            .action-btn{ width:34px; height:34px; padding:0; display:inline-flex; align-items:center; justify-content:center; }
            .badge-pending{ background:#ff6b6b; color:#fff; }
            .badge-unknown{ background:#6c757d; color:#fff; }
            .table-sm th, .table-sm td{ vertical-align:middle; }
        </style>

        <table class="table table-hover align-middle properties-table table-sm">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Pending Applications</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ([
        [
            'img' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=80&q=80',
            'title' => 'Modern 2 Bedroom Apartment',
            'location' => 'Lekki, Lagos',
            'status' => 'Active',
            'price' => '₦1,200,000/year',
            'date' => '2025-08-01',
        ],
        [
            'img' => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=80&q=80',
            'title' => 'Luxury Duplex',
            'location' => 'Abuja, FCT',
            'status' => 'Inactive',
            'price' => '₦3,500,000/year',
            'date' => '2025-07-15',
        ],
        [
            'img' => 'https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=80&q=80',
            'title' => 'Family Bungalow',
            'location' => 'Port Harcourt, Rivers',
            'status' => 'Active',
            'price' => '₦2,000,000/year',
            'date' => '2025-06-20',
        ],
    ] as $i => $property) --}}
                {{-- <tr>
                        <td>{{ $i + 1 }}</td>
                        <td><img src="{{ $property['img'] }}" alt="Property" class="rounded"
                                style="width: 56px; height: 40px; object-fit: cover;"></td>
                        <td class="fw-semibold">{{ $property['title'] }}</td>
                        <td>{{ $property['location'] }}</td>
                        <td>
                            <span
                                class="badge bg-{{ strtolower($property['status']) == 'active' ? 'success' : 'secondary' }}">{{ $property['status'] }}</span>
                        </td>
                        <td class="text-primary fw-semibold">{{ $property['price'] }}</td>
                        <td>{{ $property['date'] }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-outline-info me-1" title="View"><i
                                    class="fa fa-eye"></i></a>
                            <a href="" class="btn btn-sm btn-outline-warning me-1" title="Edit"><i
                                    class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-danger" title="Delete"><i
                                    class="fa fa-trash"></i></a>
                        </td>
                    </tr> --}}


                @forelse ($properties as $i => $property)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                            @if (!empty($property->images) && count($property->images) > 0)
                                <img src="{{ asset('storage/' . $property->images[0]) }}" alt="Property" class="prop-thumb"
                                    >
                            @else
                                <img src="https://via.placeholder.com/72x48?text=No+Image" alt="No Image" class="prop-thumb">
                            @endif
                        </td>

                        <td class="fw-semibold">{{ $property->title }}</td>
                        <td>{{ $property->address }}, {{ $property->state }}</td>
                        <td>
                            @if (!empty($property->status))
                                <span
                                    class="badge bg-{{ strtolower($property->status) == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($property->status) }}
                                </span>
                            @else
                                <span class="badge bg-secondary">Unknown</span>
                            @endif
                        </td>

                        <td class="text-primary fw-semibold">₦{{ number_format($property->price) }}/year</td>

                        <td>
                            @php $pending = $property->pending_applications_count ?? 0; @endphp
                            <a href="{{ route('dashboard.landlord.application.index', ['property_id' => $property->id]) }}" class="d-inline-flex align-items-center">
                                <span class="badge {{ $pending>0 ? 'badge-pending' : 'badge-unknown' }}">{{ $pending }}</span>
                                <small class="ms-2 text-muted">view</small>
                            </a>
                        </td>

                        <td>{{ $property->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('dashboard.landlord.properties.show', $property->id) }}" class="btn btn-outline-info btn-sm action-btn me-1" title="View">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('dashboard.landlord.properties.edit', $property->id) }}" class="btn btn-outline-warning btn-sm action-btn me-1" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form id="delete-form-{{ $property->id }}"
                                action="{{ route('dashboard.landlord.properties.delete', $property->id) }}" method="POST"
                                style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $property->id }})">
                                Delete
                            </button>

                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                function confirmDelete(id) {
                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: "This property will be permanently deleted.",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#d33',
                                        cancelButtonColor: '#3085d6',
                                        confirmButtonText: 'Yes, delete it!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.getElementById('delete-form-' + id).submit();
                                        }
                                    })
                                }
                            </script>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No properties found</td>
                    </tr>
                @endforelse

                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>

@endsection
