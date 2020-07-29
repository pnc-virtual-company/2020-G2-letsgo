@extends('layouts.frontend.menuTamplate')

@section('body')
    <div class="container mt-3">
        {{-- Search form --}}
          {{-- <form action="" method="post"> --}}
            <div class="row">
              <div class="input-icons col-md-8" style="margin: 0 auto"> 
                <span class="material-icons">search</span> 
                {{-- <input type="text" id="myInput"  onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name"> --}}
                <input class="form-control" id="search"  type="text" autocomplete="off" placeholder="Search"> 
              </div> 
            </div> 
          {{-- </form> --}}
          {{-- end search form --}}
          <br>
          <div class="form-group">
            <div class=" row">
                <div class="col-md-8" style="margin:0 auto">
                  <a class="h5">All Events</a>
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-8" style="margin:0 auto">
              <table class="table table-hover  table-borderless " id="myTable">
                  <tr>
                      <th>Organizer</th>
                      <th>City</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Start date</th>

                  </tr>
                  <br>
              
                  @foreach ($event as $events)
                    <tr class="event">
                        <td>{{$events->user->firstname}}</td>
                        <td>{{$events->city}}</td>
                        <td>{{$events->title}}</td>
                        <td>{{$events->category->category}}</td>
                        <td>{{$events->startDate}}</td>
                    </tr>
                    @endforeach
                  
              </table>
              
            </div>
          </div>
      </div>
      
      <script type="text/javaScript">
        $(document).ready(function(){
          $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".event").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>
@endsection