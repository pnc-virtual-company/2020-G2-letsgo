@extends('layouts.frontend.menuTamplate')

@section('body')

<div class="container mt-5">
  <button type="button" class="btn btn-warning float-right btn-lg" data-toggle="modal" data-target="#myModal">Create</button>

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