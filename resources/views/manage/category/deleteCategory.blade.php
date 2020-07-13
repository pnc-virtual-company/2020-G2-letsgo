<div class="modal fade" id="deleteCategory" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <strong class="modal-title">Remove item?</strong>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            Are you sure want to remove selected item?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">DON'T REMOVE</button>
            <a onclick="document.getElementById('deleteCategoryForm').submit()" class="btn btn-default text-warning">REMOVE</a>
        </div>

      </div>
    </div>
  </div>
</div>
  <form id="deleteCategoryForm" action="" method="post">
    @csrf
    @method('delete')
</form>
  <script type="text/javascript">
    
  $(document).on('click', '.delete', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#deleteCategoryForm').attr("action", "{{ url('/manage/category/destroy') }}" + "/" + id);
  })
  </script>