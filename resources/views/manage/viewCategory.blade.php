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
      <a href="#" class="btn btn-warning float-right">+ Create</a>
  </div>
<br>
<table class="table table-hover">
  
  @foreach ($category as $item )
  <tr>
    <td>{{ $item->category }}</td>
    <td>
      {{-- <a href="#" class="float-right">delete</a> --}}
     <form action="{{route('category.destroy', $item->id)}}" method="POST">
      
       @csrf
       @method('delete')
       <button id="btndeletecategory" type="submit" class="float-right" onclick="return confirm('Are you sure?')" >delete</button>
     </form>

      <a href="#" class="float-right mr-3">edit</a>
    </td>
  </tr>

  @endforeach
</table>

</div>

@endsection