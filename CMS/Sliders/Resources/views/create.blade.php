@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Sliders</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('main-menu')}}">Sliders</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('sliders/store')}}" method="POST" class="card">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Add Slider</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-11 form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" class="form-control"  placeholder="Enter Title">
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-success add_button" style="margin-top: 24px;" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                            <div class="col-12" id="field_wrapper">
                                
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

    var addButton = $('.add_button');  
    var wrapper = $('#field_wrapper');  


    $(addButton).click(function(){ 

    var indx=0;
    if($("#field_wrapper .row").length>0){
        var row=$("#field_wrapper .row").last();
        indx=row.data('index')+1;
    }

    var fieldHTML = `<div class="row" data-index="`+indx+`"><div class="col-md-5">
                                <label for="">Text</label>
                                <input type="text" class="form-control" name="actions[`+indx+`][text]" placeholder="Enter Text">
                            </div>
                            <div class="col-md-6">
                                <label for="">URL</label>
                                <input type="link" class="form-control" name="actions[`+indx+`][url]" placeholder="Enter URL">
                            </div><div class="col-md-1">
                                <button class="btn btn-danger remove_button" style="margin-top: 24px;" type="button"><i class="fa fa-trash "></i></button>
                            </div></div> `;  

        $(wrapper).append(fieldHTML);
    });

    $(wrapper).on('click', '.remove_button', function(e){
        $(this).closest('.row').remove();  
    });
});
    </script>
    @endsection