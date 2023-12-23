@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Wallet</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Deposits</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a class="btn filter-btn" href="javascript:void(0);" id="filter_search">
                        <i class="fas fa-filter"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->


        <!-- Search Filter -->
        <div class="card filter-card" id="filter_inputs">
            <div class="card-body pb-0">
                
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control filters" name="name" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control filters" name="email" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control filters">
                                    <option value=""></option>
                                    <option value="1">Active</option>
                                    <option value="0">Blocked</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <div class="form-group">
                                <button class="btn btn-primary filter-data" type="button">Submit</button>
                            </div>
                        </div>
                    </div>
               
            </div>
        </div>
        <!-- /Search Filter -->



        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover mb-0 dataTable no-footer datatables w-100">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Transaction Amount</th>
                                        <th>Transaction ID</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
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
                url: "{{url('wallet/deposits')}}",
                data: data,
            },
            buttons: [],
            columns: [
            {
                data: 'user_name',
                name: 'user_name',
                orderable:false,
            },

            {
                data: 'user_email',
                name: 'user_email',
                orderable:false,
            },

            {
                data: 'amount',
                name: 'amount',
                orderable:false,
            },

            {
                data: 'transaction_id',
                name: 'transaction_id',
                orderable:false,
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
                class:'text-end',
                orderable:false,
                searchable:false
            },

            ],
        });
    }
    DataTableInit();
    $(document).on('click', '.filter-data', function() {
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