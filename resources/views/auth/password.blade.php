@extends('tplogin')
@section('title')
    Reset Password
@stop
@section('content')
@include('errors.list')
<div>
    <div>
        <img class="logo-name" src="{{asset('images/logo.png')}}" />
    </div>       
     <h3>Reset Password</h3>
        <p class="text-center">If you forgot your password, please type your email and we will send you a link to help you reset your password. Do not forget to check your Inbox and if email not in your inbox, please check your Spam folder.</p>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @include('errors.list')

        <form id="adminForm" class="m-t" role="form" method="POST" action="{!! URL::to('/password/email') !!}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>                    
            <button type="submit" class="btn btn-primary block full-width m-b"> Send Password Reset Link</button>
        </form>
    </div>
    </div>

<script type="text/javascript">
        $('#adminForm').formValidation({
        message: 'This value is not valid',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    },
                }
            },
        }
    });
</script>

@stop

