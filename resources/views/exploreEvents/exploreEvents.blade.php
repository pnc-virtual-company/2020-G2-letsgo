@extends('layouts.frontend.menuTamplate')
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-1 col-lg-1"></div>
            <div class="col-sm-12 col-md-10 col-lg-9">
                <h5>Find your event !</h5><br>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-5 mb-2">
                        <div class="input-icons col-md-12" style="margin: 0 auto"> 
                            <span class="material-icons">search</span> 
                            <input class="form-control" id="search"  type="text" autocomplete="off" placeholder="Search"> 
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="row" style="margin: 0 auto">
                            <div class="col-12 col-md-12 col-lg-5 mt-2">
                                <small>NOT TOO FAR FROM</small>
                            </div>
                            <div class="col-12 col-md-12 col-lg-7">
                                <input name="city"  value="{{Auth::user()->city}}" class="form-control autoSuggestion" list="result" placeholder="Country..." id="serchCity" required>
                                <datalist id="result"></datalist>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        {{-- view by card or carlendar --}}
        <div class="row mt-3">
            <div class="col-sm-12 col-md-1 col-lg-1"></div>
            <div class="col-sm-12 col-md-10 col-lg-9">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-check">
                            @if (Auth::user()->check != 1)
                                <input type="checkbox" id="checkbox" name="checkbox[]" value="{{Auth::user()->check}}" class="form-check-input"> 
                            @endif
                            <label class="form-check-label" for="checkbox"><strong>Event you join only</strong></label>
                        </div>
                        <form id="ifNotCheck" action="{{route('ifnotcheck',1)}}" method="post">
                            @csrf
                            @method('put')
                        </form>
                    </div>
                    <div class="col-12 col-md-6 text-right">
                        <a href="{{route('exploreEvents.index')}}" class="btn btn-default" ><b>CARDS</b></a>
                        |
                        <a href="{{route('viewByCarlendar')}}" class="btn btn-default text-secondary"><b>CARLENDAR</b></a>
                    </div>
                </div>
            </div>
        </div>
        {{-- end view by card or carlendar --}}
        {{--================== view all explore event by card ================================--}}
        
        <div class="row">
            <div class="col-sm-12 col-md-1 col-lg-1"></div>
            <div class="col-sm-12 col-md-10 col-lg-9">
                <?php $data = $exploreEvents;?>
                <?php               
                    $date = date('Y-m-d');
                 ?>
                @foreach ($data as $item => $exploreEvents)
                    @foreach ($exploreEvents as $exploreEvent)
                        @if (Auth::id() != $exploreEvent->owner_id && $exploreEvent->endDate >= $date )
                        {{-- @if (Auth::user()->city == $exploreEvent->city) --}}
                        <div class="card-event event-city">
                            <h6>
                                {{-- get data to group by --}}
                                <?php
                            
                                    $startDate =(new DateTime($item));
                                    echo date_format($startDate, "l, F j");
                                ?>  
                            </h6>
                            <strong class="h5" hidden>{{$exploreEvent->city}}</strong>

                            <div class="card p-2 card-event" id="exploreEvent">
                                <div class="row" >
                                    <div class="col-12 col-sm-2 col-md-3 col-lg-2 startTime" data-toggle="modal" data-target="#viewDetail{{$exploreEvent->id}}">
                                        {{-- get current time and convert to AM or PM --}}
                                        <?php
                                        $startTime = $exploreEvent['startTime'];
                                        echo $newDateTime = date(' h:i A', strtotime($startTime));
                                        ?>
                                        {{--  --}}
                                    </div>
                
                                    <div class="col-8 col-sm-6 col-md-6 col-lg-4" data-toggle="modal" data-target="#viewDetail{{$exploreEvent->id}}">
                                        <b>{{$exploreEvent->category->category}}</b>
                                        <br> 
                                        <strong class="h5">{{$exploreEvent->title}}</strong>
                                        <br>
                                        
                                        {{--  counter member --}}
                                        @if ($exploreEvent->joins->count("user_id")> 1)
                                        {{$exploreEvent->joins->count("user_id")}}
                                        members going.
                                        @else
                
                                        {{$exploreEvent->joins->count("user_id")}}
                                        member going.
                                        @endif
                                        
                                        <br>
                                        
                                    </div>
                                    
                                    <div class="col-4 col-sm-3 col-md-3 col-lg-2" data-toggle="modal" data-target="#viewDetail{{$exploreEvent->id}}">   
                                            {{-- get profile from user insert --}}
                                        <img src="{{asset('asset/eventimage/'.$exploreEvent->picture)}}" style="width: 100%; border-radius: 10px" class="mx-auto d-block" id="img">
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                                    <div class="row" style="display: flex; justify-content:center; align-items:center">
                                            @foreach ($exploreEvent->joins as $join)
                                                @if ($exploreEvent->id == $join->event_id && $join->user_id == Auth::id())
                                                    <form action="{{route('quit', $join->id)}}" method="post">
                                                        @csrf
                                                        @method("delete")
                                                        <button type="submit" class="btn btn-sm btn btn-danger mt-4 quit-nutton">
                                                            <i class="fa fa-times-circle"></i>
                                                            <b>Quit</b> 
                                                        </button>
                                                    </form>
                                                @endif
                                            @endforeach
                                            {{-- important don't chnage anythink --}}
                                            <form action="{{route('join', $exploreEvent->id)}}" method="post">
                                                @csrf
                                                <div class="join_button">
                                                    <input type="hidden" class="event_id" value="{{$exploreEvent->id}}">
                                                </div>
                                                <div class="join_button_display" >
                                                </div>
                                            </form>
                                            {{-- end --}}
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <br>   
                    </div>
                        {{-- @endif --}}
                    
                    @endif  
                        {{-- detail popup of explore event --}}
                        @include('exploreEvents.viewDetail')
                @endforeach
            @endforeach
        </div>
    </div>
    {{--==================end view all explore event by card ==============================--}}
    
    <script type="text/javaScript">

        $(document).ready(function(){

            // Filter explore event
                $("#search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $(".card-event").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            //  End filter explore event

            //    List the city not far from
                var value = {!! json_encode(Auth::user()->city, JSON_HEX_TAG) !!}.toLowerCase()
                $(".event-city").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });

                $("#serchCity").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    console.log(value)
                    $(".event-city").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

            // check only user event
                $("#checkbox").on('click', function () {
                    var data = event_check();
                    if (data == 0) {
                        $('#ifNotCheck').submit();
                    }
                });
        });    
    
        // ------------------- importand ---------------------//
        joinButton()
        function joinButton(){
            var eventJoin = {!! json_encode($joinEvent, JSON_HEX_TAG) !!}
            var user_id = {!! json_encode(Auth::id(), JSON_HEX_TAG) !!}
            var event_id = document.getElementsByClassName('join_button');
            var join_button_display = document.getElementsByClassName('join_button_display');
            var data;
            var arrayEvent = [];
            for (let i = 0; i < event_id.length; i++) {
                eventJoin.forEach(items => {
                    data = event_id[i].getElementsByClassName('event_id')[0];
                    if(data.value == items.event_id){
                        arrayEvent.push(items.event_id)
                    }
                });
                if (arrayEvent[i] === undefined){
                    arrayEvent.push('!join');
                    join_button_display[i].innerHTML = `
                    <button class="btn btn-sm btn btn-success mt-4 float-right join-button">
                        <i class="fa fa-check-circle"></i>
                        <b>Join</b>
                    </button>
                    `;
                }
            }
        }

        // return value of checkbox
        function event_check(){
                var checkBox = document.getElementById('checkbox');
                if (checkBox.checked === true)
                {
                    var value = document.getElementById('checkbox').value;
                    return value;
                }
                else
                {
                    var value = document.getElementById('checkbox').value;
                    return value;
                }      
        }

    </script>

@endsection

