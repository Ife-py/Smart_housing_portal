@extends('Layout.home')


@section('content')
	<!-- Hero Section -->
	<section class="hero-section stylish-hero d-flex align-items-center justify-content-center mb-5 position-relative" style="min-height: 480px;">
		<div class="hero-bg position-absolute top-0 start-0 w-100 h-100" style="background: url('https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=1200&q=80') center center/cover no-repeat; z-index: 1;"></div>
		<div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(30, 41, 59, 0.65); z-index: 2;"></div>
		<div class="container position-relative z-3 text-center text-white py-5">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<h1 class="display-2 fw-bold mb-3" style="text-shadow: 0 4px 24px rgba(0,0,0,0.4); letter-spacing: -2px;">Find Your Next Home Effortlessly</h1>
					<p class="lead mb-4 fs-4" style="text-shadow: 0 2px 8px rgba(0,0,0,0.25);">Smart Housing Portal connects tenants and landlords for a seamless, secure, and modern housing experience.</p>
					<div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
						<a href="{{ route('register.show') }}" class="btn btn-lg btn-primary px-5 shadow">Get Started</a>
						<a href="#recent-properties" class="btn btn-lg btn-outline-light px-5 shadow">View Properties</a>
					</div>
					<div class="d-flex flex-wrap justify-content-center gap-4 mt-4">
						<div class="bg-white bg-opacity-25 rounded-4 px-4 py-2 d-inline-flex align-items-center shadow-sm">
							<i class="bi bi-house-door-fill fs-3 me-2 text-warning"></i>
							<span class="fw-semibold">Verified Listings</span>
						</div>
						<div class="bg-white bg-opacity-25 rounded-4 px-4 py-2 d-inline-flex align-items-center shadow-sm">
							<i class="bi bi-shield-lock-fill fs-3 me-2 text-info"></i>
							<span class="fw-semibold">Secure Transactions</span>
						</div>
						<div class="bg-white bg-opacity-25 rounded-4 px-4 py-2 d-inline-flex align-items-center shadow-sm">
							<i class="bi bi-people-fill fs-3 me-2 text-success"></i>
							<span class="fw-semibold">Trusted Community</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Recent Properties Section -->
	<style>
		.property-card {
			transition: transform 0.25s cubic-bezier(.4,2,.6,1), box-shadow 0.25s cubic-bezier(.4,2,.6,1);
			border-radius: 1.2rem;
			overflow: hidden;
			background: #fff;
		}
		.property-card:hover {
			transform: translateY(-10px) scale(1.03);
			box-shadow: 0 8px 32px rgba(37,117,252,0.18), 0 2px 8px rgba(0,0,0,0.10);
			z-index: 2;
		}
		.property-card .card-img-top {
			border-radius: 1.2rem 1.2rem 0 0;
			transition: filter 0.3s;
		}
		.property-card:hover .card-img-top {
			filter: brightness(0.92) saturate(1.2);
		}
		.property-card .card-title {
			font-size: 1.1rem;
			font-weight: 600;
		}
		.property-card .btn {
			border-radius: 2rem;
		}

		/* Feature cards hover */
		#features .card {
			transition: transform 0.22s cubic-bezier(.4,2,.6,1), box-shadow 0.22s cubic-bezier(.4,2,.6,1);
		}
		#features .card:hover {
			transform: translateY(-8px) scale(1.03);
			box-shadow: 0 6px 24px rgba(37,117,252,0.13), 0 1px 4px rgba(0,0,0,0.08);
		}

		/* Testimonials hover */
		.testimonial-card {
			transition: transform 0.22s cubic-bezier(.4,2,.6,1), box-shadow 0.22s cubic-bezier(.4,2,.6,1);
		}
		.testimonial-card:hover {
			transform: translateY(-6px) scale(1.02);
			box-shadow: 0 4px 18px rgba(37,117,252,0.10), 0 1px 4px rgba(0,0,0,0.07);
		}

		/* Landlord CTA button hover */
		.landlord-cta-btn {
			transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
		}
		.landlord-cta-btn:hover {
			background: #198754 !important;
			box-shadow: 0 4px 18px rgba(25,135,84,0.18);
			transform: translateY(-2px) scale(1.04);
		}
	</style>
	<section id="recent-properties" class="mb-5">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center mb-4">
				<h2 class="fw-bold mb-0"><i class="bi bi-building me-2 text-primary"></i>Recent Listings</h2>
				<a href="{{ route('home.properties') }}" class="btn btn-outline-primary btn-sm">Browse All Properties</a>
			</div>
			<div class="row g-4">
				@foreach ([
					[
						'title' => 'Modern 2 Bedroom Apartment',
						'location' => 'Lekki, Lagos',
						'price' => '₦1,200,000/year',
						'img' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=400&q=80',
					],
					[
						'title' => 'Cozy Studio Flat',
						'location' => 'Ikeja, Lagos',
						'price' => '₦600,000/year',
						'img' => 'https://images.unsplash.com/photo-1507089947368-19c1da9775ae?auto=format&fit=crop&w=400&q=80',
					],
					[
						'title' => 'Luxury Duplex',
						'location' => 'Abuja, FCT',
						'price' => '₦3,500,000/year',
						'img' => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=400&q=80',
					],
					[
						'title' => 'Family Bungalow',
						'location' => 'Port Harcourt, Rivers',
						'price' => '₦2,000,000/year',
						'img' => 'https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=400&q=80',
					],
				] as $property)
				<div class="col-md-6 col-lg-3">
					<div class="card h-100 shadow-sm border-0 property-card">
						<img src="{{ $property['img'] }}" class="card-img-top" alt="{{ $property['title'] }}" style="height: 180px; object-fit: cover;">
						<div class="card-body">
							<h5 class="card-title mb-1">{{ $property['title'] }}</h5>
							<div class="text-muted small mb-2"><i class="bi bi-geo-alt-fill me-1"></i>{{ $property['location'] }}</div>
							<div class="fw-semibold text-primary mb-2">{{ $property['price'] }}</div>
							<a href="#" class="btn btn-outline-primary btn-sm w-100">View Details</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>


	<!-- Features Section -->
	<section id="features" class="mb-5">
		<div class="container">
			<div class="row g-4">
				<div class="col-md-4">
					<div class="card h-100 shadow-sm border-0">
						<div class="card-body text-center">
							<i class="bi bi-house-door-fill display-4 text-primary mb-3"></i>
							<h5 class="card-title">Browse Properties</h5>
							<p class="card-text">Explore a wide range of available houses and apartments tailored to your needs and budget.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card h-100 shadow-sm border-0">
						<div class="card-body text-center">
							<i class="bi bi-person-badge-fill display-4 text-success mb-3"></i>
							<h5 class="card-title">Landlord & Tenant Accounts</h5>
							<p class="card-text">Register as a landlord to manage your properties or as a tenant to find and rent your next home.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card h-100 shadow-sm border-0">
						<div class="card-body text-center">
							<i class="bi bi-shield-check display-4 text-info mb-3"></i>
							<h5 class="card-title">Secure & Reliable</h5>
							<p class="card-text">Your data and transactions are protected with industry-standard security and privacy measures.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- How It Works Section -->
	<section class="mb-5">
		<div class="container">
			<h2 class="text-center mb-4">How It Works</h2>
			<div class="row g-4 align-items-center">
				<div class="col-md-6">
					<ul class="list-group list-group-flush fs-5">
						<li class="list-group-item"><i class="bi bi-check-circle-fill text-primary me-2"></i>Sign up as a tenant or landlord</li>
						<li class="list-group-item"><i class="bi bi-check-circle-fill text-primary me-2"></i>Browse or list properties</li>
						<li class="list-group-item"><i class="bi bi-check-circle-fill text-primary me-2"></i>Connect, communicate, and manage your housing needs</li>
						<li class="list-group-item"><i class="bi bi-check-circle-fill text-primary me-2"></i>Enjoy a seamless and secure experience</li>
					</ul>
				</div>
				<div class="col-md-6 text-center">
					<img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Smart Housing" class="img-fluid rounded shadow">
				</div>
			</div>
		</div>
	</section>

	<!-- Testimonials Section -->
	<section class="mb-5">
		<div class="container">
			<h2 class="text-center mb-4">What Our Users Say</h2>
			<div class="row g-4 justify-content-center">
				<div class="col-md-4">
					<div class="card border-0 shadow-sm h-100 testimonial-card">
						<div class="card-body">
							<div class="d-flex align-items-center mb-3">
								<img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-3" width="48" height="48" alt="User">
								<div>
									<div class="fw-bold">Emeka O.</div>
									<div class="text-muted small">Tenant, Lagos</div>
								</div>
							</div>
							<p class="mb-0">“I found my dream apartment in just a few days. The process was smooth and the listings were genuine!”</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card border-0 shadow-sm h-100 testimonial-card">
						<div class="card-body">
							<div class="d-flex align-items-center mb-3">
								<img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-3" width="48" height="48" alt="User">
								<div>
									<div class="fw-bold">Aisha B.</div>
									<div class="text-muted small">Landlord, Abuja</div>
								</div>
							</div>
							<p class="mb-0">“Managing my properties has never been easier. I get quality tenants and fast payments!”</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card border-0 shadow-sm h-100 testimonial-card">
						<div class="card-body">
							<div class="d-flex align-items-center mb-3">
								<img src="https://randomuser.me/api/portraits/men/65.jpg" class="rounded-circle me-3" width="48" height="48" alt="User">
								<div>
									<div class="fw-bold">Chinedu K.</div>
									<div class="text-muted small">Tenant, Port Harcourt</div>
								</div>
							</div>
							<p class="mb-0">“The support team is responsive and helpful. I recommend Smart Housing to all my friends.”</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Landlord CTA Section -->
	<section class="mb-5 py-5 bg-light rounded-4 shadow-sm">
		<div class="container text-center">
			<h2 class="fw-bold mb-3">Are You a Landlord?</h2>
			<p class="lead mb-4">List your properties for free and connect with verified tenants. Enjoy easy management, secure payments, and dedicated support.</p>
			<a href="" class="btn btn-success btn-lg px-5 landlord-cta-btn">List Your Property</a>
		</div>
	</section>

	<!-- FAQ Section -->
	<section class="mb-5">
		<div class="container">
			<h2 class="text-center mb-4">Frequently Asked Questions</h2>
			<div class="accordion accordion-flush" id="faqAccordion">
				<div class="accordion-item">
					<h2 class="accordion-header" id="faq1">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1">
							How do I register as a tenant or landlord?
						</button>
					</h2>
					<div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
						<div class="accordion-body">
							Click the “Get Started” button at the top of the page and choose your account type to begin registration.
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header" id="faq2">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
							Are the property listings verified?
						</button>
					</h2>
					<div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
						<div class="accordion-body">
							Yes, all listings are reviewed and verified by our team before they appear on the portal.
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header" id="faq3">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
							How do I contact support?
						</button>
					</h2>
					<div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
						<div class="accordion-body">
							You can reach our support team via the Contact page or by emailing support@smarthousing.com.
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection