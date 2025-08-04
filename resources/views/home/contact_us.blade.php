@extends('Layout.home')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center">
            <h2 class="fw-bold mb-3 text-primary">Contact Us</h2>
            <p class="lead text-muted">Have a question, feedback, or need support? Fill out the form below or reach us directly. We're here to help!</p>
        </div>
    </div>
    <div class="row g-5 align-items-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="#">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-4">
                <h5 class="fw-bold mb-2">Contact Information</h5>
                <p class="mb-1"><i class="bi bi-geo-alt text-primary me-2"></i> 123 Main Street, Lagos, Nigeria</p>
                <p class="mb-1"><i class="bi bi-envelope text-primary me-2"></i> support@smarthousing.com</p>
                <p class="mb-3"><i class="bi bi-telephone text-primary me-2"></i> +234 800 123 4567</p>
                <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden">
                    <iframe src="https://maps.google.com/maps?q=lagos%20nigeria&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection