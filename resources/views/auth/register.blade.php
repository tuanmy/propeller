@extends('tplogin')
@section('title')
    Register
@stop
@section('content')
@include('errors.list')
<style type="text/css">
    .vertical-align{
        display: flex;
        align-items: center;
    }
</style>
<div>
    <div>
        <image class="logo-name" src="images/logo.png" />
    </div>
     <h3>Sign Up For a New Account</h3>
     <p class="text-center">
        If you have a valid user account, please login below and start managing your fundraising events.
    </p>
<form id="registrationForm" class="form-horizontal" method="POST" action="{!! URL::to('/register') !!}">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <div class="form-group">
        <input placeholder="Name" class="form-control" type="text" name="username" value="{{ old('username') }}">
      <!--   <div class="alert-exist"></div>
        <button id="checkexist" type="button" class="btn btn-default">Check valid user</button> -->
    </div>

    <div class="form-group">
        <input placeholder="Email" class="form-control" type="email" name="email" value="{{ old('email') }}">
    </div>

    <div class="form-group">
        <input placeholder="Confirm Email" class="form-control" type="email" name="email_confirmation" value="{{ old('email_confirmation') }}">
    </div>

    <div class="form-group">
        <input placeholder="Password" class="form-control" type="password" name="password">
         <span id="passstrength"></span>
    </div>

    <div class="form-group">
        <input placeholder="Confirm Password" class="form-control" type="password" name="password_confirmation">
    </div>
    <div class="form-group">
        <select class="form-control" name="subscription">
            <option value="">Choose Subscription Level</option>
            <option value="1">Trial subscription</option>
            <option value="2">Monthly subscription</option>
            <option value="3">Yearly subscription</option>
        </select>
    </div>
    <div class="form-group">
        <input placeholder="Organization" class="form-control" type="text" name="org_name">
    </div>
    <div class="form-group">
       
        <select class="form-control" name="billing_method">
            <option value="">Choose Billing Method</option>
            <option value="Billing Method 1">Billing Method 1</option>
            <option value="Billing Method 2">Billing Method 2</option>
            <option value="Billing Method 3">Billing Method 3</option>
        </select>
    </div>
    <div class="form-group vertical-align">
        <div class="col-md-6 text-left">
            <div class="checkbox">
                <label>
                    <input type="checkbox"> I Agree to the Propeller Seeds
                </label>
            </div>
        </div>
        <div class="col-md-6">
            <a href="{{URL::to('termsofuse')}}">Terms of Use</a>
        </div>
    </div>
   
    

    <div class="form-group">
        <button class="btn btn-primary block full-width" type="submit" id="register">Register</button>
    </div>
    <p class="m-t"> <small>Or, if you already have an account, <a href="{!!URL::to('login')!!}">login here.</a></small> </p>
</form>
</div>
<script></script>
    <script type="text/javascript">
        var validateUsernameUrl = '{{ URL::route("user.checkexistusername") }}';
        var validateEmailUrl    = '{{ URL::route("user.checkexistemail") }}';
        var loginUrl =  '{!! URL::to("/password/email") !!}';
        var resetPasswordUrl = '{!! URL::to("/login") !!}';
    </script>
    {!! HTML::script('assets/js/validate-register.js')!!}   

 @stop