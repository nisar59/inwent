@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Roles & Permission</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        
                        <li class="breadcrumb-item active">Roles</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add-role">
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
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-center">Role Name</th>
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
@section('mdl')
@include('roles::create')
@endsection

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
                url: "{{url('roles')}}",
                data: data,
            },
            buttons: [],
            columns: [{
                data: 'name',
                name: 'name'
            }, {
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
    $(document).on('click', '.edit-role', function() {
        var url = $(this).data('href');
        $.ajax({
            url: url,
            type: 'GET',
            success: function(res) {
                if (res.success) {
                    $("#mdl").html(res.data);
                    $("#role-edit").modal('show');
                } else {
                    error(res.message);
                }
            },
            error: function(err) {
                error(err.responseText);
            }
        });
    });
});
</script>
@endsection