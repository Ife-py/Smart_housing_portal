<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tenant Panel | Smart Housing Portal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8fafc;
        }
        .navbar {
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }
        .sidebar {
            background: #f1f5f9;
            min-height: 100vh;
            border-right: 1px solid #e5e7eb;
        }
        .sidebar .nav-link {
            color: #334155;
            font-weight: 500;
            border-radius: 6px;
            margin-bottom: 6px;
            transition: background 0.18s, color 0.18s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #e0e7ef;
            color: #0d6efd;
        }
        .sidebar .nav-link i {
            width: 22px;
        }
        .profile-img {
            width: 38px;
            height: 38px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #e5e7eb;
            margin-left: 10px;
        }
        @media (max-width: 991.98px) {
            .sidebar {
                min-height: auto;
                border-right: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard.tenant.index') }}">
                <i class="fa-solid fa-shield-halved me-2 text-primary"></i> Tenant Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item dropdown me-2">
                        @php
                            $tenantId = Auth::guard('tenant')->id() ?? Auth::id();
                            try {
                                $unreadCount = \App\Models\Application::where('tenant_id', $tenantId)->where('status', 'pending')->count();
                                $preview = \App\Models\Application::where('tenant_id', $tenantId)->where('status', 'pending')->latest()->limit(3)->get();
                            } catch (\Exception $e) {
                                $unreadCount = 0;
                                $preview = collect();
                            }
                        @endphp

                        <a class="nav-link dropdown-toggle position-relative" href="#" id="tenantNotificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bell" style="font-size:1.2rem;color:#607d8b"></i>
                            @if($unreadCount > 0)
                                <span class="badge bg-danger position-absolute" style="top:6px;right:6px;font-size:0.65rem">{{ $unreadCount }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow dropdown-menu-notifications" aria-labelledby="tenantNotificationDropdown" style="min-width:320px;">
                            <li class="dropdown-header fw-bold">Notifications</li>
                            @if($preview->isEmpty())
                                <li class="dropdown-item text-muted">No new notifications</li>
                            @else
                                @foreach($preview as $app)
                                    <li class="dropdown-item d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fw-semibold">{{ $app->property->title ?? 'Property' }}</div>
                                            <div class="small text-muted">{{ Str::limit($app->message, 60) }}</div>
                                            <div class="small text-muted">{{ $app->created_at->diffForHumans() }}</div>
                                        </div>
                                        <div class="ms-2">
                                            <a href="{{ route('dashboard.tenant.notifications.index') }}" class="btn btn-sm btn-outline-primary">Open</a>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center text-muted" href="{{ route('dashboard.tenant.notifications.index') }}">View all notifications</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link fw-semibold">{{ Auth::user()->name ?? 'Tenant' }}</span>
                    </li>
                    <li class="nav-item">
                        <img src="{{ Auth::user()->profile_photo ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'Admin') }}" alt="Profile" class="profile-img">
                    </li>
                    <li class="nav-item ms-3">
                        <form method="POST" action="{{ route('dashboard.tenant.logout') }}">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Layout -->
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Sidebar -->
            <nav class="col-lg-2 col-md-3 d-none d-md-block sidebar py-4 px-2">
                <ul class="nav flex-column">
                    <li class="nav-item mb-1">
                        <a class="nav-link @if(request()->routeIs('tenant.dashboard')) active @endif" href="{{ route('dashboard.tenant.index') }}">
                            <i class="fa-solid fa-gauge"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link @if(request()->routeIs('tenant.properties')) active @endif" href="{{ route('dashboard.tenant.my_properties.index') }}">
                            <i class="fa-solid fa-building"></i> My Properties
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link @if(request()->routeIs('tenant.payments')) active @endif" href="{{ route('dashboard.tenant.payments.index') }}">
                            <i class="fa-solid fa-credit-card"></i> Payments
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link @if(request()->routeIs('tenant.complaints')) active @endif" href="{{ route('dashboard.tenant.complaints.index') }}">
                            <i class="fa-solid fa-triangle-exclamation"></i> Complaints
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link @if(request()->routeIs('tenant.profile')) active @endif" href="{{ route('dashboard.tenant.profile.index') }}">
                            <i class="fa-solid fa-user"></i> Profile Details
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link @if(request()->routeIs('tenant.settings')) active @endif" href="{{ route('dashboard.tenant.settings.index') }}">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Responsive Sidebar for Mobile -->
            <nav class="col-12 d-md-none sidebar py-2 px-2 mb-3">
                <ul class="nav flex-row justify-content-around">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('tenant.dashboard')) active @endif" href="{{ route('dashboard.tenant.index') }}">
                            <i class="fa-solid fa-gauge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('tenant.properties')) active @endif" href="{{ route('dashboard.tenant.my_properties.index') }}">
                           <i class="fa-solid fa-building"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('tenant.payments')) active @endif" href="{{ route('dashboard.tenant.payments.index') }}">
                            <i class="fa-solid fa-credit-card"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('tenant.complaints')) active @endif" href="{{ route('dashboard.tenant.complaints.index') }}">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('tenant.settings')) active @endif" href="{{ route('dashboard.tenant.settings.index') }}">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Main Content -->
            <main class="col px-0 py-4">
                <div class="container">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>



