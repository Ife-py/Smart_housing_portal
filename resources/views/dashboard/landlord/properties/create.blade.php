@extends('Layout.landlord_dashboard')

@section('title', 'Add New Property')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0"><i class="fa-solid fa-plus me-2"></i>Add New Property</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('dashboard.landlord.properties.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Property Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="e.g. 3 Bedroom Apartment" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Property address" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label fw-semibold">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state" class="form-label fw-semibold">State</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label fw-semibold">Price (₦)</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="e.g. 2500000" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label fw-semibold">Property Type</label>
                            <select class="form-select" id="type" name="type" required onchange="toggleCustomType(this)">
                                <option value="">Select type</option>
                                <option value="Apartment">Apartment</option>
                                <option value="Flat">Flat</option>
                                <option value="Duplex">Duplex</option>
                                <option value="Bungalow">Bungalow</option>
                                <option value="Studio">Studio</option>
                                <option value="Self-Contain">Self-Contain</option>
                                <option value="Other">Other (specify below)</option>
                            </select>
                            <input type="text" class="form-control mt-2 d-none" id="custom_type" name="custom_type" placeholder="Enter custom property type">
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
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe the property" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="features" class="form-label fw-semibold">Features <span class="text-muted small">(comma separated)</span></label>
                            <input type="text" class="form-control" id="features" name="features" placeholder="e.g. Parking, Water, Security">
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label fw-semibold">Property Images</label>
                            <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple required>
                            <div class="form-text">You can select multiple images. After upload, you will be able to choose a cover image.</div>
                        </div>
                        <div class="mb-3">
                            <label for="cover_image" class="form-label fw-semibold">Cover Image</label>
                            <select class="form-select" id="cover_image" name="cover_image">
                                <option value="">Select cover image (after upload)</option>
                                {{-- Dynamically populate this dropdown with uploaded images in edit mode or via JS after upload --}}
                            </select>
                            <div class="form-text">Choose which image will be the cover image for this property.</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('dashboard.landlord.properties.index') }}" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa-solid fa-check"></i> Create Property
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
