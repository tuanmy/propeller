@extends('template')
@section('content')
<div class="content">
     @include('errors.list')
        @if (Session::has('message'))
		        <div class="alert alert-success }}">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		            {{ Session::get('message') }}
		        </div>
		    @endif
	<form id="form" class="form-inline" method="POST" action="{{URL::route('person.create')}}">
	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label>First Name</label>
			<input type="text" class="form-control" value="" name="firstname">
		</div>
		<div class="form-group">
			<label>Middle</label>
			<input type="text" class="form-control" value="" name="middle">
		</div>
		<div class="form-group">
			<label>Last Name</label>
			<input type="text" class="form-control" value="" name="lastname">
		</div>
		<div class="form-group">
			<select class="form-control" name="tenant_id">
				<option value="">-- Select Tenant --</option>
				@if(count($listTenant) > 0 )
					@foreach($listTenant as $post)
						<option value="{{$post->id}}">{{$post->org_name}}</option>
					@endforeach
				@endif
			</select>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-default">Save</button>
		</div>
	</form>
</div>
<script type="text/javascript">
	$("div.alert").not('.alert-important').delay(3000).slideUp(300);
	 $('#form').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                firstname: {
                    validators: {
                        notEmpty: {
                            message: 'The firstname is required and can\'t be empty'
                        },
                    }
                },
                lastname: {
                    validators: {
                        notEmpty: {
                            message: 'The lastname is required and can\'t be empty'
                        },
                    }
                },
                tenant_id: {
                    validators: {
                        notEmpty: {
                            message: 'The subscription is required and can\'t be empty'
                        }
                    }
                },
            }

        });
</script>
@stop
