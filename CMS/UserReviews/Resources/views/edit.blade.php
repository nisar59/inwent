@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">User Review</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('user-reviews')}}">User Reviews</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('user-reviews/update/'.$userreviews->id)}}" method="POST" class="card" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Edit User Review</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{$userreviews->name}}" class="form-control"  placeholder="Enter Name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Designation</label>
                                <input type="text" name="designation" value="{{$userreviews->designation}}" class="form-control"  placeholder="Enter Designation">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image" id="image" onchange="document.getElementById('image-display').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <img src="{{StorageFile($userreviews->image)}}" class="image-display" id="image-display" width="100" height="100">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Review</label>
                                <textarea name="review" class="form-control" cols="68" placeholder="Enter Review" rows="10">{{$userreviews->review}}</textarea>
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
@endsection