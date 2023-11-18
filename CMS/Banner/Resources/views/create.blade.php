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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-header p-3">
                                        <h5 class="card-title">Add Title</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="">Title</label>
                                                <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title">
                                            </div>
                                        </div>
                                        <div class="mt-1" id="row"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-header p-3">
                                        <h5 class="card-title">Add Action</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="">Text</label>
                                                <input type="text" class="form-control" name="btn_text" placeholder="Enter Text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="">URL</label>
                                                <input type="text" class="form-control" name="btn_url" placeholder="Enter URL">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="">Colors</label>
                                                <select name="btn_type" class="form-control">
                                                    <option>Select Button</option>
                                                    @foreach(ButtonTypes() as $key=> $colr)
                                                    <option value="{{$key}}">{{$colr}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-header p-3">
                                        <h5 class="card-title">Add Image</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="">Image</label>
                                                <input type="file" name="banner_image" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="card">
                            <div class="card-header p-3">
                                <h5 class="card-title">Preview</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="title-preview" name="title">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
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
$(document).on('input','#title',function() {
var words=$(this).val().trim().split(" ");
var html='';
$.each(words, function(indx, vl) {
html+=`<div class="row"><div class="col-6 form-group">
    <input type="text" value="`+vl+`" class="form-control title-segments" placeholder="Enter Text">
</div>
<div class="col-6 form-group ">
    <select class="form-control color-segment">
        @foreach(BannerTitleColors() as $color=>$name)
        <option value="{{$color}}">{{$name}}</option>
        @endforeach
    </select>
</div></div>`;
});
$('#row').html(html);
TitleDesign();
});
$(document).on('change', '.color-segment', function() {
TitleDesign();
});
function TitleDesign() {
var html_des=`<h1 class="fw-bold text-center" style="">`;
$(".title-segments").each(function(ele) {
var color=$(this).parent().parent().find('.color-segment');
html_des+=`<font color='`+color.val()+`'>`+$(this).val()+`</font> `;
});
html_des+=`</h1>`;
$("#title-preview").html(html_des);
}
});
</script>
@endsection