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
  <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
  <script src="{{ asset('asset/js/awaresome.js') }}"></script>
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
            <form action="{{route('userProfile.update',Auth::user()->id)}}" autocomplete="off" method="POST" enctype="multipart/form-data">
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
                        <img src="{{asset('asset/userImage/'.Auth::user()->picture)}}" width="120px" height="120px">
                        <div class="row justify-content-center">

                            <input id="files" style="display:none;" type="file" name="picture">
                            <label for="files" class="btn" style="margin-top:-7px"><i class="fa fa-plus text-dark"></i></label>
                            <a href="#"><i class="fas fa-pencil-alt text-dark"></i></a>&nbsp;&nbsp;&nbsp;
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
                                
    </div>                                  
    @yield('body')
</body>
</html>

