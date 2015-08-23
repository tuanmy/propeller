 @extends('tplogin')
 @section('title')
    Reset password
@stop

@section('content')
<div>
    <div>
        <img class="logo-name" src="{{ URL::to('/').'/images/logo.png'}}" />
    </div>
    <h3>Reset Your Password!</h3>

    @include('errors.error')

    <form id="resetForm" class="m-t" role="form" method="POST" action="{!! URL::to('/password/reset') !!}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <input placeholder="E-Mail Address" type="email" class="form-control" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <input placeholder="Password" type="password" class="form-control" name="password">
        </div>

        <div class="form-group">
                <input placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary block full-width m-b">Reset Password</button>


    </form>
        
</div>
    <script type="text/javascript">
          $('#resetForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and can\'t be empty'
                        },
                        stringLength: {
                            min: 7,
                            max: 30,
                            message: 'The password must be more than 7 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,}$/,
                            message: 'The password must include numbers, alphabets, and special characters'
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        notEmpty: {
                            message: 'The confirm password is required and can\'t be empty'
                        },
                        identical: {
                            field: 'password',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required and can\'t be empty'
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

