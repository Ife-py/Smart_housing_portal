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

            <form action="" method="POST" enctype="multipart/form-data">
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

                {{-- Type --}}
                <div class="mb-3">
                    <label for="type" class="form-label fw-bold">Type</label>
                    <select name="type" id="type" class="form-select" required>
                        <option value="Apartment" {{ $property->type == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="House" {{ $property->type == 'House' ? 'selected' : '' }}>House</option>
                        <option value="Condo" {{ $property->type == 'Condo' ? 'selected' : '' }}>Condo</option>
                        <option value="Other" {{ $property->type == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                {{-- Custom Type (for "Other") --}}
                <div class="mb-3">
                    <label for="custom_type" class="form-label fw-bold">Custom Type (if Other)</label>
                    <input type="text" class="form-control" id="custom_type" name="custom_type" 
                           value="{{ old('custom_type', $property->custom_type) }}">
                </div>

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
                    @if($property->cover_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $property->cover_image) }}" 
                                 alt="Cover Image" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="cover_image">
                </div>

                {{-- Images --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Property Images</label>
                    <div class="d-flex flex-wrap gap-2 mb-2">
                        @if($property->images)
                            @foreach($property->images as $img)
                                <img src="{{ asset('storage/' . $img) }}" 
                                     alt="Property Image" class="img-thumbnail" style="max-height: 100px;">
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
                        <option value="inactive" {{ $property->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
