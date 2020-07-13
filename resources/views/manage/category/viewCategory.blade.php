@extends('layouts.frontend.menuTamplate')

@section('body')

<div class="container mt-3">
  {{-- Search form --}}
    {{-- <form action="" method="post"> --}}
      <div class="row">
        <div class="input-icons col-md-8" style="margin: 0 auto"> 
          <span class="material-icons">search</span> 
          <input class="form-control" id="search"  type="text" autocomplete="off"> 
        </div> 
      </div> 
    {{-- </form> --}}
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
        </table>
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
      fetch_customer_data(query);
  });

   fetch_customer_data();
   function fetch_customer_data(query)
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
        <table class="fl-table">
                <tr>
                <td><b>${element.category}</b></td>
                <td>
                    <a 
                      href="#!" 
                      class="delete float-right" 
                      style="margin-top: 7px"  
                      data-id="${element.id}" 
                      data-toggle="modal" 
                      data-target="#deleteCategory"> 
                      <span class="material-icons" id="show">delete</span>
                    </a>
                    <a 
                      href="#!" 
                      class="btn-lg edit float-right"
                      data-toggle="modal" 
                      data-id="${element.id}"
                      data-category = "${element.category}"
                      data-target="#editCategory">
                      <span class="material-icons" id="show">edit</span></a>
                </td>
                </tr>
        </table>
        `;
      });
        $('.table-hover').html(result);
     }
    })
   }
  });

  </script>


@endsection