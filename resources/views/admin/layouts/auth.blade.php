
<!DOCTYPE html>
<html lang="en">

<head>
   <html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Our Site') }}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{url(asset('plugins/bootstrap/css/bootstrap.min.css'))}}" rel="stylesheet">
    <!-- page css -->
    <link href="{{url(asset('css/my/css/pages/login-register-lock.css'))}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{url(asset('css/my/css/pages/style.css'))}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{url(asset('css/my/css/colors/blue-dark.css'))}}" id="theme"  rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin Wrap</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        @yield('content')
        
    </section>
    
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{url(asset('js/client/jquery.min.js'))}}"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{url(asset('plugins/bootstrap/js/popper.min.js'))}}"></script>
    <script src="{{url(asset('plugins/bootstrap/js/bootstrap.min.js'))}}"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        
    </script>
    
</body>

</html>