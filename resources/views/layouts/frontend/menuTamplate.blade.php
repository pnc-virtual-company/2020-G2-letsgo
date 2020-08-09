<!DOCTYPE html>
<html lang="en">
<head>
    <title>Letsgo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="{{asset('asset/css/main.css')}}">
  <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
  <script src="{{ asset('asset/js/awaresome.js') }}"></script>
  <script src="{{ asset('asset/js/readCityList.js') }}"></script>
  <script src="{{ asset('asset/js/main.js') }}"></script>
</head>
<body>
       <nav class="navbar p-0 navbar-expand-md navbar-light bg-white shadow-sm h5 fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{route('exploreEvents.index')}}">
            <img style="width: 60px;height: 60px;"  src="{{asset('asset/logo/logo.png')}}"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                        {{-- event explore --}}
                        <li class="nav-item {{(request()->segment(1) == 'exploreEvents') ? 'active' : '',ucfirst(request()->segment(1))}} ">
                            <a class="nav-link" href="{{route('exploreEvents.index')}}"> <span>Explore events</span></a>
                        </li>

                        {{-- you event --}}
                        <li class="nav-item {{(request()->segment(1) == 'yourEvent') ? 'active' : '',ucfirst(request()->segment(1))}}">
                        <a class="nav-link" href="{{route('yourEvent.index')}}">   <span>Your events</span></a>
                        </li>

                        {{-- Manage --}}
                        @can('view', 'App\Event')
                            <li class="nav-item dropdown">  
                                <a id="navbarDropdown" class=" dropdtn  nav-link dropdown-toggle {{request()->is('manage/*') ? 'active' : ''}}" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span class="caret">Manage</span></a>
                                {{-- dropdown manage--}}
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    {{-- event --}}
                                    <a class="dropdown-item {{(request()->segment(2) == 'event') ? 'active' : '',ucfirst(request()->segment(1))}}" href="{{route('event.index')}}">Events</a>
                                    {{-- end event --}}

                                    {{-- category --}}
                                    <a class="dropdown-item {{(request()->segment(2) == 'category') ?  : '',ucfirst(request()->segment(1))}}" href="{{route('category.index')}}">Categories</a>
                                    {{-- end category --}}

                                </div>
                            </li>
                        @endcan
                        {{-- End manage --}}

                        {{-- dropdown user information --}}
                        <li class="nav-item dropdown">

                            {{-- First name --}}
                            <a id="navbarDropdown" class="nav-link dropdown-toggle {{(request()->segment(2) == 'profile') ? 'active' : '',ucfirst(request()->segment(1))}}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="caret">{{Auth::user()->firstname}}</span>
                            </a>
                            {{-- end first name --}}

                            {{-- dropdown --}}
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                {{-- profile --}}
                                <a class="dropdown-item {{(request()->segment(2) == 'profile') ? 'active' : '',ucfirst(request()->segment(1))}}"  data-toggle="modal" data-target="#profile" href="#">Profile</a>
                                {{-- end profile --}}

                                {{-- Change password of user --}}
                                <a class="dropdown-item {{(request()->segment(2) == 'changePassword') ? 'active' : '',ucfirst(request()->segment(1))}}"  data-toggle="modal" data-target="#changePassword" href="#">Change Password</a>
                                {{-- end Change password of user --}}

                                {{-- logout --}}
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                {{-- end logout --}}

                            </div>
                            {{-- end dropdown --}}

                        </li>
                        {{-- end dropdown user information --}}
                </ul>
            </div>
        </div>
    </nav>
    <br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3"></div>
            <div class="col-sm-3"></div>
            <div class="col-sm-3">
                @if(session()->has('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert">x</button>
                </div>
                @endif
                @if(session()->has('fail'))
                <div class="alert alert-danger" id="success-alert">
                    {{ session()->get('fail') }}
                    <button type="button" class="close" data-dismiss="alert">x</button>
                </div>
                @endif
                @if(session()->has('confirm'))
                <div class="alert alert-danger" id="success-alert">
                    {{ session()->get('confirm') }}
                    <button type="button" class="close" data-dismiss="alert">x</button>
                </div>
                @endif
            </div>
        </div>
    </div>
    {{-- -------------------------------------------------------Display user profile------------------------------------------------ --}}
    <div class="modal fade" id="profile" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Edit Profile</h4>
            </div>
            <div class="modal-body">
                {{-- ----------form to display user Info------------------- --}}
            <form action="{{route('userProfile.update',Auth::user()->id)}}" autocomplete="off" method="POST" enctype="multipart/form-data" >
                @csrf
                @method("PUT")
               
                <div class="row">
                    <div class="col-12 col-sm-8">
                        {{-- -------- Show user First Name-------------- --}}
                        <div class="form-group">
                        <input type="text" name="firstname" value="{{Auth::user()->firstname}}"  class="form-control" required>
                        </div>
                        {{-- -------- Show user Last Name-------------- --}}
                        
                        <div class="form-group">
                            <input type="text" name="lastname" value="{{Auth::user()->lastname}}"  class="form-control" required>
                        </div>

                         {{-- -------- Show user Gender-------------- --}}
                        
                         <div class="form-group">
                            <label for="sex">Sex</label>
                            <br>
                            @if (Auth::user()->sex == 'Male')
                                <input checked name="sex" value="Male" type="radio"> Male
                                <input name="sex" value="Female" type="radio"> Female
                            @else
                                <input name="sex" value="Male" type="radio"> Male
                                <input checked name="sex" value="Female" type="radio"> Female
                            @endif
                        </div>
                        {{-- ----------end-------------- --}}

                        {{-- -------- Show user Birth-------------- --}}
                        <div class="form-group">
                            <input type="date" name="birth" placeholder="date of birth" value="{{Auth::user()->birth}}"  class="form-control" required>
                        </div>
                        {{-- ----------end-------------- --}}


                        {{-- -------- Show user Email-------------- --}}

                        <div class="form-group">
                            <input type="text" name="email" value="{{Auth::user()->email}}"  class="form-control" required>
                        </div>
                        {{-- ----------end-------------- --}}
                        
                        {{-- -------- Show user city-------------- --}}

                        <div class="form-group">
                            <input name="city" value="{{Auth::user()->city}}" class="form-control autoSuggestion" list="result" placeholder="City" id="city" required>
                            <datalist id="result">
                            </datalist>
                        </div>
                        {{-- ----------end city-------------- --}}
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="row" style="display: flex; justify-content:center; align-items:center">
                            @if(Auth::user()->picture)
                            {{-- get profile from user insert --}}
                            <img src="{{asset('asset/userImage/'.Auth::user()->picture)}}" style="border-radius:50%" width="120px" height="120px"  id="img_aupload">
                            @else
                                    {{-- default profile --}}
                                <img src="asset/userImage/user.png" style="border-radius:50%" width="120px" height="120px"  id="img_aupload"/>
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            {{-- button add profile --}}
                            <input id="file" style="display:none;" type="file" name="picture">
                            <label for="file" class="btn"><i class="fa fa-plus text-dark"></i></label>
                                {{-- end button --}}
                            {{-- button delete profile --}}
                            <a href="#" onclick="document.getElementById('deleteProfile').submit()"><i class="far fa-trash-alt text-dark mt-2"></i></a>&nbsp;&nbsp;&nbsp;
                                {{-- end button --}}
                            <span id="msg_img_error"></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-default text-warning float-right">UPDATE</button>
                <button type="button" class="btn btn-default float-right" data-dismiss="modal">DISCARD</button>
            </form>
            {{-- ---------------------End Form---------------------- --}}

            <form action="{{route('userProfile.destroy',Auth::user()->id)}}" method="POST" id="deleteProfile">
                @csrf
                @method('delete')
            </form> 

            </div>
        </div>
        </div>
    </div>          
         
     {{-- -------------------------------------------------------Display Change Passowrd of User------------------------------------------------ --}}
     <!-- Modal -->
     <div id="changePassword" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-center">Change Password</h4>
            </div>
                <form action="{{route('changePasswords')}}" method="POST">
                    @csrf
                    @method('PUT')
                <div class="modal-body">
                   
                    {{-- Old password --}}
                   <label for="">Old Pasword</label>
                   <div class="form-group">      
                    <input id="old-password" placeholder="Password" type="password" class="form-control" name="old-password" required >
                        
                    </div>
                    {{--End Old password --}}
                   
                   {{-- New password --}}
                   <label for="">New Pasword</label>
                   <div class="form-group">      
                   <input id="new-password"  type="password" class="form-control " name="new-password" placeholder="new password" required  >
                    </div>
                    {{--End New password --}}
                   
                   {{-- Confirm password --}}
                   <label for="">Confirm Pasword</label>
                   <div class="form-group">
                    <input id="password-confirm"  type="password" class="form-control " placeholder="confirm password"  name="password-confirmation" required >
                    <span id="msg-error" class="text-danger"></span>
                    </div>
                    {{--End Confirm password --}}

               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">DISCARD</button>
                 <button type="submit" id="change-password" class="btn text-warning float-right">UPDATE</button>
               </div>
            </form>
          </div>
        </div>
      </div>
    
    @yield('body')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

     {{--use javascript to add profile  --}}
    <script type="text/javascript">
      $('#file').on('change',function(ev){
        console.log("here inside");
        
        var filedata=this.files[0];
        var imgtype=filedata.type;
     
        var match=['image/png','image/jpg','image/jpeg','image/gif'];
     
        if(!((imgtype==match[0])||(imgtype==match[1])||(imgtype==match[2])||(imgtype==match[3]))){
            $('#msg_img_error').html('<p style="color:red">Plz select a valid type image..only png jpg jpeg gif allowed</p>');
    
        }else{
     
          $('#msg_img_error').empty();
     
        var reader=new FileReader();
    
        reader.onload=function(ev){
          $('#img_aupload').attr('src',ev.target.result).css('width','120px').css('height','120px');
        }
        reader.readAsDataURL(this.files[0]);
    
            var postData=new FormData();
            postData.append('file',this.files[0]);
    
            var url="{{url('userImage.update')}}";
     
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

  <script type="text/javaScript">
    $(document).ready(function () {
        $(document).on('keyup', function () {
            var newpwd = $('#new-password').val();
            var confirm = $('#password-confirm').val();
            if(confirm == newpwd){
                $('#msg-error').html('');
            }else if(confirm == ''){
                $('#msg-error').html('');
            }else{
                $('#msg-error').html('Attribute confirmation does not match.');
            }
        }) 
    });

    $("#success-alert").fadeTo(6000, 1000).slideUp(1000, function(){
    $("#success-alert").slideUp(1000);
});
  </script>
</body>

</html>

