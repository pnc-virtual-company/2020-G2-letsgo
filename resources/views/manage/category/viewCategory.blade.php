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
        <table class="table-hover fl-table">
        </table>
        <ul class="list-group list-group-flush">
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
    $(document).on('keyup', '#search', function(){
        var query = $(this).val();
        fetch_categories_data(query);
    });
   fetch_categories_data();
   function fetch_categories_data(query)
   {
    $.ajax({
     url:"{{ route('category.search')}}",
     method:'get',
     data:{query:query},
     dataType:'json',
     success:function(data)
     {
      var result = "";
        data.forEach(element => {
        result += `
          <li class="list-group-item d-flex justify-content-between align-items-center">
            ${element.category}
            <span class="badge">
                     <a 
                      href="#!" 
                      class="delete float-right" 
                      style="margin-top: 4px"  
                      data-id="${element.id}" 
                      data-toggle="modal" 
                      data-target="#deleteCategory"> 
                      <i class="far fa-trash-alt text-dark" style="font-size:16px;" id="show"></i>
                    </a>
                    <a 
                      href="#!" 
                      class="btn-lg edit float-right"
                      style="margin-top:-10px"
                      data-toggle="modal" 
                      data-id="${element.id}"
                      data-category = "${element.category}"
                      data-target="#editCategory">
                      <i class="fas fa-pencil-alt text-dark" style="font-size:16px;" id="show"></i></a>
            </span>
          </li>
        `;
      });
        $('.list-group').html(result);
     }
    })
   }
  });
  </script>
@endsection