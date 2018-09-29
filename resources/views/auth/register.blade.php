@extends('layouts.appMainDev')

@section('content')
<style>
    /* label focus color */
   .custom-error {
     color: #000;
}
/* label underline focus color */
   .custom-error {
     border-bottom: 1px solid #f95c3c !important;
     box-shadow: 0 1px 0 0 #f95c3c  !important;
   }
</style>
@include('inc.main.headerDevSign')

<section class="section joinContainer">
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2" id="joinForm">
                <div class="card">

                    <div class="card-tabs">
                        <ul class="tabs tabs-width-f" style="overflow: hidden;">
                            <li class="tab center joinActive col s6 m6 l6">
                                <a href="{{route('login')}}" target="_self" class="black-text" id="signIn">Sign In</a>
                            </li>
                            <li class="tab center col s6 m6 l6" id="signUp">
                                <a href="#tab1" class="black-text joinActive active" id="signUp">Sign Up</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-content">

                        <div id="tab1">
                            <div class="row">
                                <div class="col s10 offset-s1 left">
                                    <h2>Create your Account</h2>
                                    @if($errors->count() > 0) 
                                        <p class="center white-text red" style="margin:2% 0">Please check your fields</p>
                                    @endif
                                </div>

                                <div class="col s10 offset-s1 left">
                                    <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col s6">
                                                <div class="input-field">
                                                    <input value="{{ old('firstName') }}" id="firstName" name="firstName" type="text" autofocus class="{{ $errors->has('firstName') ? ' custom-error' : '' }}">
                                                    {{-- <label data-error="Invalid" for="firstName"></label> --}}
                                                    <label for="firstName">First Name</label>
                                                </div>
                                            </div>
                                            <div class="col s6">
                                                <div class="input-field">
                                                    <input value="{{ old('lastName') }}" id="lastName" name="lastName" type="text"  class="{{ $errors->has('lastName') ? ' custom-error' : '' }}">
                                                    <label for="lastName">Last Name</label>
                                                </div>
{{-- 
                                                @if ($errors->has('lastName'))
                                                    <span style="helper-text" data-error="{{ $errors->first('lastName') }}" role="alert">
                                                    </span>
                                                @endif --}}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col s6">
                                                <div class="input-field">
                                                    <input value="{{ old('email') }}" id="email" name="email" type="text" autofocus class="{{ $errors->has('email') ? ' custom-error' : '' }}">
                                                    {{-- <label data-error="Invalid" for="firstName"></label> --}}
                                                    <label for="email">Email</label>
                                                </div>
                                            </div>
                                            <div class="col s6">
                                                <div class="input-field">
                                                    <input value="{{ old('mobileNo') }}" id="mobileNo" name="mobileNo" type="text"  class="{{ $errors->has('mobileNo') ? ' custom-error' : '' }}">
                                                    <label for="mobileNo">Mobile No</label>
                                                </div>
{{-- 
                                                @if ($errors->has('lastName'))
                                                    <span style="helper-text" data-error="{{ $errors->first('lastName') }}" role="alert">
                                                    </span>
                                                @endif --}}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col s6">
                                                <div class="input-field">
                                                    <input value="{{ old('password') }}" id="password" name="password" type="password" autofocus class="{{ $errors->has('password') ? ' custom-error' : '' }}">
                                                    {{-- <label data-error="Invalid" for="firstName"></label> --}}
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                            <div class="col s6">
                                                <div class="input-field">
                                                    <input value="{{ old('password_confirmation') }}" id="password_confirmation" name="password_confirmation" type="password">
                                                    <label for="password_confirmation">Confirm Password</label>
                                                </div>
{{-- 
                                                @if ($errors->has('lastName'))
                                                    <span style="helper-text" data-error="{{ $errors->first('lastName') }}" role="alert">
                                                    </span>
                                                @endif --}}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col s6">
                                                <div class="input-field">
                                                    <input value="{{ old('gstNo') }}" id="gstNo" name="gstNo" type="text" autofocus class="{{ $errors->has('gstNo') ? ' custom-error' : '' }}">
                                                    {{-- <label data-error="Invalid" for="firstName"></label> --}}
                                                    <label for="gstNo">GST Number</label>
                                                </div>
                                            </div>
                                            <div class="col s6">
                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>Photo</span>
                                                        <input type="file" name="gstImage">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input type="text" value="{{old('gstImage')}}" class="file-path">
                                                    </div>
                                                </div>                                           
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col s6">
                                                <div class="input-field">
                                                    <input value="{{ old('drugNo') }}" id="drugNo" name="drugNo" type="text" autofocus class="{{ $errors->has('drugNo') ? ' custom-error' : '' }}">
                                                    {{-- <label data-error="Invalid" for="firstName"></label> --}}
                                                    <label for="drugNo">Drug License No.</label>
                                                </div>
                                            </div>
                                            <div class="col s6">
                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>Photo</span>
                                                        <input type="file" name="drugImage">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input type="text" value="{{old('drugImage')}}" class="file-path">
                                                    </div>
                                                </div>                                           
                                            </div>
                                        </div>
                                        

                                        <p style="font-size: 90%; margin:2% 0 4% 0;">By clicking Sign Up, you agree to our <span class="blue-text"><b>Terms of Use</b></span> and our <span class="blue-text"><b>Privacy Policy</b></span>.</p>
                                        <div class="input-field">
                                            <input type="submit" class="btn blue" value="Sign In" style="width: 100%;">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <div class="login-box">
   
    <div class="card">
        <div class="body">
            <form id="sign_in" method="POST" action="{{route('login')}}">
                @csrf
                <div class="msg">Sign in to start your session</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                    </div>

                    @if ($errors->has('email'))
                        <span style="color:red; opacity:0.9; padding-top:2px;" role="alert">
                            <small>{{ $errors->first('email') }}</small>
                        </span>
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input id="password" type="password" class="form-control" name="password" required placeholder="Password">                    
                    </div>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="remember" id="remember" class="filled-in chk-col-pink" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Remember Me</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6 align-right">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>                    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> --}}
@endsection



{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
