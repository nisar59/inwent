@extends('layouts.app')
@section('content')
<!-- Main Wrapper -->
<div class="main-wrapper login-body">
	<!-- Page Content -->
	<div class="container-fluid">
		<div class="row account-page-container justify-content-center align-items-center">
			<div class="col-md-9 col-sm-12 account-page-inner-container">
				<div class="row h-100 ">
					<form action="{{ route('register') }}" method="POST" class="col-md-6 col-sm-12 m-0 p-5 pt-3 h-100 account-page-left-container login-left">
						@csrf
						<div class="row justify-content-center align-items-center h-100">
							<div class="col-12 row">
								<div class="col-12 text-center">
									<h6 class="fw-bold text-purple font-family-neue">Welcome back</h6>
									<p>Welcome back! Please enter your details</p>
								</div>
								<div class="col-md-12 form-group">
									<label for="" class="form-label">Name</label>
									<input id="name" type="text" class="form-control @error('password') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Name" autocomplete="name" autofocus>
									@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="col-md-12 form-group">
									<label for="" class="form-label">Email</label>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" autocomplete="email">
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="col-md-12 form-group position-relative">
									<label for="" class="form-label">Password</label>
									<input id="password" type="password" class="form-control pass-input @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" autocomplete="new-password">
									<i class="password-show toggle-password"></i>
									@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="col-md-12 form-group position-relative">
									<label for="" class="form-label">Confirm Password</label>
									<input id="password-confirm" type="password" class="form-control pass-input" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password">
								</div>
								<div class="col-md-12 form-group pt-3">
									<button class="btn btn-primary btn-block" type="submit">Register</button>
								</div>
							</div>
						</div>
					</form>
					<div class="col-md-6 d-none d-md-flex p-0 h-100 account-page-right-container login-right justify-content-center align-items-center">
						<a href=""><img src="{{url('assets/img/logo-with-slogun.png')}}" alt=""></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Content -->
</div>
<!-- /Main Wrapper -->
@endsection