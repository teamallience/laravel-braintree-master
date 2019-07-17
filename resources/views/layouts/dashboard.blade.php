<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N4N2LKM');</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{asset('img/favicon.png') }}">

    <title>@yield('title')</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/jqueryui/jquery-ui.min.css')}}">
    <link href="{{url(asset('plugins/bootstrap/css/bootstrap.min.css'))}}" rel="stylesheet">
    <link href="{{url('plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <!-- This page CSS -->
    <link href="{{url('plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{url('css/admin/style.css')}}" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{url('css/admin/pages/dashboard1.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://voipservices.io/css/admin/icons/simple-line-icons/css/simple-line-icons.css">

    @yield('styles')

    <!-- You can change the theme colors from here -->
    <link href="{{url('css/admin/colors/green-dark.css')}}" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{url('css/admin/custom.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    {{-- <script src="https://cdn.rawgit.com/samsonjs/strftime/master/strftime-min.js"></script>
    <script src="//js.pusher.com/3.0/pusher.min.js"></script> --}}

</head>

<body class="card-no-border mini-sidebar">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N4N2LKM"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Loading ...</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('components.header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            @include('components.footer')
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script src="{{url(asset('plugins/jquery/jquery.min.js'))}}"></script>
    <script src="{{url(asset('plugins/jqueryui/jquery-ui.min.js'))}}"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="{{url(asset('plugins/bootstrap/js/popper.min.js'))}}"></script>
    <script src="{{url(asset('plugins/bootstrap/js/bootstrap.min.js'))}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{url(asset('plugins/ps/perfect-scrollbar.jquery.min.js'))}}"></script>
    <!--Wave Effects -->
    <script src="{{url(asset('js/admin/waves.js'))}}"></script>
    <!--Menu sidebar -->
    <script src="{{url(asset('js/admin/sidebarmenu.js'))}}"></script>
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="{{url(asset('plugins/toast-master/js/jquery.toast.js'))}}"></script>
    
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{url(asset('plugins/styleswitcher/jQuery.style.switcher.js'))}}"></script>
    {{-- <script src="{{url(asset('js/app.js'))}}"></script> --}}
    <!--Custom JavaScript -->
    <!-- ============================================================== -->
    <script src="{{url(asset('js/client/custom.js'))}}"></script>

        @yield('page_scripts')

    <script type="text/javascript">
        var cluster = "{{ config('broadcasting.connections.pusher.options.cluster') }}"
        var app_key = "{{ config('broadcasting.connections.pusher.key')}}"
        var id = "{{Auth::id()}}"
        
    </script>

        @yield('scripts')

    <script>
        var APP_ID = "h8o9qz7b"
        
        var intDate = function(dateStr) {
            return new Date(dateStr).getTime();
        };
        
        window.intercomSettings = {
            app_id: APP_ID,
            name: '{{Auth::user()->name}}', // Full name
            email: '{{Auth::user()->email}}', // Email address
            user_id: '{{Auth::user()->id}}' // current_user_id
        };
        
        (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/h8o9qz7b';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
    </script>
    
</body>

</html>