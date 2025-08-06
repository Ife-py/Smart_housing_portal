@extends('Layout.home')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('register.show') }}" class="text-decoration-none text-secondary d-flex align-items-center fw-semibold">
            <i class="bi bi-arrow-left-circle me-2"></i> Back to Register
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="text-center mb-4">
                    <div class="bg-success bg-gradient text-white rounded-circle d-flex justify-content-center align-items-center mx-auto mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-person-check-fill fs-2"></i>
                    </div>
                    <h3 class="fw-bold mb-1">Landlord Registration</h3>
                    <p class="text-muted mb-0">Create your landlord account to manage your properties.</p>
                </div>
                <form method="POST" action="">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required autofocus>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your preferred username" required autofocus>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label fw-semibold">Company/Business Name <span class="text-muted small">(optional)</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-building"></i></span>
                            <input type="text" class="form-control" id="company" name="company" placeholder="Enter your company or business name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label fw-semibold">Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="occupation" class="form-label fw-semibold">Occupation</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-briefcase"></i></span>
                            <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Your occupation" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label fw-semibold">Date of Birth</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-calendar-date"></i></span>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label fw-semibold">City</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-geo"></i></span>
                                <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label fw-semibold">State</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-flag"></i></span>
                                <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label fw-semibold">Country</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-flag"></i></span>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Country" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-telephone"></i></span>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="id_number" class="form-label fw-semibold">National ID/Verification Number</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-card-checklist"></i></span>
                            <input type="text" class="form-control" id="id_number" name="id_number" placeholder="Enter your ID or verification number" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="properties_count" class="form-label fw-semibold">How many properties do you own/manage?</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-houses"></i></span>
                            <input type="number" min="1" class="form-control" id="properties_count" name="properties_count" placeholder="Number of properties" required>
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
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="profile_photo" class="form-label fw-semibold">Profile Photo <span class="text-muted small">(optional)</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-image"></i></span>
                            <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept="image/*">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100 py-2 fw-bold mt-2">
                        <i class="bi bi-person-plus me-1"></i> Register as Landlord
                    </button>
                </form>
                <div class="text-center mt-3">
                    <small class="text-muted">Already have an account? <a href="" class="text-success fw-semibold">Login</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
