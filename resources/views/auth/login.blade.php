@extends('layouts.app')
@section('content')
<!-- Main Wrapper -->
<div class="main-wrapper login-body">
	<!-- Page Content -->
	<div class="container-fluid">
		<div class="row account-page-container justify-content-center align-items-center">
			<div class="col-md-9 col-sm-12 account-page-inner-container">
				<div class="row h-100 ">
					<div class="col-md-6 col-sm-12 m-0 p-5 pt-3 h-100 account-page-left-container login-left">
						<form action="{{ route('login') }}" method="POST" class="row justify-content-center align-items-center h-100">
							@csrf
							<div class="col-12 row">
								<div class="col-12 text-center">
									<h6 class="fw-bold text-purple font-family-neue">Welcome back</h6>
									<p>Welcome back! Please enter your details</p>
								</div>
								<div class="col-md-12 form-group">
									<label for="" class="form-label">Email</label>
									<input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Email" required autocomplete="email" autofocus>
								@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
								</div>
								<div class="col-md-12 form-group position-relative">
									<label for="" class="form-label">Password</label>
									<input type="password" class="form-control pass-input @error('password') is-invalid @enderror" name="password" placeholder="Password">
									<i class="password-show toggle-password"></i>

									                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
								</div>
								<div class="col-6">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
								</div>
								<div class="col-6 text-end">
									<a href="update.html">Forgot Password?</a>
								</div>
								<div class="col-md-12 form-group pt-3">
									<button class="btn btn-primary btn-block" type="submit">Log in</button>
								</div>
							</div>
						</form>
					</div>
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