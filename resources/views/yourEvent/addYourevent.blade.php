  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="card">
            <div class="card-body">
              <form action="{{route('yourEvent.store')}}" method="post" enctype="multipart/form-data" >
                @csrf   
                <div class="row">
                    <div class="col-12 col-sm-9">
                        <div class="row">
                          <div class="col-9">
                            <h5>Create an event</h5>
                          </div>
                          <div class="col-3">
                            
                          </div>
                        </div>
                        <div class="form-group">
                            <select name="category"  class="form-control" required>
                                @if (!$categories->isEmpty())
                                    <option value=""  disabled selected >Event Category</option>
                                    @foreach ( $categories as $category)
                                       <option value="{{$category->id}}" >{{$category->category}}</option>
                                    @endforeach 
                                @else
                                    <option value="" disabled selected>Don't have any category</option>
                                @endif
                            </select>
                          </div>
                        {{-- -------- Show event title-------------- --}}
                        <div class="form-group">
                            <input type="text" name="title"  placeholder="Title"  class="form-control" required>
                        </div>   
                        {{-- ----------end-------------- --}}
  
                        {{-- -------- Show start date-------------- --}}
                        <div class="form-row">
                            {{-- -----------start date and start time-------- --}}
                            <div class="form-group col-6">
                              {{-- <input type="date" name="startDate" placeholder="Staet date" class="form-control"> --}}
                              <input type="text" name="startDate" readonly placeholder="Start date" class="form-control startdate" id="beginDate" autocomplete="off" required>
                            </div>
                            <div class="form-group col-6">
                              <input type="time" name="startTime-start-time" id="add-start-time" placeholder="At"  class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                        {{-- ----------end-------------- --}}
  
                        {{-- -------- Show end date and end time-------------- --}}
                        <small class="text-danger" id="add-validate"></small>
                        <small class="add-time-validate text-danger" style="margin-left: 132px"></small>
                        <div class="form-row">
                            <div class="form-group col-6">
                              <input type='text' name="endDate" readonly placeholder="End date"  class="form-control enddate" id="endDate" autocomplete="off" required>
                            </div>
                            <div class="form-group col-6">
                              <input type="time" name="endTime" id="add-end-time" placeholder="At"  class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                        {{-- ----------end-------------- --}}
                        
                        {{-- -------- Show event city-------------- --}}
                        <div class="form-group">
                            <input name="city" class="form-control autoSuggestion" list="result" placeholder="City" required>
                            <datalist id="result">
                            </datalist>
                        </div>
                        {{-- ----------end city-------------- --}}
  
                        {{-- Description --}}
                        <div class="form-group">
                            <label for="comment">Description</label>
                            <textarea class="form-control" maxlength="250" minlength="50" rows="3" id="description" name="description" required></textarea>
                        </div>
                        {{-- end --}}
                    </div>
                    <div class="col-12 col-sm-3" style="margin-top: 32px">
                          <div class="row justify-content-center">
                              <img src="asset/eventimage/event.png" width="120px" height="120px" onchange="readURLs(this)"  style="border-radius: 10px" id="img"/>
                          </div>
                          <div class="row justify-content-center">
                            {{-- button add profile --}}
                            <label for="add" class="btn"><i class="fa fa-plus text-dark"></i></label>
                            <input id="add" style="display:none;" type="file" onchange="readURLs(this)" name="picture">
                                {{-- end button --}}
                            <span id="mgs" class="text-danger"></span>
                          </div>
                    </div>
                </div>
                <button type="submit"  class="btn btn-default float-right text-warning" >SUBMIT</button>
                <button type="button" data-dismiss="modal" class="btn btn-default  float-right">DISCARD</button>
              </form>
            </div>
          </div>
      </div>    
    </div>
  </div>

{{--use javascript to add profile  --}}
<script type="text/javaScript">
// display image at the moment
    function readURLs(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img')
                        .attr('src', e.target.result)
                        .width(120)
                        .height(120);
                };
                reader.readAsDataURL(input.files[0]);
            }
  }


    $("#beginDate").datepicker({
    minDate: 0,
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd',
    onClose: function (selectedDate, instance) {
        if (selectedDate != '') {
            $("#endDate").datepicker("option", "minDate", selectedDate);
            var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
            date.setMonth(date.getMonth() + 3);
           var minDate2 = new Date(selectedDate);
            minDate2.setDate(minDate2.getDate());
            
            $("#endDate").datepicker("option", "minDate", minDate2);
            $("#endDate").datepicker("option", "maxDate", date);
        }
    }
});
$("#endDate").datepicker({
    minDate: 0,
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd',
    onClose: function (selectedDate) {
        $("#beginDate").datepicker("option", "maxDate", selectedDate);
    }
});

function getValue(end, start) {
    return Math.floor((Date.parse(end) - Date.parse(start)) / 86400000);
}

function getValueBeginDate() {
    return $('#beginDate').val();
}
function getValueEndDate() {
    return $('#endDate').val();
}
function starttime() {
    return $('#add-start-time').val();
}
function endTime() {
    return $('#add-end-time').val();
}

$('#beginDate,#endDate').on('change', function(){
  var result = getValue(getValueEndDate(), getValueBeginDate());
    if (result < 0) {
        $('#add-validate').html('End date must before the start date or the same date');
        end = $('#endDate').val('');
    } else {
        $('#add-validate').html('');
    }
});

// display error if user selete end date before start date
$('#add-start-time,#add-end-time,#beginDate,#endDate').on('change', function(){
  var result = getValue(getValueEndDate(), getValueBeginDate());
  var time = caculateTime(starttime(), endTime());
  if (result == 0) {
      if (time < 0) {
        $('.add-time-validate').html('End time must before the start time');
        endtime = $('#add-end-time').val('');
      }else {
        $('.add-time-validate').html('');
      }
    }
});

// caculate time
function caculateTime(start, end) {
    start = start.split(":");
    end = end.split(":");
    var startDate = new Date(0, 0, 0, start[0], start[1], 0);
    var endDate = new Date(0, 0, 0, end[0], end[1], 0);
    var diff = endDate.getTime() - startDate.getTime();
    return diff;
}
  </script>