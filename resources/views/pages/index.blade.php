<?php
if (!preg_match("/voyyp/", $_SERVER['HTTP_HOST'])) {
    header("Location: /login");
    die();
}
?>
@extends('layouts.app')
@section('content')
    <style >
        a{
            color: #f00;
        }
        a:hover{
            text-decoration: none;
        }
    </style>
		<!-- Banner Area Start -->
		<div id="particles-js" style="height: 80%" class="bg-green">
		<div id="banner" class="banner-area bg-1 fix particle-network-animation" style="z-index: 2">
		    <div class="row">
		    	<div class="col-md-offset-2 col-md-8">
                    <div class="text-content-wrapper" style="margin: 0 auto; perspective: 970px">
                        <div id="hero-cta" class="text-content text-center">
                            <h1 class="title1">Engage Your Customers, Existing and Potential</h1>
                            <h3 style="color: #fff; margin-bottom: 40px;">Use our contact center to launch powerful<br>outbound call campaigns and easily handle inbound.</h3>
                            <div class="banner-button">
                                <span style="
								    font-size: 18px;
								    text-transform: uppercase;
								    color: #fff;
								    font-weight: bold;
								    font-family: 'Poppins';
								">CALL (833) DIAL-MORE<span style="margin: 0 10px; display: inline-block">OR</span></span>
								<a class="default-btn button signup-btn" href="#signup">Sign Up Now</a>	                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		</div>
		<!-- Banner Area End -->
		<!-- feature Area Start -->
		<div id="feature" class="service-area">
		    <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="single-service-container">
                            <div class="single-service-item">
                                <div class="service-icon">
                                    <div class="service-icon-cell">
                                        <img src="img/icon/voip.png" alt="">
                                    </div>
                                </div>
                                <div class="service-text">
                                    <span>$.0069/min (6/6)</span>
                                    <span>VOIP Termination</span>
                                </div>
                            </div>
                            <div class="single-service-item">
                                <div class="service-icon">
                                    <div class="service-icon-cell">
                                        <img src="img/icon/pbx.png" alt="">
                                    </div>
                                </div>
                                <div class="service-text">
                                    <span>Elastic</span>
                                    <span>SIP Trunks</span>
                                </div>
                            </div>
                            <div class="single-service-item">
                                <div class="service-icon">
                                    <div class="service-icon-cell">
                                        <img src="img/icon/sip.png" alt="">
                                    </div>
                                </div>
                                <div class="service-text">
                                    <span>Built-in</span>
                                    <span>Load Balancing</span>
                                </div>
                            </div>
                            <div class="single-service-item">
                                <div class="service-icon">
                                    <div class="service-icon-cell">
                                        <img src="img/icon/clock.png" alt="">
                                    </div>
                                </div>
                                <div class="service-text">
                                    <span>99.95%</span>
                                    <span>Up-time</span>
                                </div>
                            </div>
                            <div class="single-service-item">
                                <div class="service-icon">
                                    <div class="service-icon-cell">
                                        <img src="img/icon/resi.png" alt="">
                                    </div>
                                </div>
                                <div class="service-text">
                                    <span>Modern</span>
                                    <span>Dashboard</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <style>.service-item { width: 100%; } .service-area { background: #141414; }</style>
                <div class="service-section" style="padding-bottom: 60px">
                    <div class="row">
                        <div class="col-12"><div class="service-container" style="padding-left:0"><h2>Why Choose Us</h2></div></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="service-item">
                                <h3>Premium Routes</h3>
                                <p>Our network is comprised of Tier 1 providers and premium routes to support high-capacity VoIP traffic.</p>
                            </div>
                            <div class="service-item">
                                <h3>US-48 Termination at $0.0069/min</h3>
                                <p>If you dial more than 5,000 minutes per day, we're happy to accommodate you at $0.0069 per minute billed in 6-second increments. Yes, really.</p>
                            </div>
                            <div class="service-item">
                                <h3>Unlimited and Instant Ports</h3>
                                <p>Whether you need to make 10 calls at a time or 1,000 &mdash; our elastic SIP trunks have got you covered.  Dial as your business demands it.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="service-item">
                                <h3>Free Setup, Zero Contracts and Caps</h3>
                                <p>We're confident you'll love our service, so we don't need to tie you down with paperwork. &amp; We don't believe in limits, so you're free to dial more.</p>
                            </div>
                            <div class="service-item">
                                <h3>Clean and Comprehensive Reporting</h3>
                                <p>We love being fully transparent, and one way we accomplish this is with an easy to read and near real-time dashboard.</p>
                            </div>
                            <div class="service-item">
                                <h3>Carrier-grade Infastructure</h3>
                                <p>Our world-class team has created industry-leading diagnostic and automation processes on top of our fully-redundant architecture.</p>
                            </div>
                        </div>
                    </div>
                </div>
		    </div>
		</div>
		<!-- feature Area End -->
		
		<div style="
			background: #e8e8e8;
		    text-align: center;
		    color: #fff;
		    font-size: 50px;
		    padding-top: 80px;
		">
		      <style>
		      #preview {
                transition: 1s;
                margin: 5px;
                border-radius: 10px;
                overflow: hidden;
                margin-top: 30px;
                margin-bottom: 70px;
                opacity: .3;
                max-width: 100%;
		      }
		      #preview:hover { opacity: 1; }
		      @media screen and (max-width: 600px) { #preview-wrapper { display: none; } }
		      
		      </style>
		    <div id="preview-wrapper">  <center><h2>Dashboard Preview</h2></center>
		    <img id="preview" src="https://i.imgur.com/N0fdoF2.png">
            </div>
        </div>
		<hr />
		<div id="signup" style="
			background: #e8e8e8;
		    text-align: center;
		    color: #fff;
		    font-size: 50px;
		">
		    <h2 style="
    margin-bottom: -151px;
    z-index: 99;
    position: relative;
">Sign Up Now</h2>
            <div style="padding: 80px 0"  class="pipedriveWebForms" data-pd-webforms="https://pipedrivewebforms.com/form/9982a74808b9cb02b8f502e987153ed72618332"><script src="https://cdn.pipedriveassets.com/web-form-assets/webforms.min.js"></script></div>
        </div>

        <!-- Testimonial Area Start -->
        <div class="testimonial-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 text-center">
                        <h2>The Experts Agree: You'll Love Voyyp</h2>
                        <div class="testimonial-wrapper">
                            <div class="single-testimonial">
                                <h4>Travis D.</h4>
                                <h5>Nationwide Telecom Campaign Manager</h5>
                                <p><span>Our press-1 campaign has a low conversion rate (i.e. we have to make a lot of calls). <br>Without these low dialing costs, we would not be in business.</span></p>
                            </div>
                            <div class="single-testimonial">
                                <h4>Tarmo J.</h4>
                                <h5>CTO</h5>
                                <p><span>Since we started using Voyyp, we know that whenever something isn't working that it's on our end. Seriously, they're awesome.</span></p>
                            </div>
                            <div class="single-testimonial">
                                <h4>Phillip B.</h4>
                                <h5>Call Center Operations Officer</h5>
                                <p><span>The customer support at Voyyp is so patient. They've gone above and beyond to make sure we're performing at our best.</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial Area End -->

        <!-- Footer Area Start -->
        <div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="footer-text">
                            <span class="block" style="margin-bottom: 10px;">Copyright &copy; 2018 Voyyp, LLC. - All rights reserved.</span>
                            <a class="mt-10" href="{{url('terms')}}" style="margin-top: 10px">Terms and Policy.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Area End -->
        <!-- Login Register Start -->
        <div id="quickview-login">
            <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="header-tab-menu">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">login</a></li>
                                    <li role="presentation"><a href="#register" aria-controls="register" role="tab" data-toggle="tab">Sign Up</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="login"> 
                                    <div class="login-form-container">
                                        <span>Please login using account detail bellow.</span>
                                        <form action="#" method="post">
                                            <input type="text" name="user-name" placeholder="Username">
                                            <input type="password" name="user-password" placeholder="Password">
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <input type="checkbox" id="remember">
                                                    <label for="remember">Remember me</label>
                                                    <a href="#">Forgot Password?</a>
                                                </div>
                                                <button type="submit" class="default-btn floatright">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="register"> 
                                    <div class="register-form">
                                        <span>Please sign up using account detail bellow.</span>
                                        <form action="#" method="post">
                                            <input type="text" name="user-name" placeholder="Username">
                                            <input type="password" name="user-password" placeholder="Password">
                                            <input type="email" name="user-email" placeholder="Email">
                                            <div class="button-box">
                                                <button type="submit" class="default-btn floatright">Register</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>    
						</div>	
					</div>	
				</div>
			</div>
        </div>
        <!-- Login Register End -->

@endsection