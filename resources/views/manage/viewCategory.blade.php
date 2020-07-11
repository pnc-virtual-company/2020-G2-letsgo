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
  
  @foreach ($category as $item)
  <tr>
    <td>{{$item->category}}</td>
    <td>
      <a href="#" class="float-right">delete</a>

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

@endsection