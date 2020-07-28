@extends('layouts.frontend.menuTamplate')

@section('body')

<div class="container mt-3">
  {{-- Search form --}}
    {{-- <form action="" method="post"> --}}
      <div class="row">
        <div class="input-icons col-md-8" style="margin: 0 auto"> 
          <span class="material-icons">search</span> 
          <input class="form-control" id="search"  type="text" autocomplete="off" placeholder="Search"> 
        </div> 
      </div> 
    {{-- </form> --}}
    {{-- end search form --}}
    <br>
    <div class="form-group">
      <div class=" row">
          <div class="col-md-8" style="margin:0 auto">
            <a class="h5">Categories</a>
          <button type="button" class="btn btn-warning btn-sm text-white float-right button-create" data-toggle="modal" data-target="#myModal"><span class="material-icons float-left">add</span><b>Create</b></button>
          </div>
        </div>
      </div>
    <div class="row">
      <div class="col-md-8" style="margin:0 auto">
        <ul id="myUL"  class="list-group data-search list-group-flush" id="categories-search">
          @foreach ($categories as $category)
          <li class="list-group-item" id="list-category">
            <a class="cat-search">
              {{$category->category}}
              <span class="badge">
                <a 
                href="#!" 
                class="delete float-right" 
                style="margin-top: 4px"  
                data-id="{{$category->id}}" 
                data-toggle="modal" 
                data-target="#deleteCategory"> 
                <i class="far fa-trash-alt text-dark" style="font-size:16px;" id="show"></i>
              </a>
              <a 
                href="#!" 
                class="btn-lg edit float-right"
                style="margin-top:-10px"
                data-toggle="modal" 
                data-id="{{$category->id}}"
                data-category = "{{$category->category}}"
                data-target="#editCategory">
                <i class="fas fa-pencil-alt text-dark" style="font-size:16px;" id="show"></i>
                </a>
              </span>
            </a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
</div>

{{-- delete --}}
@include('manage.category.deleteCategory')
{{-- edit --}}
@include('manage.category.editCategory')
{{-- create --}}
@include('manage.category.createCategory') 

   <script type="text/javaScript">
        $(document).ready(function(){
          $("#search").on("keyup", function() {
            var value = $(this).val().toUpperCase();
            li = $('#myUL #list-category');
              for (i = 0; i < li.length; i++) {
                  a = li[i].getElementsByTagName("a")[0];
                  txtValue = a.textContent || a.innerText;
                  if (txtValue.toUpperCase().indexOf(value) > -1) {
                      li[i].style.display = "";
                  } else {
                      li[i].style.display = "none";
                  }
              }
          });
        });
      </script>
@endsection