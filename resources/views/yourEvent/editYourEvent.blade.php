{{-------------- Form of edit your event ----------}}
    <!-- Modal -->
    <div class="modal fade" id="editYourEvent" role="dialog">
        <div class="modal-dialog">                           
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Your Events</h4>
            </div>
            <form id="form-edit-event"  method="POST" autocomplete="off" enctype="multipart/form-data" >
            @csrf
            @method('PUT')                             
            <div class="modal-body">
            <div class="row">
                <div class="col-8">
                {{-- -------- Show category-------------- --}}
                <div class="form-group">
                    <select name="category" id="category" class="form-control">
                    @foreach ($categories as $category )                       
                        <option value="{{$category->id}}" {{($category->id==$event->cate_id) ? 'selected' : ''}} >{{$category->category}}</option>
                    @endforeach  
                    </select>
                    
                </div>
                {{-- --------end Show category-------------- --}}
                {{-- -------- Show event Name-------------- --}}
                                                        
                <div class="form-group">
                    <input type="text" name="title" id="title"  placeholder="Title" class="form-control">
                </div>
                {{-- -------- end Show event Name-------------- --}}
                {{-- -------- Show start date-------------- --}}
                <div class="form-row">
                    <div class="form-group col-6">
                        <input type="text" name="startDate" placeholder="Start date"  class="form-control dpicker startdate" id="start-date" autocomplete="off">
                    </div>
                    <div class="form-group col-6">
                        <input type="time" name="startTime"  placeholder="At"  class="form-control" id="startTime">
                    </div>
                </div>
                {{-- ----------end-------------- --}}
                {{-- -------- Show end date-------------- --}}
                <div class="form-row">
                    <div class="form-group col-6">
                        <input type='text' name="endDate" placeholder="End date"  class="form-control enddate dpicker" id="end-date" autocomplete="off">
                    </div>
                    <div class="form-group col-6">
                        <input type="time" name="endTime" placeholder="At" id="endTime"  class="form-control">
                    </div>
                </div>
                {{-- ----------end-------------- --}}
                                                        
                {{-- -------- Show user city-------------- --}}     
                <div class="form-group">
                    <input class="form-control autoSuggestion" list="result" id="city" placeholder="Country name here .."  name="city"/>
                    <datalist id="result">
                    </datalist>
                </div>
                {{-- ----------end city-------------- --}}
                {{-- Description --}}
                <div class="form-group">
                     <textarea class="form-control" rows="5" id="description-edit" name="description"></textarea>
                </div>
                {{-- end --}}
                </div>
                <div class="col-4">                                       
                 {{-- edit picture from event  --}}
                    <img src="" width="120px" id="image" height="120px"  onchange="readURL(this)">
                    <div class="row justify-content-center">
                        <label for="picture" ><i class="fa fa-pencil-alt text-dark"></i></label>
                        <input type='file' id="picture" name="picture" style="display: none"  onchange="readURL(this);" />
                     
                    {{-- edit picture from event  --}} 
                </div>
                </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">DISCARD</button>
                    <button type="submit" class="btn text-warning" >UPDATE</button>
                </div>                 
            </form>
        </div>
        </div>
    </div>
{{-------------- Form of edit your event ----------}}
<script type="text/javaScript">
    $(".startdate").datepicker({
    minDate: 1,
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd',
    onClose: function (selectedDate, instance) {
        if (selectedDate != '') {
            $(".enddate").datepicker("option", "minDate", selectedDate);
            var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
            date.setMonth(date.getMonth() + 3);
           var minDate2 = new Date(selectedDate);
            minDate2.setDate(minDate2.getDate());
            
            $(".enddate").datepicker("option", "minDate", minDate2);
            $(".enddate").datepicker("option", "maxDate", date);
        }
    }
});

$(".enddate").datepicker({
    minDate: 1,
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd',
    onClose: function (selectedDate) {
        $(".startdate").datepicker("option", "maxDate", selectedDate);
    }
});

function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image')
                        .attr('src', e.target.result)
                        .width(120)
                        .height(120);
                };

                reader.readAsDataURL(input.files[0]);
            }
}

$(document).on('click','.edit-event', function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        var title = $(this).data('title');
        var city = $(this).data('city');
        var description = $(this).data('description');
        var startdate = $(this).data('startdate');
        var starttime = $(this).data('starttime');
        var enddate = $(this).data('enddate');
        var endtime = $(this).data('endtime');
        var picture = $(this).data('picture');
        
        $('#title').val(title);
        $('#description-edit').val(description);
        $('#city').val(city);
        $('#start-date').val(startdate);
        $('#end-date').val(enddate);
        $('#startTime').val(starttime);
        $('#endTime').val(endtime);
        $('#image').attr("src", "asset/eventimage/"+picture);

        $('#form-edit-event').attr("action", "{{ url('yourEvent/update') }}" + "/" + id);
});
  </script>