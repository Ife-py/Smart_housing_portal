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
            background: #ffffff;
            min-height: 100vh;
            padding: 1.5rem 1rem;
            border-right: 1px solid #e5e7eb;
            font-size: 0.95rem;
        }

        .sidebar .sidebar-header {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #198754;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sidebar .nav-section {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #6c757d;
            font-weight: 600;
            margin: 1rem 0 0.5rem 0.75rem;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 6px;
            color: #374151;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar a i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar a:hover {
            background: #f0fdf4;
            color: #198754;
            text-decoration: none;
            transform: translateX(3px);
        }

        .sidebar a.active {
            background: #e9f5ee;
            border-left: 4px solid #198754;
            color: #198754;
            font-weight: 600;
            padding-left: 18px;
        }

        .sidebar a.logout {
            margin-top: 2rem;
            color: #dc3545;
            font-weight: 600;
        }

        .sidebar a.logout:hover {
            background: #f8d7da;
            color: #dc3545;
            transform: translateX(3px);
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
            box-shadow: 0 2px 16px 0 rgba(44, 62, 80, 0.07);
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
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas"
                aria-controls="sidebarOffcanvas" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex align-items-center">
                <span class="profile-name fw-semibold me-2">{{ Auth::user()->name ?? 'Landlord' }}</span>
                <img src="{{ Auth::user()->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Landlord') }}"
                    alt="Profile" class="profile-img">
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Offcanvas Sidebar for mobile -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarOffcanvas"
                aria-labelledby="sidebarOffcanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarOffcanvasLabel"><i class="fa-solid fa-house-user me-2"></i>
                        Landlord</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                    <nav class="sidebar">
                        <a href="{{ route('dashboard.landlord.index') }}"
                            class="{{ request()->routeIs('landlord.dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-gauge"></i> Dashboard
                        </a>
                        <a href="{{ route('dashboard.landlord.properties.index') }}"
                            class="{{ request()->routeIs('landlord.properties') ? 'active' : '' }}">
                            <i class="fa-solid fa-building"></i> Manage Properties
                        </a>
                        <a href="{{ route('dashboard.landlord.tenants.index') }}"
                            class="{{ request()->routeIs('landlord.tenants') ? 'active' : '' }}">
                            <i class="fa-solid fa-users"></i> Tenants
                        </a>
                        <a href="{{ route('dashboard.landlord.complaints.index') }}"
                            class="{{ request()->routeIs('landlord.complaints') ? 'active' : '' }}">
                            <i class="fa-solid fa-triangle-exclamation"></i> Complaints
                        </a>
                        <a href="{{ route('dashboard.landlord.settings.index') }}"
                            class="{{ request()->routeIs('landlord.settings') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>
                        <a href=""
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('dashboard.landlord.logout') }}" method="POST"
                            class="d-none">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </nav>
                </div>
            </div>
            <!-- Desktop Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-header text-center">
                    <i class="fa-solid fa-house-user me-2"></i> Landlord
                </div>

                <div class="nav-section">Main</div>
                <a href="{{ route('dashboard.landlord.index') }}"
                    class="{{ request()->routeIs('landlord.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge"></i> Dashboard
                </a>

                <div class="nav-section">Properties</div>
                <a href="{{ route('dashboard.landlord.properties.index') }}"
                    class="{{ request()->routeIs('landlord.properties') ? 'active' : '' }}">
                    <i class="fa-solid fa-building"></i> Manage Properties
                </a>

                <div class="nav-section">Management</div>
                <a href="{{ route('dashboard.landlord.tenants.index') }}"
                    class="{{ request()->routeIs('landlord.tenants') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Tenants
                </a>
                <a href="{{ route('dashboard.landlord.complaints.index') }}"
                    class="{{ request()->routeIs('landlord.complaints') ? 'active' : '' }}">
                    <i class="fa-solid fa-triangle-exclamation"></i> Complaints
                </a>

                <div class="nav-section">Settings</div>
                <a href="{{ route('dashboard.landlord.settings.index') }}"
                    class="{{ request()->routeIs('landlord.settings') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear"></i> Settings
                </a>
                <li class="nav-item mb-1">
                        <a class="nav-link @if(request()->routeIs('landlord.profile')) active @endif" href="{{ route('dashboard.landlord.profile.index') }}">
                            <i class="fa-solid fa-user"></i> Profile Details
                        </a>
                </li>

                <a href="" class="logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('dashboard.landlord.logout') }}" method="POST" class="d-none">
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
