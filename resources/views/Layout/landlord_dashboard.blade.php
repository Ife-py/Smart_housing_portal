<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Landlord Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8fafc;
            min-height: 100vh;
        }
        .navbar {
            background: #fff;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.07);
        }
        .navbar .navbar-brand,
        .navbar .profile-name {
            color: #198754 !important;
        }
        .sidebar {
            background: #f4f6fb;
            color: #22223b;
            min-height: 100vh;
            padding-top: 2rem;
            border-right: 1px solid #e5e7eb;
        }
        .sidebar .sidebar-header {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #198754;
        }
        .sidebar a {
            color: #22223b;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 18px;
            border-radius: 6px;
            margin-bottom: 6px;
            font-size: 1.05rem;
            font-weight: 500;
            transition: background 0.18s, color 0.18s;
        }
        .sidebar a.active, .sidebar a:hover {
            background: #e9f5ee;
            color: #198754;
            text-decoration: none;
        }
        .sidebar a:last-child {
            margin-top: 2rem;
            color: #dc3545;
        }
        .sidebar a:last-child:hover {
            background: #f8d7da;
            color: #dc3545;
        }
        .content-wrapper {
            padding: 40px 30px 30px 30px;
            min-height: 100vh;
            background: transparent;
        }
        .card {
            border: none;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 2px 16px 0 rgba(44,62,80,0.07);
        }
        .profile-img {
            width: 38px;
            height: 38px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #198754;
            margin-left: 10px;
        }
        @media (max-width: 991.98px) {
            .sidebar {
                min-height: 100vh;
                padding-top: 2rem;
                border-right: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="fa-solid fa-house-user me-2"></i> Smart Housing Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex align-items-center">
                <span class="profile-name fw-semibold me-2">{{ Auth::user()->name ?? 'Landlord' }}</span>
                <img src="{{ Auth::user()->profile_photo ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'Landlord') }}" alt="Profile" class="profile-img">
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Offcanvas Sidebar for mobile -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarOffcanvasLabel"><i class="fa-solid fa-house-user me-2"></i> Landlord</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                    <nav class="sidebar">
                        <a href="{{ route('dashboard.landlord.index') }}" class="{{ request()->routeIs('landlord.dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-gauge"></i> Dashboard
                        </a>
                        <a href="{{ route('dashboard.landlord.properties.index') }}" class="{{ request()->routeIs('landlord.properties') ? 'active' : '' }}">
                            <i class="fa-solid fa-building"></i> Manage Properties
                        </a>
                        <a href="{{ route('dashboard.landlord.tenants.index') }}" class="{{ request()->routeIs('landlord.tenants') ? 'active' : '' }}">
                            <i class="fa-solid fa-users"></i> Tenants
                        </a>
                        <a href="{{ route('dashboard.landlord.complaints.index') }}" class="{{ request()->routeIs('landlord.complaints') ? 'active' : '' }}">
                            <i class="fa-solid fa-triangle-exclamation"></i> Complaints
                        </a>
                        <a href="{{ route('dashboard.landlord.settings.index') }}" class="{{ request()->routeIs('landlord.settings') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>
                        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                        <form id="logout-form" action="" method="POST" class="d-none">
                            @csrf
                        </form>
                    </nav>
                </div>
            </div>
            <!-- Desktop Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-header text-center mb-4">
                    <i class="fa-solid fa-house-user me-2"></i> Landlord
                </div>
                <a href="{{ route('dashboard.landlord.index') }}" class="{{ request()->routeIs('landlord.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge"></i> Dashboard
                </a>
                <a href="{{ route('dashboard.landlord.properties.index') }}" class="{{ request()->routeIs('landlord.properties') ? 'active' : '' }}">
                    <i class="fa-solid fa-building"></i> Manage Properties
                </a>
                <a href="{{ route('dashboard.landlord.tenants.index') }}" class="{{ request()->routeIs('landlord.tenants') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Tenants
                </a>
                <a href="{{ route('dashboard.landlord.complaints.index') }}" class="{{ request()->routeIs('landlord.complaints') ? 'active' : '' }}">
                    <i class="fa-solid fa-triangle-exclamation"></i> Complaints
                </a>
                <a href="{{ route('dashboard.landlord.settings.index') }}" class="{{ request()->routeIs('landlord.settings') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear"></i> Settings
                </a>
                <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
                <form id="logout-form" action="" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
            <main class="col-md-10 ms-sm-auto col-lg-10 content-wrapper">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body