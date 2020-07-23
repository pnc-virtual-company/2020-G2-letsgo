{{-------------- Form of edit your event ----------}}
    <!-- Modal -->
    <div class="modal fade" id="editYourEvent{{$event->id}}" role="dialog">
        <div class="modal-dialog">                           
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Your Events</h4>
            </div>
            <form action="{{route('yourEvent.update',$event->id)}}"  method="POST" autocomplete="off" enctype="multipart/form-data" >
            @csrf
            @method('PUT')                             
            <div class="modal-body">
            <div class="row">
                <div class="col-8">
                {{-- -------- Show category-------------- --}}
                <div class="form-group">
                    <label for="">Category:</label>
                    <select name="category"  class="form-control">
                    @foreach ($categories as $category )                       
                        <option value="{{$category->id}}" {{($category->id == $event->category->id) ? 'selected' : ''}}>{{$category->category}}</option>
                    @endforeach  
                    </select>
                </div>
                {{-- --------end Show category-------------- --}}
                {{-- -------- Show event Name-------------- --}}
                                                        
                <div class="form-group">
                    <label for="">Title:</label>
                    <input type="text" name="title"  placeholder="Title" value="{{$event->title}}" class="form-control">
                </div>
                {{-- -------- end Show event Name-------------- --}}
                {{-- -------- Show start date-------------- --}}
                <div class="form-group">
                    <label for="">Start Date:</label>
                    <input type="date" name="startDate" placeholder="Staet date" value="{{$event->startDate}}" class="form-control">
                    <label for="">Start Time:</label>
                    <input type="text" name="startTime" placeholder="At" value="{{$event->startTime}}"  class="form-control">
                </div>
                {{-- ----------end-------------- --}}
                {{-- -------- Show end date-------------- --}}
                <div class="form-group">
                    <label for="">End Date:</label>
                    <input type="date" name="endDate" placeholder="End date" value="{{$event->endDate}}"  class="form-control">
                   <label for="">End Time:</label>
                    <input type="text" name="endTime" placeholder="At" value="{{$event->endTime}}"  class="form-control">
                </div>
                {{-- ----------end-------------- --}}
                                                        
                {{-- -------- Show user city-------------- --}}     
                <div class="form-group">
                    <label for="">City:</label>
                    <input class="form-control" list="result" id="autoSuggestion" placeholder="Country name here .." value="{{$event->city}}"  name="city"/>
                    <datalist id="result">
                    </datalist>
                </div>
                {{-- ----------end city-------------- --}}
                {{-- Description --}}
                <div class="form-group">
                    <label for="">Description:</label>
                     <textarea class="form-control" rows="5" id="description" name="description">{{$event->description}}</textarea>
                </div>
                {{-- end --}}
                </div>
                <div class="col-4">                                       
                 {{-- edit picture from event  --}}
                    <img src="{{asset('asset/eventimage/'.$event->picture)}}" width="120px" id="image" height="120px" >
                    <div class="row justify-content-center">
                        <label for="edit_image"><i class="fa fa-pencil-alt text-dark"></i></label>
                        <input type="file"  name="picture" id="edit_image">
                        <span id="message"></span>
                     
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
    $('#edit_image').on('change',function(ev){
      
      var filedata=this.files[0];
      var imgtype=filedata.type;
   
      var match=['image/png','image/jpg','image/jpeg','image/gif'];
   
      if(!((imgtype==match[0])||(imgtype==match[1])||(imgtype==match[2])||(imgtype==match[3])||(imgtype==match[4]))){
          $('#message').html('<p style="color:red">Plz select a valid type image..only png jpg jpeg gif allowed</p>');
   
      }else{
   
        $('#message').empty();
   
      var reader=new FileReader();
   
      reader.onload=function(ev){
        $('#image').attr('src',ev.target.result).css('width','120px').css('height','120px');
      }
      reader.readAsDataURL(this.files[0]);
  
          var postData=new FormData();
          postData.append('edit_image',this.files[0]);
        var url="{{url('eventimage.update')}}";
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
  </script>