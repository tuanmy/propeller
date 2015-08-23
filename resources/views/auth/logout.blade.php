@extends('tplogin')
@section('title')
    Login
@stop
@section('content')
<div>
    <div>
        <img class="logo-name" src="images/logo.png" />
    </div>
    <h3>Logged Out</h3>
    <p class="text-center">You are now logged out of Propeller Seeds. You can close this window.</p>
    @include('errors.list')
    @if(Session::has('success'))
            <div class="alert alert-success }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('success') }}
            </div>
    @endif  
    <form id="loginForm" class="m-t" method="POST" action="{!! URL::to('/login') !!}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" id="password" placeholder="Password" required="">
        </div>
        

  <!--   @if(Session::has('verify'))
        <div class="alert-danger }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Please verify your account by click on the link that we sent you via email or <a target="_blank" href="{{URL::route('user.resendemail',$emailverify)}}">Click here to re-send verify email</a>
        </div>
    @endif  -->

   <!--  @if(Session::has('block'))
        <div class="alert-danger }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Your account was blocked, please <a href="{{URL::to('password/email')}}">Reset yor password</a> to join my system!
        </div>
    @endif -->
        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
        <p>
            <a href="{!! URL::to('/password/email') !!}"><small>Forgot Password?</small></a>
        </p>
        
    </form>

    {!! HTML::script('assets/js/validate-login.js')!!}       
</div>
@endsection

