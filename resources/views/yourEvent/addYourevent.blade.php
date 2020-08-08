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
                              <input type="text" name="startDate" placeholder="Start date" class="form-control dpicker" id="beginDate" autocomplete="off" required>
                            </div>
                            <div class="form-group col-6">
                              <input type="time" name="startTime" placeholder="At"  class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                        {{-- ----------end-------------- --}}
  
                        {{-- -------- Show end date and end time-------------- --}}
                        <div class="form-row">
                            <div class="form-group col-6">
                              <input type='text' name="endDate" placeholder="End date"  class="form-control dpicker" id="endDate" autocomplete="off" required>
                            </div>
                            <div class="form-group col-6">
                              <input type="time" name="endTime" placeholder="At"  class="form-control" autocomplete="off" required>
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
                              <img src="asset/eventimage/event.png" width="120px" height="120px" style="border-radius: 10px" id="img"/>
                          </div>
                          <div class="row justify-content-center">
                            {{-- button add profile --}}
                            <label for="add" class="btn"><i class="fa fa-plus text-dark"></i></label>
                            <input id="add" style="display:none;" type="file" name="picture">
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
    $('#add').on('change',function(ev){
      
      var filedata=this.files[0];
      var imgtype=filedata.type;
   
      var match=['image/png','image/jpg','image/jpeg','image/gif'];
   
      if(!((imgtype==match[0])||(imgtype==match[1])||(imgtype==match[2])||(imgtype==match[3])||(imgtype==match[4]))){
          $('#mgs').html('<p style="color:red">Plz select a valid type image..only png jpg jpeg gif allowed</p>');
   
      }else{
   
        $('#mgs').empty();
   
      var reader=new FileReader();
   
      reader.onload=function(ev){
        $('#img').attr('src',ev.target.result).css('width','120px').css('height','120px');
      }
      reader.readAsDataURL(this.files[0]);
  
          var postData=new FormData();
          postData.append('add',this.files[0]);
        var url="{{url('eventimage.store')}}";
        $.ajax({
        headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
        async:true,
        type:"post",
        contentType:false,
        url:url,
        data:postData,
        processData:false,
        success:function(){
          console.log("success");
        }
          });
      }
    });


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
  </script>