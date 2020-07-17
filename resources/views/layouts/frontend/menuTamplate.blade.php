<!DOCTYPE html>
<html lang="en">
<head>
    <title>Letsgo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.min.css" rel="stylesheet"></link>
    <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
  <script src="{{ asset('asset/js/awaresome.js') }}"></script>
  <script src="{{ asset('asset/js/readCityList.js') }}"></script>
</head>
<body>
       <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm h5">
        <div class="container">
            <a class="navbar-brand" href="{{route('exploreEvents.index')}}">
            <img style="width: 70px;height: 70px;"  src="{{asset('asset/logo/logo1.png')}}"/>
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
                            <a class="nav-link" href="{{route('exploreEvents.index')}}">Explore events</a>
                        </li>

                        {{-- you event --}}
                        <li class="nav-item {{(request()->segment(1) == 'yourEvent') ? 'active' : '',ucfirst(request()->segment(1))}}">
                        <a class="nav-link" href="{{route('yourEvent.index')}}">Your events</a>
                        </li>

                        {{-- Manage --}}
                        @can('view', 'App\Event')
                            <li class="nav-item dropdown">  
                                <a id="navbarDropdown" class="nav-link dropdown-toggle {{request()->is('manage/*') ? 'active' : ''}}" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span class="caret">Manage</span></a>
                                {{-- dropdown manage--}}
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    {{-- event --}}
                                    <a class="dropdown-item {{(request()->segment(2) == 'event') ? 'active' : '',ucfirst(request()->segment(1))}}" href="{{route('event.index')}}">Events</a>
                                    {{-- end event --}}

                                    {{-- category --}}
                                    <a class="dropdown-item {{(request()->segment(2) == 'category') ? 'active' : '',ucfirst(request()->segment(1))}}" href="{{route('category.index')}}">Categories</a>
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
            <form action="{{route('userProfile.update',Auth::user()->id)}}" autocomplete="off" id="saveimage" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
               
                <div class="row">
                    <div class="col-8">
                        {{-- -------- Show user First Name-------------- --}}
                        <div class="form-group">
                        <input type="text" name="firstname" value="{{Auth::user()->firstname}}"  class="form-control">
                        </div>
                        {{-- -------- Show user Last Name-------------- --}}
                        
                        <div class="form-group">
                            <input type="text" name="lastname" value="{{Auth::user()->lastname}}"  class="form-control">
                        </div>
                        {{-- -------- Show user Email-------------- --}}

                        <div class="form-group">
                            <input type="text" name="email" value="{{Auth::user()->email}}"  class="form-control">
                        </div>
                        {{-- -------- Show user Birth-------------- --}}

                        <div class="form-group">
                            <input type="date" name="birth" placeholder="date of birth" value="{{Auth::user()->birth}}"  class="form-control">
                        </div>
                        {{-- -------- Show user Gender-------------- --}}

                        {{-- -------- Show user city-------------- --}}

                        <div class="form-group">
                            <select class="form-control" name="city" id="select">
                                <option value="{{Auth::user()->city}}" selected>{{Auth::user()->city}}</option>
                            </select>
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
                    </div>
                    <div class="col-4">
                        @if(Auth::user()->picture)
                            <img src="{{asset('asset/userImage/'.Auth::user()->picture)}}" id="img_prv" width="120px" height="120px">
                        @else
                            <img src="asset/userImage/user.png" width="120px" id="img_prv" height="120px"/>
                        @endif
                        <div class="row justify-content-center">

                            <label for="file" class="btn" style="margin-top:-7px"><i class="fa fa-plus text-dark"></i></label>
                            <input id="file"  style="display:none;" type="file" name="picture">
                            <span id="mgs_ta">

                            <a href="#" id="upload"><i class="fas fa-pencil-alt text-dark"></i></a>&nbsp;&nbsp;&nbsp;
                            <a href="#" onclick="document.getElementById('deleteProfile').submit()"><i class="far fa-trash-alt text-dark"></i></a>&nbsp;&nbsp;&nbsp;
                            
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
                <form action="{{route('changePasswords')}}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                <div class="modal-body">
                   
                    {{-- Old password --}}
                   <label for="">Old Pasword</label>
                   <div class="form-group">      
                   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="old-password" required autocomplete="current-password">

                   @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    {{--End Old password --}}
                   
                   {{-- New password --}}
                   <label for="">New Pasword</label>
                   <div class="form-group">      
                   <input id="new-password"  type="password" class="form-control @error('password') is-invalid @enderror " name="new-password" required autocomplete="new-password" >

                   @error('new-password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    {{--End New password --}}
                   
                   {{-- Confirm password --}}
                   <label for="">Confirm Pasword</label>
                   <div class="form-group">
                    <input id="password-confirm"  type="password" class="form-control @error('password') is-invalid @enderror "  name="password-confirmation" required autocomplete="new-password">
                    </div>
                    {{--End Confirm password --}}

               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">DISCARD</button>
                 <button type="submit" class="btn text-warning float-right">UPDATE</button>
               </div>
            </form>
          </div>
        </div>
      </div>
    
    @yield('body')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
     
    <script type="text/javascript">
      $('#file').on('change',function(ev){
        console.log("here inside");
     
        var filedata=this.files[0];
        var imgtype=filedata.type;
     
     
        var match=['image/jpeg','image/jpg'];
     
        if(!(imgtype==match[0])||(imgtype==match[1])){
            $('#mgs_ta').html('<p style="color:red">Plz select a valid type image..only jpg jpeg allowed</p>');
     
        }else{
     
          $('#mgs_ta').empty();
        
     
        //---image preview
     
        var reader=new FileReader();
     
        reader.onload=function(ev){
          $('#img_prv').attr('src',ev.target.result).css('width','150px').css('height','150px');
        }
        reader.readAsDataURL(this.files[0]);
     
        /// preview end
     
            //upload
     
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
</body>
</html>

