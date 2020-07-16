@extends('layouts.frontend.menuTamplate')

@section('body')
  <select class="form-control" name="" id="select">
      <option disabled selected>City</option>
    </select>

    {{---------- view all event ----------}}
    <div class="container mt-5">
        {{-- <div class="row"> --}}
          {{-- <div class="col-12"> --}}
            @foreach ($yourevent as $item)
            <div class="card">
              <div class="card-body">
              <div class="row">
                {{$item->cate_id}}<br>
                <div class="col-4">
                  {{$item->startDate}}
                </div>
                <div class="col-4">
                  <h3 class="text-center">{{$item->title}}</h3>
              </div>
                <div class="col-4">
                  <button class="btn float-right">Cancel</button>
                </div>
              </div>
              </div>
            </div>
        @endforeach
          {{-- </div> --}}
        {{-- </div> --}}
    </div>





       {{-- read city from json file --}}
    <script type="text/javaScript">
        $(document).ready(function(){
           read();
           function read(){
             if (sessionStorage.getItem('country')===null) {
                $.ajax({
                  url:"{{route('read')}}",
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
    
  </select>
@endsection