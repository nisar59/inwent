@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Project Configuration</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('pages')}}">Project Configuration</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('project-config/store')}}" method="POST" class="card">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Add Project Configuration</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Type</label>
                                <select name="type" id="" class="form-control">
                                    <option>Select One Type</option>
                                    @foreach(Types() as $key=> $type)
                                    <option value="{{$key}}">{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Name</label>
                                <input type="text" name="name"class="form-control"  placeholder="Enter Name">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control" cols="68" placeholder="Enter Description" rows="10"></textarea>
                            </div>
                            
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