         
<!-- The Modal to show detail of explore event-->
<div class="modal fade" id="viewDetail{{$exploreEvent->id}}">
    <div class="modal-dialog" id="dialog" role="dialog">
        <div class="modal-content">
                  
        <!-- Modal body -->
        <div class="modal-body">
            <div class="row">
                <div class="col-3 col-sm-3 mt-3">
                    <img src="{{asset('asset/eventimage/'.$exploreEvent->picture)}}" style="width: 100%; border-radius: 10px" class="mx-auto d-block" id="img">
                </div>
                <div class="col-9 col-sm-9">
                    {{$exploreEvent->category->category}}
                    <h5><b>{{$exploreEvent->title}}</b></h5>
                    <i class="material-icons">place</i> {{$exploreEvent->city}} <br>
                    <i class="material-icons">people_outline</i>
                    {{--  counter member --}}
                    @if ($exploreEvent->joins->count("user_id")> 1)
                        {{$exploreEvent->joins->count("user_id")}}
                            members going.
                    @else
                        {{$exploreEvent->joins->count("user_id")}}
                            member going.
                    @endif
                        <br>
                        <i class="material-icons">person_outline</i> Organized by: {{$exploreEvent->user->firstname}} <br>
                        <i class="material-icons">access_time</i> 
                        <?php   
                            $startDate =(new DateTime($item));
                                echo date_format($startDate, "l, F j");
                        ?>​-
                        <?php
                            $startTime = $exploreEvent['startTime'];
                                echo $newDateTime = date(' h:i A', strtotime($startTime));
                        ?>        

                    <div class="float-right" style="display: flex;margin-right:40px">
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
                            <div class="join_button_display" ></div>
                        </form>
                        {{-- end --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer"> 
                    <textarea name="" disabled class="form-control" id="" rows="4">
                        {{$exploreEvent->description}}
                    </textarea>
            
            </div> 
        </div>
    </div>           
</div>
        <script type="text/javaScript">
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
                            arrayEvent.push('had join');
                            join_button_display[i].innerHTML = `
                            <button class="btn btn-sm btn btn-success mt-4 float-right join-button">
                                <i class="fa fa-check-circle"></i>
                                <b>Join</b>
                            </button>
                            `;
                        }
                    }            
                }
                // -----------------------end---------------------------
        </script>

                
        