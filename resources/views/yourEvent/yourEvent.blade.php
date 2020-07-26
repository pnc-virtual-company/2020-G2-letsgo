@extends('layouts.frontend.menuTamplate')

@section('body')    
                    
<div class="container">
        <br>
        <div class="row">
            <div class="col-sm-12 col-md-1 col-lg-1"></div>
               <div class="col-sm-12 col-md-10 col-lg-9">
                   <div class="form-group">
                       <div class=" row">
                       <div class="col-12" style="margin:0 auto">
                         <a class="h5">Your events</a>
                        {{-- --------------Create New Event---------------- --}}
                          <button type="button" class="btn btn-warning  btn-sm text-white float-right button-create" data-toggle="modal" data-target="#myModal"><span class="material-icons float-left">add</span><b>Create</b></button>
                        {{-- ----- Model Create Your Event ----------- --}}
                          @include('yourEvent.addYourevent')
                        {{-- ----- End Model Create Your Event ----------- --}}
                        </div>
                    </div>
                 </div>
               </div>
           <div class="col-sm-12 col-md-1 col-lg-2"></div>
        </div>
       <div class="row">
           <div class="col-sm-12 col-md-1 col-lg-1"></div>
           <div class="col-sm-12 col-md-10 col-lg-9">
              
                
               <?php $data = $events;?>
               @foreach ($data as $item => $events)
              
            @foreach ($events as $event)
            {{-- condition to get thire own event --}}
            @if (Auth::user()->id == $event->owner_id)
            <h6>
                {{-- get data to group by --}}
                <?php
               
                    $startDate =(new DateTime($item));
                    echo date_format($startDate, "l, F j");
                ?>  
                </h6>
                {{--  --}}
            <div class="card p-2 card-event">
                <div class="row">
                    <div class="col-12 col-sm-2 col-md-3 col-lg-2 startTime">
                        {{-- get current time and convert to AM or PM --}}
                        <?php
                        $currentDateTime = $event['startTime'];
                         echo $newDateTime = date(' h:i A', strtotime($currentDateTime));
                         ?>
                         {{--  --}}
                    </div>
                    <div class="col-8 col-sm-6 col-md-5 col-lg-4">
                        <b>{{$event->category->category}}</b>
                        <br>
                        <strong class="h5">{{$event->title}}</strong>
                        <br>
                        <p>5 members going</p>
                    </div>
                    <div class="col-4 col-sm-3 col-md-4 col-lg-2">   
                        @if($event->picture)
                                {{-- get profile from user insert --}}
                            <img src="{{asset('asset/eventimage/'.$event->picture)}}" style="width: 100px; height:100px" id="img">
                        @else
                                {{-- default profile --}}
                            <img src="asset/eventimage/event.png" style="width: 100px; height:100px" id="img"/>
                        @endif
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-3">
                                <a class="btn btn-sm mt-4 float-right delete" style="background: rgb(182, 182, 182)" data-id="{{$event->id}}" data-toggle="modal" data-target="#deleteEvent" href="#!"><b>Cancel</b></a>
                            </div>
                            <div class="col-3">
                                <a class="btn btn-sm mt-4 edit-event float-right"
                                 style="background: rgb(182, 182, 182)" 
                                 data-toggle="modal" 
                                 data-id = "{{$event->id}}"
                                 data-target="#editYourEvent" 
                                 data-title = "{{$event->title}}"
                                 data-cate_id = "{{$event->cate_id}}"
                                 data-description = "{{$event->description}}"
                                 data-city = "{{$event->city}}"
                                 data-startdate = "{{$event->startDate}}"
                                 data-enddate = "{{$event->endDate}}"
                                 data-starttime = "{{$event->startTime}}"
                                 data-endtime = "{{$event->endTime}}"
                                 data-picture = "{{$event->picture}}"
                                 href="!#"><b>Edit</b></a>
                            </div>
                            <div class="col-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
                
            @endif
        @endforeach
        @endforeach
           </div>
           <div class="col-sm-12 col-md-1 col-lg-2"></div>
       </div>

    </div>
{{-- delete --}}
@include('yourEvent.deleteEvent')
{{-- modal edit --}}
@include('yourEvent.editYourEvent')
{{--end modal edit --}}

@endsection

