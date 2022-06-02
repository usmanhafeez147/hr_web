@extends('layouts.app')

<link rel="ICON" href="{{asset('/dist/img/hicon.png')}}" type="image/ico" />

@section('content')
<div class="container" style="margin-top: 120px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="border-color: white">

               <!--<div class="panel-header">LogIn</div>-->

                <div class="panel-body" style="margin-top: 0px;">

                     <img style="text-align: center;width: 150px; text-align: right; margin-left: 300px;margin-bottom: 30px" src="/dist/img/logo1.jpg" class="img-circle" alt="User Image">

                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" placeholder="Password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                                    </label>

                                    <a style="margin-left: 47px" class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #f0ad4e; border-color: #f0ad4e;font-size:18px;font-weight: 500;">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
                 <a style="font-size: 25px;font-weight: 700;color:black; font-family: sans-serif;margin-left: 330px " href="{{route('subscribe',[str_slug($package->name),$package->id_package])}}" >Join us</a> |
                  <a style="color: black;font-size: 20px" href="{{route('home')}}" >Back</a>
      </button>
            </div>
        </div>
    </div>
</div>
@endsection
