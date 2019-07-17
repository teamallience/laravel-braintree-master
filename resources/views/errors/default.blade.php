<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{URL:: asset('images/icon/favicon.png') }}">
    <title>We'll Be Back</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{url(asset('plugins/bootstrap/css/bootstrap.min.css'))}}" rel="stylesheet">
    <!-- This page CSS -->
    <!-- Custom CSS -->
    <link href="{{url('css/admin/style.css')}}" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{url('css/admin/pages/error-pages.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{url('css/admin/colors/blue-dark.css')}}" rel="stylesheet">
    <link href="{{url('css/admin/custom.css')}}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<?php
    use Carbon\Carbon;
?>
<body class="fix-header card-no-border fix-sidebar">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>Oops</h1>
                <h3 class="text-uppercase">The site will be back momentarily. Your dialing is unaffected.</h3>
                <p class="text-muted m-t-30 m-b-30">Please Try After Some Time</p>
                <a href="{{route('index')}}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
            <footer class="footer text-center">&copy; {{Carbon::now()->year}}</footer>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
   <script src="{{url(asset('plugins/jquery/jquery.min.js'))}}"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="{{url(asset('plugins/bootstrap/js/popper.min.js'))}}"></script>
    <script src="{{url(asset('plugins/bootstrap/js/bootstrap.min.js'))}}"></script>
    <!--Wave Effects -->
   	<script src="{{url(asset('js/admin/waves.js'))}}"></script>
</body>

</html>