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
                <span id="update-message-error" class="text-danger"></span>
            </div>
            <button type="submit" class="btn btn-default text-warning float-right" id="disable-button-update" >UPDATE</button>
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

    $(document).on('keyup','#value-edit', function(){
      var value = $(this).val();
      existCategory(value);
    });
    existCategory();
     function existCategory(value){
      $.ajax({
        url:"{{route('updateExistCategory')}}",
        method:'get',
        data:{value:value},
        dataType:'json',
        success:function(data)
        {
          var disableBtnUpdate = document.getElementById('disable-button-update');
          if(data !=''){
            $('#update-message-error').html('This category is already exist.');
            disableBtnUpdate.disabled = true;
          }else{
            $('#update-message-error').html('');
            disableBtnUpdate.disabled = false;
          } 
        }
      });
    }


  </script>