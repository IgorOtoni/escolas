<!DOCTYPE html>
<html class="no-js" lang="pt">
<head>
    <!-- Basic Page Needs ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{$igreja->nome}}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <!-- CSS ================================================== -->
    <link href="{{asset('template_igreja/template-padrao/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('template_igreja/template-padrao/plugins/mediaelement/mediaelementplayer.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('template_igreja/template-padrao/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('template_igreja/template-padrao/plugins/prettyphoto/css/prettyPhoto.css')}}" rel="stylesheet" type="text/css">
    <!-- Color Style -->
    <link href="{{asset('template_igreja/template-padrao/colors/color1.css')}}" rel="stylesheet" type="text/css"> 
    <link href="{{asset('template_igreja/template-padrao/css/custom.css')}}" rel="stylesheet" type="text/css">
    <!-- SCRIPTS ================================================== -->
    <!-- Modernizr -->
    <script src="{{asset('template_igreja/template-padrao/js/modernizr.js')}}"></script>
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{asset('template_igreja/template-padrao/css/extralayers.css')}}" media="screen" />	
    <link rel="stylesheet" type="text/css" href="{{asset('template_igreja/template-padrao/plugins/rs-plugin/css/settings.css')}}" media="screen" />
</head>
<body>
    <div class="body"> 
        <!-- Start Site Header -->
        <header class="site-header">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-2">
                    <h1 class="logo"> <a href="/{{$igreja->url}}/"><img style="witdh: 100px; height: 50px;" src="{{asset('/storage/'.(($igreja->logo != null) ? 'igrejas/'.$igreja->logo : 'no-logo.jpg' ))}}" alt="Logo"></a> </h1>
                    </div>
                    <div class="col-md-10 col-sm-8 col-xs-8">
                        <ul class="top-navigation pull-right">
                            <h5>{{$igreja->nome}}</h5>
                        </ul>
                    </div>
                    <div class="col-sm-2 col-xs-2">
                        <a href="#" class="visible-sm visible-xs menu-toggle"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-menu-wrapper">
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                <nav class="navigation">
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
                                                        ?> <li><a href="{{verifica_link($subsubmenu->link, $igreja)}}">{{$subsubmenu->nome}}</a></li> <?php
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
                </div>
            </div>
            </div>
        </div>
        </header>
        @yield('content')
        <footer class="site-footer-bottom">
            <div class="container">
            <div class="row">
                <div class="copyrights-col-left col-md-6 col-sm-6">
                <p>{{$igreja->nome}} - <b> powered by hotsystems</b></p>
                </div>
                <div class="copyrights-col-right col-md-6 col-sm-6">
                <div class="social-icons"> 
                    <?php if($igreja->facebook != null){ ?>
                        <a href="{{$igreja->facebook}}" target="_blank">
                            <i class="fa fa-facebook"></i></a> 
                    <?php } ?>
                    <?php if($igreja->twitter != null){ ?>
                        <a href="{{$igreja->twitter}}" target="_blank">
                            <i class="fa fa-twitter"></i></a> 
                    <?php } ?>
                    <!--<a href="http://www.pinterest.com/" target="_blank">
                        <i class="fa fa-pinterest"></i></a>-->
                    <!--<a href="https://plus.google.com/" target="_blank">
                        <i class="fa fa-google-plus"></i></a>-->
                    <?php if($igreja->youtube != null){ ?>
                        <a href="{{$igreja->youtube}}" target="_blank">
                            <i class="fa fa-youtube"></i></a>
                    <?php } ?>
                    <!--<a href="#">
                        <i class="fa fa-rss"></i></a>--> 
                </div>
                </div>
            </div>
            </div>
        </footer>
        <!-- End Footer -->
        <a id="back-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>
    
    <!-- Jquery Library Call -->
    <script src="{{asset('template_igreja/template-padrao/js/jquery-2.0.0.min.js')}}"></script> 
    <!-- PrettyPhoto Plugin --> 
    <script src="{{asset('template_igreja/template-padrao/plugins/prettyphoto/js/prettyphoto.js')}}"></script> 
    <!-- Plugins -->
    <script src="{{asset('template_igreja/template-padrao/js/helper-plugins.js')}}"></script> 
    <!-- UI -->
    <script src="{{asset('template_igreja/template-padrao/js/bootstrap.js')}}"></script> 
    <!-- Waypoints -->
    <script src="{{asset('template_igreja/template-padrao/js/waypoints.js')}}"></script> 
    <!-- MediaElements -->
    <script src="{{asset('template_igreja/template-padrao/plugins/mediaelement/mediaelement-and-player.min.js')}}"></script> 
    <!-- All Scripts -->
    <script src="{{asset('template_igreja/template-padrao/js/init.js')}}"></script>  
    <!-- Jquery Timer -->
    <script src="{{asset('template_igreja/template-padrao/plugins/countdown/js/jquery.countdown.min.js')}}"></script> 
    <!-- Bootstrap Validator -->
    <script src="{{asset('template_adm/plugins/bootstrap-validator/validator.js')}}"></script>
    @stack('script')
</body>
</html>