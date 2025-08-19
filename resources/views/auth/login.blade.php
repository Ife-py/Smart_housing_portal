@extends('Layout.home')

@section('content')
<style>
    .login-card {
        max-width: 420px;
        margin: 3rem auto;
        border-radius: 1.2rem;
        background: #fff;
        box-shadow: 0 2px 16px 0 rgba(37,117,252,0.07);
        padding: 2.5rem 2rem 2rem 2rem;
    }
    .social-btn {
        width: 100%;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
</style>

<div class="login-card">
    <h3 class="fw-bold text-center text-info mb-4">Sign In to Your Account</h3>
    <form method="POST" action="">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
        </div>
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <a href="" class="small text-info">Forgot Password?</a>
        </div>
        <button type="submit" class="btn btn-info w-100 mb-3">Login</button>
    </form>
    <!-- Social login options removed for simplicity -->
    <div class="text-center mt-3">
        <span class="text-muted">Don't have an account?</span>
        <a href="{{ route('register.show') }}" class="text-info">Register</a>
    </div>
</div>

@endsection
<div>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
</div>
