<!DOCTYPE html>
<html>
    <head>
    <meta name="csrf-token" content="{!! csrf_token() !!}">
        <title>{{ $title or "Propeller" }}</title>       
        <meta name="csrf-token" content="{!! csrf_token() !!}">
        {!! HTML::style('assets/css/bootstrap.min.css')!!}
        {!! HTML::style('assets/formvalidation/css/formValidation.min.css')!!}
        <link rel="stylesheet/less" type="text/css" href="{{ URL::asset('assets/css/less/template.less')}}" />
        {!! HTML::script('assets/js/less.min.js')!!}       
        
        {!! HTML::style('assets/css/compiled/style.css')!!}

     
        {!! HTML::script('assets/js/jquery.min.js')!!}        
        {!! HTML::script('assets/js/bootstrap.min.js')!!}        
        {!! HTML::script('assets/js/template.js')!!}   
        {!! HTML::script('assets/formvalidation/js/formValidation.js')!!}   
        {!! HTML::script('assets/formvalidation/js/framework/bootstrap.min.js')!!}   


    </head>
    <body>
        @if (!Auth::guest())
        <div class="form-group form-inline">
        <a class="btn btn-danger" href="{!! URL::to('/logout') !!}">Logout</a>
        <a class="btn btn-success" href="{!! URL::route('user.getProfile',Auth::user()->id) !!}">Edit profile</a>
        @widget('SwitchTenant')
    
            @if(\Session::get('role') == ROLE_ADMIN)
            <a class="btn btn-success" href="{!! URL::route('user.create') !!}">Create new user</a>
            <a class="btn btn-success" href="{!! URL::route('user.getUserSameTenant')!!}">Show users in tenant</a>
            @endif

        </div>
        @endif  
        <header class="header">
            @section('header')
             <p>This is the header.</p>
            @show
        </header>
        <div class="container">
             @section('sidebar')
             <p>This is the master sidebar.</p>
             @show
            <div class="content">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
             @section('footer')
             <p>This is the footer.</p>
            @show
        </footer>

     
    </body>
</html>
