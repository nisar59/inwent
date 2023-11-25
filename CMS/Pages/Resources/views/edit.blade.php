@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Page</h3>
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
                <form action="{{url('pages/update/'.$page->id)}}" method="POST" class="card">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Edit Page</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="">Slider/Banner</label>
                                <select name="slider_banner_type" id="slider_banner_type" class="form-control">
                                  <option value="">Select</option>
                                  <option @if($page->slider_banner_type=='slider') selected @endif value="slider">Slider</option>
                                  <option @if($page->slider_banner_type=='banner') selected @endif value="banner">Banner</option>
                                  <option @if($page->slider_banner_type=='action-banner') selected @endif value="action-banner">Action Banner</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-12" id="slider-banner">
                              @if($page->slider_banner_type=="slider")
                              <div class="form-group">
                                <label for="">Slider</label>
                                <select name="slider_banner_id" class="form-control">
                                <option value="">Select Slider</option>
                                  @foreach($sliders as $slider)
                                  <option value="{{$slider->id}}" @if($slider->id==$page->slider_banner_id) selected @endif>{{$slider->title}}</option>
                                  @endforeach
                                </select>
                              </div>   

                              @elseif($page->slider_banner_type=="banner")
                              <div class="form-group"><label for="">Banner</label>
                              <select name="slider_banner_id" class="form-control">
                                <option value="">Select Banner</option>
                                @foreach($banners as $banner)
                                <option value="{{$banner->id}}" @if($banner->id==$page->slider_banner_id) selected @endif>{{ $banner->name }}</option>
                                @endforeach
                              </select></div>

                              @elseif($page->slider_banner_type=="action-banner")
                              <div class="form-group"><label for="">Banner</label>
                              <select name="slider_banner_id" class="form-control">
                                <option value="">Select Banner</option>
                                @foreach($action_banners as $actbnr)
                                <option value="{{$actbnr->id}}" @if($actbnr->id==$page->slider_banner_id) selected @endif>{!! $actbnr->title !!}</option>
                                @endforeach
                              </select></div>


                              @else

                              @endif
                            </div>


                            <div class="col-md-6 form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{$page->title}}"  placeholder="Enter Title">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" value="{{$page->slug}}"  placeholder="Enter Slug">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Meta Title</label>
                                <input type="text" name="meta_title" value="{{$page->meta_title}}" class="form-control"  placeholder="Enter Title">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Meta Description</label>
                                <textarea name="meta_description" class="form-control"  id="" cols="68" placeholder="Enter Description" rows="10">{{$page->meta_description}}</textarea>
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



$(document).on("change",'#slider_banner_type', function() {
var type=$(this).val();
var slider_html=`<div class="form-group">
                <label for="">Slider</label>
                <select name="slider_banner_id" class="form-control">
                <option value="">Select Slider</option>
                  @foreach($sliders as $slider)
                  <option value="{{$slider->id}}" @if($slider->id==$page->slider_banner_id) selected @endif>{{$slider->title}}</option>
                  @endforeach
                </select>
              </div>`;

var banner_html=`<div class="form-group"><label for="">Banner</label>
<select name="slider_banner_id" class="form-control">
<option value="">Select Banner</option>
  @foreach($banners as $banner)
  <option value="{{$banner->id}}" @if($banner->id==$page->slider_banner_id) selected @endif>{{$banner->name}}</option>
  @endforeach
</select></div>`;


var action_banner_html=`<div class="form-group"><label for="">Action Banner</label>
<select name="slider_banner_id" class="form-control">
<option value="">Select Banner</option>
  @foreach($action_banners as $acbnr)
  <option value="{{$acbnr->id}}" @if($acbnr->id==$page->slider_banner_id) selected @endif>{!!$acbnr->title!!}</option>
  @endforeach
</select></div>`;


if(type=="slider"){
$("#slider-banner").html(slider_html);
}
else if(type=="banner"){
$("#slider-banner").html(banner_html);
}
else if(type=="action-banner"){
$("#slider-banner").html(action_banner_html);
}
else{
  $("#slider-banner").html('');

}

});

});
</script>
@endsection