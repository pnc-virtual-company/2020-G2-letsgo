@extends('layouts.frontend.menuTamplate')

@section('body')
    <h3 class="text-center text-info mt-5">Views Of Your Events</h3>
    <select class="form-control" name="" id="select">
      <option disabled selected> Choose country</option>
    </select>
    <script type="text/javaScript">
        $(document).ready(function(){
            // $(document).on('click', '#select', function(){
              read();
            // });
           function read(){
             if (sessionStorage.getItem('country')===null) {
                $.ajax({
                  url:"{{route('event.read')}}",
                  method:'GET',
                  dataType:'json',
                  success:function(respone)
                  {
                    sessionStorage.setItem('country',respone);
                    var data = listCounty('country');
                    getResult(data);
                  }
                });
             } else {
                var data = listCounty('country');
                getResult(data);
             }
          }
        });
        // list of country and city.
        function listCounty(data) {
          return JSON.parse(sessionStorage.getItem(data));
        }
        // display result
        function getResult(data) {
          var option = "";
          data.forEach(element => {
            option += ` <option >${element.name},${element.city}</option>`;
          });
          $('#select').append(option);
        }
      </script>
@endsection