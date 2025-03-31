
<header class="header-style1 menu_area-light">
	<div class="navbar-default border-bottom border-color-light-white">
		<!-- start top search -->
		<div class="top-search bg-primary">
			<div class="container">
				<form
					class="search-form"
					action="search.html"
					method="GET"
					accept-charset="utf-8">
					<div class="input-group">
						<span class="input-group-addon cursor-pointer">
							<button
								class="search-form_submit fas fa-search text-white"
								type="submit"></button>
						</span>
						<input
							type="text"
							class="search-form_input form-control"
							name="s"
							autocomplete="off"
							placeholder="Type & hit enter..." />
						<span class="input-group-addon close-search mt-1"><i class="fas fa-times"></i></span>
					</div>
				</form>
			</div>
		</div>
		<!-- end top search -->
		<div class="container">
			<div class="row align-items-center">
				<div class="col-12 col-lg-12">
					<div class="menu_area alt-font">
						<nav class="navbar navbar-expand-lg navbar-light p-0">
							<div class="navbar-header navbar-header-custom">
								<!-- start logo -->
								<a href="{{ url('/') }}" class="">
									<img src="{{ asset('front/images/Gaam_Raam_logo.png') }}" alt="logo121" />
								</a>
								<!-- end logo -->
							</div>
							<div class="navbar-toggler bg-primary"></div>
							<!-- start menu area -->
							<ul
								class="navbar-nav ms-auto"
								id="nav"
								style="display: none">
								<li><a href="{{url('/')}}">Home</a></li>
								<!-- <li><a href="">Student</a></li> -->
								<li>
									<a href="{{url('course')}}">Courses</a>
									<!-- <ul>
													<li><a href="courses-grid.html">UPSC</a></li>
													<li><a href="courses-grid.html">SSC</a></li>
													</ul> -->
								</li>
								<li><a href="{{url('become-a-member')}}">Member</a></li> 
								<li><a href="{{ url('our-college') }}">Institutions</a></li>
								<li><a href="{{url('about')}}">About Us</a></li>
								 
								<!-- <li><a href="{{url('contact')}}">Contact</a></li> -->
							</ul>
							<!-- end menu area -->
							<!-- start attribute navigation -->
							<div
								class="attr-nav align-items-xl-center ms-xl-auto main-font">
								<ul>

									<!-- <li class="d-none d-xl-inline-block">
										<a href="{{route('student.login')}}" class="butn md text-white"><i class="fas fa-plus-circle icon-arrow before"></i><span class="label">Student Login</span><i class="fas fa-plus-circle icon-arrow after"></i></a>
									</li>
									<li class="d-none d-xl-inline-block">
										<a href="{{url('member-register')}}" class="butn md text-white"><i class="fas fa-plus-circle icon-arrow before"></i><span class="label">Member Login</span><i class="fas fa-plus-circle icon-arrow after"></i></a>
									</li> -->
									<li class="d-xl-inline-block">
										<a href="{{ route('donate-now') }}" class="butn md text-white"><i class="fas fa-plus-circle icon-arrow before"></i><span class="label">Donate Now</span><i class="fas fa-plus-circle icon-arrow after"></i></a>
									</li>
								</ul>
							</div>
							<!-- end attribute navigation -->
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>