@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Main Menu</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('main-menu')}}">Main Menu</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('main-menu/update/'.$main_menu->id)}}" method="POST" class="card">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Edit Main Menu</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Text</label>
                                <input type="text" name="text" value="{{$main_menu->text}}" class="form-control"  placeholder="Enter Text">
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>URL Type</label>
                                    <select class="form-control" name="url_type" id="url_type_chnage">
                                        <option>Select URL Type</option>
                                        <option value="0"@if($main_menu->url_type=="0") selected @endif>Page</option>
                                        <option value="1"@if($main_menu->url_type=="1") selected @endif>URL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="type-content">
                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="link" class="form-control" value="{{$main_menu->url}}"  name="url" placeholder="Enter URL">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Target</label>
                                <select name="target" id="" class="form-control">
                                    <option value="0"@if($main_menu->target=="0") selected @endif>Parent</option>
                                    <option value="1"@if($main_menu->target=="1") selected @endif>New Tab</option>
                                </select>
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
$(document).on('change', '#url_type_chnage',function() {
var url=`<div class="col-md-6 form-group">
    <label>URL</label>
    <select class="form-control" name="url" id="type" style="width:492px;">
        <option>Select URL</option>
        @foreach($pages as $page)
        <option value="{{$page->slug}}">{{$page->slug}}</option>
        @endforeach
    </select>
</div>`;
var pages=`<div class="col-md-6">
    <div class="form-group">
        <label>URL</label>
        <input type="link" class="form-control" style="width:492px;" name="url" placeholder="Enter URL">
    </div>
</div>`;
if($(this).val()==0){
$('#type-content').html(url);
}else{
$('#type-content').html(pages);
}
});
});
</script>
@endsection