@extends('layouts.frontend.menuTamplate')

@section('body')
    {{-- <input list="result" id="autoSuggestion"  name="country"/>
    <datalist id="result">
    </datalist> --}}
    <div class="container">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-warning btn-sm text-white float-right" data-toggle="modal" data-target="#myModal"><span class="material-icons float-left">add</span><b>Create</b></button>
      
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
                <form action="{{route('yourevents.store')}}" autocomplete="off" method="POST" enctype="multipart/form-data" >
                    @csrf                   
                    <div class="row">
                        <div class="col-8">
                            <h5>Create an event</h5>
                            <div class="form-group">
                                <select class="form-control" id="sel1">
                                </select>
                              </div>
                            {{-- -------- Show user Last Name-------------- --}}
                            
                            <div class="form-group">
                                <input type="text" name="title" value="" placeholder="Title"  class="form-control">
                            </div>
    
                            
                            {{-- -------- Show start date-------------- --}}
                            <div class="form-group">
                                <input type="date" name="startDate" placeholder="Staet date" value=""  class="form-control">
                                <input type="text" name="startTime" placeholder="At" value=""  class="form-control">
                            </div>
                            {{-- ----------end-------------- --}}
                            {{-- -------- Show end date-------------- --}}
                            <div class="form-group">
                                <input type="date" name="endDate" placeholder="End date" value=""  class="form-control">
                                <input type="text" name="endTime" placeholder="At" value=""  class="form-control">
                            </div>
                            {{-- ----------end-------------- --}}
                            
                            {{-- -------- Show user city-------------- --}}
    
                            <div class="form-group">
                                <input class="form-control" list="result" id="autoSuggestion" placeholder="Country name here .."  name="city"/>
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
                    <button type="submit" class="btn btn-default text-warning float-right">UPDATE</button>
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">SUBMIT</button>
                </form>
          </div>
        </div>
        
      </div>
      </div>


@endsection