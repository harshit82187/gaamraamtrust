<header id="page-topbar">
	<div class="layout-width">
		<div class="navbar-header">
			<div class="d-flex">
				<!-- LOGO -->
				<div class="navbar-brand-box horizontal-logo">
					<a href="{{url('/')}}" target="_blank" class="logo logo-dark">
					<span class="logo-sm">
					<img src="{{ asset('front/images/Gaam_Raam_logo.png') }}" alt="" height="22">
					</span>
					<span class="logo-lg">
					<img src="{{ asset('front/images/Gaam_Raam_logo.png') }}" alt="" height="17">
					</span>
					</a>
					<a href="{{ url('/') }}" target="_blank" class="logo logo-light">
					<span class="logo-sm">
					<img src="{{ asset('front/images/Gaam_Raam_logo.png') }}" alt="" height="22">
					</span>
					<span class="logo-lg">
					<img src="{{ asset('front/images/Gaam_Raam_logo.png') }}" alt="" height="17">
					</span>
					</a>
				</div>
				<button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
				<span class="hamburger-icon">
				<span></span>
				<span></span>
				<span></span>
				</span>
				</button>
				<!-- App Search-->
			</div>
            @php 
			  $student = Auth::guard('student')->user();
			  $notifications = \App\Models\Notification::whereJsonContains('student_id', (string) $student->id)->orWhereJsonContains('student_id', "0")->count();
			 @endphp
			<div class="d-flex align-items-center">
                <a href="{{ route('student.notification') }}">
                    <span class="notification_bell">
                        <i class="fa-solid fa-bell"></i>
                        <div class="notification_count">{{ $notifications ?? '' }}</div>
                    </span>
                </a>
				
				<div class="dropdown ms-sm-3 header-item topbar-user" style="background-color:#d85f3b">
					<button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="d-flex align-items-center">
							@if(auth()->guard('student')->user()->image == null)
							<img class="rounded-circle header-profile-user" src="{{ asset('student/backend/images/users/avatar-1.jpg') }}" alt="Header Avatar">
							@else 
							<img class="rounded-circle header-profile-user" src="{{ asset(auth()->guard('student')->user()->image) }}" alt="Profile Image">
							@endif
							<span class="text-start ms-xl-2">
								<span class="d-none d-xl-inline-block ms-1 text-white fw-medium user-name-text" style="font-size:16px;">{{ ucwords(Auth::guard('student')->user()->name) ?? '' }}</span>
								<!-- <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">Founder</span> -->
							</span>
						</span>
					</button>
					<div class="dropdown-menu dropdown-menu-end">
						<!-- item-->
						<h6 class="dropdown-header">Welcome Admin!</h6>
						<a class="dropdown-item" href="{{ route('student.profile') }}"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
						<div class="dropdown-divider"></div>
						<a id="logoutButton" class="dropdown-item" href="{{ route('student.logout') }}" 
						onclick="return confirm('Are you sure you want to logout?')">
						<i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> 
						<span class="align-middle" data-key="t-logout">Logout</span>
					 </a>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>