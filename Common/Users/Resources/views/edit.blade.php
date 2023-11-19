@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">
				<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Admins</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{url('admins')}}">Admins</a></li>
						<li class="breadcrumb-item active">Create</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="row">
			<div class="col-sm-12">
				<form action="{{url('admins/update/'.$admin->id)}}" method="POST" class="card">
					@csrf
					<div class="card-header p-3">
						<h5 class="card-title">Add Admin</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="">Name</label>
								<input type="text" name="name" value="{{$admin->name}}" class="form-control" placeholder="Name">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Email</label>
								<input type="email" name="email" value="{{$admin->email}}" class="form-control" placeholder="Email">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Password</label>
								<input type="text" name="password" class="form-control" placeholder="Password">
								<p><b>Note: </b>Leave empty if you don't want to change password!</p>
							</div>
							<div class="col-md-6 form-group">
								<label for="">Role</label>
								<select name="role" class="form-control" @if($admin->hasRole('super-admin')) disabled @endif>
									<option value="">Select a Role</option>
									@foreach($roles as $role)
									<option value="{{$role->name}}" {{in_array($role->name, $admin->roles->pluck('name')->toArray()) ? 'selected' : ''}}>{{$role->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="card-footer text-end">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>
<!-- /Page Wrapper -->
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function() {
});
</script>
@endsection