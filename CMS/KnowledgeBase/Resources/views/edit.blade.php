@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Knowledge Base</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('knowledge-base')}}">Knowledge Base</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('knowledge-base/update/'.$knowledge_base->id)}}" method="POST" class="card">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Add Knowledge Base</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Knowledge Base Categories</label>
                                <select name="knowledge_base_category_id" class="form-control">
                                    <option value="">Select Knowledge Base Category</option>
                                    @foreach($knowledge_base_cate as $know_base)
                                    <option value="{{$know_base->id}}"{{ ($know_base->id == $knowledge_base->knowledge_base_category_id) ? 'selected' : '' }}>{{$know_base->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" value="{{$knowledge_base->title}}" id="title" class="form-control"  placeholder="Enter Title">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Description</label>
                                <textarea name="description" class="editor form-control">{{$knowledge_base->description}}</textarea>
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
<script>


</script>
@endsection