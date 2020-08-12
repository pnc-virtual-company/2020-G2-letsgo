@extends('layouts.frontend.menuTamplate')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-1 col-lg-1"></div>
            <div class="col-sm-12 col-md-10 col-lg-9">
                <h5>Find your event !</h5><br>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-5 mb-2">
                        <div class="input-icons col-md-12" style="margin: 0 auto"> 
                            <span class="material-icons">search</span> 
                            <input class="form-control" id="search"  type="text" autocomplete="off" placeholder="Search"> 
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="row" style="margin: 0 auto">
                            <div class="col-12 col-md-12 col-lg-5 mt-2">
                                <p>Not far from city</p>
                            </div>
                            <div class="col-12 col-md-12 col-lg-7">
                                <input name="city"  value="{{Auth::user()->city}}" class="form-control autoSuggestion" list="result" placeholder="City" id="serchCity" required>
                                <datalist id="result"> </datalist>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        {{-- view by card or carlendar --}}
        <div class="row mt-3">
            <div class="col-sm-12 col-md-1 col-lg-1"></div>
            <div class="col-sm-12 col-md-10 col-lg-9">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-check">
                            @if (Auth::user()->check == 1)
                                <input type="checkbox" id="checkbox" checked name="checkbox[]" value="{{Auth::user()->check}}" class="form-check-input"> 
                            @endif
                            <label class="form-check-label" for="checkbox"><strong>Event you join only</strong></label>
                        </div>
                        <form id="ifNocheckOnCalendar" action="{{route('ifNocheckOnCalendar',0)}}" method="post">
                            @csrf
                            @method('put')
                        </form>
                    </div>
                    <div class="col-12 col-md-6 text-right">
                        <a href="{{route('onlyEventJoin')}}" class="btn btn-default" ><b>CARDS</b></a>
                        |
                        <a href="{{route('onlyEventUserOnCalendar')}}" class="btn btn-default text-secondary"><b>CARLENDAR</b></a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div id="calendar" style="padding: 5px">
        </div>
    </div>

    <script>
        function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
        }

        document.addEventListener('DOMContentLoaded', function() {
              var calendarEl = document.getElementById('calendar');
              var event = {!! json_encode($data, JSON_HEX_TAG) !!};
              var calendar = new FullCalendar.Calendar(calendarEl, {
                dayMinWidth:50,
                headerToolbar: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialDate: formatDate(Date()),
                initialView: 'dayGridMonth',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: event
              });
              calendar.render();
            });
        
        // check only user event
         $("#checkbox").on('click', function () {
                    var data = event_check();
                    if (data == 1) {
                        $('#ifNocheckOnCalendar').submit();
                    }
        });
        // return value of checkbox
        function event_check(){
                var checkBox = document.getElementById('checkbox');
                if (checkBox.checked === true)
                {
                    var value = document.getElementById('checkbox').value;
                    return value;
                }
                else
                {
                    var value = document.getElementById('checkbox').value;
                    return value;
                }      
        }
    </script>
@endsection
