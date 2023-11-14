@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Footer Menu Heading</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('footer-menu-headings')}}">Footer Menu Heading</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <form action="{{url('footer-menu-headings/store')}}" method="POST" class="card">
                    @csrf
                    <div class="card-header p-3">
                        <h5 class="card-title">Add Footer Menu Heading</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Heading</label>
                                <input type="text" name="heading" class="form-control"  placeholder="Enter Heading">
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