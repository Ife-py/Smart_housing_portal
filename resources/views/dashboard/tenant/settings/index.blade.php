@extends('Layout.tenant_dashboard')

@section('content')
<style>
	.settings-card {
		border-radius: 1.2rem;
		background: #fff;
		box-shadow: 0 2px 16px 0 rgba(37,117,252,0.07);
		transition: box-shadow 0.18s, transform 0.18s;
	}
	.settings-card:hover {
		transform: translateY(-4px) scale(1.01);
		box-shadow: 0 8px 32px rgba(37,117,252,0.13), 0 2px 8px rgba(0,0,0,0.10);
	}
</style>

<h2 class="fw-bold text-info mb-4"><i class="fa-solid fa-gear me-2"></i> Account Settings</h2>

<div class="row g-4">
	<div class="col-lg-6">
		<div class="settings-card p-4 mb-3">
			<h5 class="mb-3"><i class="fa fa-user-circle me-2"></i> Profile Information</h5>
			<form>
				<div class="mb-3">
					<label class="form-label">Full Name</label>
					<input type="text" class="form-control" value="John Doe">
				</div>
				<div class="mb-3">
					<label class="form-label">Email Address</label>
					<input type="email" class="form-control" value="johndoe@email.com">
				</div>
				<div class="mb-3">
					<label class="form-label">Phone Number</label>
					<input type="text" class="form-control" value="08012345678">
				</div>
				<button type="submit" class="btn btn-info">Update Profile</button>
			</form>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="settings-card p-4 mb-3">
			<h5 class="mb-3"><i class="fa fa-lock me-2"></i> Change Password</h5>
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
				<button type="submit" class="btn btn-info">Change Password</button>
			</form>
		</div>
	</div>
</div>

<div class="settings-card p-4 mb-3 mt-4">
	<h5 class="mb-3"><i class="fa fa-bell me-2"></i> Notification Preferences</h5>
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
			<input class="form-check-input" type="checkbox" id="appNotif" checked>
			<label class="form-check-label" for="appNotif">In-App Notifications</label>
		</div>
		<button type="submit" class="btn btn-info mt-2">Save Preferences</button>
	</form>
</div>

@endsection