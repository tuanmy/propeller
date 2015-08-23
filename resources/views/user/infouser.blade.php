<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Add User Existed to Current Tanent</h4>
</div>

<form method="POST" action="{{ URL::route('user.addUserExist') }}" id="adduserForm">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="modal-body">
        @if($owner == true)
        <h2>This is your infomation, Click <a style="color:green" href="{{URL::route('user.getProfile',$user->userid)}}" target="_blank">here</a>
            to edit your info</h2>
            @endif
            <div class="form-group">
                <label>Email: </label><span id="email_exist">{{$user->email}}</span>
            </div>

            <div class="form-group">
                <label>First Name: </label><span id="firstname_exist">{{$user->firstname}}</span>
            </div>

            <div class="form-group">
                <label>Midlle: </label><span id="middle_exist" >{{$user->middle}}</span>
            </div>

            <div class="form-group">
                <label>Last Name: </label><span id="lastname_exist">{{$user->lastname}}</span>
            </div>
            @if($owner == false)
            <div class="form-group">
                <label>Select Role</label>
                <select class="form-control" name="role">
                    <option value="">-- Select Role --</option>
                    @if(count($roleList) > 0 )
                    @foreach($roleList as $post)
                    <option value="{{$post->id}}" <?php if($post->id == $role_id) echo 'selected'; ?>>{{$post->role}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            @endif
        </div>
        <div class="modal-footer">
            <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
             @if(!$owner)
            <button type="submit" class="btn btn-primary" id="save_exist">Save changes</button>
            @endif
        </div>
        <input type="hidden" id="user_id" name="user_id" value="{{$user->userid}}">

    </form>

<script type="text/javascript">
      $('#adduserForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                role: {
                    validators: {
                        notEmpty: {
                            message: 'The role name is required and can\'t be empty'
                        }
                    }
                },
            }

        });
</script>