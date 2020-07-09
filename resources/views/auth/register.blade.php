@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header h2 text-center">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                                <input id="firstname" placeholder="First Name" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" required autocomplete="off" autofocus>
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <input id="lastname" placeholder="First Name" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" required autocomplete="off" autofocus>
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                                <input id="email" type="email" placeholder="Mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <br>
                            <input type="radio" name="sex" value="Male"> Male
                            <input type="radio" name="sex" value="Female"> Female
                        </div>
                        <div class="form-group">
                            <label for="data of birth">Date of birth (Optional)</label>
                            <br>
                            <input class="form-control" type="date" name="dateOfBirth">
                        </div>
                        <div class="form-group">
                           
                                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                                <input id="password-confirm" placeholder="Confirm password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                       

                        <div class="form-group">
                            <div class="justify-content-center">
                                <a style="text-decoration: underline;" class="mt-1" href="{{ route('login') }}"><b>Or back to sing in</b></a>
                                <button type="submit" class="btn btn-warning text-white float-right">
                                    <b>{{ __('Next') }}</b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
