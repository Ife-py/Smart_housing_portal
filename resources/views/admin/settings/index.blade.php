@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-4">Admin Settings</h2>
    <div class="row g-4">
        <!-- Profile Settings -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent fw-bold">Profile Information</div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="adminName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="adminName" value="Admin Name">
                        </div>
                        <div class="mb-3">
                            <label for="adminEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="adminEmail" value="admin@example.com">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Password Settings -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent fw-bold">Change Password</div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword">
                        </div>
                        <button type="submit" class="btn btn-warning">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <!-- Notification Settings -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent fw-bold">Notification Preferences</div>
                <div class="card-body">
                    <form>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                            <label class="form-check-label" for="emailNotif">Email Notifications</label>
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="smsNotif">
                            <label class="form-check-label" for="smsNotif">SMS Notifications</label>
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="pushNotif" checked>
                            <label class="form-check-label" for="pushNotif">Push Notifications</label>
                        </div>
                        <button type="submit" class="btn btn-info">Save Preferences</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Portal Settings -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent fw-bold">Portal Settings</div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="portalName" class="form-label">Portal Name</label>
                            <input type="text" class="form-control" id="portalName" value="Smart Housing Portal">
                        </div>
                        <div class="mb-3">
                            <label for="portalStatus" class="form-label">Portal Status</label>
                            <select class="form-select" id="portalStatus">
                                <option selected>Active</option>
                                <option>Maintenance</option>
                                <option>Closed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-secondary">Update Portal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
