<div id="scrollbar">
	<div class="container-fluid">
		<div id="two-column-menu">
		</div>
		<ul class="navbar-nav" id="navbar-nav">
			<li class="menu-title"><span data-key="t-menu">Menu</span></li>
			@php   $documentExist = \App\Models\Document::where('student_id',Auth::guard('student')->user()->id)->get(); @endphp
			@if(count($documentExist) >= '3')
			<li class="nav-item">
				<a class="nav-link menu-link" href="{{ route('student.dashboard') }}">
				<i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">Dashboard</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ route('student.profile') }}" class="nav-link menu-link {{ request()->routeIs('student.profile') ? 'active' : '' }}">
					<i class="fas fa-user"></i> 
					<span data-key="t-users">Profile</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ route('student.document-list') }}" class="nav-link menu-link {{ request()->routeIs('student.document-list') ? 'active' : '' }}">
					<i class="fas fa-file-alt"></i> 
					<span data-key="t-users">Document</span>
				</a>
			</li>

			<li class="nav-item">
				<a href="#testSeriesSubmenu" class="nav-link menu-link {{ request()->routeIs('student.test-series-list') ? 'active' : '' }}" data-bs-toggle="collapse" aria-expanded="false">
					<i class="fas fa-pen-alt"></i>
					<span data-key="t-users">Test Series</span>				
				</a>
				<ul class="collapse list-unstyled {{ request()->routeIs('student.test-series-list') ? 'show' : '' }}" id="testSeriesSubmenu">
					<li class="nav-item">
						<a href="{{ route('student.test-series-list') }}" class="nav-link {{ request()->routeIs('student.test-series-list') ? 'active' : '' }}">
							<i class="fas fa-dot-circle"></i>Test Series List
						</a>
					</li>
					<li class="nav-item">
						<a href="" class="nav-link ">
							<i class="fas fa-circle"></i> Attempted Tests
						</a>
					</li>
				</ul>
			</li>			

			<li class="nav-item">
				<a href="{{ route('student.notification') }}" class="nav-link menu-link {{ request()->routeIs('student.notification') ? 'active' : '' }}">
					<i class="fas fa-bell"></i> 
					<span data-key="t-users">Notification</span>
				</a>
			</li>
			@endif
			
			
		

			

			
		</ul>
	</div>
	<!-- Sidebar -->
</div>