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
                <?php $data = $exploreEvents;?>
                @foreach ($data as $item => $exploreEvents)
               
             @foreach ($exploreEvents as $exploreEvent)
             @if (Auth::id() != $exploreEvent->owner_id)
             <h6>
                {{-- get data to group by --}}
                <?php
               
                    $startDate =(new DateTime($item));
                    echo date_format($startDate, "l, F j");
                ?>  
                </h6>
             <div class="card p-2 card-event" id="exploreEvent">
                 <div class="row" >
                    <div class="col-12 col-sm-2 col-md-3 col-lg-2 startTime">
                         {{-- get current time and convert to AM or PM --}}
                         <?php
                         $startTime = $exploreEvent['startTime'];
                          echo $newDateTime = date(' h:i A', strtotime($startTime));
                          ?>
                          {{--  --}}
                    </div>

                    <div class="col-8 col-sm-6 col-md-5 col-lg-4">
                         <b>{{$exploreEvent->category->category}}</b>
                         <br> 
                         <strong class="h5 ">{{$exploreEvent->title}}</strong>
                         <br>
                         {{--  counter member --}}
                         @if ($exploreEvent->joins->count("user_id")> 1)
                          {{$exploreEvent->joins->count("user_id")}}
                          members going.
                          @else

                          {{$exploreEvent->joins->count("user_id")}}
                          member going.
                          @endif
                          

                        
                     </div>
                      
                     <div class="col-4 col-sm-3 col-md-4 col-lg-2">   
                            {{-- get profile from user insert --}}
                          <img src="{{asset('asset/eventimage/'.$exploreEvent->picture)}}" style="width: 100px; height:100px" id="img">
                     </div>
                   
               
                     <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="row">
                            {{-- // --}}
      
                            <div class="col-4">
                                <form action="{{route('join', $exploreEvent->id)}}" method="post">
                                   @csrf
                                    <button class="btn btn-sm btn btn-success mt-4 float-right" >
                                       <i class="fa fa-check-circle"></i>
                                        <b>Join</b> 
                                   </button>
                                   </form>
                               </div>
                               <div class="col-4">
                                   <a href="#" class="btn btn-sm btn btn-danger mt-4 ">
                                       <i class="fa fa-times-circle"></i>
                                       <b>Quit</b>
                                   </a>
                               </div>
                               <div class="col-4">
                                    <button class="btn btn-sm btn btn-success mt-4 float-right" data-toggle="modal" data-target="#viewDetail{{$exploreEvent->id}}" >
                                            <i class="fa fa-eye"></i>
                                             <b>view</b> 
                                        </button>
                                  
                               </div>
                             
                        </div>
                        {{--  --}}
                    </div> 
                 </div>
             </div>
             <br>   
             @endif   
        {{-- modal of view detail explore event --}}
        @include('exploreEvents.viewDetail')
        {{-- end modal of view detail explore event --}}
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
          // end search
         
        });
    </script>

@endsection