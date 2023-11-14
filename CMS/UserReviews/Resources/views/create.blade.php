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
                <form action="{{url('user-reviews/store')}}" method="POST" class="card" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Add User Review</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control"  placeholder="Enter Name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Designation</label>
                                <input type="text" name="designation"class="form-control"  placeholder="Enter Designation">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Review</label>
                                <textarea name="review" class="form-control"  id="" cols="68" placeholder="Enter Review" rows="10"></textarea>
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