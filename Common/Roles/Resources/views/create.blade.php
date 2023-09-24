<!-- Add Modal -->
<div class="modal fade" id="add-role">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{url('roles/store')}}" class="modal-content">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Add Role</h5>
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <!-- /Modal Header -->
            
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label>Role Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Role Name">
                </div>
            </div>
            <!-- /Modal body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- /Add Modal -->