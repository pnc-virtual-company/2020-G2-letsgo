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
                         <input type="text" id="search" onkeyup="myFunction()" placeholder="Search" class="form-control">
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
             @foreach ($exploreEvents as $exploreEvent)
             
             <div class="card p-2 card-event">
                <ul id="myData">
                 <div class="row" >
                    <div class="col-12 col-sm-2 col-md-3 col-lg-2 startTime">
                        <li><a href="#">{{$exploreEvent->startTime}}</a></li>
                    </div>

                    <div class="col-8 col-sm-6 col-md-5 col-lg-4">
                         
                         <li><b><a href="#">{{$exploreEvent->category->category}}</a></b></li>
                         <br>
                             <li><strong class="h5"><a href="#">{{$exploreEvent->title}}</a></strong></li>
                         <br>
                         <li><p>5 members going</p></li>
                     </div>

                     <div class="col-4 col-sm-3 col-md-4 col-lg-2">   
                            {{-- get profile from user insert --}}
                         <li><a href="#"><img src="{{asset('asset/eventimage/'.$exploreEvent->picture)}}" style="width: 100px; height:100px" id="img"></a></li>
                     </div>

                     <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-sm mt-4 float-right delete" style="background: rgb(182, 182, 182)" href="#!"><b>Join</b></a>
                            </div>
                        </div>
                    </div> 
                 </div>
                </ul>
             </div>
           
             <br>      
         @endforeach
            </div>
            <div class="col-sm-12 col-md-1 col-lg-2"></div>
        </div>
        {{--==================end view all explore event ==============================--}}
    </div>

    <script>
        function myFunction() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myData");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
        </script>
        
@endsection