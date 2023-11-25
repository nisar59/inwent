@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Banner</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('banner')}}">Banner</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('banner/store')}}" class="row" method="POST" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-header p-3">
                                        <h5 class="card-title">Add Title</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="">Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                            </div>                                             
                                            <div class="col-12">
                                                <label for="">Title</label>
                                                <input type="text" name="title" class="form-control editor" placeholder="Enter Title">
                                            </div>                                           
                                            <div class="col-12">
                                                <label for="">Button Type</label>
                                                <select name="btn_type" class="form-control">
                                                    <option value="">Select Button Type</option>
                                                    @foreach(ButtonTypes() as $key=> $colr)
                                                    <option value="{{$key}}">{{$colr}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="">Button Text</label>
                                                <input type="text" class="form-control" name="btn_text" placeholder="Enter Button Text">
                                            </div>
                                             <div class="col-12">
                                                <label for="">Button URL</label>
                                                <input type="text" class="form-control" name="btn_url" placeholder="Enter Button URL">
                                            </div>

                                            <div class="col-12">
                                                <label for="">Image</label>
                                                <input type="file" name="banner_image" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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