 @extends('template')
@section('content')
@include('errors.list')
<div class="container">
<form id="registrationForm" class="form-horizontal" method="POST" action="{!! URL::route('user.create') !!}">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <div class="form-group">
        Username
        <input class="form-control" type="text" name="username" value="{{ old('username') }}">
        <div class="alert-exist"></div>
        <!-- <button id="checkexist" type="button" class="btn btn-default">Check user existed</button> -->
    </div>

    <div class="form-group">
        Email
        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
    </div>

    <div class="form-group">
        Confirm email
        <input class="form-control" type="email" name="email_confirmation" value="{{ old('email_confirmation') }}">
    </div>

    <div class="form-group">
        Password
        <input class="form-control" type="password" name="password">
         <span id="passstrength"></span>
    </div>

    <div class="form-group">
        Confirm Password
        <input class="form-control" type="password" name="password_confirmation">
    </div>
    <div class="form-group">
        Select Role
        <select class="form-control" name="role">
            <option value="">-- Select Role --</option>
            @if(count($roleList) > 0 )
            	@foreach($roleList as $post)
            		 <option value="{{$post->id}}">{{$post->role}}</option>
            	@endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit" id="register">Save</button>
    </div>
</form>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
    </div>
  </div>
</div>

</div>
 <script type="text/javascript">
    $( document ).ready(function() {
    
        $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
        });
        $("#checkexist").click(function(){
            var username = $("input[name=username]").val();
            $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ URL::route("user.checkexistusername") }}',
                type: "POST",
                data:{
                    'username': username,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'html',
                success: function (result) {
                    if(result == 'exist') {
                        $(".alert-exist").html('Username not available');
                        $("#register").attr('disabled', 'disabled');
                    }
                    else {
                        $(".alert-exist").html('Username available');
                        $("#register").removeAttr("disabled");
                    }
                },
            });
        });	

        $('#registrationForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'The username is required and can\'t be empty'
                        },
                        remote: {
                            message: 'The username is not available',
                            url: '{{ URL::route("user.checkexistusername") }}',
                            type: 'POST',
                        }
                    }
                },
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
                        remote: {
                            message: 'The email is not available!  Click to <a href="#" id="showModal" onclick="myFunction()" >Add this user to current Tenant</button>',
                            url: '{{ URL::route("user.checkexistemail") }}',
                            type: 'POST',
                        }
                    }
                },
                email_confirmation: {
                    validators: {
                        notEmpty: {
                            message: 'The confirm email is required and can\'t be empty'
                        },
                        identical: {
                            field: 'email',
                            message: 'The email and its confirm are not the same'
                        }
                    }
                },
                role: {
                    validators: {
                        notEmpty: {
                            message: 'The role name is required and can\'t be empty'
                        }
                    }
                },
            }

        });

   

    });

 $('input[name=password]').keyup(function(e) {
     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     var enoughRegex = new RegExp("(?=.{6,}).*", "g");
     if (false == enoughRegex.test($(this).val())) {
             $('#passstrength').html('More Characters');
     } else if (strongRegex.test($(this).val())) {
             $('#passstrength').className = 'ok';
             $('#passstrength').html('Strong!');
     } else if (mediumRegex.test($(this).val())) {
             $('#passstrength').className = 'alert';
             $('#passstrength').html('Medium!');
     } else {
             $('#passstrength').className = 'error';
             $('#passstrength').html('Weak!');
     }
     return true;
});

    function myFunction(){
       

        var email = $("input[name=email]").val();
        $.ajax({
            url: '{{ URL::route("user.getInfoUser") }}',
            type: "POST",
            data:{
                'email': email,
                '_token': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: 'html',
            success: function (result) {
                // user = jQuery.parseJSON(result);
                // console.log(user);
                // $("#email_exist").html(user.email);
                // $("#firstname_exist").html(user.firstname);
                // $("#lastname_exist").html(user.lastname);
                // $("#middle_exist").html(user.middle);
                $(".modal-content").html(result);
            
            },
        });
         $("#myModal").modal({
            'show':true
        });
    }

    

 </script>
 @stop


