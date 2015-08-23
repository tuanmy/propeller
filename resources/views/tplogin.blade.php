<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <title>@yield('title')</title>
    {!! HTML::script('assets/js/jquery.min.js')!!}        
    {!! HTML::script('assets/js/bootstrap.min.js')!!}        
    {!! HTML::script('assets/formvalidation/js/formValidation.min.js')!!}   
    {!! HTML::script('assets/formvalidation/js/framework/bootstrap.min.js')!!}      

    {!! HTML::style('assets/css/bootstrap.min.css')!!}
    {!! HTML::style('assets/font-awesome/css/font-awesome.css')!!}
    {!! HTML::style('assets/css/animate.css')!!}
    {!! HTML::style('assets/css/compiled/style.css')!!}
    <!--<link rel="stylesheet/less" type="text/css" href="{{ URL::asset('assets/css/less/style.less')}}" />-->


</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        @yield('content')       
    </div>
    <script>
         $("div.alert").not('.alert-important').delay(8000).slideUp(300);
    </script>
</body>
             

</html>
