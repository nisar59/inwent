@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Blog</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('blog')}}">Blogs</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('blogs/store', request()->id)}}" method="POST" class="card" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Add Blog</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Page Banner (1680x304)</label>
                                <input type="file" name="page_banner" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Thumbnail (1200x800)</label>
                                <input type="file" name="thumbnail" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" id="title" class="form-control"  placeholder="Enter title">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control"  placeholder="Enter Slug">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Short Description</label>
                                <textarea name="short_description" class="form-control"></textarea>
                            </div>
                              
                            <div class="col-md-12 form-group">
                                <label>Description</label>
                                <textarea name="description" class="editor form-control"></textarea>
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
$("#title").keyup(function() {
var Text = $(this).val();
Text = Text.toLowerCase();
Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
$("#slug").val(Text);
});

</script>
@endsection