<!DOCTYPE html>
<html class="no-js" lang="pt">
<head>
    <!-- Basic Page Needs ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo strip_tags($site->nome) ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <!-- CSS ================================================== -->
    <link href="{{asset('template_site/template-padrao/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('template_site/template-padrao/plugins/mediaelement/mediaelementplayer.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('template_site/template-padrao/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('template_site/template-padrao/plugins/prettyphoto/css/prettyPhoto.css')}}" rel="stylesheet" type="text/css">
    <!-- Color Style -->
    <link href="{{asset('template_site/template-padrao/colors/color1.css')}}" rel="stylesheet" type="text/css"> 
    <link href="{{asset('template_site/template-padrao/css/custom.css')}}" rel="stylesheet" type="text/css">
    <!-- SCRIPTS ================================================== -->
    <!-- Modernizr -->
    <script src="{{asset('template_site/template-padrao/js/modernizr.js')}}"></script>
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{asset('template_site/template-padrao/css/extralayers.css')}}" media="screen" />	
    <link rel="stylesheet" type="text/css" href="{{asset('template_site/template-padrao/plugins/rs-plugin/css/settings.css')}}" media="screen" />

    <?php if($site->custom_style != null){ ?>
        <style><?php echo $site->custom_style ?></style>
    <?php } ?>
    
</head>
<body>
    <div class="body"> 
        <!-- Start Site Header -->
        <header class="site-header">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-2">
                    <h1 class="logo"> <a href="{{route('site.index', ['url' => $site->url])}}"><img style="witdh: 100px; height: 50px;" src="{{(($site->logo != null) ? 'data:image;base64,'.base64_encode($site->logo) : '/storage/no-logo.jpg' )}}" alt="Logo"></a> </h1>
                    </div>
                    <div class="col-md-10 col-sm-8 col-xs-8">
                        <ul class="top-navigation pull-right">
                            <h5><?php echo htmlentities($site->nome); ?></h5>
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
                            ?><li><a href="{{verifica_link($menu->link, $site)}}"><?php echo htmlentities($menu->nome); ?></a><?php
                                if($submenus != null && array_key_exists($menu->id, $submenus) && count($submenus[$menu->id]) > 0){ ?>
                                    <ul class="dropdown">
                                        <?php foreach($submenus[$menu->id] as $submenu){
                                            ?><li><a href="{{verifica_link($submenu->link, $site)}}"><?php echo htmlentities($submenu->nome); ?></a><?php
                                            if($subsubmenus != null && array_key_exists($submenu->id, $subsubmenus) && count($subsubmenus[$submenu->id]) > 0){ ?>
                                                <ul class="dropdown">
                                                    <?php foreach($subsubmenus[$submenu->id] as $subsubmenu){
                                                        ?> <li><a href="{{verifica_link($subsubmenu->link, $site)}}"><?php echo htmlentities($subsubmenu->nome); ?></a></li> <?php
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
                <p><?php echo strip_tags(htmlentities($site->nome)) ?></p>
                </div>
                <div class="copyrights-col-right col-md-6 col-sm-6">
                <div class="social-icons"> 
                    <?php if($site->facebook != null){ ?>
                        <a href="{{$site->facebook}}" target="_blank">
                            <i class="fa fa-facebook"></i></a> 
                    <?php } ?>
                    <?php if($site->twitter != null){ ?>
                        <a href="{{$site->twitter}}" target="_blank">
                            <i class="fa fa-twitter"></i></a> 
                    <?php } ?>
                    <?php if($site->youtube != null){ ?>
                        <a href="{{$site->youtube}}" target="_blank">
                            <i class="fa fa-youtube"></i></a>
                    <?php } ?>
                </div>
                </div>
            </div>
            </div>
        </footer>
        <!-- End Footer -->
        <a id="back-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>
    
    <!-- Jquery Library Call -->
    <script src="{{asset('template_site/template-padrao/js/jquery.js')}}"></script> 
    <!-- PrettyPhoto Plugin --> 
    <script src="{{asset('template_site/template-padrao/plugins/prettyphoto/js/prettyphoto.js')}}"></script> 
    <!-- Plugins -->
    <script src="{{asset('template_site/template-padrao/js/helper-plugins.js')}}"></script> 
    <!-- UI -->
    <script src="{{asset('template_site/template-padrao/js/bootstrap.js')}}"></script> 
    <!-- Waypoints -->
    <script src="{{asset('template_site/template-padrao/js/waypoints.js')}}"></script> 
    <!-- MediaElements -->
    <script src="{{asset('template_site/template-padrao/plugins/mediaelement/mediaelement-and-player.min.js')}}"></script> 
    <!-- All Scripts -->
    <script src="{{asset('template_site/template-padrao/js/init.js')}}"></script>  
    <!-- Jquery Timer -->
    <script src="{{asset('template_site/template-padrao/plugins/countdown/js/jquery.countdown.min.js')}}"></script> 
    <!-- Bootstrap Validator -->
    <script src="{{asset('template_adm/plugins/bootstrap-validator/validator.js')}}"></script>
    @stack('script')
</body>
</html>