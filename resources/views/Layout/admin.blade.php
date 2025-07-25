<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Smart Housing Portal</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .sidebar {
            height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #e3e6ec;
            padding-top: 60px;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            transition: all 0.3s;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
        }

        .sidebar .nav-link {
            color: #495057;
            font-weight: 500;
            padding: 12px 20px;
            transition: all 0.2s;
            border-radius: 4px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #e8f0fe;
            color: #0d6efd;
        }

        .main-content {
            margin-left: 250px;
            padding: 80px 30px 30px 30px;
        }

        .navbar {
            z-index: 1030;
            background-color: #ffffff !important;
            border-bottom: 1px solid #e3e6ec;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        }

        .navbar-brand {
            font-weight: 600;
            color: #0d6efd !important;
        }

        .logout-btn {
            color: #dc3545;
            font-weight: 500;
        }

        .icon {
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.index') }}">Smart Housing Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="adminNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form method="POST" action="">
                            @csrf
                            <button class="btn btn-link nav-link logout-btn" type="submit">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3">
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
            <a href="{{ route('admin.index') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 icon"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users') }}"
                    class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="bi bi-people icon"></i> Manage Users
                </a>
            </li>
            <li>
                <a href="{{ route('admin.landlords') }}"
                    class="nav-link {{ request()->routeIs('admin.landlords') ? 'active' : '' }}">
                    <i class="bi bi-building icon"></i> Landlords
                </a>
            </li>
            <li>
                <a href="{{ route('admin.tenants') }}"
                    class="nav-link {{ request()->routeIs('admin.tenants') ? 'active' : '' }}">
                    <i class="bi bi-house-door icon"></i> Tenants
                </a>
            </li>
            <li>
                <a href=""
                    class="nav-link {{ request()->routeIs('admin.properties') ? 'active' : '' }}">
                    <i class="bi bi-house icon"></i> Properties
                </a>
            </li>
            <li>
                <a href=""
                    class="nav-link {{ request()->routeIs('admin.complaints') ? 'active' : '' }}">
                    <i class="bi bi-exclamation-triangle icon"></i> Complaints
                </a>
            </li>
            <li>
                <a href=""
                    class="nav-link {{ request()->routeIs('admin.payments') ? 'active' : '' }}">
                    <i class="bi bi-credit-card icon"></i> Payments
                </a>
            </li>
            <li>
                <a href=""
                    class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                    <i class="bi bi-graph-up icon"></i> Reports
                </a>
            </li>
            <li>
                <a href=""
                    class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="bi bi-gear icon"></i> Settings
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
