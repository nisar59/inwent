@extends('layouts.template')
@section('content')
 <!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Footer Menu</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('main-menu')}}">Footer Menu</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('footer-menu/update/'.$footer_menu->id)}}" method="POST" class="card">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Edit Footer Menu</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Footer Menu Headings</label>
                                <select name="cms_footer_menu_heading_id" class="form-control">
                                    <option>Select Footer Heading</option>
                                    @foreach($footer_menu_heading as $footer_menu_h)
                                    <option value="{{$footer_menu_h->id}}"{{ $footer_menu_h->id == $footer_menu->cms_footer_menu_heading_id ? 'selected' : ''}}>{{$footer_menu_h->heading}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Text</label>
                                    <input type="text" class="form-control"name="text" value="{{$footer_menu->text}}" placeholder="Enter Text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>URL Type</label>
                                    <select class="form-control" name="url_type" id="url_type_chnage">
                                        <option>Select URL Type</option>
                                        <option value="0"@if($footer_menu->url_type=="0") selected @endif>Page</option>
                                        <option value="1"@if($footer_menu->url_type=="1") selected @endif>URL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="type-content">
                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="link" class="form-control"  name="url" value="{{$footer_menu->url}}" placeholder="Enter URL">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Target</label>
                                <select name="target" class="form-control">
                                    <option value="0"@if($footer_menu->target=="0") selected @endif>Parent</option>
                                    <option value="1"@if($footer_menu->target=="1") selected @endif>New Tab</option>
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