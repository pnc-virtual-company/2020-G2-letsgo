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
                <?php $data = $exploreEvents;?>
                @foreach ($data as $item => $exploreEvents)
                    @foreach ($exploreEvents as $exploreEvent)
                        @if (Auth::id() != $exploreEvent->owner_id)
                              <div class="card-event">
                                    {{-- get data to group by --}}
                                <h6>
                                    <?php
                                        $startDate =(new DateTime($item));
                                        echo date_format($startDate, "l, F j");
                                    ?>  
                                </h6>
                                {{-- end group by --}}

                                <div class="card p-2" id="exploreEvent" style="border-radius: 20px">
                                    <div class="row" >

                                        <div class="col-12 col-sm-2 col-md-3 col-lg-2 startTime">

                                            {{-- get current time and convert to AM or PM --}}
                                            <?php
                                            $startTime = $exploreEvent['startTime'];
                                            echo $newDateTime = date(' h:i A', strtotime($startTime));
                                            ?>
                                            {{-- end current time --}}

                                        </div>

                                        <div class="col-8 col-sm-6 col-md-5 col-lg-4">

                                            <b>{{$exploreEvent->category->category}}</b>
                                            <br> 
                                            <strong class="h5">{{$exploreEvent->title}}</strong>
                                            <br>

                                            {{-- user join only event --}}
                                                @foreach ($exploreEvent->joins as $user)
                                                    @if ($user->user_id == Auth::id())
                                                        <p style="display: none"><a class="only-event-user-join">{{Auth::id()}}</a></p>
                                                    @else 
                                                        <p style="display: none"><a class="only-event-user-join">N</a></p>
                                                    @endif
                                                @endforeach
                                            {{-- end user join only --}}

                                            {{--  counter member --}}
                                                @if ($exploreEvent->joins->count("user_id")> 1)
                                                    {{$exploreEvent->joins->count("user_id")}} members going.
                                                @else
                                                    {{$exploreEvent->joins->count("user_id")}} member going.
                                                @endif   
                                            {{-- end count members --}}

                                        </div>
                                        
                                        <div class="col-4 col-sm-3 col-md-4 col-lg-2">   
                                                {{-- get image of event --}}
                                            <img src="{{asset('asset/eventimage/'.$exploreEvent->picture)}}" style="width: 100px; height:100px" id="img">
                                        </div>
                                    
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                                            <div class="row">
                                               
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                              </div>
                            <br>   
                        @endif   
                    @endforeach
                @endforeach
            </div>
        </div>
        {{--==================end view all explore event ==============================--}}
    </div>
    
    <script type="text/javaScript">
    // for search
        $(document).ready(function(){

          $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".card").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });

        // click on checkbox
        $("#checkbox").on("click", function() {
            var value = event_check().toUpperCase();
            var data = document.getElementsByClassName('card-event');
            var a, txtValue;
            for (let i = 0; i < data.length; i++) {
                a = data[i].getElementsByClassName('only-event-user-join')[0];
                txtValue = txtValue = a.innerText || a.textContent;
                if (txtValue.toUpperCase().indexOf(value) > -1) {
                    data[i].style.display = "";
                  } else {
                    data[i].style.display = "none";
                  }
            }
            
        });
    });
    
    // voice
    // No @ paramenter
    // return value of checkbox
    function event_check(){
            
            // get element from chechbox
            var checkBox = document.getElementById('checkbox');

            // if checkbox had check
            if (checkBox.checked === true)
            {
                // get value from checkbox
                var value = document.getElementById('checkbox').value;
                return value;
            }

            // if checkbox had not check
            else
            {
                // null value 
                var value = "";
                return value;
            }      
    }
    // end click
               
      </script>

@endsection