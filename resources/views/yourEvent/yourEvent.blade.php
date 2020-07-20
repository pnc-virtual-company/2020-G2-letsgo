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
                <form action="{{route('yourEvent.store')}}"  method="POST" enctype="multipart/form-data" >
                    @csrf       
                    <div class="row">
                        <div class="col-8">
                            <h5>Create an event</h5>
                            <div class="form-group">
                                <select name="department" id="department" class="form-control">
                                    <option value=""> Event Category</option>
                                    @foreach ($categorys as $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach 
                                </select>
                              </div>
                            {{-- -------- Show user Last Name-------------- --}}
                            
                            <div class="form-group">
                                <input type="text" name="title" value="" placeholder="Title"  class="form-control">
                            </div>
    
                            
                            {{-- -------- Show start date-------------- --}}
                            <div class="form-group">
                                <input type="date" name="startDate" placeholder="Staet date" value=""  class="form-control">
                                <input type="text" name="startTime" placeholder="At"  class="form-control">
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
                    <button type="submit" class="btn btn-default float-right text-warning" data-dismiss="modal">SUBMIT</button>
                    <button type="button" class="btn btn-default  float-right">DISCARD</button>
                </form>
          </div>
        </div>
        
      </div>
      </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

     {{--use javascript to add profile  --}}
    <script type="text/javascript">
      $('#file').on('change',function(ev){
        console.log("here inside");
        
        var filedata=this.files[0];
        var imgtype=filedata.type;
     
        var match=['image/png','image/jpg','image/jpeg','image/gif'];
     
        if(!((imgtype==match[0])||(imgtype==match[1])||(imgtype==match[2])||(imgtype==match[3])||(imgtype==match[4]))){
            $('#mgs_ta').html('<p style="color:red">Plz select a valid type image..only png jpg jpeg gif allowed</p>');
     
        }else{
     
          $('#mgs_ta').empty();
     
        //---image preview
     
        var reader=new FileReader();
     
        reader.onload=function(ev){
          $('#img_prv').attr('src',ev.target.result).css('width','120px').css('height','120px');
        }
        reader.readAsDataURL(this.files[0]);
     
        /// preview end

            //upload
     
            var postData=new FormData();
            postData.append('file',this.files[0]);
     
            var url="{{url('userImage.store')}}";
     
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

@endsection