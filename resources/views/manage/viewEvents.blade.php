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
                  <tr id="result">

                  </tr>
                  {{-- @foreach ($event as $events)
                  <tr>
                        <td>{{$events->owner_id}}</td>
                        <td>{{$events->city}}</td>
                        <td>{{$events->title}}</td>
                        <td>{{$events->category->category}}</td>
                        <td>{{$events->startDate}}</td>
                    </tr>
                    @endforeach --}}
                  
              </table>
              {{-- <ul class="list-group list-group-flush"> --}}
              {{-- </ul> --}}
            </div>
          </div>
      </div>
      <script type="text/javaScript">
        $(document).ready(function(){
          $(document).on('keyup', '#search', function(){
              var query = $(this).val();
              fetch_events_data(query);
          });
          fetch_events_data();
         function fetch_events_data(query)
         {
          $.ajax({
           url:"{{ route('event.searches')}}",
           method:'get',
           data:{query:query},
           dataType:'json',
           success:function(data)
           {
            var result = "";
            
              data.forEach(element => {
              result += `
                
                    <td>${element.owner_id}</td>
                    <td>${element.city}</td>
                    <td>${element.title}</td>
                    <td>${element.category}</td>
                    <td>${element.startDate}</td>
                 `;
            });
              $('#result').html(result);
           }
          })
         }
        });
        </script>

        {{-- <script>
            function myFunction() {
              var input, filter, table, tr, td, i, txtValue;
              input = document.getElementById("myInput");
              filter = input.value.toUpperCase();
              console.log(filter);
              table = document.getElementById("myTable");
              tr = table.getElementsByTagName("tr");
              for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                  txtValue = td.textContent || td.innerText;
                  console.log(txtValue);
                  if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                }       
              }
            }
            </script> --}}






















@endsection