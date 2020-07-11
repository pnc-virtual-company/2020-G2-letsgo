@extends('layouts.frontend.menuTamplate')

@section('body')

<<<<<<< HEAD
<link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
=======
>>>>>>> 40a65345dac43922d89522be5d87c0cf8b64c55b
<div class="container mt-3">
  {{-- Search form --}}
    <form action="" method="post">
      <div class="row">
        <div class="input-icons col-md-8" style="margin: 0 auto"> 
          <span class="material-icons">search</span> 
          <input class="form-control" type="text"> 
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
              <br>
              {{-- delete form --}}
              <a href="#" class="float-right" style="margin-top: 7px" onclick="document.getElementById('delete{{$item->id}}').submit()"><span class="material-icons" id="show">delete</span></a>

                <form id="delete{{$item->id}}" action="{{route('category.destroy', $item->id)}}" method="post">
                  @csrf
                  @method('delete')
                </form>

              {{-- end delete form --}}

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
<<<<<<< HEAD
      
    <form action="{{route('category.store')}}" method="POST">
      @csrf
      
      <div class="modal-body">
        <input type="text" name="category" class="form-control" placeholder="Your category....">
        @foreach($errors->get('catogories') as $error)
          <span class="help-block">{{ $error }}</span>
        @endforeach
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
=======
    {{-- end model content --}}
    {{-- form create --}}
      <form id="create_category" action="{{route('category.store')}}" method="POST">
>>>>>>> 40a65345dac43922d89522be5d87c0cf8b64c55b
        @csrf
        <div class="modal-body">
<<<<<<< HEAD
           {{-- delete category --}}
     <form action="{{route('category.destroy', $item->id)}}" method="POST">
      @csrf
      @method('delete')
      <button id="btndeletecategory" type="submit" class="float-right" onclick="return confirm('Are you sure?')" >delete</button>
    </form>

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
=======
          <input id="category" type="text" name="category" class="form-control" placeholder="Your category...." >
          @error('category')
            <small class="text-danger">&nbsp;&nbsp;&nbsp;{{$message}}</small>           
          @enderror
>>>>>>> 40a65345dac43922d89522be5d87c0cf8b64c55b
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">DISCARD</button>
          <button type="submit" class="btn text-warning">CREATE</button>
      </form>
      {{-- end form create --}}
    </div>
<<<<<<< HEAD
  </div>
    </td>
  </tr>

  @endforeach

</table>

</div>
</div>
@endsection
<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>

=======
</div>

@endsection
>>>>>>> 40a65345dac43922d89522be5d87c0cf8b64c55b
