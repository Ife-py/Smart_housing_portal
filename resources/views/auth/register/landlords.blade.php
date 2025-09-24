@extends('Layout.home')

@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <a href="{{ route('register.show') }}"
                class="text-decoration-none text-secondary d-flex align-items-center fw-semibold">
                <i class="bi bi-arrow-left-circle me-2"></i> Back to Register
            </a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <div class="text-center mb-4">
                        <div class="bg-success bg-gradient text-white rounded-circle d-flex justify-content-center align-items-center mx-auto mb-3"
                            style="width: 70px; height: 70px;">
                            <i class="bi bi-person-check-fill fs-2"></i>
                        </div>
                        <h3 class="fw-bold mb-1">Landlord Registration</h3>
                        <p class="text-muted mb-0">Create your landlord account to manage your properties.</p>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('register.landlords.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your full name" required autofocus>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter your preferred username" required autofocus>
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email address" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label fw-semibold">Company/Business Name <span
                                    class="text-muted small">(optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-building"></i></span>
                                <input type="text" class="form-control" id="company" name="company"
                                    placeholder="Enter your company or business name">
                                @error('company')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-geo-alt"></i></span>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter your address" required>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="occupation" class="form-label fw-semibold">Occupation</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-briefcase"></i></span>
                                <input type="text" class="form-control" id="occupation" name="occupation"
                                    placeholder="Your occupation" required>
                                @error('occupation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label fw-semibold">Date of Birth</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-calendar-date"></i></span>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    required>
                                @error('date_of_birth')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label fw-semibold">City</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-geo"></i></span>
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="City" required>
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state" class="form-label fw-semibold">State</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-flag"></i></span>
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="State" required>
                                    @error('state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label fw-semibold">Country</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-flag"></i></span>
                                <input type="text" class="form-control" id="country" name="country"
                                    placeholder="Country" required>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-telephone"></i></span>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    placeholder="Enter your phone number" required>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sex" class="form-label fw-semibold">Sex</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-gender-ambiguous"></i></span>
                                <select class="form-select" name="sex" id="sex" required>
                                    <option value="" disabled
                                        {{ old('sex', $landlord->sex ?? '') == '' ? 'selected' : '' }}>Select Sex</option>
                                    <option value="Male"
                                        {{ old('sex', $landlord->sex ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female"
                                        {{ old('sex', $landlord->sex ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            @error('sex')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_number" class="form-label fw-semibold">National ID/Verification Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-card-checklist"></i></span>
                                <input type="text" class="form-control" id="id_number" name="id_number"
                                    placeholder="Enter your ID or verification number" required>
                                @error('id_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="properties_count" class="form-label fw-semibold">How many properties do you
                                own/manage?</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-houses"></i></span>
                                <input type="number" min="1" class="form-control" id="properties_count"
                                    name="properties_count" placeholder="Number of properties" required>
                                @error('properties_count')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="contact_method" class="form-label fw-semibold">Preferred Contact Method</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-chat-dots"></i></span>
                                <select class="form-select" id="contact_method" name="contact_method" required>
                                    <option value="">Select method</option>
                                    <option value="phone">Phone</option>
                                    <option value="email">Email</option>
                                    <option value="sms">SMS</option>
                                </select>
                                @error('contact_method')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="profile_photo" class="form-label fw-semibold">Profile Photo <span
                                    class="text-muted small">(optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-image"></i></span>
                                <input type="file" class="form-control" id="profile_photo" name="profile_photo"
                                    accept="image/*">
                                @error('profile_photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Create a password" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm your password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100 py-2 fw-bold mt-2">
                            <i class="bi bi-person-plus me-1"></i> Register as Landlord
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        <small class="text-muted">Already have an account? <a href=""
                                class="text-success fw-semibold">Login</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
