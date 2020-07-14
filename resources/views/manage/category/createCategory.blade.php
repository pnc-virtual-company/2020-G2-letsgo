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
            @error('category')
              <small class="text-danger">&nbsp;&nbsp;&nbsp;{{$message}}</small>           
            @enderror
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">DISCARD</button>
            <button type="submit" class="btn text-warning">CREATE</button>
        </form>
        {{-- end form create --}}
      </div>
  </div>   
</div> 
