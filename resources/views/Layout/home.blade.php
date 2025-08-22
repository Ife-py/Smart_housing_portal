<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Housing Portal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
        }

        .nav-link {
            margin-right: 1rem;
        }

        .hero-section {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            padding: 4rem 2rem;
            border-radius: 0 0 20px 20px;
        }

        .footer {
            background: linear-gradient(90deg, #232526 0%, #414345 100%);
            color: #f8f9fa;
            padding: 2.5rem 0 1.2rem 0;
            border-top: none;
        }
        .footer .footer-brand {
            font-weight: bold;
            font-size: 1.3rem;
            color: #fff;
            letter-spacing: 1px;
        }
        .footer .footer-links a {
            color: #b0b3b8;
            margin: 0 0.7rem;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.18s;
        }
        .footer .footer-links a:hover {
            color: #00bcd4;
        }
        .footer .footer-social a {
            color: #b0b3b8;
            margin: 0 0.4rem;
            font-size: 1.3rem;
            transition: color 0.18s;
        }
        .footer .footer-social a:hover {
            color: #00bcd4;
        }
        .footer .footer-bottom {
            color: #b0b3b8;
            font-size: 0.95rem;
            margin-top: 1.2rem;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">Smart Housing</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.properties') }}">Browse Houses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.contact') }}">Contact</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('auth.login') }}">Login</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="btn btn-primary btn-sm" href="{{ route('register.show') }}">Sign Up</a>
                        </li>
                    @else
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="">Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>



    {{-- Content Area --}}
    <main class="container my-5">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer mt-5">
        <div class="container">
            <div class="row align-items-center mb-3">
                <div class="col-md-4 text-md-start mb-3 mb-md-0">
                    <span class="footer-brand">Smart Housing</span>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="footer-links">
                        <a href="{{ route('home.index') }}">Home</a>
                        <a href="{{ route('home.properties') }}">Browse Houses</a>
                        <a href="{{ route('home.contact') }}">Contact</a>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="footer-social">
                        <a href="#" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" title="Twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom text-center">
                &copy; {{ date('Y') }} Smart Housing Portal. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
