@extends('Layout.landlord_dashboard')

@section('title', 'Edit Property')

@section('content')
    <div class="container my-5">

        {{-- Back Button --}}
        <div class="mb-4">
            <a href="{{ route('dashboard.landlord.properties.index') }}" class="btn btn-outline-secondary btn-lg shadow-sm">
                <i class="bi bi-arrow-left-circle me-2"></i> Back to Properties
            </a>
        </div>

        <div class="card border-0 shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Property</h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('dashboard.landlord.properties.update', $property->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $property->title) }}" required>
                    </div>

                    {{-- Address --}}
                    <div class="mb-3">
                        <label for="address" class="form-label fw-bold">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address', $property->address) }}" required>
                    </div>

                    {{-- City --}}
                    <div class="mb-3">
                        <label for="city" class="form-label fw-bold">City</label>
                        <input type="text" class="form-control" id="city" name="city"
                            value="{{ old('city', $property->city) }}" required>
                    </div>

                    {{-- State --}}
                    <div class="mb-3">
                        <label for="state" class="form-label fw-bold">State</label>
                        <input type="text" class="form-control" id="state" name="state"
                            value="{{ old('state', $property->state) }}" required>
                    </div>

                    {{-- Price --}}
                    <div class="mb-3">
                        <label for="price" class="form-label fw-bold">Price (₦)</label>
                        <input type="number" class="form-control" id="price" name="price"
                            value="{{ old('price', $property->price) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label fw-semibold">Property Type</label>
                        <select class="form-select" id="type" name="type" required
                            onchange="toggleCustomType(this)">
                            <option value="">Select type</option>
                            <option value="Apartment" {{ $property->type == 'Apartment' ? 'selected' : '' }}>Apartment
                            </option>
                            <option value="Flat" {{ $property->type == 'Flat' ? 'selected' : '' }}>Flat</option>
                            <option value="Duplex" {{ $property->type == 'Duplex' ? 'selected' : '' }}>Duplex</option>
                            <option value="Bungalow" {{ $property->type == 'Bungalow' ? 'selected' : '' }}>Bungalow
                            </option>
                            <option value="Studio" {{ $property->type == 'Studio' ? 'selected' : '' }}>Studio</option>
                            <option value="Self-Contain" {{ $property->type == 'Self-Contain' ? 'selected' : '' }}>
                                Self-Contain</option>
                            <option value="Other" {{ $property->type == 'Other' ? 'selected' : '' }}>Other (specify below)
                            </option>
                        </select>

                        {{-- Custom Type --}}
                        <input type="text" class="form-control mt-2 {{ $property->type == 'Other' ? '' : 'd-none' }}"
                            id="custom_type" name="custom_type" placeholder="Enter custom property type"
                            value="{{ $property->custom_type ?? '' }}" {{ $property->type == 'Other' ? 'required' : '' }}>
                    </div>

                    <script>
                        function toggleCustomType(select) {
                            var customTypeInput = document.getElementById('custom_type');
                            if (select.value === 'Other') {
                                customTypeInput.classList.remove('d-none');
                                customTypeInput.required = true;
                            } else {
                                customTypeInput.classList.add('d-none');
                                customTypeInput.required = false;
                                customTypeInput.value = '';
                            }
                        }
                    </script>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $property->description) }}</textarea>
                    </div>

                    {{-- Features --}}
                    <div class="mb-3">
                        <label for="features" class="form-label fw-bold">Features</label>
                        <textarea class="form-control" id="features" name="features" rows="3">{{ old('features', $property->features) }}</textarea>
                        <div class="form-text">Example: 3 Bedrooms, Parking Space, Kitchen</div>
                    </div>

                    {{-- Cover Image --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Cover Image</label>
                        @if ($property->cover_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $property->cover_image) }}" alt="Cover Image"
                                    class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="cover_image">
                    </div>

                    {{-- Images --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Property Images</label>
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            @if ($property->images)
                                @foreach ($property->images as $img)
                                    <img src="{{ asset('storage/' . $img) }}" alt="Property Image" class="img-thumbnail"
                                        style="max-height: 100px;">
                                @endforeach
                            @endif
                        </div>
                        <input type="file" class="form-control" name="images[]" multiple>
                        <div class="form-text">You can upload multiple images (jpeg, png, jpg, gif).</div>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="active" {{ $property->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $property->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-save me-2"></i> Update Property
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
