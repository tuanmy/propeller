@extends('tplogin')
@section('title')
    Login
@stop
@section('content')
	@if(Session::has('success'))
        <div class="alert-danger }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('success')}}
        </div>
    @endif
	Please verify your account by click on the link that we sent you via email or <a href="{{URL::route('user.resendemail',Auth::user()->email)}}">Click here to re-send verify email</a>
@stop