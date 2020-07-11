@extends('layouts.frontend.menuTamplate')

@section('body')
<link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
<div class="container mt-3">
        
  <div class="input-group mb-3">
      <div class="input-group-append">
          <i class="fas fa-search"></i>
      </div>
      <input type="text" class="form-control" placeholder="Search">
  </div>

  <div class="container  mb-5">
      <h3>Category</h3>
      <!-- Trigger the modal with a button -->
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
      @csrf
      
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
<br>
<table class="table table-hover">
  
  @foreach ($category as $item )
  <tr>
    <td>{{ $item->category }}</td>
    <td>
    
      <form action="{{route('category.destroy', $item->id)}}" method="post">
        @csrf
        @method('delete')
          <button id="btndeletecategory" class="float-right mr-3" type="submit" onclick="return confirm('Are you sure?')">delete</button>
      </form>

      {{-- Edit Category --}}
  <a href="" class=" btn-lg float-right" data-toggle="modal" data-target="#myModal{{$item->id}}"><span class="material-icons">
    edit
    </span></a>

  <!-- Modal -->
<div class="modal fade" id="myModal{{$item->id}}" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Category</h4>
        </div>
        <div class="modal-body">

<form action="{{route('category.update',$item->id)}}" method="POST">
        @csrf
        @method('PUT')
    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" class="form-control" name="category" value="{{$item->category}}">
    </div>
        <button type="submit" class="btn btn-default text-warning float-right" >UPDATE</button>
        <button type="submit" class="btn btn-default  float-right" >DISCARD</button>
</form>
        </div>
      </div>
      
    </div>
  </div>
    </td>
  </tr>

  @endforeach
</table>
</div>
</div>
@endsection