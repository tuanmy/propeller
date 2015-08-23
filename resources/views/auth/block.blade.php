@extends('tplogin')
@section('title')
    Login
@stop
@section('content')
	<div class="alert-danger">
       	Your account was blocked, please <a href="{{URL::to('password/email')}}">Reset yor password</a> to join my system!
    </div>
@stop