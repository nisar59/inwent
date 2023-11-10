<!-- Header -->
<div class="header">
	
	<!-- Logo -->
	<div class="header-left">
		<a href="index.html" class="logo">
			<img src="{{asset('assets/img/white-logo.png')}}" alt="Logo">
		</a>
		<a href="index.html" class="logo logo-small">
			<img src="{{asset('assets/img/logo-small.png')}}" alt="Logo" width="30" height="30">
		</a>
		<!-- Sidebar Toggle -->
		<a href="javascript:void(0);" id="toggle_btn">
			<i data-feather="align-justify"></i>
		</a>
		<!-- /Sidebar Toggle -->
		
		<!-- Mobile Menu Toggle -->
		<a class="mobile_btn" id="mobile_btn">
			<i data-feather="align-justify"></i>
		</a>
		<!-- /Mobile Menu Toggle -->
	</div>
	<!-- /Logo -->
	
	<!-- Search -->
	<div class="top-nav-search">
		<form>
			<input type="text" class="form-control" placeholder="Start typing your Search...">
			<button class="btn" type="submit"><i class="feather-search"></i></button>
		</form>
	</div>
	<!-- /Search -->
	
	<!-- Header Menu -->
	<ul class="nav user-menu">
		<!-- Notifications -->
		<li class="nav-item dropdown">
			<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
				<i class="feather-bell"></i> <span class="badge badge-pill">5</span>
			</a>
			<div class="dropdown-menu notifications">
				<div class="topnav-dropdown-header">
					<span class="notification-title">Notifications</span>
					<a href="javascript:void(0)" class="clear-noti"> Clear All</a>
				</div>
				<div class="noti-content">
					<ul class="notification-list">
						<li class="notification-message">
							<a href="#">
								<div class="media d-flex">
									<span class="avatar avatar-sm flex-shrink-0">
										<img class="avatar-img rounded-circle" alt="" src="{{asset('assets/img/profiles/avatar-02.jpg')}}">
									</span>
									<div class="media-body flex-grow-1">
										<p class="noti-details"><span class="noti-title">Brian Johnson</span> paid the invoice <span class="noti-title">#DF65485</span></p>
										<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
									</div>
								</div>
							</a>
						</li>
						<li class="notification-message">
							<a href="#">
								<div class="media d-flex">
									<span class="avatar avatar-sm flex-shrink-0">
										<img class="avatar-img rounded-circle" alt="" src="{{asset('assets/img/profiles/avatar-03.jpg')}}">
									</span>
									<div class="media-body flex-grow-1">
										<p class="noti-details"><span class="noti-title">Marie Canales</span> has accepted your estimate <span class="noti-title">#GTR458789</span></p>
										<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
									</div>
								</div>
							</a>
						</li>
						<li class="notification-message">
							<a href="#">
								<div class="media d-flex">
									<div class="avatar avatar-sm flex-shrink-0">
										<span class="avatar-title rounded-circle bg-primary-light"><i class="far fa-user"></i></span>
									</div>
									<div class="media-body flex-grow-1">
										<p class="noti-details"><span class="noti-title">New user registered</span></p>
										<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
									</div>
								</div>
							</a>
						</li>
						<li class="notification-message">
							<a href="#">
								<div class="media d-flex">
									<span class="avatar avatar-sm flex-shrink-0">
										<img class="avatar-img rounded-circle" alt="" src="{{asset('assets/img/profiles/avatar-04.jpg')}}">
									</span>
									<div class="media-body flex-grow-1">
										<p class="noti-details"><span class="noti-title">Barbara Moore</span> declined the invoice <span class="noti-title">#RDW026896</span></p>
										<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
									</div>
								</div>
							</a>
						</li>
						<li class="notification-message">
							<a href="#">
								<div class="media d-flex">
									<div class="avatar avatar-sm flex-shrink-0">
										<span class="avatar-title rounded-circle bg-info-light"><i class="far fa-comment"></i></span>
									</div>
									<div class="media-body flex-grow-1">
										<p class="noti-details"><span class="noti-title">You have received a new message</span></p>
										<p class="noti-time"><span class="notification-time">2 days ago</span></p>
									</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="topnav-dropdown-footer">
					<a href="#">View all Notifications</a>
				</div>
			</div>
		</li>
		<!-- /Notifications -->
		
		<!-- User Menu -->
		<li class="nav-item dropdown has-arrow main-drop">
			<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
				<span class="user-img">
					<img src="{{asset('assets/img/profiles/avatar-07.jpg')}}" alt="">
					<span class="status online"></span>
				</span>
			</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="profile.html"><i data-feather="user" class="me-1"></i> Profile</a>
				<a class="dropdown-item" href="settings.html"><i data-feather="settings" class="me-1"></i> Settings</a>
				<a class="dropdown-item" onclick="$('#auth-logout').submit();" href="javascript:void(0)"><i data-feather="log-out" class="me-1"></i> Logout</a>
				<form hidden action="{{route('logout')}}" method="POST" id="auth-logout">
					@csrf
				</form>
			</div>
		</li>
		<!-- /User Menu -->
		
	</ul>
	<!-- /Header Menu -->
	
</div>
<!-- /Header -->