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
                        
                        <li class="breadcrumb-item active">Sponsored Posts</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{url('/network/sponsored-posts/create')}}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table w-100 table-sm table-bordered datatables">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Corporation / Business Name</th>
                                        <th class="text-center">Corporation / Business Avatar</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- /Page Wrapper -->

@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function() {
    var data_table;

    function DataTableInit(data = {}) {
        data_table = $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{url('network/sponsored-posts')}}",
                data: data,
            },
            buttons: [],
            columns: [
            {
                data: 'name',
                name: 'name',
                class:'text-center'
            },
            {
                data: 'corporation_business_name',
                name: 'corporation_business_name',
                class:'text-center',
                orderable:false,
                searchable:false
            },

            {
                data: 'corporation_business_avatar',
                name: 'corporation_business_avatar',
                class:'text-center',
                orderable:false,
                searchable:false
            },

            {
                data: 'status',
                name: 'status',
                class:'text-center',
                orderable:false,
                searchable:false
            },
             {
                data: 'action',
                name: 'action',
                orderable: false,
                class: "d-flex justify-content-center w-auto",
                searchable: false
            }, ],
        });
    }
    DataTableInit();
    $(document).on('change', '.filters', function() {
        var data = {};
        $('.filters').each(function() {
            data[$(this).attr('name')] = $(this).val();
        });
        data_table.destroy();
        DataTableInit(data);
    });
});
</script>
@endsection