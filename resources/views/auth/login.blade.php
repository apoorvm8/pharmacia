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
                            <li class="tab center joinActive col s6">
                                <a href="#tab1" class="black-text active joinActive" id="signIn">Sign In</a>
                            </li>
                            <li class="tab center col s6" id="signUp">
                                <a href="{{route('register')}}" target="_self" class="black-text" id="signUp">Sign Up</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-content">
                        {{-- <div id="tab2" style="padding-left: -10% !important;">
                            This is tab sign up
                        </div> --}}
                        <div id="tab1">
                            <div class="row">
                                <div class="col s10 offset-s1 left">
                                    <h2>Sign in to your Account</h2>
                                    @if(session('success'))
                                        <p class="white-text green lighten-1 center"> {{session('success')}}</p>
                                    @endif
                                    @if($errors->count() > 0) 
                                        <p class="center white-text red lighten-1" style="margin:2% 0">Please check your fields</p>
                                    @endif
                                </div>

                                <div class="col s10 offset-s1 left">
                                    <form action="{{route('login')}}" method="post">
                                        @csrf
                                        <div class="input-field">
                                            <input value="{{ old('email') }}"  id="email" name="email" type="email"  class="{{ $errors->has('email') ? ' custom-error' : '' }}" autofocus>
                                            <label for="email">Email Address</label>
    
                                                {{-- @if ($errors->has('email'))
                                                    <span style="helper-text" data-error="{{ $errors->first('email') }}" role="alert">
                                                    </span>
                                                @endif --}}
                                        </div>

                                        <div class="input-field">
                                            <input id="password" name="password" type="password"  class="{{ $errors->has('password') ? ' custom-error' : '' }}">
                                            <label for="password">Password</label>

                                            {{-- @if ($errors->has('password'))
                                                <span style="helper-text" data-error="{{ $errors->first('password') }}" role="alert">
                                            </span>
                                            @endif --}}
                                        </div>

                                        <p style="font-size: 90%; margin:2% 0 4% 0;">By clicking Sign In, you agree to our <span class="blue-text"><b>Terms of Use</b></span> and our <span class="blue-text"><b>Privacy Policy</b></span>.</p>
                                        <div class="input-field">
                                            <input type="submit" class="btn blue" value="Sign In" style="width: 100%;">
                                        </div>
                                    </form>
                                    <div class="center">
                                        <a href="#">Forgot your password?</a>
                                    </div>
                                    <div class="divider" style="margin-top:4%;"></div>
                                    {{-- <p id="otherServices">Or sign with Google</p> --}}
                                    <div>
                                    </div>
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
