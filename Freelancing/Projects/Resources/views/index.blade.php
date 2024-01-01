@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Freelancing Projects</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        
                        <li class="breadcrumb-item active">Freelancing Projects</li>
                    </ul>
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
                                        <th class="text-center">Project Name</th>
                                        <th class="text-center">Pricing Type</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">User Name</th>
                                        <th class="text-center">User Email</th>
                                        <th class="text-center">Posted Date</th>
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
                url: "{{url('freelancing/projects')}}",
                data: data,
            },
            buttons: [],
            columns: [
            {
                data: 'project_name',
                name: 'project_name',
                class:'text-center'
            },
            {
                data: 'pricing_type',
                name: 'pricing_type',
                class:'text-center',
                orderable:false,
                searchable:false
            },

            {
                data: 'price',
                name: 'price',
                class:'text-center',
                orderable:false,
                searchable:false
            },

            {
                data: 'user_name',
                name: 'user_name',
                class:'text-center',
                orderable:false,
                searchable:false
            },

            {
                data: 'user_email',
                name: 'user_email',
                class:'text-center',
                orderable:false,
                searchable:false
            },


            {
                data: 'created_at',
                name: 'created_at',
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