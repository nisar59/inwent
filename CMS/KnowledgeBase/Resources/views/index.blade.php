@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Knowledge Base</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        
                        <li class="breadcrumb-item active">Knowledge Base</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{url('knowledge-base/create')}}" class="btn btn-success btn-sm">
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
                                        <th class="text-center">Knowledge Base Category</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Description</th>
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
                url: "{{url('knowledge-base')}}",
                data: data,
            },
            buttons: [],
            columns: [
            {
                data: 'knowledge_base_category_id',
                name: 'knowledge_base_category_id',
                class:'text-center'
            },
            {
                data: 'title',
                name: 'title',
                class:'text-center'
            },
            {
                data: 'description',
                name: 'description',
                class:'text-center'
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
                class: "text-center",
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