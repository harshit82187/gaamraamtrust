@extends('front.layout.app')
@section('content')
<section class="page-title-section bg-img cover-background top-position1 left-overlay-dark" data-overlay-dark="9" data-background="img/bg/bg-04.jpg">
	<div class="container">
		<div class="row text-center">
			<div class="col-md-12">
				<h1>Contact</h1>
			</div>
			<div class="col-md-12">
				<ul>
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ url('contact') }}">Contact</a></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="contact-form pb-0">
	<div class="container mb-2-9 mb-md-6 mb-lg-7">
		<div class="section-heading">
			<span class="sub-title">OUR CONTACTS</span>
			<h2 class="mb-9 display-16 display-sm-14 display-lg-10 font-weight-800">We`re here to Help You</h2>
			<div class="heading-seperator"><span></span></div>
		</div>
		<div class="row mt-n2-9 mb-md-6 mb-lg-7">
			<div class="col-lg-4 mt-2-9">
				<div class="contact-wrapper bg-light rounded position-relative h-100 px-4">
					<div class="mb-4">
						<i class="contact-icon ti-email"></i>
					</div>
					<div>
						<h4>Email Here</h4>
						<ul class="list-unstyled p-0 m-0">
							<li><a href="#!">gaamraam.ngo@gmail.com</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-4 mt-2-9">
				<div class="contact-wrapper bg-light rounded position-relative h-100 px-4">
					<div class="mb-4">
						<i class="contact-icon ti-map-alt"></i>
					</div>
					<div>
						<h4>Location Here</h4>
						<ul class="list-unstyled p-0 m-0">
							<li>House No. 81 Village Shimla Moulana Post office Chandoli District Panipat Panipat HARYANA 132103</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-4 mt-2-9">
				<div class="contact-wrapper bg-light rounded position-relative h-100 px-4">
					<div class="mb-4">
						<i class="contact-icon ti-mobile"></i>
					</div>
					<div>
						<h4>Call Here</h4>
						<ul class="list-unstyled p-0 m-0">
							<li><a href="#!">+91 9053903100</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- CONTACT FORM
	================================================== -->
<section class="bg-very-light-gray py-md-8 pb-lg-0">
	<div class="container">
		<div class="row align-items-end">
			<div class="col-lg-6 d-none d-lg-block">
				<img src="{{asset('front/img/content/contact-img-01.jpg')}}" alt="...">
			</div>
			<div class="col-lg-6">
				<div class="faq-form">
					<h2 class="mb-4 text-primary">Get In Touch</h2>
					<form class="contact" action="{{route('sumit-contact-form')}}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="quform-elements">
							<div class="row">
								<!-- Begin Text input element -->
								<div class="col-md-6">
									<div class="quform-element form-group">
										<label for="name">Your Name <span class="quform-required">*</span></label>
										<div class="quform-input">
											<input class="form-control" id="name" type="text" name="name" value="{{old('name')}}" placeholder="Your name here" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="quform-element form-group">
										<label for="email">Your Email <span class="quform-required">*</span></label>
										<div class="quform-input">
											<input class="form-control" id="email" type="text" name="email" value="{{old('email')}}" placeholder="Your email here" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="quform-element form-group">
										<label for="subject">Your Subject <span class="quform-required">*</span></label>
										<div class="quform-input">
											<input class="form-control" id="subject" type="text" name="subject" value="{{old('subject')}}" placeholder="Your subject here" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="quform-element form-group">
										<label for="phone">Contact Number</label>
										<div class="quform-input">
											<input class="form-control" id="phone" type="text" name="phone" value="{{old('phone')}}" placeholder="Your phone here" />
										</div>
									</div>
								</div>
								<!-- End Text input element -->
								<!-- Begin Textarea element -->
								<div class="col-md-12">
									<div class="quform-element form-group">
										<label for="message">Message <span class="quform-required">*</span></label>
										<div class="quform-input">
											<textarea class="form-control" id="message" name="message" rows="3" placeholder="Tell us a few words"></textarea>
										</div>
									</div>
								</div>
								<!-- End Textarea element -->
								<!-- Begin Submit button -->
								<div class="col-md-12">
									<div class="quform-submit-inner">
										<button class="butn secondary" type="submit"><i class="far fa-paper-plane icon-arrow before"></i><span class="label">Send Message</span><i class="far fa-paper-plane icon-arrow after"></i></button>
									</div>
									<div class="quform-loading-wrap text-start"><span class="quform-loading"></span></div>
								</div>
								<!-- End Submit button -->
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- MAP
	================================================== -->
<section class="p-0">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3496.6979595593093!2d76.9816154!3d29.4556669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390dd930a1468d97%3A0x54ae2ba208162db7!2sGaamraam!5e1!3m2!1sen!2sin!4v1743135242853!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>
@endsection