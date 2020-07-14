<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      {{-- Modal content --}}
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Category</h4>
        </div>
      {{-- end model content --}}
      {{-- form create --}}
        <form id="create_category" action="{{route('category.store')}}" method="POST">
          @csrf
          <div class="modal-body">
            <input id="category" type="text" name="category" class="form-control" placeholder="Your category...." autocomplete="off">
          
            <small class="text-danger" id="alertmessage"></small>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">DISCARD</button>
            <button type="submit" class="btn text-warning">CREATE</button>
        </form>
        {{-- end form create --}}
      </div>
  </div>   
</div> 

<script type="text/javaScript">
  $(document).ready(function(){
    $(document).on('keyup','#category', function(){
      var value = $(this).val();
      existCategory(value);
    });
    existCategory();
     function existCategory(value){
      $.ajax({
     url:"{{route('category.existCategory')}}",
     method:'get',
     data:{value:value},
     dataType:'json',
     success:function(inputdata)
     {
       if(inputdata !=''){
         $('#alertmessage').html('This category is already exist.');
       }else{
        $('#alertmessage').html('');
       }
     }
      });
    }
  })
</script>