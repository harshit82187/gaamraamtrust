@extends('front.layout.app')


@section('content')
<section class="banner-section">
	<div class="overlay-div"></div>
	<div class="container">
		<div class="donate-banner">
			<h2 class="text-white">Start Your Donation Today</h2>
			<p class="text-white">Make a difference with your contribution.</p>

		</div>
	</div>

</section>
<div class="container my-5">
	<div class="row">
		<div class="col-lg-6">
			<!-- <div class="donation-container">
				<button class="donate-btn" onclick="donate()"></button>
				<div class="donation-box"></div>
			</div> -->
			<div class="donation-contentt">
				<div class="donate-image">
					<img src="{{ asset('front/images/Donate.jpeg') }}" alt="{{ asset('front/images/Donate.jpeg') }}">
				</div>
				<!-- <div class="donate-image">
					<img src="{{ asset('../public/front/images/box.jpg') }}" alt="{{ asset('front/images/Donate.jpeg') }}">
				</div> -->
				<div class="content-div-box">

					<h5 class="text-center my-2">Thank You for Your Willingness to Give!</h5>
					<p class="text-center">Your kindness and generosity mean a lot. We truly appreciate your support in making a difference.</p>
					<p class="text-center"> But before you proceed, we invite you to take a bigger step—become a member. Why? Because as a member, you don’t just donate—you see the impact you create and become part of real, lasting change.</p>

					<h6 class="text-center">Why Become a Member?</h6>
					<ul class="">
						<li>See Your Contribution in Action – Track how your support transforms lives.</li>
						<li> Be a Changemaker, Not Just a Donor – Play an active role in shaping the future.</li>
						<li>Multiply Your Impact – Support meaningful causes beyond a one-time donation.</li>
					</ul>
				</div>
			</div>

		</div>
		<div class="col-lg-6">
			<div class="donate-form">
				<div class="donation-heading text-center">
					<img src="{{ asset('front/images/Gaam_Raam_logo.png') }}" alt="{{ asset('front/images/Gaam_Raam_logo.png') }}">
					<h2>NGO Donation form</h2>
				</div>
				<form id="donate-online" action="{{ route('donate-now-amount') }}" method="POST">
					@csrf
					<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
					<input type="hidden" name="transaction_via" value="razorpay">
					<input type="hidden" name="merchant_order_id" value="<?= rand(11111, 99999) . time() ?>">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control alphabet" id="name"  aria-describedby="">

					</div>
					<div class="form-group">
						<label for="number">Phone</label>
						<input type="text" name="mobile_no" class="form-control number" id="mobile_no" >
					</div>
					<div class="form-group">
						<label for="number">Email</label>
						<input type="email" name="email" class="form-control" id="email" >
					</div>
					<div class="form-group">
						<label for="amount">Amount</label>
						<input type="text" name="amount" class="form-control number" id="amount" required>
					</div>
					<button type="submit" id="donate-now-submit" class="btnn-donate">Donate Now</button>
				</form>

				<p class="text-center become-textt">If you want to become an Part of Gaamraam then join us ?</p>
				<a href="{{ url('member-register') }}" class="text-center donate-arrow"><i class="fa-solid fa-hand-pointer blinking-text"></i>Become a member</a>

			</div>
		</div>
	</div>
</div>

<section class="donation-section py-1">
	<div class="container">
		<div class="denoation-amount-div">
			{{-- <marquee>A new Donation Amount RS. 500 Paid by Mr. Akash Sharma</marquee> --}}

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
</section>

@endsection

@push('js')

<script>
	var RAZORPAY_KEY = "{{ env('RAZORPAY_KEY') }}";
	var razorpay_logo = "{{ asset('front/images/Gaam_Raam_logo.png') }}";
</script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="{{ asset('front/js/razorpay.js') }}"></script>

<script>
	$(document).ready(function() {
		// Swiper: Slider
		new Swiper('.swiper-container-donation', {
			loop: true,
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			slidesPerView: 3,
			paginationClickable: true,
			spaceBetween: 20,
			breakpoints: {
				320: {
					slidesPerView: 1, // 1 slide for very small screens (mobile devices)
					spaceBetween: 10, // Space between slides
				},
				480: {
					slidesPerView: 1, // 1 slide for mobile devices in portrait mode
					spaceBetween: 10, // Space between slides
				},
				768: {
					slidesPerView: 2, // 2 slides for tablets and small screens
					spaceBetween: 20, // Space between slides
				},
				1024: {
					slidesPerView: 3, // 3 slides for small desktops
					spaceBetween: 30, // Space between slides
				},
				1200: {
					slidesPerView: 4, // 4 slides for larger desktops
					spaceBetween: 30, // Space between slides
				},
			},
		});
	});
</script>
@endpush