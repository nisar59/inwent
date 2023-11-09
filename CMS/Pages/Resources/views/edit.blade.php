@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Pages</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('pages')}}">Pages</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('pages/update/'.$pages->id)}}" method="POST" class="card">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Edit Pages</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{$pages->title}}"  placeholder="Enter Title">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" value="{{$pages->slug}}"  placeholder="Enter Slug">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Meta Title</label>
                                <input type="text" name="meta_title" value="{{$pages->meta_title}}" class="form-control"  placeholder="Enter Title">
                            </div>
                             <div class="col-md-12 form-group">
                                <label for="">Meta Description</label>
                              <textarea name="meta_description" class="form-control"  id="" cols="68" placeholder="Enter Description" rows="10">{{$pages->meta_description}}</textarea>
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
@section('js')
<script type="text/javascript">
$(document).ready(function() {
    $("#title").keyup(function() {
  var Text = $(this).val();
  Text = Text.toLowerCase();
  Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
  $("#slug").val(Text);        
});
});
</script>
@endsection