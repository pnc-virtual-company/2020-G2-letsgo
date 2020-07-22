@extends('layouts.frontend.menuTamplate')

@section('body')
    <div class="container">
       <div class="row">
           <div class="col-sm-12 col-md-1 col-lg-1"></div>
           <div class="col-sm-12 col-md-10 col-lg-9">
            @foreach ($events as $event)
            <div class="card p-2 card-event">
                <div class="row">
                    <div class="col-12 col-sm-2 col-md-4 col-lg-2 startTime">
                        {{$event->startTime}}
                    </div>
                    <div class="col-8 col-sm-6 col-md-4 col-lg-5">
                        <b>{{$event->category->category}}</b>
                        <br>
                        <strong class="h5">{{$event->title}}</strong>
                        <br>
                        <p>5 members going</p>
                    </div>
                    <div class="col-4 col-sm-3 col-md-4 col-lg-2">
                        <img class="mx-auto" src="{{asset('asset/eventimage/'.$event->picture)}}" width="100px" id="img_prv">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                        <div class="row">
                            <div class="col-6">
                                    {{-- @if (Auth::user() && (Auth::user()->id == $event->owner_id)) --}}
                                <form action="{{route('yourEvent.destroy',$event->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm mt-4" style="background: rgb(182, 182, 182)" data-toggle="modal" data-target="#deleteEvent"><b>cancel</b></button>
                                </form>
                                {{-- @endif --}}
                            </div>
                            <div class="col-6">
                                <a class="btn btn-sm mt-4 float-right" style="background: rgb(182, 182, 182)" href=""><b>Edit</b></a>
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
    </div>
    {{-- delete --}}
@include('yourEvent.deleteEvent')

@endsection