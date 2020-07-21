@extends('layouts.frontend.menuTamplate')

@section('body')
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

@endsection