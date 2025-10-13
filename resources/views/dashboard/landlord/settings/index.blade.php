@extends('Layout.landlord_dashboard')
@section('content')
    <h2 class="fw-bold text-primary mb-4"><i class="fa-solid fa-gear me-2"></i> Account Settings</h2>

    <div class="row g-4">
        <!-- Profile Update -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header bg-white fw-semibold">Profile Information</div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->phone ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Photo</label>
                            <input type="file" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Password Change -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header bg-white fw-semibold">Change Password</div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Preferences -->
    <div class="card mb-4">
        <div class="card-header bg-white fw-semibold">Notification Preferences</div>
        <div class="card-body">
            <form class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="notif1" checked>
                        <label class="form-check-label" for="notif1">
                            Email me when I receive a new complaint
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="notif2" checked>
                        <label class="form-check-label" for="notif2">
                            Email me when a tenant moves in/out
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="notif3">
                        <label class="form-check-label" for="notif3">
                            Email me about platform updates
                        </label>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-outline-primary">Save Preferences</button>
                </div>
            </form>
        </div>
    </div>
@endsection
