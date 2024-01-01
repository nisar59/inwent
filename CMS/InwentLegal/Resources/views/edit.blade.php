@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Inwent Legal</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('inwent-legal')}}">Inwent Legal</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('inwent-legal/update/'.$inwentlegal->id)}}" method="POST" class="card">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Edit Inwent Legal</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" id="title" value="{{$inwentlegal->title}}" class="form-control"  placeholder="Enter title">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Slug</label>
                                <input type="text" name="slug" id="slug" value="{{$inwentlegal->slug}}" class="form-control"  placeholder="Enter Slug">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Effective Date</label>
                                <input type="date" name="effective_date" value="{{$inwentlegal->effective_date}}" class="form-control" placeholder="Enter Effective Date">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Summary Of Changes</label>
                                <input type="text" name="summary_of_changes" value="{{$inwentlegal->summary_of_changes}}" class="form-control" placeholder="Enter Summary Of Changes">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Description</label>
                                <textarea name="description" placeholder="Description" class="editor">{{$inwentlegal->description}}</textarea>
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