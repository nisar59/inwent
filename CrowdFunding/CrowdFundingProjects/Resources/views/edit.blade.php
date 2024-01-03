@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Sponsored Posts</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('professional-skills')}}">Sponsored Posts</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('network/sponsored-posts/update/'.$post->id)}}" method="POST" class="card" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Edit Sponsored Posts</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="">Sponsored Post Name</label>
                                <input type="text" name="name" value="{{$post->name}}" class="form-control"  placeholder="Sponsored Post Name">
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="">Sponsored Corporation / Business Name</label>
                                <input type="text" value="{{$post->corporation_business_name}}" name="corporation_business_name" class="form-control"  placeholder="Sponsored Corporation/Business Name">
                            </div>
                            <div class="col-md-4 form-group text-truncate">
                                <label for="">Sponsored Corporation / Business Avatar</label>
                                <input type="file" name="corporation_business_avatar" class="form-control">
                                <a target="_blank" href="{{$post->corporation_business_avatar}}"><i class="fas fa-external-link-alt"></i> {{$post->corporation_business_avatar}}</a>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Description</label>
                                <textarea name="description" placeholder="Description" class="form-control editor">{{$post->description}}</textarea>
                            </div>

                            <div class="col-md-4 form-group text-truncate">
                                <label for="">Sponsored Media</label>
                                <input type="file" name="media" class="form-control">
                                <a target="_blank" href="{{$post->media}}"><i class="fas fa-external-link-alt"></i> {{$post->media}}</a>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="">Action URL</label>
                                <input type="text" value="{{$post->action}}" name="action" class="form-control" placeholder="Action Content">
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="">Action Text</label>
                                <input type="text" value="{{$post->action_text}}" name="action_text" class="form-control" placeholder="Action Content">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Action Description</label>
                                <textarea type="text" name="action_description" class="form-control" placeholder="Action Description"> {{$post->action_description}}</textarea>
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
});
</script>
@endsection