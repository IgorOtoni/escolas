<!DOCTYPE HTML>
<html class="no-js">
<head>
<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Adore Church - Responsive HTML5 Template</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<!-- CSS
  ================================================== -->
<link href="{{asset('template_igreja/template-branco/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('template_igreja/template-branco/css/bootstrap-theme.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('template_igreja/template-branco/css/style.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('template_igreja/template-branco/vendor/prettyphoto/css/prettyPhoto.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('template_igreja/template-branco/vendor/mediaelement/mediaelementplayer.css')}}" rel="stylesheet" type="text/css">
<!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
<link href="{{asset('template_igreja/template-branco/css/custom.css')}}" rel="stylesheet" type="text/css"><!-- CUSTOM STYLESHEET FOR STYLING -->
<!-- Color Style -->
<link href="{{asset('template_igreja/template-branco/colors/color1.css')}}" rel="stylesheet" type="text/css">
<!-- SCRIPTS
  ================================================== -->
<script src="{{asset('template_igreja/template-branco/js/modernizr.js')}}"></script><!-- Modernizr -->
</head>
<body class="home">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<div class="body"> 
	<!-- Start Site Header -->
	<header class="site-header">
    	<div class="container for-navi">
        	<div class="site-logo">
            <h1>
                <a href="/{{$igreja->url}}">
                    <img style="witdh: 120px; height: 50px;" src="{{asset('/storage/'.(($igreja->logo != null) ? 'igrejas/'.$igreja->logo : 'no-logo.jpg' ))}}" alt="" />
                    <span class="logo-text"><span>{{$igreja->nome}}</span></span>
                    <span class="logo-tagline"></span>
                </a>
            </h1>
            </div>
            <!-- Main Navigation -->
            <nav class="main-navigation" role="navigation">
                <ul class="sf-menu">
                    <?php
                    foreach($menus as $menu){
                        ?><li><a href="{{verifica_link($menu->link, $igreja)}}">{{$menu->nome}}</a><?php
                            if($submenus != null && array_key_exists($menu->id, $submenus) && count($submenus[$menu->id]) > 0){ ?>
                                <ul class="dropdown">
                                    <?php foreach($submenus[$menu->id] as $submenu){
                                        ?><li><a href="{{verifica_link($submenu->link, $igreja)}}">{{$submenu->nome}}</a><?php
                                        if($subsubmenus != null && array_key_exists($submenu->id, $subsubmenus) && count($subsubmenus[$submenu->id]) > 0){ ?>
                                            <ul class="dropdown">
                                                <?php foreach($subsubmenus[$submenu->id] as $subsubmenu){
                                                    ?> <li><a href="/{{verifica_link($subsubmenu->link, $igreja)}}">{{$subsubmenu->nome}}</a></li> <?php
                                                } ?>
                                            </ul>
                                        <?php
                                        }
                                        ?></li><?php
                                    } ?>
                                </ul>
                                <?php
                            }
                        ?></li><?php
                    }
                    ?>
                </ul>
            </nav>       
            <a href="#" class="visible-sm visible-xs" id="menu-toggle"><i class="fa fa-bars"></i></a>
    	</div>
	</header>
    <!-- End Site Header -->
    @yield('banner')
    
    @yield('content')
    
    <!-- Start site footer -->
    <footer class="site-footer">
       	<div class="container">
    		<div class="site-footer-top">
        		<div class="site-footer-bottom">
            		<div class="row">
                		<div class="col-md-6 col-sm-6 copyrights-coll">
        					{{$igreja->nome}}
            			</div>
                		<div class="col-md-6 col-sm-6 copyrights-colr">
        					<nav class="footer-nav" role="navigation">
                        		<ul>
                                    <?php if($igreja->twitter != null){ ?>
                                        <li><a href="{{$igreja->twitter}}" title="Twitter">Twitter</a></li>
                                    <?php } ?>
                                    <?php if($igreja->facebook != null){ ?>
                                        <li><a href="{{$igreja->facebook}}" title="Facebook">Facebook</a></li>
                                    <?php } ?>
                                    <?php if($igreja->youtube != null){ ?>
                                        <li><a href="{{$igreja->youtube}}" title="Youtube">Youtube</a></li>
                                    <?php } ?>
                            	</ul>
                        	</nav>
            			</div>
                   	</div>
               	</div>
           	</div>
        </div>
    </footer>
    <!-- End site footer -->
  	<a id="back-to-top"><i class="fa fa-angle-double-up"></i></a>  
</div>
<!-- Event Directions Popup -->
<div class="quick-info-overlay">
	<div class="quick-info-overlay-left accent-bg">
        <a href="#" class="btn-close"><i class="icon-delete"></i></a>
    	<div class="event-info">
    		<h3 class="event-title"> </h3>
      		<div class="event-address"></div>
            <a href="" class="btn btn-default btn-transparent btn-permalink">Full details</a>
        </div>
    </div>
	<div class="quick-info-overlay-right">
      	<div id="event-directions"></div>
    </div>
</div>
<!-- Event Contact Modal Window -->
<div class="modal fade" id="Econtact" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="Econtact" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contact Event Manager <span class="accent-color"></span></h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="fname" class="form-control" placeholder="First name (Required)">
                </div>
                <div class="col-md-6">
                    <input type="text" name="lname" class="form-control" placeholder="Last name">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Your email (Required)">
                </div>
                <div class="col-md-6">
                    <input type="number" name="phone" class="form-control" placeholder="Your phone">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea rows="3" cols="5" class="form-control" placeholder="Additional notes"></textarea>
                </div>
            </div>
            <input type="submit" name="donate" class="btn btn-primary btn-lg btn-block" value="Contact Now">
        </form>
      </div>
      <div class="modal-footer">
        <p class="small short">If you would prefer to call in for inquiries, please call 1800.785.876</p>
      </div>
    </div>
  </div>
</div>
<!-- Event Register Tickets -->
<div class="ticket-booking-wrapper">
    <a href="#" class="ticket-booking-close label-danger"><i class="icon icon-delete"></i></a>
    <div class="ticket-booking">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3><strong>Book your</strong> <span>tickets</span></h3>
                </div>
                <div class="col-md-9">
                    <div class="event-ticket ticket-form">
                        <div class="event-ticket-left">
                            <div class="ticket-handle"></div>
                            <div class="ticket-cuts ticket-cuts-top"></div>
                            <div class="ticket-cuts ticket-cuts-bottom"></div>
                        </div>
                        <div class="event-ticket-right">
                            <div class="event-ticket-right-inner">
                                <div class="row">
                                    <div class="col-md-9 col-sm-9">
                                        <span class="meta-data">Your ticket for</span>
                                        <h4 id="dy-event-title"></h4>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <span class="meta-data">Tickets count</span>
                                        <select class="form-control input-sm">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="event-ticket-info">
                                    <div class="row">
                                        <div class="col">
                                            <p class="ticket-col" id="dy-event-date"></p>
                                        </div>
                                        <div class="col">
                                            <a href="#" class="btn btn-warning btn btn-block ticket-col">Book</a>
                                        </div>
                                        <div class="col">
                                            <p id="dy-event-time">Starts </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="event-location" id="dy-event-location"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   	</div>
</div>
<script src="{{asset('template_igreja/template-branco/js/jquery-2.0.0.min.js')}}"></script> <!-- Jquery Library Call -->
<script src="{{asset('template_igreja/template-branco/vendor/prettyphoto/js/prettyphoto.js')}}"></script> <!-- PrettyPhoto Plugin -->
<script src="{{asset('template_igreja/template-branco/js/helper-plugins.js')}}"></script> <!-- Helper Plugins -->
<script src="{{asset('template_igreja/template-branco/js/bootstrap.js')}}"></script> <!-- UI -->
<script src="{{asset('template_igreja/template-branco/js/init.js')}}"></script> <!-- All Scripts -->
<script src="{{asset('template_igreja/template-branco/js/home.js')}}"></script> 
<script src="{{asset('template_igreja/template-branco/vendor/flexslider/js/jquery.flexslider.js')}}"></script> <!-- FlexSlider -->
<script src="{{asset('template_igreja/template-branco/vendor/countdown/js/jquery.countdown.min.js')}}"></script> <!-- Jquery Timer -->
<script src="{{asset('template_igreja/template-branco/vendor/mediaelement/mediaelement-and-player.min.js')}}"></script> <!-- MediaElements --> 
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
</body>
</html>