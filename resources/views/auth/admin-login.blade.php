@extends('layouts.app')

@section('content')
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">Admin Login</a>
        <small>Welcome to Pharmcia Adminstrator Panel</small>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" method="POST" action="{{route('admin.login.submit', ['admin' => 'admin'])}}">
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
                            <small><b>{{ $errors->first('email') }}</b></small>
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

                
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">people</i>
                    </span>
                    <select class="form-control" name="role">
                        <option value="">-- Please Select Role --</option>
                        <option value="dataEntry">Data Entry</option>
                        <option value="admin">Admin</option>
                    </select>

                    @if ($errors->has('role'))
                        <span style="color:red; opacity:0.9; padding-top:2px;" role="alert">
                            <small><b>{{ $errors->first('role') }}</b></small>
                        </span>
                    @endif
                </div>
{{-- 
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-group">
                       <select name="" id="" class="form-control">
                        <option value="">Data Entry</option>
                        <option value="">Admin</option>   
                        </select>                 
                    </div>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div> --}}
                <div class="row">
                    {{-- <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="remember" id="remember" class="filled-in chk-col-pink" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Remember Me</label>
                    </div> --}}
                    <div class="col-xs-6" style="margin-left: 25%;">
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
</div>
@endsection
