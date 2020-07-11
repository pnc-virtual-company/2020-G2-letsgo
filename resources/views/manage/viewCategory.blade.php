@extends('layouts.frontend.menuTamplate')

@section('body')

<div class="container mt-3">
        
  <div class="input-group mb-3">
      <div class="input-group-append">
          <i class="fas fa-search"></i>
      </div>
      <input type="text" class="form-control" placeholder="Search">
  </div>

  <div class="container  mb-5">
      <h3>Category</h3>
      <a href="#" class="btn btn-warning float-right">+ Create</a>
  </div>
<br>
<table class="table table-hover">
  
  @foreach ($category as $item )
  <tr>
    <td>{{ $item->category }}</td>
    <td>
      <a href="#" class="float-right">delete</a>
      <a href="#" class="float-right mr-3">edit</a>
    </td>
  </tr>

  @endforeach
</table>

  
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Create Category</h4>
      </div>
    <form action="{{route('category.store')}}" method="POST">
      <div class="modal-body">
        <input type="text" name="category" class="form-control" placeholder="Your category....">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">DISCARD</button>
        <button type="submit" class="btn text-warning">CREATE</button>
      </div>
    </form>
    </div>

  </div>
</div>
</div>
@endsection