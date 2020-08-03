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
                            <input type="checkbox" id="checkbox" value="{{Auth::id()}}" class="form-check-input">
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
                                <input name="city"  value="{{Auth::user()->city}}" class="form-control autoSuggestion" list="result" placeholder="City" required>
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
         {{-- view by card or carlendar --}}
            <div class="row">
                <div class="col-8"></div>
                <div class="col-4">
                    <a href="{{route('exploreEvents.index')}}" class="btn btn-default " >CARDS</a>|
                    <a href="{{route('viewByCarlendar')}}" class="btn btn-default ">CARLENDAR</a>
                </div>
            </div>
        {{-- end view by card or carlendar --}}
        
        {{--================== view all explore event by carlendar ================================--}}
        
        <div class="row mt-5">
           <div class="col-12">
            <h3 class="text-center text-danger">View Explore Event By Carlendar</h3>
           </div>
        </div>
        {{--==================end view all explore event by carlendar ==============================--}}
    
    </div>

@endsection

