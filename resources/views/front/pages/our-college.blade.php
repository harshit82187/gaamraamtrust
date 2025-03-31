@extends('front.layout.app')

@section('content')
<section class="page-title-section bg-img cover-background top-position1 left-overlay-dark" data-overlay-dark="9" data-background="{{asset('front/img/bg/part.jpg')}}">
	<div class="container">
		<div class="row text-center">
			<div class="col-md-12">
				<h1>Our Associate Institution</h1>
			</div>
			<div class="col-md-12">
				<ul>
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ url()->current() }}">Our College</a></li>
				</ul>
			</div>
		</div>
	</div>
</section>

<!-- login member section -->

<section class="py-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 d-flex py-2">
				<div class="login-section">
					<h4 class="py-3 text-center">Partner with GaamRaam & Transform Education at Zero Cost!</h4>
					<p>GaamRaam NGO is revolutionizing education by bringing free, high-quality coaching for UPSC, SSC, and other competitive exams directly to students’ hometowns. By partnering with us, your institution can become a center of excellence, offering live classes from Mukherjee Nagar’s top educators—all without financial commitment.</p>
					<div class="why-gaamraam">
						<h6>Why Partner with GaamRaam?</h6>
						<ul>
							<li>Live Coaching from Mukherjee Nagar – Direct access to India’s best educators.</li>
							<li>Boost Your Institution’s Reputation – Be known as a premier coaching hub.</li>
							<li>Increase Local Enrollment – Our outreach promotes your institution.</li>
							<li>Zero Cost to You – GaamRaam covers faculty salaries, study materials, and operations.</li>
							<li>Empower Your Community – Keep students close to home while ensuring quality education.</li>
						</ul>
					</div>
				</div>

			</div>
			<div class="col-lg-6 py-2">
				<div class="donate-form member-signup">
					<div class="donation-heading text-center">
						<img src="https://server1.pearl-developer.com/gaamraam/public/front/images/Gaam_Raam_logo.png" alt="GaamRaam Logo">
						<h2>Membership Form</h2>
					</div>

					<ul class="nav nav-tabs" id="donateTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="signup-tab" data-toggle="tab" href="#signup" role="tab">Sign Up</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="login-tab" data-toggle="tab" href="#login" role="tab">Login</a>
						</li>
					</ul>

					<div class="tab-content" id="donateTabContent">
						<!-- Sign Up Form -->
						<div class="tab-pane fade show active" id="signup" role="tabpanel">
							<form id="signup-form" action="https://server1.pearl-developer.com/gaamraam/public/member-register" method="POST">
								<div class="form-group">
									<label for="signup-name">Name</label>
									<input type="text" name="name" class="form-control" id="signup-name" required>
								</div>
								<div class="form-group">
									<label for="signup-email">Email</label>
									<input type="email" name="email" class="form-control" id="signup-email" required>
								</div>
								<div class="form-group">
									<label for="signup-password">Password</label>
									<input type="password" name="password" class="form-control" id="signup-password" required>
								</div>
								<button type="submit" class="btnn-donate">Sign Up</button>
							</form>
						</div>

						<!-- Login Form -->
						<div class="tab-pane fade" id="login" role="tabpanel">
							<form id="login-form" action="https://server1.pearl-developer.com/gaamraam/public/login" method="POST">
								<div class="form-group">
									<label for="login-email">Email</label>
									<input type="email" name="email" class="form-control" id="login-email" required>
								</div>
								<div class="form-group">
									<label for="login-password">Password</label>
									<input type="password" name="password" class="form-control" id="login-password" required>
								</div>
								<button type="submit" class="btnn-donate">Login</button>
							</form>
							<p class="text-center mt-2">
								<a href="#" id="forgot-password-link">Forgot Password?</a>
							</p>

							<!-- Forgot Password Form (Initially Hidden) -->
							<div id="forgot-password-form" style="display: none;">
								<form action="https://server1.pearl-developer.com/gaamraam/public/forgot-password" method="POST">
									<div class="form-group">
										<label for="forgot-email">Enter Your Email</label>
										<input type="email" name="email" class="form-control" id="forgot-email" required>
									</div>
									<button type="submit" class="btnn-donate">Reset Password</button>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<section class="py-5 bg-very-light-gray">
	<div class="container">
		<div class="row">
			<div class="section-heading">
				<h2 class="member-all">Expectations from Your Institution</h2>
			</div>
			<div class="requirment-content">
				<div class="box institution">
					<h2>What's Required from Your Institution?</h2>
					<ul>
						<li>Provide Classrooms (2:30 PM – 5:30 PM) – Utilize idle space for competitive exam coaching.</li>
						<li>Appoint a Class Coordinator – Manage attendance and discipline.</li>
						<li>Equip LCD/Projection Screens – Enable interactive learning.</li>
					</ul>
				</div>
				<div class="box commitment">
					<h2>GaamRaam’s Commitment</h2>
					<ul>
						<li>Hire & Pay Faculty – Including live sessions from Mukherjee Nagar.</li>
						<li>Provide Study Materials – e-notes & test series for all major exams.</li>
						<li>Monitor Student Progress – Regular feedback for continuous improvement.</li>
						<li>Promote Your Institution – Increase visibility and student enrollment.</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="py-5">
	<div class="container">
		<div class="row py-5">
			<div class="section-heading">
				<h2 class="member-all">Our Associate Institution</h2>
			</div>
			<div class="process-wrapper">
				<!-- remove this class process-content-wrapper -->
				<div class="">
					<div class="row mt-n1-9">
						@isset($colleges)
						@foreach($colleges as $college)
						<div class="col-md-6 col-lg-4 mt-1-9">
							<div class="process-content-teacher">
								<div class="student-image-block py-2">
									<a href="">
										<img src="{{ asset($college->logo) }}" alt="{{ asset($college->logo) }}">

									</a>
								</div>
								<h3 class="h4">{{ $college->name ?? '' }}</h3>
								<p class="mb-0 college-content">
									{{ Illuminate\Support\Str::limit(strip_tags($college->description, 15)) }} <i class="fa fa-info-circle" data-toggle="tooltip" title="{{ strip_tags($college->description) }}"></i>
								</p>
							</div>
						</div>
						@endforeach
						@endisset
					</div>
				</div>
			</div>
		</div>

	</div>
</section>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		var tabs = document.querySelectorAll(".nav-link");
		tabs.forEach(function(tab) {
			tab.addEventListener("click", function(event) {
				event.preventDefault();
				var activeTab = document.querySelector(".nav-link.active");
				var activeContent = document.querySelector(".tab-pane.show.active");

				if (activeTab) activeTab.classList.remove("active");
				if (activeContent) activeContent.classList.remove("show", "active");

				var target = document.querySelector(tab.getAttribute("href"));
				tab.classList.add("active");
				target.classList.add("show", "active");
			});
		});

		// Forgot password toggle
		document.getElementById("forgot-password-link").addEventListener("click", function(event) {
			event.preventDefault();
			document.getElementById("forgot-password-form").style.display = "block";
		});
	});
</script>
@endsection