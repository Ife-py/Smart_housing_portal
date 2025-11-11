<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Housing Portal | Admin Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            background-color: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            max-width: 900px;
            width: 100%;
        }

        .login-image {
            background: url('https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=900&q=80') center center/cover no-repeat;
            flex: 1;
        }

        .login-form {
            flex: 1;
            padding: 50px 40px;
        }

        .login-form h3 {
            font-weight: 700;
            color: #0d6efd;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            font-weight: 600;
            border-radius: 10px;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .alert {
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .login-image {
                display: none;
            }

            .login-form {
                padding: 40px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-image"></div>

        <div class="login-form">
            <h3>Admin Login</h3>
            <p class="text-muted text-center mb-4">Sign in to manage the Smart Housing Portal</p>

            @if ($errors->any())
                <div class="alert alert-danger text-center">{{ $errors->first('login') }}</div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control form-control-lg" required
                        placeholder="Enter admin username">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" required
                        placeholder="Enter admin password">
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 mt-2">Login</button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">© {{ date('Y') }} Smart Housing Portal</small>
            </div>
        </div>
    </div>
</body>

</html>
