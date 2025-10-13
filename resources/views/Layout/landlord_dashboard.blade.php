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
            box-shadow: 0 4px 24px rgba(44, 62, 80, 0.07);
            border-bottom: 1px solid #e3e8ee;
        }

        .navbar-brand {
            font-weight: 700;
            color: #198754 !important;
            letter-spacing: 1px;
        }

        .navbar .nav-link,
        .navbar .dropdown-toggle {
            color: #4e5d6c !important;
            font-weight: 500;
            font-size: 1.05rem;
        }

        .navbar .nav-link:hover,
        .navbar .dropdown-toggle:hover {
            color: #00bcd4 !important;
        }

        .notification-bell {
            position: relative;
            font-size: 1.35rem;
            color: #607d8b;
            cursor: pointer;
        }

        .notification-bell .badge {
            position: absolute;
            top: -6px;
            right: -8px;
            font-size: 0.7rem;
            background: #ff5252;
            color: #fff;
        }

        .dropdown-menu-notifications {
            min-width: 320px;
            max-width: 350px;
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
            <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard.landlord.index') }}">
                <i class="fa-solid fa-house-user me-2"></i> Smart Housing Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas"
                aria-controls="sidebarOffcanvas" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex align-items-center">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item dropdown">
                        @php
                            $landlordId = Auth::guard('landlord')->id() ?? Auth::id();
                            // unresolved applications: pending or accepted (landlord attention)
                            $attentionApps = \App\Models\Application::where('landlord_id', $landlordId)
                                ->whereIn('status', ['pending', 'accepted'])
                                ->where('is_read_by_landlord', false)
                                ->orderBy('created_at', 'desc')
                                ->get();

                            // unresolved complaints: status != resolved and unread by landlord
                            $openComplaints = \App\Models\Complaint::where('landlord_id', $landlordId)
                                ->where('status', '!=', 'resolved')
                                ->where('is_read_by_landlord', false)
                                ->orderBy('created_at', 'desc')
                                ->get();

                            // count items that require attention
                            $unreadCount = $attentionApps->count() + $openComplaints->count();

                            // prepare preview (top 3 recent items)
                            $unreadItems = $attentionApps
                                ->concat($openComplaints)
                                ->sortByDesc('created_at')
                                ->values()
                                ->take(3);
                        @endphp

                        <a class="nav-link notification-bell" href="#" id="notificationDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bell"></i>
                            @if ($unreadCount > 0)
                                <span class="badge">{{ $unreadCount }}</span>
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-notifications shadow"
                            aria-labelledby="notificationDropdown">
                            <li class="dropdown-header fw-bold">Notifications</li>
                            @if ($unreadItems->isEmpty())
                                <li>
                                    <div class="dropdown-item text-muted">No new notifications</div>
                                </li>
                            @else
                                @foreach ($unreadItems as $item)
                                    @if (isset($item->subject) && isset($item->description))
                                        {{-- complaint --}}
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.landlord.complaints.show', $item->id) }}">
                                                <i class="fa fa-triangle-exclamation text-danger me-2"></i>
                                                {{ \Illuminate\Support\Str::limit($item->subject, 60) }}
                                                <div class="small text-muted">Complaint •
                                                    {{ optional($item->property)->title ?? 'Property' }}</div>
                                            </a>
                                        </li>
                                    @else
                                        {{-- application --}}
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.landlord.application.show', $item->id) }}">
                                                <i class="fa fa-envelope text-primary me-2"></i>
                                                {{ optional($item->tenant)->name ?? 'Applicant' }} •
                                                {{ optional($item->property)->title ?? 'Property' }}
                                                <div class="small text-muted">Status: {{ ucfirst($item->status) }}</div>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-center text-muted"
                                    href="{{ route('dashboard.landlord.notifications.index') }}">View all
                                    notifications</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-3">
                        <span class="profile-name fw-semibold me-2">{{ Auth::user()->name ?? 'Landlord' }}</span>
                    </li>
                    <li class="nav-item">
                        <img src="{{ Auth::user()->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Landlord') }}"
                            alt="Profile" class="profile-img">
                    </li>
                </ul>
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
                        <a href="{{ route('dashboard.landlord.payments.index') }}"
                            class="{{ request()->routeIs('landlord.payment') ? 'active' : '' }}">
                            <i class="fa-solid fa-credit-card"></i> Payment
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
                <a href="{{ route('dashboard.landlord.payments.index') }}"
                    class="{{ request()->routeIs('landlord.payment') ? 'active' : '' }}">
                    <i class="fa-solid fa-credit-card"></i> Payment
                </a>

                <div class="nav-section">Settings</div>
                <a href="{{ route('dashboard.landlord.settings.index') }}"
                    class="{{ request()->routeIs('landlord.settings') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear"></i> Settings
                </a>
                <li class="nav-item mb-1">
                    <a class="nav-link @if (request()->routeIs('landlord.profile')) active @endif"
                        href="{{ route('dashboard.landlord.profile.index') }}">
                        <i class="fa-solid fa-user"></i> Profile Details
                    </a>
                </li>

                <a href="" class="logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('dashboard.landlord.logout') }}" method="POST"
                    class="d-none">
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
</body>

</html>
