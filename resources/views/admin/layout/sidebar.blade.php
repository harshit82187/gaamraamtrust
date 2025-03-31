<div class="sidebar" data-background-color="dark">
	<div class="sidebar-logo">
		<!-- Logo Header -->
		<div class="logo-header" data-background-color="dark" style="background:white;">
			<a href="{{ url('/') }}" target="_blank" class="logo">
			<img
				src="{{ asset('front/images/Gaam_Raam_logo.png') }}"
				alt="navbar brand"
				class="navbar-brand"
				height="50"
				/>
			</a>
			<div class="nav-toggle">
				<button class="btn btn-toggle toggle-sidebar">
				<i class="gg-menu-right"></i>
				</button>
				<button class="btn btn-toggle sidenav-toggler">
				<i class="gg-menu-left"></i>
				</button>
			</div>
			<button class="topbar-toggler more">
			<i class="gg-more-vertical-alt"></i>
			</button>
		</div>
		<!-- End Logo Header -->
	</div>
	<div class="sidebar-wrapper scrollbar scrollbar-inner">
		<div class="sidebar-content">
			<ul class="nav nav-secondary">
				<li class="nav-item active">
					<a	href="{{ route('admin.dashboard') }}"	aria-expanded="false">
						<i class="fas fa-home"></i>	<p>Dashboard</p>						
					</a>					
				</li>
			
				<li class="nav-item {{ request()->routeIs('admin.enrool-student') ? 'active' : '' }}">
					<a  href="{{ route('admin.enrool-student') }}">
						<i class="fas fa-user-plus"></i>
						<p>Enroll Student</p>
					</a>					
				</li>

				<li class="nav-item {{ request()->routeIs('admin.member.indian-list') ? 'active' : '' }}">
					<a data-bs-toggle="collapse" href="#members">
						<i class="fas fa-id-card"></i>
						<p>Manage Member</p>
						<span class="caret"></span>
					</a>
					<div class="collapse  {{ request()->routeIs('admin.member.indian-list') ? 'show' : '' }}"  id="members">
						<ul class="nav nav-collapse">
							<li class="{{ request()->routeIs('admin.member.indian-list') ? 'active' : '' }}" >
								<a href="{{ route('admin.member.indian-list') }}">
								<span class="sub-item">Member List</span>
								</a>
							</li>
							
						</ul>
					</div>
				</li>

				
				<li class="nav-item {{ request()->routeIs('admin.donation-report') ? 'active' : '' }}">
					<a data-bs-toggle="collapse" href="#donations">
						<i class="fas fa-gem"></i>
						<p>Donation &  Point's</p>
						<span class="caret"></span>
					</a>
					<div class="collapse {{ request()->routeIs('admin.donation-report') ? 'show' : '' }}" id="donations">
						<ul class="nav nav-collapse">
							<li class="{{ request()->routeIs('admin.donation-report') ? 'active' : '' }}">
								<a href="{{ route('admin.donation-report') }}">	<span class="sub-item">Donation Report</span></a>
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item {{ request()->routeIs('admin.notification') ? 'active' : '' }}">
					<a href="{{ route('admin.notification') }}">
						<i class="fas fa-bell"></i>
						<p>Student Notification</p>
					</a>				
				</li>

				<li class="nav-item {{ request()->routeIs('admin.document') ? 'active' : '' }}">
					<a  href="{{ route('admin.document') }}">
						<i class="fas fa-file-alt"></i>
						<p>Student Document</p>
					</a>
				
				</li>

				<li class="nav-item {{ request()->routeIs('admin.courses') ? 'active' : '' }}">
					<a data-bs-toggle="collapse" href="#courses" class="menu-link">
						<i class="fas fa-book-open"></i>
						<p>Course Management</p>
						<span class="caret"></span>
					</a>
					<div class="collapse {{ request()->routeIs('admin.courses') || request()->routeIs('admin.edit-course') ? 'show' : '' }}" id="courses">
						<ul class="nav nav-collapse">
							<li class="{{ request()->routeIs('admin.courses') || request()->routeIs('admin.edit-course') ? 'active' : '' }}">
								<a href="{{ route('admin.courses') }}">
									<span class="sub-item">Add Course</span>
								</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item {{ request()->routeIs('admin.college-add') ? 'active' : '' }}">
					<a data-bs-toggle="collapse" href="#collegeManagement">
						<i class="fas fa-university"></i>
						<p>College Management</p>
						<span class="caret"></span>
					</a>
					<div class="collapse {{ request()->routeIs('admin.college-add') || request()->routeIs('admin.college-list') ? 'show' : '' }}" id="collegeManagement">
						<ul class="nav nav-collapse">
							<li class="{{ request()->routeIs('admin.college-add') ? 'active' : '' }}">
								<a href="{{ route('admin.college-add') }}">	<span class="sub-item">College Add</span></a>
							</li>
							<li class="{{ request()->routeIs('admin.college-list') ? 'active' : '' }}">
								<a href="{{ route('admin.college-list') }}">	<span class="sub-item">College List</span></a>
							</li>
							
						</ul>
					</div>
				</li>

					<li class="nav-item {{ request()->routeIs('admin.test-series.list') ? 'active' : '' }}">
					<a data-bs-toggle="collapse" href="#questions">
						<i class="fas fa-question-circle"></i>
						<p>Question Bank</p>
						<span class="caret"></span>
					</a>
					<div class="collapse  {{ request()->routeIs('admin.test-series.list') || request()->routeIs('admin.question.list') ? 'show' : '' }}"  id="questions">
						<ul class="nav nav-collapse">
							<li class="{{ request()->routeIs('admin.test-series.list') ? 'active' : '' }}" >
								<a href="{{ route('admin.test-series.list') }}">
								<span class="sub-item">Add Test Series</span>
								</a>
							</li>

							<li class="{{ request()->routeIs('admin.question.list') ? 'active' : '' }}" >
								<a href="{{ route('admin.question.list') }}">
								<span class="sub-item">Add Question</span>
								</a>
							</li>
							
						</ul>
					</div>
				</li>

				<li class="nav-item {{ request()->routeIs('admin.task-list') ? 'active' : '' }}">
					<a data-bs-toggle="collapse" href="#tasks">
						<i class="fas fa-tasks"></i>
						<p>Manage Task</p>
						<span class="caret"></span>
					</a>
					<div class="collapse  {{ request()->routeIs('admin.task-list') ? 'show' : '' }}" id="tasks">
						<ul class="nav nav-collapse">
							<li class="{{ request()->routeIs('admin.task-list') ? 'active' : '' }}" >
								<a href="{{ route('admin.task-list') }}">
								<span class="sub-item">Add Task</span>
								</a>
							</li>
							
						</ul>
					</div>
				</li>

				<li class="nav-item {{ request()->routeIs('admin.social-pages.privacy-policy') ||  request()->routeIs('admin.social-pages.term-condition') || request()->routeIs('admin.contact-us') ? 'active' : '' }}">
					<a data-bs-toggle="collapse" href="#settings">
						<i class="fas fa-shield-alt"></i>
						<p>Trust Setting</p>
						<span class="caret"></span>
					</a>
					<div class="collapse  {{ request()->routeIs('admin.social-pages.privacy-policy') || request()->routeIs('admin.social-pages.term-condition') ? 'show' : '' }}"  id="settings">
						<ul class="nav nav-collapse">
							<li class="{{ request()->routeIs('admin.social-pages.privacy-policy') || request()->routeIs('admin.social-pages.term-condition') ? 'active' : '' }}" >
								<a href="{{ route('admin.social-pages.privacy-policy') }}">
								<span class="sub-item">Social Pages</span>
								</a>
							</li>

							<li class="{{ request()->routeIs('admin.contact-us')  ? 'active' : '' }}" >
								<a href="{{ route('admin.contact-us') }}">
								<span class="sub-item">Contact Us</span>
								</a>
							</li>
							
						</ul>
					</div>
				</li>

				

				


			
			</ul>
		</div>
	</div>
</div>