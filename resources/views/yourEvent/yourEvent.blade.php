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
            @foreach ($events as $event)
            <p>{{$event->startDate}}</p>
            <div class="card p-2 card-event">
                <div class="row">
                    <div class="col-12 col-sm-2 col-md-3 col-lg-2 startTime">
                        {{$event->startTime}}
                    </div>
                    <div class="col-8 col-sm-6 col-md-5 col-lg-4">
                        <b>{{$event->category->category}}</b>
                        <br>
                        <strong class="h5">{{$event->title}}</strong>
                        <br>
                        @foreach ($data_event as $members)
                            @if ($members['event_id'] == $event->id)
                                <p>{{$members['member']}} members going</p>
                            @endif
                         @endforeach
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
                                <a class="btn btn-sm  float-right delete" style="background: rgb(182, 182, 182); margin-top: 35px;" data-id="{{$event->id}}" data-toggle="modal" data-target="#deleteEvent" href="#!"><b>Cancel</b></a>
                            </div>
                            <div class="col-3">
                                <a class="btn btn-sm edit-event float-right"
                                 style="background: rgb(182, 182, 182); margin-top: 35px;" 
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

