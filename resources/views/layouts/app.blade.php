<!doctype html>
<html class="no-js" lang="en">
    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N4N2LKM');</script>
        <!-- End Google Tag Manager -->
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Voyyp | Dial More</title>
        <meta name="description" content="Use our contact center to launch powerful outbound call campaigns and easily handle inbound.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon Icon -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:400,600" rel="stylesheet"> 
		
		<!-- all css here -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/slick.css">
        <link rel="stylesheet" href="css/meanmenu.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N4N2LKM"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <?php
            use Carbon\Carbon;
        ?>
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    	<!-- Header Area Start -->
		<header class="header-area fixed">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="logo">
                            <img src="img/logo-shadow.png" alt="Voyyp" height="50px">
                        </div>
                    </div>
                    <div class="col-md-10 hidden-sm hidden-xs">
                        <div class="main-menu text-center">
                            <nav>
                                <ul style="text-align:right">
                                    <!--
                                    <li class="active"><a href="/">Home</a></li>
                                    <li><a href="features.html">Features</a></li>
                                    <li><a href="pricing.html">VOIP Price</a></li>
                                    <li><a href="support.html">Support</a></li>
                                    <li><a href="service.html">Services</a></li>
                                    <li><a href="contact-us.html">Contact</a></li>
                                    -->
                                    @guest
                                        <li><a href="{{ URL::route('login') }}">Dashboard</a></li>
                                        <li><a href="#signup" style="background: #fff; color: #1dca3d; text-shadow: none; border-radius: 30px;">Sign Up</a></li>
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
                            </nav>
                        </div>
                    </div>
                    <!--
                    <div class="col-md-2 col-sm-4 hidden-xs">
                        <button class="modal-view nav-btn" data-toggle="modal" data-target="#productModal"><i class="fa fa-bars"></i><span>Sign In / Sign Up</span></button> 
                    </div>
                    -->
                    <div class="col-md-12">
                       <div class="mobile-menu  hidden-lg hidden-md">
                            <nav>
                                <ul>
                                    @guest
                                        <li><a href="{{ URL::route('login') }}">View Dashboard</a></li>
                                        <li><a href="#signup">Sign Up</a></li>
                                    @else
                                        <li><a  href="{{ route('client.dashboard') }}">View Dashboard</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Sign Out
                                            </a>
                                        </li>
                                    @endguest
                                </ul>
                            </nav>
                        </div>
                    </div> 
                </div>
            </div>
		</header>
		<!-- Header Area End -->
		
		@yield('content')
        
		<!-- All js here -->
        <script src="js/vendor/jquery-1.12.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.nav.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/ajax-mail.js"></script>
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/counterup.js"></script>
        <script src="js/jquery.meanmenu.js"></script>
        <script src="js/plugins.js"></script>
        <!-- google map api -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_qDiT4MyM7IxaGPbQyLnMjVUsJck02N0"></script>
        <script src="js/map.js"></script>
        <script src="js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
        <script>
            particlesJS("particles-js", {"particles":{"number":{"value":80,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":3,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
            var moveForce = 30; // max popup movement in pixels
            var rotateForce = 13; // max popup rotation in deg
            
            // $(document).mousemove(function(e) {
            //     var docX = $(window).width();
            //     var docY = $(window).height();
                
            //     if (e.pageY > docY) e.pageY = docY;
                
            //     var moveX = -(e.pageX - docX/2) / (docX/2) * -moveForce;
            //     var moveY = -(e.pageY - docY/2) / (docY/2) * -moveForce;
                
            //     var rotateY = (e.pageX / docX * rotateForce*2) - rotateForce;
            //     var rotateX = -((e.pageY / docY * rotateForce*2) - rotateForce);
                
            //     $('#hero-cta')
            //         .css('position', 'relative')
            //         .css('left', moveX+'px')
            //         .css('top', moveY+'px')
            //         .css('transform', 'rotateX('+rotateX+'deg) rotateY('+rotateY+'deg)');
            // });
        </script>
        <script>
            var APP_ID = "h8o9qz7b"
            
            var intDate = function(dateStr) {
                return new Date(dateStr).getTime();
            };
            @if(Auth::check())
                window.intercomSettings = {
                    app_id: APP_ID,
                    name: '{{Auth::user()->name}}', // Full name
                    email: '{{Auth::user()->email}}', // Email address
                    user_id: '{{Auth::user()->id}}' // current_user_id
                };
            @else
                window.intercomSettings = {
                    app_id: APP_ID
                };    
            @endif
            (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/h8o9qz7b';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
        </script>

    </body>
</html>