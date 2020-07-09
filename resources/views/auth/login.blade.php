@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 10%">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header h2 text-center">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf

                        <div class="form-group">
                                <input id="email" type="email" placeholder="Mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <div class="justify-content-center">
                                <a style="text-decoration: underline;" class="mt-1" href=""><b>Create account</b></a>
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
