 $( document ).ready(function() {
    $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
     });
    $("#register").attr('disabled', 'disabled');

    $("#checkexist").click(function(){

        var username = $("input[name=username]").val();
        $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: validateUsernameUrl,
            type: "POST",
            data:{
                'username': username,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'html',
            success: function (result) {
                console.log(result);
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
                        url: validateUsernameUrl,
                        type: 'POST',
                    }
                }
            },
             password: {
                 validators: {

                     callback:{
                         message: 'Weak!',
                         callback: function(value, validator, $field){
                           var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
                            var mediumRegex = new RegExp("^(?=.{7,})(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$.*$", "g");
                            var enoughRegex = new RegExp("(?=.{6,}).*", "g");
                       //     if (false == enoughRegex.test($(this).val())) {
                       //             $('#passstrength').html('More Characters');
                       //     } else
                           $('#passstrength').removeAttr('class');
                            if (strongRegex.test(value)) {
                                    $('#passstrength').addClass('ok');
                                    $('#passstrength').html('Strong!');
                            } else if (mediumRegex.test(value)) {
                                    $('#passstrength').addClass('ok');
                                    $('#passstrength').html('Medium!');
                            } else {
                                $('#passstrength').html('');
                                return false;
                            }
                           return true;
                         }
                     },
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
                         message: 'The password must include numbers, alphabets, and special characters',
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
                        message: 'The email is not available!  Click to <a href="'+loginUrl+'">Reset Password</a> or <a href="'+ resetPasswordUrl +'">Login</a>',
                        url: validateEmailUrl,
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
            subscription: {
                validators: {
                    notEmpty: {
                        message: 'The subscription is required and can\'t be empty'
                    }
                }
            },
            billing_method: {
                validators: {
                    notEmpty: {
                        message: 'The billing method is required and can\'t be empty'
                    }
                }
            },
            org_name: {
                validators: {
                    notEmpty: {
                        message: 'The organization name is required and can\'t be empty'
                    }
                }
            },
        }

    });    

});