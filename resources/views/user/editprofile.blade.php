 @extends('template')
@section('content')
@include('errors.list')
<div class="container">
<form id="registrationForm" class="form-horizontal" method="POST" action="{!! URL::route('user.postProfile',$item->id) !!}">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" value="{{{ Input::old('username', isset($item) ? $item->username : null) }}}" name="username">
			        <div class="alert-exist"></div>
			<!-- <button id="checkexist" type="button" class="btn btn-default">Check user existed</button> -->
		</div>
     	<div class="form-group">
			<label>First Name</label>
			<input type="text" class="form-control" value="{{{ Input::old('firstname', isset($item) ? $item->firstname : null) }}}" name="firstname">
		</div>
		<div class="form-group">
			<label>Middle</label>
			<input type="text" class="form-control" value="{{{ Input::old('middle', isset($item) ? $item->middle : null) }}}" name="middle">
		</div>
		<div class="form-group">
			<label>Last Name</label>
			<input type="text" class="form-control" value="{{{ Input::old('lastname', isset($item) ? $item->lastname : null) }}}" name="lastname">
		</div>
		<div class="form-group">
			<label>Phone</label>
			<input type="text" class="form-control" value="{{{ Input::old('phone', isset($item) ? $item->phone : null) }}}" name="phone">
		</div>
		<div class="form-group">
			 <button class="btn btn-primary" type="submit" id="save">Save</button>
		</div>
</form>

<script type="text/javascript">
      $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
                            url: '{{ URL::route("user.checkexistusernameignore") }}',
                            type: 'POST',
                        }
                    }
                },
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
                url: '{{ URL::route("user.checkexistusernameignore") }}',
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
</script>
@stop