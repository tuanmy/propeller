@extends('tplogin')
@section('title')
    Re-send email verify
@stop
@section('content')
	<h3>An verify email was re-sent to your email</h3>
	<small>Return to <a href="{{URL::to('login')}}">login page</a></small>
@stop