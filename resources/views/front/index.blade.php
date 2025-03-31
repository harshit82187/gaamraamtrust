@extends('front.layout.app')

@section('content')

<section class="top-position1 py-0">
	<div class="container-fluid px-0">
		<div class="slider-fade1 owl-carousel owl-theme w-100">
			<div
				class="item bg-img cover-background pt-6 pb-10 pt-sm-6 pb-sm-14 py-md-16 py-lg-20 py-xxl-24 left-overlay-dark"
				data-overlay-dark="8"
				data-background="{{ asset('front/images/IAS.jpg') }}">
				<div class="container pt-6 pt-md-0">
					<div class="row align-items-center">
						<div
							class="col-md-10 col-lg-8 col-xl-7 mb-1-9 mb-lg-0 py-6 position-relative">
							<span class="h5 text-secondary">IN EVERY DISTRICT OF HARYANA</span>
							<h1 class="display-1 font-weight-800 mb-1 title text-white">
								Free Coaching
							</h1>
							<h3
								class="font-weight-700 mb-2-5 title text-white display-15">
								by GaamRaam Charitable Trust
							</h3>
							<!-- <li class="d-none d-xl-inline-block"> -->
							<a href="{{route('student.login')}}" class="become-memb butn md text-white my-2 "><i class="fas fa-plus-circle icon-arrow before"></i><span class="label">Student Login</span><i class="fas fa-plus-circle icon-arrow after"></i></a>
						</div>
						<div class="col-md-4 col-lg-4 col-xl-4">
							<div class="faq-form enrol-form d-none">
								<h2 class="text-primary">Sign Up</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div
				class="item bg-img cover-background pt-6 pb-10 pt-sm-6 pb-sm-14 py-md-16 py-lg-20 py-xxl-24 left-overlay-dark"
				data-overlay-dark="8"
				data-background="{{ asset('front/images/IPS.jpg') }}">
				<div class="container pt-6 pt-md-0">
					<div class="row align-items-center">
						<div
							class="col-md-10 col-lg-8 col-xl-7 mb-1-9 mb-lg-0 py-6 position-relative">
							<span class="h5 text-secondary">IN EVERY DISTRICT OF HARYANA</span>
							<h2 class="display-1 font-weight-800 mb-1 title text-white">
								Free Coaching
							</h2>
							<h3
								class="font-weight-700 mb-2-5 title text-white display-15">
								by GaamRaam Charitable Trust
							</h3>
							<!-- <li class="d-none d-xl-inline-block"> -->
							<a href="{{route('student.login')}}" class="become-memb butn md text-white my-2"><i class="fas fa-plus-circle icon-arrow before"></i><span class="label">Student Login</span><i class="fas fa-plus-circle icon-arrow after"></i></a>
						</div>
						<div class="col-md-4 col-lg-4 col-xl-4">
							<div class="faq-form enrol-form d-none">
								<h2 class="text-primary">Become a Student</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div
				class="item bg-img cover-background pt-6 pb-10 pt-sm-6 pb-sm-14 py-md-16 py-lg-20 py-xxl-24 left-overlay-dark"
				data-overlay-dark="8"
				data-background="{{ asset('front/images/SDM.jpg') }}">
				<div class="container pt-6 pt-md-0">
					<div class="row align-items-center">
						<div
							class="col-md-10 col-lg-8 col-xl-7 mb-1-9 mb-lg-0 py-6 position-relative">
							<span class="h5 text-secondary">IN EVERY DISTRICT OF HARYANA</span>
							<h2 class="display-1 font-weight-800 mb-1 title text-white">
								Free Coaching
							</h2>
							<h3
								class="font-weight-700 mb-2-5 title text-white display-15">
								by GaamRaam Charitable Trust
							</h3>
							<!-- <li class="d-none d-xl-inline-block"> -->
							<a href="{{route('student.login')}}" class="become-memb butn md text-white my-2"><i class="fas fa-plus-circle icon-arrow before"></i><span class="label">Student Login</span><i class="fas fa-plus-circle icon-arrow after"></i></a>
						</div>
						<div class="col-md-4 col-lg-4 col-xl-4">
							<div class="faq-form enrol-form d-none">
								<h2 class="text-primary">Sign Up</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="faq-form enrol-form">
			<h2 class="mb-2 text-primary">Sing Up for Free Coaching</h2>
			<form class="contact " action="{{ route('contact-us') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="quform-elements">
					<div class="row">
						<!-- Begin Text input element -->
						<div class="col-md-12">
							<div class="quform-element form-group">
								<label for="name">Your Name<span class="quform-required">*</span></label>
								<div class="quform-input">
									<input class="form-control alphabet" id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="Enter Your Name" />
								</div>
								@error('name')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-12">
							<div class="quform-element form-group mb-0">
								<label for="email">Your Email <span class="quform-required">*</span></label>
								<div class="quform-input form-group mb-0">
									<input class="form-control" id="email" type="email" required value="{{ old('email') }}" name="email" placeholder="Enter Your Email" />
									<button type="button" class="send-otp-btn my-2" id="sendOtpBtn">Send OTP</button>
								</div>
								<span id="emailError"></span>
							</div>
						</div>

						<div class="col-md-12 d-none" id="otpSection">
							<div class="quform-element form-group">
								<label for="otp">Enter OTP <span class="quform-required">*</span></label>
								<div class="quform-input form-group mb-0">
									<input class="form-control otp-number" id="otp" type="text" name="otp" placeholder="Enter OTP here" />
									<button type="button" class="btn btn-success my-2" id="verifyOtpBtn">Verify OTP</button>
								</div>
								<span id="otpError"></span>
							</div>
						</div>

						<div class="col-md-6">
							<div class="quform-element form-group">
								<label for="phone">Password<span class="quform-required">*</span></label>
								<div class="quform-input">
									<input class="form-control " type="password" id="password" autocomplete="one-time-code" required value="{{ old('password') }}" name="password" placeholder="Create Your Password" />
								</div>
								@error('password')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="col-md-6">
							<div class="quform-element form-group">
								<label for="phone">Confirm Password<span class="quform-required">*</span></label>
								<div class="quform-input">
									<input class="form-control" type="password" id="cpassword" autocomplete="one-time-code" required value="{{ old('password') }}" name="password" placeholder="Confirm Password" />
									<span id="password_error" class="text-danger"></span>
								</div>
								@error('password')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="col-md-12">
							<div class="quform-element form-group">
								<label for="phone">Contact Number<span class="quform-required">*</span></label>
								<div class="quform-input">
									<input class="form-control number" type="text" required value="{{ old('phone') }}" name="phone" placeholder="Enter Your WhatsApp Number" />
								</div>
								@error('phone')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-12">
							<div class="quform-element form-group">
								<label for="course">Select Course Applying For<span class="quform-required">*</span></label>
								<div class="quform-input">
									<select class="form-control" name="course" required>
										<option value="">Select Course Applying For</option>
										<option value="UPSC">UPSC</option>
										<option value="SSC">SSC</option>
									</select>
								</div>
								@error('course')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-12">
							<div class="quform-submit-inner">
								<button class="butn secondary" id="enrool-now-button" type="submit"><i class="far fa-paper-plane icon-arrow before"></i><span class="label">Sign Up</span>
									<i class="far fa-paper-plane icon-arrow after"></i>
								</button>
							</div>
							<div class="quform-loading-wrap text-start">
								<span class="quform-loading"></span>
							</div>
						</div>
						<!-- End Submit button -->
					</div>
				</div>
			</form>
		</div>
	</div>
	<div
		class="triangle-shape top-15 right-10 z-index-9 d-none d-md-block"></div>
	<div
		class="square-shape top-25 left-5 z-index-9 d-none d-xl-block"></div>
	<div class="shape-five z-index-9 right-10 bottom-15"></div>
</section>
<!-- INFORMATION
	================================================== -->
<section class="p-0 overflow-visible service-block">
	<div class="container">
		<div class="row mt-n1-9">
			<div class="col-md-6 col-lg-6 col-xl-3 mt-3 mt-sm-4">
				<div class="card card-style3 h-100">
					<div class="card-body px-1-9 py-2-3">
						<div class="mb-3 d-flex align-items-center flex-column justify-content-center gap-3">
							<div class="card-icon">
								Step-1
							</div>
							<h4 class="mb-0 text-center"> Sign Up & Get Started</h4>
						</div>
						<div class="step-card-para text-center">
							<p class="mb-3">
								You are in the right place for free UPSC & SSC coaching! To begin, fill out the SignUp form available on this website. </p>

							<a href="{{ route('step-for-enroll') }}" class="butn-style1 secondary">View More +</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-xl-3 mt-3">
				<div class="card card-style3 h-100">
					<div class="card-body px-1-9 py-2-3">
						<div class="mb-3 d-flex align-items-center flex-column justify-content-center gap-3">
							<div class="card-icon">
								Step-2
							</div>
							<h4 class="mb-0 text-center">Upload & Verify Your Documents</h4>
						</div>
						<div class="step-card-para text-center">
							<p class="mb-3">
								After completing the SignUp, click on ‘Student Login’ at the top of the website. Use your registered email ID and password to access your student dashboard. </p>
							<a href="{{ route('step-for-enroll') }}" class="butn-style1 secondary">View More +</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-xl-3 mt-3">
				<div class="card card-style3 h-100">
					<div class="card-body px-1-9 py-2-3">
						<div class="mb-3 d-flex align-items-center flex-column justify-content-center gap-3">
							<div class="card-icon">
								Step-3
							</div>
							<h4 class="mb-0 text-center">Aptitude Test & Institution Selection</h4>
						</div>
						<div class="step-card-para text-center">
							<p class="mb-3">
								Students who pass document verification will take an aptitude test to assess their problem-solving and analytical abilities.
							</p>
							<a href="{{ route('step-for-enroll') }}" class="butn-style1 secondary">View More +</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-xl-3 mt-3">
				<div class="card card-style3 h-100">
					<div class="card-body px-1-9 py-2-3">
						<div class="mb-3 d-flex align-items-center flex-column justify-content-center gap-3">
							<div class="card-icon">
								Step-4
							</div>
							<h4 class="mb-0 text-center">Attend Physical Classes</h4>
						</div>
						<div class="step-card-para text-center">
							<p class="mb-3">
								Students who qualify will receive their official student I-card, which grants access to physical classes at their selected institution. Free classes begin on March 30, 2025, at partnered colleges, universities, or schools near you. </p>
							<a href="{{ route('step-for-enroll') }}" class="butn-style1 secondary">View More +</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- <section class="donation-section my-0 py-5">
	<div class="container">
		<div class="denoation-amount-div">
			@if($latest_payment)
			<marquee>New donation of ₹{{ number_format($latest_payment->amount, 2) }} received from {{ $latest_payment->user_name }}</marquee>
			@endif
			<div class="conainer">
				<div class="swiper mySwiper review-principle-swiper">
					<div class="swiper-wrapper">

						<div class="swiper-slide">
							<a href="{{route('donate-amount-details')}}">
								<div class="remaining-amount card1">
									<img src="../public/front/images/rupee.png" alt="">
									<span class="py-2">Total Donation Amount</span>
									<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
									<h6>&#8377; {{ $total_amount ?? '0' }}</h6>
									<div class="go-corner" href="#">
										<div class="go-arrow">
											→
										</div>
									</div>
								</div>
							</a>

						</div>
						<div class="swiper-slide">
							<div class="remaining-amount  card1">
								<img src="../public/front/images/rupee.png" alt="">
								<span class="py-2">Total Expensve Amount</span>
								<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
								<h6>&#8377; 0</h6>
								<div class="go-corner" href="#">
									<div class="go-arrow">
										→
									</div>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="remaining-amount  card1">
								<img src="../public/front/images/rupee.png" alt="">
								<span class="py-2">Total Expensve Amount</span>
								<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
								<h6>&#8377; 0</h6>
								<div class="go-corner" href="#">
									<div class="go-arrow">
										→
									</div>
								</div>
							</div>
						</div>



					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>


		</div>
	</div>
</section> -->


<!-- ABOUTUS
	================================================== -->
<section class="aboutus-style-01 position-relative py-5">
	<div class="container pt-lg-4">
		<div class="row align-items-baseline mt-n1-9">
			<div class="col-md-12 col-lg-6 mt-1-9 order-2 order-lg-1">
				<div class="position-relative">
					<div class="sticky-class">
						<div class="position-relative">

							<div class="image-hover">
								<img
									src="{{ asset('front/images/ngo.jpeg') }}"
									alt="..."
									class="position-relative z-index-1" />
							</div>
							<!-- <img src="images/about-02.jpg" alt="..." class="img-2 d-none d-xl-block"> -->
							<img
								src="{{ asset('front/images/bg-07.png') }}"
								class="bg-shape1  d-sm-block"
								alt="..." />

						</div>
						<div class="d-sm-block">
							<div class="about-text">
								<p>New Batch Starting from
								<div class="about-counter">
									<span class="countup">30</span> th
								</div>
								April 2025</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-6 mt-1-9 order-2 order-lg-1">
				<div class="section-heading text-start mb-2">
					<span class="sub-title">welcome!</span>
				</div>
				<h2 class="font-weight-800 h1 mb-1-9 text-primary">
					Why Free Coaching is Necessary
				</h2>
				<blockquote>

					GaamRaam Trust considers every child in Haryana a member of its family and believes education should be accessible to all, not just the privileged. However, many talented students face financial, social, and geographical barriers that limit their opportunities in UPSC and SSC exams.
				</blockquote>
				<blockquote>
					<h5> Breaking Barriers to Education</h5>
					High coaching fees and travel limitations prevent many—especially rural and low-income students—from competing at the national level. To level the playing field, GaamRaam Trust provides free coaching across Haryana, ensuring that:
					<ul>
						<li>Underprivileged students receive expert guidance.</li>
						<li>Girls who cannot travel to Delhi get quality coaching.</li>
						<li> Rural aspirants access top faculty from Mukherjee Nagar, Delhi.</li>
					</ul>
				</blockquote>

				<div class="show-more-ngo" id="show-content" style="display: none;">

					<blockquote>
						<h5>Merit-Based Institution Selection</h5>
						Success should depend on talent, not financial status. Students who excel in the aptitude test get the first choice of partnered institutions, shaping their education without financial burden.
					</blockquote>
					<blockquote>
						<h5>Equal Opportunities for All</h5>
						By bringing education closer, GaamRaam Trust ensures no child in Haryana is left behind due to economic or social constraints.
					</blockquote>
					<blockquote> Free coaching is not charity—it is an investment in Haryana’s youth and the nation’s future.</blockquote>
				</div>
				<button class="show-more-btn mt-3" id="view-toggle" onclick="togglecontent()">See More</button>

				<div class="dotted-seprator pt-1-9 mt-1-9"></div>

				<!-- <div class="row">
					<div class="col-sm-6 col-12 mb-3 mb-sm-0">
						<div class="media">
							<i class="ti-mobile display-15 text-secondary"></i>
							<div class="media-body align-self-center ms-3">
								<h4 class="mb-1 h5">Phone Number</h4>
								<p class="mb-0">9053903100</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-12">
						<div class="media">
							<i class="ti-email display-15 text-secondary"></i>
							<div class="media-body align-self-center ms-3">
								<h4 class="mb-1 h5">Email Address</h4>
								<p class="mb-0" style="white-space: nowrap;">gaamraam.ngo@gmail.com</p>
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>
		<div class="shape18">
			<img src="{{ asset('front/images/bg-01.jpg') }}" alt="..." />
		</div>
		<div class="shape20">
			<img src="{{ asset('front/images/bg-02.jpg') }}" alt="..." />
		</div>
	</div>
</section>

<!-- ONLINE COURSES
	================================================== -->

<section class="aboutus-style-01 position-relative bg-very-light-gray py-3">
	<div class="container">
		<div class="section-heading">
			<h2 class="h1 mb-0">Free Courses</h2>
		</div>
		<div class="row g-xxl-5 mt-n2-6 justify-content-center">
			@if(isset($courses))
			@foreach($courses as $course)
			<div class="col-md-6 col-xl-4 mt-3">
				<div class="card card-style1 p-0 h-100">
					<div class="card-img rounded-0">
						<div class="image-hover">
							<img class="rounded-top" src="{{ asset($course->image) }}" alt="{{ asset($course->image) }}" />
						</div>
					</div>
					<div class="card-body position-relative pt-0 px-1-9 pb-1-9">
						<div class="card-author d-flex d-none">
						</div>
						<div class="pt-6">
							<h3 class="h4 mb-4">
								<a href="{{ route('course-detail', $course->slug) }}">{{ $course->name ?? 'Unnamed Course' }}</a>
							</h3>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			@endif
		</div>
	</div>
	<div class="container py-4">
		<div class="row mt-n1-9">
			<div class="col-sm-6 col-lg-3 mt-1-9 counter-col-div">
				<div class="counter-wrapper">
					<div class="counter-icon">
						<div class="d-table-cell align-middle">
							<img src="{{asset('front/images/icon-01.png')}}" class="w-55px" alt="..." />
						</div>
					</div>
					<div class="counter-content">
						<h4 class="counter-number">
							<span class="countup">20</span>
						</h4>
						<p class="mb-0 font-weight-600">Total Institution</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3 mt-1-9 counter-col-div">
				<div class="counter-wrapper">
					<div class="counter-icon">
						<div class="d-table-cell align-middle">
							<img src="{{asset('front/images/icon-03.png')}}" class="w-55px" alt="..." />
						</div>
					</div>
					<div class="counter-content">
						<h4 class="counter-number">
							<span class="countup">4000</span>
						</h4>
						<p class="mb-0 font-weight-600">Total Seats</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3 mt-1-9 counter-col-div">
				<div class="counter-wrapper">
					<div class="counter-icon">
						<div class="d-table-cell align-middle">
							<img src="{{asset('front/images/icon-02.png')}}" class="w-55px" alt="..." />
						</div>
					</div>
					<div class="counter-content">
						<h4 class="counter-number">
							<span class="countup">200</span>
						</h4>
						<p class="mb-0 font-weight-600">Student Enrollment</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3 mt-1-9 counter-col-div">
				<div class="counter-wrapper">
					<div class="counter-icon">
						<div class="d-table-cell align-middle">
							<img src="{{asset('front/images/icon-04.png')}}" class="w-55px" alt="..." />
						</div>
					</div>
					<div class="counter-content">
						<h4 class="counter-number">
							<span class="countup">30</span>+
						</h4>
						<p class="mb-0 font-weight-600">Certified Teachers</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container pt-lg-4">

		<div class="shape19">
			<img src="{{ asset('front/img/bg/shape22.png') }}" alt="..." />
		</div>
		<div class="shape22">
			<img src="{{ asset('front/img/bg/shape23.png') }}" alt="..." />
		</div>
	</div>
</section>


<!-- 
<section class="bg-very-light-gray">
	<div class="container">
		<div class="section-heading">
			<h2 class="h1 mb-0">Free Courses</h2>
		</div>
		<div class="row g-xxl-5 mt-n2-6 justify-content-center">
			@if(isset($courses))
			@foreach($courses as $course)
			<div class="col-md-6 col-xl-4 mt-2-6">
				<div class="card card-style1 p-0 h-100">
					<div class="card-img rounded-0">
						<div class="image-hover">
							<img class="rounded-top" src="{{ asset($course->image) }}" alt="{{ asset($course->image) }}" />
						</div>
					</div>
					<div class="card-body position-relative pt-0 px-1-9 pb-1-9">
						<div class="card-author d-flex d-none">
						</div>
						<div class="pt-6">
							<h3 class="h4 mb-4">
								<a href="{{ route('course-detail', $course->slug) }}">{{ $course->name ?? 'Unnamed Course' }}</a>
							</h3>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			@endif
		</div>
	</div>
	<div class="container py-5">
		<div class="row mt-n1-9">
			<div class="col-sm-6 col-lg-3 mt-1-9 counter-col-div">
				<div class="counter-wrapper">
					<div class="counter-icon">
						<div class="d-table-cell align-middle">
							<img src="{{asset('front/images/icon-01.png')}}" class="w-55px" alt="..." />
						</div>
					</div>
					<div class="counter-content">
						<h4 class="counter-number">
							<span class="countup">20</span>
						</h4>
						<p class="mb-0 font-weight-600">Total Institution</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3 mt-1-9 counter-col-div">
				<div class="counter-wrapper">
					<div class="counter-icon">
						<div class="d-table-cell align-middle">
							<img src="{{asset('front/images/icon-03.png')}}" class="w-55px" alt="..." />
						</div>
					</div>
					<div class="counter-content">
						<h4 class="counter-number">
							<span class="countup">4000</span>
						</h4>
						<p class="mb-0 font-weight-600">Total Seats</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3 mt-1-9 counter-col-div">
				<div class="counter-wrapper">
					<div class="counter-icon">
						<div class="d-table-cell align-middle">
							<img src="{{asset('front/images/icon-02.png')}}" class="w-55px" alt="..." />
						</div>
					</div>
					<div class="counter-content">
						<h4 class="counter-number">
							<span class="countup">200</span>
						</h4>
						<p class="mb-0 font-weight-600">Student Enrollment</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3 mt-1-9 counter-col-div">
				<div class="counter-wrapper">
					<div class="counter-icon">
						<div class="d-table-cell align-middle">
							<img src="{{asset('front/images/icon-04.png')}}" class="w-55px" alt="..." />
						</div>
					</div>
					<div class="counter-content">
						<h4 class="counter-number">
							<span class="countup">30</span>+
						</h4>
						<p class="mb-0 font-weight-600">Certified Teachers</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> -->


<!-- member sectionn -->
<section class="py-5 member-section-div py-5">
	<div class="container">
		<div class="row">
			<div class="section-heading member-contentt">
				<!-- <span class="sub-title">process</span> -->
				<h2 class="membrr-all my-4  my-sm-2 text-center">Become a Part of the GaamRaam Family</h2>
				<p class="py-3 text-center ">GaamRaam is more than just an organization—it’s a movement, a family united by action and a shared dream of a better future. Here, every effort counts, every voice matters. No matter where you are, you belong.</p>
			</div>
		</div>
		<div class="row">

			<div class="col-lg-6 my-1">
				<div class="process-content-teacher member-card-div-2">
					<h3>Local Member</h3>
					<h5 class="">Be the Change in Your Community </h5>
					<p class="mb-0">Opportunities aren’t equal for everyone—but together, we can change that.</p>
					<ul>
						<li>Membership Fee: ₹100—A small contribution, a big impact.</li>
						<li>On-Ground Action: Be the force of change—participate in social initiatives, awareness drives, and community programs.</li>
						<li> Volunteer Leadership: Lead teams, organize events, and make a real impact where it’s needed most.</li>
						<li>Social Media Engagement: Use your voice to amplify causes, mobilize support, and inspire action.</li>
					</ul>
					<div class="member-read-more my-4">
						<a href="{{url('member-register') }}">Join Now</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 my-1">
				<div class="process-content-teacher member-card-div-2">
					<h3>Global Member</h3>
					<h5 class=""> Stay Connected to Your Roots, Create Impact </h5>

					<p class="mb-0">You know what it means to be far from home—the struggles, the sacrifices. Now, you have the power to ensure no child in your village has to leave just to survive.</p>
					<ul>
						<li>Membership Fee: Just one hour’s earnings per month—turn your success into someone’s chance.</li>
						<li>Digital Advocacy: Use your reach to spread awareness, inspire action, and bring people together.</li>
						<li>Global Outreach: Connect with changemakers worldwide and expand the mission beyond borders.</li>
						<li>Strategic Support: Mentor, fund, or network—because real change knows no boundaries.
						</li>
					</ul>
					<div class="member-read-more my-4">
						<a href="{{url('member-register')}}">Join Now</a>
					</div>
				</div>
			</div>

		</div>

		<div class="row">
			<div class="section-heading member-contentt py-4 ">
				<!-- <span class="sub-title">process</span> -->
				<h3 class="membrr-all">A Family Built on Trust and Transparency
				</h3>
				<p class="">At GaamRaam NGO, every rupee counts and every effort matters. Donations are instantly recorded, expenses are updated in real time with verified bills, and all financial records remain open to the public—ensuring complete transparency. Here, leadership isn’t given; it’s earned through dedication and impact, not connections. Our Social Credit Points system ensures that every contribution is recognized fairly, giving members respect, influence, and a voice in decision-making based on their real impact.</p>
			</div>
		</div>
		<div class="row">
			<div class="counter-container">
				<div class="row">
					<div class="counter-container">
						<div class="row">
							<div class="col-md-4 my-1">
								<div class="counter-box">
									<i class="fas fa-money-bill fa-3x"></i>
									<p class="pb-0">Total Recieved Amount</p>
									<div class="member-counter" id="received">0</div>
								</div>
							</div>
							<div class="col-md-4 my-1 ">
								<div class="counter-box">
									<i class="fas fa-wallet fa-3x"></i> <!-- Expense Icon -->
									<p class="pb-0">Total Expend Amount</p>
									<div class="member-counter" id="spent">0</div>
								</div>
							</div>
							<div class="col-md-4 my-1">
								<div class="counter-box">
									<i class="fas fa-piggy-bank fa-3x"></i> <!-- Remaining Money Icon -->
									<p class="pb-0">Total Remaining Amount</p>
									<div class="member-counter" id="remaining">0</div>
								</div>
							</div>
						</div>



					</div>
				</div>



			</div>
		</div>
	</div>
</section>

<!-- Member section -->
<section class="py-1 bg-very-light-gray py-4">
	<div class="container">
		<div class="section-heading py-4 mb-0">
			<h2 class="membrr-all ">Our Member</h2>
		</div>
		<div class="row">
			<div class="process-wrapper memb-card-slide">
				<div class="member-swiper-container">
					<div class="swiper-wrapper">

						@isset($members)
						@foreach($members as $member)
						<div class="swiper-slide">
							<div class="member-cardss">
								<div class="student-image-block">
									@if($member->image != null)
									<img src="{{ asset($member->image) }}" alt="{{ asset($member->image) }}" />
									@else
									<img src="{{ asset('front/images/boy.png') }}" alt="{{ asset('front/images/boy.png') }}" />
									@endif
								</div>
								<h3 class="h4 py-2">{{ $member->name ?? 'N/A' }}</h3>
								<p class="mb-0">Soical Point :- 1000</p>
								<p class="mb-0">Member Id :- {{ $member->id }}</p>
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

<!-- TRENDING CATEGORIES
	================================================== -->
<!-- <section
	class="bg-img cover-background dark-overlay"
	data-overlay-dark="8"
	data-background="">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="section-heading text-center">
					<h2 class="h1 mb-0" style="color: #fff">Popular Categories</h2>
				</div>
			</div>
		</div>
		<div class="row mt-n1-9">
			<div class="col-sm-6 col-lg-4 col-xl-3 mt-1-9">
				<a href="{{url('course')}}" class="category-item-01">
					<div class="category-img">
						<img src="{{ asset('front/images/icon-09.png') }}" alt="" />
					</div>
					<div class="ms-3">
						<h3 class="h4 mb-0 text-white">Chemistry</h3>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-4 col-xl-3 mt-1-9">
				<a href="{{url('course')}}" class="category-item-01">
					<div class="category-img">
						<img src="{{ asset('front/images/physics.png') }}" alt="" style="height:47px;" />
					</div>
					<div class="ms-3">
						<h3 class="h4 mb-0 text-white">Physics</h3>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-4 col-xl-3 mt-1-9">
				<a href="{{url('course')}}" class="category-item-01">
					<div class="category-img">
						<img src="{{ asset('front/images/calculator.png') }}" alt="" style="height:47px;" />
					</div>
					<div class="ms-3">
						<h3 class="h4 mb-0 text-white">Maths</h3>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-4 col-xl-3 mt-1-9">
				<a href="{{url('course')}}" class="category-item-01">
					<div class="category-img">
						<img src="{{ asset('front/images/icon-12.png') }}" alt="" />
					</div>
					<div class="ms-3">
						<h3 class="h4 mb-0 text-white">Reasoning</h3>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-4 col-xl-3 mt-1-9">
				<a href="{{url('course')}}" class="category-item-01">
					<div class="category-img">
						<img src="{{ asset('front/images/icon-08.png') }}" alt="" />
					</div>
					<div class="ms-3">
						<h3 class="h4 mb-0 text-white">General Awearness</h3>
					</div>
				</a>
			</div>
			<div class="col-sm-6 col-lg-4 col-xl-3 mt-1-9">
				<a href="{{url('course')}}" class="category-item-01">
					<div class="category-img">
						<img src="{{ asset('front/images/icon-07.png') }}" alt="" />
					</div>
					<div class="ms-3">
						<h3 class="h4 mb-0 text-white">General Knowledge</h3>
					</div>
				</a>
			</div>
		</div>
	</div>
</section> -->


<!-- ONLINE INSTRUCTORS
	================================================== -->
<section class="position-relative py-5">
	<div class="container">
		<div class="section-heading">
			<h2 class="membrr-all">Our Guardians</h2>
		</div>
		<div class="swiper-ap">
			<div class="swiper-wrapper">
				<!-- Slide 1 -->
				<div class="swiper-slide">
					<div class="team-style1 text-center">
						<img src="{{asset('front/images/guru6.png')}}" class="border-radius-5" alt="..." />
						<div class="team-info">
							<h3 class="text-primary mb-1 h4">"जगद्गुरु शंकराचार्य स्वामिश्रीः"</h3>
							<span class="font-weight-600 text-secondary">"अविमुक्तेश्वरानंदः सरस्वती जी"</span>
						</div>
						<div class="team-overlay">
							<div class="d-table h-100 w-100">
								<div class="d-table-cell align-middle">
									<h3><a href="#" class="text-white">"गामराम का काम धन के लिए नहीं, धर्म के लिए.."</a></h3>
									<p class="text-white mb-0">"जगद्गुरु शंकराचार्य स्वामिश्रीः अविमुक्तेश्वरानंदः सरस्वती जी"</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Slide 2 -->
				<div class="swiper-slide">
					<div class="team-style1 text-center">
						<img src="{{asset('front/images/wangchuk1.png')}}" class="border-radius-5" alt="..." />
						<div class="team-info">
							<h3 class="text-primary mb-1 h4">Sonam Wangchuk</h3>
							<span class="font-weight-600 text-secondary">Indian Engineer & Innovator</span>
						</div>
						<div class="team-overlay">
							<div class="d-table h-100 w-100">
								<div class="d-table-cell align-middle">
									<h3><a href="#" class="text-white">Gaamraam empowers young minds...</a></h3>
									<p class="text-white mb-0">Sonam Wangchuk</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Slide 3 -->
				<div class="swiper-slide">
					<div class="team-style1 text-center">
						<img src="{{asset('front/images/sant.png')}}" class="border-radius-5" alt="..." />
						<div class="team-info">
							<h3 class="text-primary mb-1 h4">"संत गोपाल दास"</h3>
							<span class="font-weight-600 text-secondary">"संत गोपाल दास"</span>
						</div>
						<div class="team-overlay">
							<div class="d-table h-100 w-100">
								<div class="d-table-cell align-middle">
									<h3><a href="#" class="text-white">"गामराम का यह सपना 'शिक्षित, सशक्त और समृद्ध हो देश..."</a></h3>
									<p class="text-white mb-0">"संत गोपाल दास"</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Slide 4 -->
				<div class="swiper-slide">
					<div class="team-style1 text-center">
						<img src="{{asset('front/images/Muni ji2.jpg')}}" class="border-radius-5" alt="..." />
						<div class="team-info">
							<h3 class="text-primary mb-1 h4">"श्री श्रेयांस मुनि जी महाराज"</h3>
							<span class="font-weight-600 text-secondary">"श्री श्रेयांस मुनि जी महाराज"</span>
						</div>
						<div class="team-overlay">
							<div class="d-table h-100 w-100">
								<div class="d-table-cell align-middle">
									<h3><a href="#" class="text-white">"'"</a></h3>
									<p class="text-white mb-0">"श्री श्रेयांस मुनि जी महाराज"</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="shape18">
			<img src="{{asset('front/images/bg-01.jpg')}}" alt="..." />
		</div>
		<div class="shape20">
			<img src="{{asset('front/images/bg-02.jpg')}}" alt="..." />
		</div>
		<div class="shape21">
			<img src="{{asset('front/images/bg-03.jpg')}}" alt="..." />
		</div>
	</div>
</section>
<!-- WHY CHOOSE US
	================================================== -->
<!-- <section>
		<div class="container">
		<div class="row align-items-center mt-n1-9">
			<div class="col-lg-6 mt-1-9">
				<div class="why-choose-img position-relative">
					<img
						class="border-radius-5"
						src="{{asset('front/images/why-choose-img.jpg')}}"
						alt="..." />
					<div
						class="position-absolute top-50 start-50 translate-middle story-video">
						<a class="video video_btn" href="https://youtube.com/@gaamraamngo?si=_G4O9dU5kg1yfeGn"><i class="fas fa-play font-size22"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 mt-1-9">

				<div class="why-choose-content">
					<div class="mb-1-9">
						<h2 class="h1 mb-2 text-primary">Our Commitments</h2>
					
					</div>
					<div class="media">
						<i class="ti-panel display-15 text-secondary"></i>
						<div class="media-body ps-3">
							<h4 class="h5 font-weight-700 mb-1 mb-md-2">
								Expert Teachers and Personalised Mentorship
							</h4>
							<p class="mb-0 w-lg-90">
								A structured learning approach where students attend physical classrooms in their own districts, while expert teachers from Mukherjee Nagar conduct live-streamed interactive lectures
							</p>
							<ul>
								<li class="mb-0 w-lg-90">
									GaamRaam NGO provides top-tier coaching from highly experienced faculty from Mukherjee Nagar and Rajendra Nagar, the most renowned hubs for UPSC and SSC exam preparation.
								</li>
								<li class="mb-0 w-lg-90">
									Our mentors equip students with the best strategies, exam techniques, and subject mastery.
								</li>
								<li class="mb-0 w-lg-90">
									Regular doubt-clearing sessions ensure personalised support tailored to each student’s learning needs.
								</li>
							</ul>
						</div>
					</div>
					<div class="readmore-content" id="showcontent" style="display: none;">
						<div class="dotted-seprator pt-1-9"></div>
						<div class="media">
							<i class="ti-package display-15 text-secondary"></i>
							<div class="media-body ps-3">
								<h4 class="h5 font-weight-700 mb-1 mb-md-2">
									Practical Training and Continuous Motivation
								</h4>
								<ul>
									<li class="mb-0 w-lg-90">
										Mock tests, group discussions, and interview preparation provide real-time exam experience and enhance analytical thinking.
									</li>
									<li class="mb-0 w-lg-90">
										Interactive workshops and motivational sessions by successful candidates, bureaucrats, and subject matter experts keep students inspired and goal-oriented.
									</li>
								</ul>
							</div>
						</div>
						<div class="dotted-seprator pt-1-9"></div>
						<div class="media">
							<i class="ti-bookmark-alt display-15 text-secondary"></i>
							<div class="media-body ps-3">
								<h4 class="h5 font-weight-700 mb-1 mb-md-2">
									Comprehensive Study Resources
								</h4>
								<ul>
									<li class="mb-0 w-lg-90">
										Soft copies of study material, notes, and practice papers are provided free of cost to strengthen conceptual understanding.
									</li>
									<li class="mb-0 w-lg-90">
										Access to online resources and recorded video lectures supports flexible and in-depth learning.
									</li>
								</ul>
							</div>
						</div>
						<div class="dotted-seprator pt-1-9"></div>
						<div class="media">
							<i class="ti-bookmark-alt display-15 text-secondary"></i>
							<div class="media-body ps-3">
								<h4 class="h5 font-weight-700 mb-1 mb-md-2">
									100% Free and Transparent Process
								</h4>
								<ul>
									<li class="mb-0 w-lg-90">
										No hidden charges – all coaching, study materials, and test series are completely free of cost.
									</li>
									<li class="mb-0 w-lg-90">
										GaamRaam NGO is committed to full transparency, ensuring equal opportunities for every deserving student without financial barriers.
									</li>
								</ul>
							</div>
						</div>
					</div>
					<button class="show-more-btn mt-3" id="toggleviewbtn" onclick="toggleview()">See More</button>

				</div>
			</div>
		</div>
		</div>
	</section> -->

<!-- principle throught -->
<section class="principle-section  py-5 member-section-div py-5 bg-very-light-gray">
	<div class="container">
		<div class="section-heading">

			<h2 class="membrr-all">Associated with us</h2>
			<p class="text-black">Partner with GaamRaam & Transform Education—at Zero Cost!</p>
		</div>
		<div class="row">
			<p class="text-center">GaamRaam NGO is revolutionizing education by bringing free, high-quality coaching for UPSC, SSC, and other competitive exams directly to students’ hometowns. By partnering with us, your institution can become a center of excellence, offering live classes from Mukherjee Nagar’s top educators—all without financial commitment.</p>
		</div>
		<div class="row">
			<div class="col-lg-4 my-1">
				<div class="our-partner-cont h-100 ">
					<h5 class=" mb-3">Why Partner with GaamRaam?</h5>
					<p>Empowering the Youngest Members of Our Family</p>
					<p>Our students are the youngest members of this family. Today, they need our support.</p>
					<ul>
						<li> Live Coaching from Mukherjee Nagar – Direct access to India’s best educators. </li>
					</ul>
					<div class="show-more-ngo" id="member-show" style="display: none;">
						<ul>
							<li>Boost Your Institution’s Reputation – Be known as a premier coaching hub.</li>
							<li> Increase Local Enrollment – Our outreach promotes your institution.</li>
							<li>Zero Cost to You – GaamRaam covers faculty salaries, study materials, and operations.</li>
							<li> Empower Your Community – Keep students close to home while ensuring quality education.</li>
						</ul>
					</div>
					<a class="show-more-btn mt-3" href="{{ url('our-college') }}">Know more</a>
				</div>
			</div>
			<div class="col-lg-4 my-1">
				<div class="our-partner-cont h-100 ">
					<h5 class="mb-3">What’s Required from Your Institution?</h5>
					<ul>
						<li> Provide Classrooms (2:30 PM – 5:30 PM) – Utilize idle space for competitive exam coaching.</li>
						<li>Appoint a Class Coordinator – Manage attendance and discipline.</li>
						<li>Equip LCD/Projection Screens – Enable interactive learning.</li>
					</ul>
					<a class="show-more-btn mt-3" href="{{ url('our-college') }}">Know more</a>
				</div>
			</div>
			<div class="col-lg-4 my-1">
				<div class="our-partner-cont h-100">
					<h5 class="mb-3">
						GaamRaam’s Commitment</h5>
					<ul>
						<li> Hire & Pay Faculty – Including live sessions from Mukherjee Nagar.</li>
						<li> Provide Study Materials – e-notes & test series for all major exams.</li>
						<li> Monitor Student Progress – Regular feedback for continuous improvement.</li>
						<li> Promote Your Institution – Increase visibility and student enrollment.</li>
					</ul>
					<a class="show-more-btn mt-3" href="{{ url('our-college') }}">Know more</a>
				</div>

			</div>
		</div>
		@php
		$hasVideo = $colleges->contains(function ($college) {
		return !empty($college->video_url);
		});
		@endphp
		@if($hasVideo)
		<div class="row mt-3">
			<div class="process-wrapper">
				<div class="">
					<div class="swiper college-swiper review-principle-swiper">
						<div class="swiper-wrapper">
							@foreach($colleges as $college)
							@if(!empty($college->video_url))
							<div class="swiper-slide">
								<div class="partner-divv">
									<div class="process-contentt">
										<div class="play-image-block">
											<div class="video-block" data-video-url="{{ $college->video_url }}">
												<div class="overlay-div"></div>
												<div class="play-vedio-image">
													<img src="{{ asset($college->logo) }}" alt="Video Thumbnail" class="videoThumbnail">
													<a href="javascript:void(0);" class="playButton">
														<img src="{{asset('front/images/play-button.png')}}" alt="Play Button" />
													</a>
													<div class="videoContainer" style="display: none;">
														<iframe class="videoIframe" width="100%" height="315" frameborder="0" allowfullscreen></iframe>
													</div>
												</div>
											</div>
											<div class="principle-contentt collegg-content">
												<h3 class="h4">{{ $college->name }} </h3>
												<p class="mb-0">
													Free UPSC & SSC Coaching for Students!
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endif
							@endforeach

						</div>
						<div class="swiper-button-next next-bbtn"></div>
						<div class="swiper-button-prev next-bbtn"></div>
					</div>

				</div>
			</div>
		</div>
		@endif
</section>


<!-- PARTNER
	================================================== -->
<section class="py-3">
	<div class="container">
		<div class="client-carousel owl-carousel owl-theme">
			@if(isset($colleges))
			@foreach($colleges as $college)
			<a href="{{ $college->website_link }}" target="_blank">
				<div class="review-colloge">
					<img src="{{ asset($college->logo) }}" alt="{{ asset($college->logo) }}">
					<h6 class="text-center text-white">{{ $college->name ?? '' }}</h6>
				</div>
			</a>


			@endforeach
			@endif
		</div>
	</div>
</section>


@endsection
@push('js')

<script>
	var sendOtpRoute = "{{ route('send.otp') }}";
	var verifyOtp = "{{ route('verify.otp') }}";
	console.log(sendOtpRoute);
	console.log(verifyOtp);
</script>
<script>
	var swiper = new Swiper(".college-swiper", {
		loop: true, // Infinite loop
		speed: 500, // Slow down slide transition
		slidesPerView: 1, // Show only one slide at a time
		spaceBetween: 10, // Space between slides
		centeredSlides: true, // Keep the active slide centered
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
	});
</script>
<script>
	var swiper = new Swiper('.swiper-ap', {
		slidesPerView: 1,
		spaceBetween: 20,
		loop: true,
		autoplay: {
			delay: 3000,
			disableOnInteraction: false
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev'
		},
		breakpoints: {
			768: {
				slidesPerView: 2
			},
			1024: {
				slidesPerView: 3
			}
		}
	});
</script>
@endpush