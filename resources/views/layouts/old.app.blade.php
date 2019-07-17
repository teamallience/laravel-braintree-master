<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Our Site') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Main CSS file -->
    <link rel="stylesheet" href="{{URL:: asset('css/my/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{URL:: asset('css/my/css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/my/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{URL:: asset('css/my/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/my/css/style.css') }}" />
    <link rel="stylesheet" href="{{URL:: asset('css/my/css/responsive.css') }}" />


    <!-- Favicon -->
    <link rel="shortcut icon" href="{{URL:: asset('images/icon/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{URL:: asset('images/icon/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{URL:: asset('images/icon/apple-touch-icon-72-precomposedsed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{URL:: asset('images/icon/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{URL:: asset('images/icon/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{URL:: asset('images/icon/apple-touch-icon-57-precomposed.png')}}">

    <!--login-->
    <link href="{{URL:: asset('css/my/css/login-register.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">   

    <script src="{{URL:: asset('js/client/login-register.js') }}" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
     <!-- PRELOADER -->
        <div id="st-preloader">
            <div id="pre-status">
                <div class="preload-placeholder"></div>
            </div>
        </div>
        <!-- /PRELOADER -->


        <!-- HEADER -->
        <header id="header">
            <nav class="navbar st-navbar navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#st-navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        {{--<a class="logo" href="{{ URL::route('home') }}"><img src="{{URL:: asset('images/logo.png')}}" width=150px height=100px; alt=""></a>--}}
                   {{----}}
                    </div>

                    <div class="collapse navbar-collapse" id="st-navbar-collapse" >
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#slider">Home</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#our-works">Works</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                            <li><a href="#our-team">Team</a></li>
                            <li><a href="#contact">Contact</a></li>
                            {{--<li><a href="{{ URL::route('product') }}">Products</a></li>--}}
                            <!--<li><a class="btn big-login" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Log in</a></li>
                            <li> <a class="btn big-register" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register</a></li>-->
                            @guest
                                @if(Request::is('account/sign-in'))
                                    <li><em class="btn  big-login" >Sign In</em></li>
                                @else
                                 <li><a href="{{ URL::route('login') }}">Sign In</a></li>
                                @endif

                                @if(Request::is('account/sign-up'))
                                 <li><em class="btn  big-register">Sign Up</em></li>
                                @else
                                    <li><a href="{{ URL::route('register') }}">Sign Up</a></li>
                                @endif
                            @else
                                <li>
                                    <a  href="{{ route('client.dashboard') }}">Dashboard</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Sign Out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endguest
                            

                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container -->
            </nav>
        </header>
        

        @yield('content')
    

    <!-- Scripts -->
    <script type="text/javascript" src="{{URL:: asset('js/client/jquery.min.js')}}"></script><!-- jQuery -->
    <script type="text/javascript" src="{{URL:: asset('js/client/bootstrap.min.js')}}"></script><!-- Bootstrap -->
    <script type="text/javascript" src="{{URL:: asset('js/client/jquery.parallax.js')}}"></script><!-- Parallax -->
    <script type="text/javascript" src="{{URL:: asset('js/client/smoothscroll.js')}}"></script><!-- Smooth Scroll -->
    <script type="text/javascript" src="{{URL:: asset('js/client/masonry.pkgd.min.js')}}"></script><!-- masonry -->
    <script type="text/javascript" src="{{URL:: asset('js/client/jquery.fitvids.js')}}"></script><!-- fitvids -->
    <script type="text/javascript" src="{{URL:: asset('js/client/owl.carousel.min.js')}}"></script><!-- Owl-Carousel -->
    <script type="text/javascript" src="{{URL:: asset('js/client/jquery.counterup.min.js')}}"></script><!-- CounterUp -->
    <script type="text/javascript" src="{{URL:: asset('js/client/waypoints.min.js')}}"></script><!-- CounterUp -->
    <script type="text/javascript" src="{{URL:: asset('js/client/jquery.isotope.min.js')}}"></script><!-- isotope -->
    <script type="text/javascript" src="{{URL:: asset('js/client/jquery.magnific-popup.min.js')}}"></script><!-- magnific-popup -->
    <script type="text/javascript" src="{{URL:: asset('js/client/scripts.js')}}"></script>
</body>
</html>
