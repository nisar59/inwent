@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Boards Categories</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        
                        <li class="breadcrumb-item active">Boards Categories</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add-categories">
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
                                        <th>Title</th>
                                        <th>Slug</th>
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

@section('mdl')
@include('boardscategories::create')
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
                url: "{{url('network/boards-categories')}}",
                data: data,
            },
            buttons: [],
            columns: [{
                data: 'title',
                name: 'title',
            },
            {
                data: 'slug',
                name: 'slug',
            },
             {
                data: 'status',
                name: 'status',
                orderable: false,
                searchable: false
            }, {
                data: 'action',
                name: 'action',
                orderable: false,
                class: "d-flex justify-content-end w-auto",
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
    $(document).on('click', '.edit-category', function() {
        var url = $(this).data('href');
        $.ajax({
            url: url,
            type: 'GET',
            success: function(res) {
                if (res.success) {
                    $("#mdl").html(res.data);
                    $("#edit-categories").modal('show');
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