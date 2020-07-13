<div class="modal fade" id="editCategory" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Category</h4>
        </div>
        <div class="modal-body">
        <form id="editFormCategory" action="" method="POST">
                @csrf
                @method('PUT')
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="value-edit" name="category">
            </div>
            <button type="submit" class="btn btn-default text-warning float-right" >UPDATE</button>
            <button type="button" class="btn btn-default float-right" data-dismiss="modal" >DISCARD</button>
        </form>
        </div>
      </div>
  </div>
</div>
  <script type="text/javascript">
    $(document).on('click', '.edit', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var category = $(this).data('category');
    $('#value-edit').val(category);
    $('#editFormCategory').attr("action", "{{ url('/manage/category/update') }}" + "/" + id);
    })
  </script>