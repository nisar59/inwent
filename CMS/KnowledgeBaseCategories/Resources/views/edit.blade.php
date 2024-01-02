@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Knowledge Base Category</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('knowledge-base-categories')}}">Knowledge Base Categories</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('knowledge-base-categories/update/'.$knowledge_base_cate->id)}}" method="POST" class="card">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Edit Knowledge Base Category</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" value="{{$knowledge_base_cate->title}}" class="form-control"  placeholder="Enter Title">
                            </div>

                            <div class="col-md-12 form-group text-truncate">
                                <label for="">Icon</label>
                                <input type="file" name="icon" class="form-control">
                                <a class="text-truncate" target="_blank" href="{{$knowledge_base_cate->icon}}"> <i class="fas fa-external-link-alt"></i> {{$knowledge_base_cate->icon}}</a>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="">Description</label>
                                <input type="text" name="description" value="{{$knowledge_base_cate->description}}" class="form-control"  placeholder="Enter description">
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
 