@extends('layouts.frontend.menuTamplate')

@section('body')
    <input list="result" id="autoSuggestion"  name="country"/>
    <datalist id="result">
    </datalist>
    <div class="container">
       <div class="card">
           <div class="card-body">
               @foreach ($events as $event)
               <div class="row">
                   <div class="col-3">{{$event->startTime}}</div>
                   <div class="col-3">
                    {{$event->category->category}}
                    <h4> {{$event->title}}</h4>
                    <p>Counter</p>
                   </div>
                   <div class="col-3">
                    <img src="{{asset('asset/eventimage/'.$event->picture)}}" width="120px" height="120px" id="img_prv">

                   </div>
                   <div class="col-3">
                            {{-- buuton delete event --}}
                            @if (Auth::user() && (Auth::user()->id == $event->owner_id))
                            <form action="{{route('yourEvent.destroy',$event->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Are you sure to remove this event?')">cancel</button>
                            </form> 
                        @endif
                            {{-- end button --}}

                       <a href="#">edit</a>
                   </div>
               </div>
               @endforeach
               
           </div>
       </div>
    </div>
@endsection