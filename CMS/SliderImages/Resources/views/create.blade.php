@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Slider Images</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('main-menu')}}">Slider Images</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('slider-images/store')}}" method="POST" class="card" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Add Slider Images</h5>
                    </div>
                    <div class="card-body">
                        <input type="text" hidden name="slider_id" value="{{request()->route('id')}}">
                        <div class="row field_wrapper">
                            <div class="col-md-11">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="images[]" placeholder="Enter Text">
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-success add_button" style="margin-top: 24px;" type="button"><i class="fas fa-plus "></i></button>
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
    @endsection
    @section('js')
    <script type="text/javascript">
    $(document).ready(function(){
    var maxField = 10;
    var addButton = $('.add_button');
    var wrapper = $('.field_wrapper');
    var fieldHTML = `<div><div class="row" id="removeall"><div class="col-md-10">
        <label for="">Image</label>
        <input type="file" class="form-control" name="images[]" placeholder="Enter Text">
    </div>
    <div class="col-md-2">
        <button class="btn btn-danger remove_button" style="margin-top: 24px;" type="button"><i class="fa fa-trash "></i></button>
    </div></div></div>`;
    var x = 1;
    $(addButton).click(function(){
    if(x < maxField){
    x++;
    $(wrapper).append(fieldHTML);
    }
    });
    $(wrapper).on('click', '.remove_button', function(e){
    /*$(this).parent('#removeall').remove();*/
    $(this).closest('#removeall').remove();
    x--;
    });
    });
    </script>
    @endsection