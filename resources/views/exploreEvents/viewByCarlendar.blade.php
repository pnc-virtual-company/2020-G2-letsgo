@extends('layouts.frontend.menuTamplate')

@section('body')
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
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
                    <a href="{{route('exploreEvents.index')}}" class="btn btn-default text-secondary " ><b>CARDS</b></a>|
                    <a href="{{route('viewByCarlendar')}}" class="btn btn-default "><b>CARLENDAR</b></a>
                </div>
            </div>
        {{-- end view by card or carlendar --}}
        
        {{--================== view all explore event by carlendar ================================--}}
        
        <div class="row mt-5">
           <div class="col-12">
            <div class="response"></div>
            <div id="calendar"></div>
           </div>
        </div>
        {{--==================end view all explore event by carlendar ==============================--}}
       
            
    </div>
    
    
    
    <div class="container">
    <div class="response"></div>
    <div id='calendar'></div>
    </div>
    
    <script>
    $('#calendar').fullCalendar({
    header: {
    left: 'prev,next today',
    right: 'month,agendaWeek,agendaDay'
    },
    defaultDate: Date(),
    navLinks: true,
    eventLimit: true,
    events: [{
    title: 'Front-End Conference',
    start: '2020-07-22',
    end: '2020-07-22'
    },
    {
    title: 'Hair stylist with Mike',
    start: '2020-11-20',
    allDay: true
    },
    {
    title: 'Car mechanic',
    start: '2020-11-14T09:00:00',
    end: '2020-11-14T11:00:00'
    },
    {
    title: 'Dinner with Mike',
    start: '2020-11-21T19:00:00',
    end: '2020-11-21T22:00:00'
    },
    {
    title: 'Chillout',
    start: '2020-11-15',
    allDay: true
    },
    {
    title: 'Vacation',
    start: '2020-11-23',
    end: '2020-11-29'
    },
    ]
    });
    </script>
@endsection



