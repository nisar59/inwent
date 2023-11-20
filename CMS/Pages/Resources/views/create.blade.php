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
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('pages/store')}}" method="POST" class="card">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Add Page</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="">Slider/Banner</label>
                                <select name="slider_banner_type" id="slider_banner_type" class="form-control">
                                  <option value="">Select</option>
                                  <option value="slider">Slider</option>
                                  <option value="banner">Banner</option>
                                  <option value="action-banner">Action Banner</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-12" id="slider-banner"></div>
                            <div class="col-md-6 form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" id="title" class="form-control"  placeholder="Enter Title">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control"  placeholder="Enter Slug">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control"  placeholder="Enter Title">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Meta Description</label>
                                <textarea name="meta_description" class="form-control"  id="" cols="68" placeholder="Enter Description" rows="10"></textarea>
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
                  @foreach($sliders as $slider)
                  <option value="{{$slider->id}}">{{$slider->title}}</option>
                  @endforeach
                </select>
              </div>`;

var banner_html=`<div class="form-group"><label for="">Banner</label>
<select name="slider_banner_id" class="form-control">
  @foreach($banners as $banner)
  <option value="{{$banner->id}}">{{$banner->title}}</option>
  @endforeach
</select></div>`;


var action_banner_html=`<div class="form-group"><label for="">Action Banner</label>
<select name="slider_banner_id" class="form-control">
  @foreach($action_banners as $acbnr)
  <option value="{{$acbnr->id}}">{{$acbnr->title}}</option>
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