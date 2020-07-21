@extends('layouts.frontend.menuTamplate')

@section('body')
<<<<<<< HEAD
    {{-- <input list="result" id="autoSuggestion"  name="country"/>
    <datalist id="result">
    </datalist> --}}
    <div class="container">
      <table>
          <tr>
              <th>Name</th>
          </tr>
         
      </table>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-warning btn-sm text-white float-right" data-toggle="modal" data-target="#myModal"><span class="material-icons float-left">add</span><b>Create</b></button>
      
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          
          
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

=======
    <div class="container">
       <div class="row">
           <div class="col-sm-12 col-md-1 col-lg-1"></div>
           <div class="col-sm-12 col-md-10 col-lg-9">
            @foreach ($events as $event)
            <div class="card p-2 card-event">
                <div class="row">
                    <div class="col-12 col-sm-2 col-md-4 col-lg-2 startTime">
                        {{$event->startTime}}
                    </div>
                    <div class="col-8 col-sm-6 col-md-4 col-lg-5">
                        <b>{{$event->category->category}}</b>
                        <br>
                        <strong class="h5">{{$event->title}}</strong>
                        <br>
                        <p>5 members going</p>
                    </div>
                    <div class="col-4 col-sm-3 col-md-4 col-lg-2">
                        <img class="mx-auto" src="{{asset('asset/eventimage/'.$event->picture)}}" width="100px" id="img_prv">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-sm mt-4 float-right" style="background: rgb(182, 182, 182)" href=""><b>Cancel</b></a>
                            </div>
                            <div class="col-6">
                                <a class="btn btn-sm mt-4 float-right" style="background: rgb(182, 182, 182)" href=""><b>Edit</b></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

        @endforeach
           </div>
           <div class="col-sm-12 col-md-1 col-lg-2"></div>
       </div>
    </div>
>>>>>>> 19b92c7af970a1acbe71caa2ea21c30fbe3a61ff
@endsection