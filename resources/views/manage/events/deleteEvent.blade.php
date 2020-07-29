<div class="modal fade" id="deleteEvent" role="dialog">
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
            <a onclick="document.getElementById('deleteViewEvent').submit()" class="btn btn-default text-warning">REMOVE</a>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- form action of delete --}}
  <form id="deleteViewEvent" action="" method="POST">
        @csrf
        @method('delete')
</form>
{{--end form action of delete --}}

<script type="text/javascript">
  $(document).on('click', '.deleteEvent', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#deleteViewEvent').attr("action", "{{ url('/manage/event/destroy') }}" + "/" +id);
  })
</script>