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
                            <input type="checkbox"  value="{{Auth::id()}}" class="form-check-input" id="checkbox">
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
             @if (Auth::id() != $exploreEvent->owner_id)
             <div class="card card-event p-2 card-event" id="exploreEvent">
                 <div class="row" >
                    <div class="col-12 col-sm-2 col-md-3 col-lg-2 startTime">
                        {{$exploreEvent->startTime}}
                    </div>

                    <div class="col-8 col-sm-6 col-md-5 col-lg-4">
                         <b class="text-info">{{$exploreEvent->category->category}}</b>
                         <br>
                         <strong class="h5">{{$exploreEvent->title}}</strong>
                         <br>
                         {{-- test counter member --}}
                            {{-- user join only event --}}
                            @foreach ($exploreEvent->joins as $user)
                                @if ($user->user_id == Auth::id())
                                    <p class="join"><a style="display: none" class="only-own-event">{{$user->user_id}}</a></p>
                                @endif
                            @endforeach
                            {{-- end user join only --}}

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
             @endif   
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

        $("#checkbox").on("click", function() {
            var value = event_check().toUpperCase();
            var data = document.getElementsByClassName('card-event');
            var a, txtValue;
            for (i = 0; i < data.length; i++) {
                a = data[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                console.log(txtValue.toUpperCase().indexOf(value) > -1);
                if (txtValue.toUpperCase().indexOf(value) > -1) {
                    data[i].style.display = "";
                    } else {
                    data[i].style.display = "none";
                }
            }        
        });
    });
    
    function event_check(){
            
            var checkBox = document.getElementById('checkbox');

            if (checkBox.checked === true)
            {
                var value = document.getElementById('checkbox').value;
                return value;
            }
            else
            {
                var value = "";
                return value;
            }      
    }
               
      </script>
@endsection