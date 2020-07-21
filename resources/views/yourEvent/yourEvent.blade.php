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
                         {{-- <button type="button" class="btn btn-warning btn-sm text-white float-right button-create" data-toggle="modal" data-target=""><span class="material-icons float-left">add</span><b>Create</b></button> --}}
                           <!-- Modal content-->
              <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-warning  btn-sm text-white float-right button-create" data-toggle="modal" data-target="#myModal"><span class="material-icons float-left">add</span><b>Create</b></button>

                <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                    <!-- Modal content-->
                            <div class="modal-content">
                        <form action="{{route('yourEvent.store')}}"  method="POST" enctype="multipart/form-data" >
                            @csrf   
                            {{-- @method('PUT'); --}}
                            <div class="row">
                                <div class="col-8">
                                    <h5>Create an event</h5>
                                    <div class="form-group">
                                        <select name="category"  class="form-control">
                                            <option value="">Event Category</option>
                                            @foreach ( $categories as $category)
                                             <option value="">{{$category->category}}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                    {{-- -------- Show user Last Name-------------- --}}
                                    
                                    <div class="form-group">
                                        <input type="text" name="title"  placeholder="Title"  class="form-control">
                                    </div>
            
                                    
                                    {{-- -------- Show start date-------------- --}}
                                    <div class="form-group">
                                        <input type="date" name="startDate" placeholder="Staet date" class="form-control">
                                        <input type="text" name="startTime" placeholder="At"  class="form-control">
                                    </div>
                                    {{-- ----------end-------------- --}}
                                    {{-- -------- Show end date-------------- --}}
                                    <div class="form-group">
                                        <input type="date" name="endDate" placeholder="End date"  class="form-control">
                                        <input type="text" name="endTime" placeholder="At"  class="form-control">
                                    </div>
                                    {{-- ----------end-------------- --}}
                                    
                                    {{-- -------- Show user city-------------- --}}
            
                                    <div class="form-group">
                                        <input name="city" class="form-control" list="result" id="autoSuggestion" placeholder="Country name here .." />
                                        <datalist id="result">
                                        </datalist>
                                    </div>
                                    {{-- ----------end city-------------- --}}
                                    {{-- Description --}}
                                    <div class="form-group">
                                        <label for="comment">Description</label>
                                        <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                                    </div>
                                    {{-- end --}}
                                </div>
                                <div class="col-4">

                                    @if(Auth::user()->picture)
                                            {{-- get profile from user insert --}}
                                        <img src="{{asset('asset/userImage/'.Auth::user()->picture)}}" width="120px" height="120px" id="img_prv">
                                    @else
                                            {{-- default profile --}}
                                        <img src="asset/userImage/user.png" width="120px" height="120px" id="img_prv"/>
                                    @endif
                                    
                                    <div class="row justify-content-center">
                                        {{-- button add profile --}}
                                        <input id="file" style="display:none;" type="file" name="picture">
                                        <label for="file" class="btn"><i class="fa fa-plus text-dark"></i></label>
                                            {{-- end button --}}
                                        {{-- button delete profile --}}
                                        <a href="#" onclick="document.getElementById('deleteProfile').submit()"><i class="far fa-trash-alt text-dark mt-2"></i></a>&nbsp;&nbsp;&nbsp;
                                            {{-- end button --}}
                                        <span id="mgs_ta"></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"  class="btn btn-default float-right text-warning" >SUBMIT</button>
                            <button type="button" class="btn btn-default  float-right">DISCARD</button>
                        </form>
                    </div>
                </div>           
            </div>
    </div>
</div>
                        </div>
                     </div>
                   </div>
                   <div class="col-sm-12 col-md-1 col-lg-2"></div>
            </div>
{{-- end container --}}
 </div>
            {{-- ....................Rot............................. --}}
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
                                <a class="btn btn-sm mt-4 float-right" style="background: rgb(182, 182, 182)" href=""><b>Cancel</b></a>
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
@endsection