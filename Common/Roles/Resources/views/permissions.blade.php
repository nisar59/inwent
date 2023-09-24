@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Roles & Permission</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('roles')}}">Roles</a></li>
                        <li class="breadcrumb-item active">Permissions</li>
                    </ul>
                </div>
                <div class="col-auto">
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <form method="POST" action="{{url()->current()}}" class="row">
            @csrf
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header mb-4">
                            <h5 class="card-title">Role Name</h5>
                        </div>
                        <div class="form-group">
                            <label>Role Name</label>
                            <select class="form-control" disabled>
                                <option>{{$role->name}}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header mb-4">
                            <h5 class="card-title">Role Permissions</h5>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                            @foreach(AllPermissions() as $module=> $submodules)
                            @if(count($submodules)>0)
                            <h5 class="w-100 text-capitalize ">{{$module}}</h5>
                            @endif
                            @foreach($submodules as $submodule =>$permissions)
                            @foreach($permissions as $permission)
                            @php
                            $permission_name=$submodule.'.'.$permission;
                            $role_permissions=$role->permissions->pluck('name')->toArray();
                            @endphp
                            <div class="col d-flex">
                                <div class="card border flex-fill">
                                    <div class="card-body p-3 text-center">
                                        <p class="card-text f-12 text-capitalize">{{$submodule}} {{$permission}} </p>
                                    </div>
                                    <div class="card-footer">
                                        <label class="form-group toggle-switch mb-0" for="{{$permission_name}}">
                                            <input type="checkbox" value="{{$permission_name}}" name="permissions[]" class="toggle-switch-input" id="{{$permission_name}}" {{in_array($permission_name, $role_permissions) ? 'checked' : ''}}>
                                            <span class="toggle-switch-label mx-auto">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
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