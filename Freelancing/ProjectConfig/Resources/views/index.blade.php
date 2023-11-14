@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Project Configuration</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        
                        <li class="breadcrumb-item active">Project Configuration</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{url('project-config/create')}}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="card card-primary" id="filters-container">
                    <div class="card-header bg-white" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <h4><i class="fas fa-filter"></i> Filters</h4>
                    </div>
                    <div class="card-body p-0">
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="p-3 accordion-body">
                                <div class="row">
                                    
                                    <div class="col-md-4 form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control filters" name="name" placeholder="Name">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Address</label>
                                        <input type="text" class="form-control filters" name="address" placeholder="Address">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Contact Number</label>
                                        <input type="text" class="form-control filters" name="contact_number" placeholder="Contact Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table w-100 table-sm table-bordered datatables">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Name</th>
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
url: "{{url('project-config')}}",
data: data,
},
buttons: [],
columns: [
{
data: 'type',
name: 'type',
class:'text-center'
},
{
data: 'name',
name: 'name',
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