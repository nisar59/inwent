<!-- Header -->
<div class="header">
	
	<!-- Logo -->
	<div class="header-left">
		<a href="/" class="logo">
			<img src="{{Settings()->portal_logo}}" alt="Logo">
		</a>
		<a href="/" class="logo logo-small">
			<img src="{{Settings()->portal_logo_small}}" alt="Logo" width="30" height="30">
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
	<div class="top-nav-search">

	</div>
	<!-- /Search -->
	
	<!-- Header Menu -->
	<ul class="nav user-menu">
		<div class="nav-item dropdown mt-2">
			<a href="#" style="color:#003eae" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
				<i class="h4 feather-grid"></i>
			</a>
			<div class="dropdown-menu notifications">
				<div class="topnav-dropdown-header">
					<span class="notification-title">Apps</span>
				</div>
				<div class="noti-content">
					<div class="row m-0 p-2 justify-content-evenly">
					@php($i=0)
					@foreach(APPS() as $key=>$app)
						
						<a href="{{url('module',$key)}}" style="background-color: {{$app['bg']}} ;" class="@if($i==0) col-8 @else col-5 @endif @if($app['bg']!='') text-light @endif text-center p-2 mb-2 shadow rounded">
							<i class="h4 {{$app['icon']}}"></i>
							<p class="h5 fw-bold">{{$app['title']}}</p>
						</a>


						@php($i=$i+1)
					@endforeach
					</div>
				</div>
				<div class="topnav-dropdown-footer">
					
				</div>
			</div>
		</div>
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