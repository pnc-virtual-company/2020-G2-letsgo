@extends('layouts.frontend.menuTamplate')

@section('body')

    <div class="container mt-5">
        
        <div class="row">
            
            <div class="col-sm-12 col-md-1 col-lg-1"></div>
            <div class="col-sm-12 col-md-10 col-lg-9">
                <h5>Find your event !</h5><br>
                <div class="row">
                     
                <div class="col-6">
                    <div class="row">
                        {{-- Search form --}}
                        {{-- <form action="" method="post"> --}}
                        <div class="input-icons col-md-12" style="margin: 0 auto"> 
                        <span class="material-icons">search</span> 
                        <input class="form-control" id="search"  type="text" autocomplete="off" placeholder="Search"> 
                        </div> <br><br><br>
                        {{-- </form> --}}
                        {{-- end search form --}}

                        {{--====== checkbox  ==========--}}
                        <div class="form-check " style="margin-left:30px">
                            <input type="checkbox" class="form-check-input">
                            <label class="form-check-label" for="">Event you join only</label>
                          </div>
                          {{--======end checkbox  ==========--}}
                    </div>   
                </div> 
                {{-- find city --}}
                <div class="col-6">  
                    <div class="row">
                        <div class="col-4"   >
                            <p >Not to far from </p>
                        </div>
                        <div class="col-8">
                            <div class="form-group" >
                                <input name="city" class="form-control autoSuggestion" list="result" placeholder="City" required>
                                <datalist id="result">
                                </datalist>
                            </div>
                        </div>
                    </div>
                </div>
                 {{--end find city --}}
                </div>
            </div>
           
        </div><br><br>

        {{--================== view all explore event ================================--}}
        <div class="row">
            <div class="col-sm-12 col-md-1 col-lg-1"></div>
            <div class="col-sm-12 col-md-10 col-lg-9">
             @foreach ($exploreEvents as $exploreEvent)
             <div class="card p-2 card-event" id="exploreEvent">
                 <div class="row" >
                    <div class="col-12 col-sm-2 col-md-3 col-lg-2 startTime">
                        {{$exploreEvent->startTime}}
                    </div>

                    <div class="col-8 col-sm-6 col-md-5 col-lg-4">
                         <b>{{$exploreEvent->category->category}}</b>
                         <br>
                         <strong class="h5">{{$exploreEvent->title}}</strong>
                         <br>
                         <p>5 members going</p>
                     </div>

                     <div class="col-4 col-sm-3 col-md-4 col-lg-2">   
                            {{-- get profile from user insert --}}
                          <img src="{{asset('asset/eventimage/'.$exploreEvent->picture)}}" style="width: 100px; height:100px" id="img">
                     </div>

                     <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-sm mt-4 float-right delete" style="background: rgb(182, 182, 182)" href="#!"><b>Join</b></a>
                            </div>
                        </div>
                    </div> 
                 </div>
             </div>
             <br>      
         @endforeach
            </div>
            <div class="col-sm-12 col-md-1 col-lg-2"></div>
        </div>

        {{--==================end view all explore event ==============================--}}
    </div>
  
    <script type="text/javaScript">
        $(document).ready(function(){
          $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".card").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
      </script>
@endsection