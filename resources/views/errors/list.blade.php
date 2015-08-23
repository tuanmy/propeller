@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>        
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <!--<p>Do you want to <a href="{{URL::to('password/email')}}">Reset Your Password</a></p>-->
    </div>
@endif