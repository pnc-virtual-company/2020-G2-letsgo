@extends('layouts.frontend.menuTamplate')

@section('body')
@include('manage.deleteCategory')

<div class="container mt-3">
  {{-- Search form --}}
    <form action="" method="post">
      <div class="row">
        <div class="input-icons col-md-8" style="margin: 0 auto"> 
          <span class="material-icons">search</span> 
          <input class="form-control" id="searchField"  type="text"> 
        </div> 
      </div> 
    </form>
    {{-- end search form --}}
    <br>
    {{-- create new category --}}
    <div class="form-group">
      <div class=" row">
          <div class="col-md-8" style="margin:0 auto">
            <a class="h5">Category</a>
            <button type="button" class="btn btn-warning btn-sm text-white float-right" data-toggle="modal" data-target="#myModal"><span class="material-icons float-left">add</span><b>Create</b></button> 
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8" style="margin:0 auto">
        <table class="table-hover fl-table">
          @foreach ($category as $item)
          <tr>

            {{-- category name --}}
            <td> &nbsp;<b>{{ $item->category }}</b></td>
            {{-- end category name --}}
           
            {{-- action --}}
            <td>

              {{-- delete button --}}
              <a href="#!" class="delete float-right" style="margin-top: 7px"  data-id="{{ $item->id }}" data-toggle="modal" data-target="#deleteCategory"> <span class="material-icons" id="show">delete</span></a>
              
              {{-- end delete button --}}

              {{-- edit form --}}

                  {{-- button edit fomm --}}
                  <a href="" class="btn-lg float-right" data-toggle="modal" data-target="#edit{{$item->id}}"><span class="material-icons" id="show">edit</span></a>
                  {{-- end button edit form --}}

                  {{-- edit from model pop up --}}
                  <div class="modal fade" id="edit{{$item->id}}" role="dialog">
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
                            <button type="button" class="btn btn-default float-right" data-dismiss="modal" >DISCARD</button>
                        </form>
                        </div>
                      </div>
                  </div>
                  {{-- end edit form model pop up --}}

              {{-- end edit form --}}
            </td>
            {{-- end action --}}
 
          </tr>
          @endforeach
        </table>
      </div>
      {{-- end create new category --}}
    </div>
</div>

{{-- --------------------------------------Model create new category------------------------------ --}}

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
          <input id="category" type="text" name="category" class="form-control" placeholder="Your category...." >
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
{{----------------------------------------modal delete category--------------------------------- --}}



@endsection