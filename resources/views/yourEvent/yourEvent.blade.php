@extends('layouts.frontend.menuTamplate')

@section('body')
    <select class="form-control" name="" id="select">
      <option disabled selected>City</option>
    </select>
    <script type="text/javaScript">
        $(document).ready(function(){
           read();
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
            option += ` <option value =">${element.name},${element.city}">${element.name},${element.city}</option>`;
          });
          $('#select').append(option);
        }
      </script>
@endsection