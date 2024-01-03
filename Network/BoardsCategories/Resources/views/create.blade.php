
<!-- Add Modal -->
<div class="modal fade" id="add-categories">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{url('network/boards-categories/store')}}" class="modal-content">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Add Boards Category</h5>
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <!-- /Modal Header -->
            
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter Category Name">
                </div>

                <div class="form-group">
                    <label>Category Parent</label>
                    <select name="parent_id" class="form-control">
                        <option value="">Select Parent</option>
                        @foreach(BoardsCategories() as $cate)
                            <option value="{{$cate->id}}">{{$cate->title}}</option>
                        @endforeach
                    </select>
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