<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/layouts/template1.blade.php */ ?>
<!DOCTYPE html>
<html class="no-js" lang="pt">
<head>
    <!-- Basic Page Needs ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo e($site->nome); ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <!-- CSS ================================================== -->
    <link href="<?php echo e(asset('template_site/template-padrao/css/bootstrap.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('template_site/template-padrao/plugins/mediaelement/mediaelementplayer.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('template_site/template-padrao/css/style.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('template_site/template-padrao/plugins/prettyphoto/css/prettyPhoto.css')); ?>" rel="stylesheet" type="text/css">
    <!-- Color Style -->
    <link href="<?php echo e(asset('template_site/template-padrao/colors/color1.css')); ?>" rel="stylesheet" type="text/css"> 
    <link href="<?php echo e(asset('template_site/template-padrao/css/custom.css')); ?>" rel="stylesheet" type="text/css">
    <!-- SCRIPTS ================================================== -->
    <!-- Modernizr -->
    <script src="<?php echo e(asset('template_site/template-padrao/js/modernizr.js')); ?>"></script>
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('template_site/template-padrao/css/extralayers.css')); ?>" media="screen" />	
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('template_site/template-padrao/plugins/rs-plugin/css/settings.css')); ?>" media="screen" />
</head>
<body>
    <div class="body"> 
        <!-- Start Site Header -->
        <header class="site-header">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-2">
                    <h1 class="logo"> <a href="/<?php echo e($site->url); ?>/"><img style="witdh: 100px; height: 50px;" src="<?php echo e(asset('/storage/'.(($site->logo != null) ? 'sites/'.$site->logo : 'no-logo.jpg' ))); ?>" alt="Logo"></a> </h1>
                    </div>
                    <div class="col-md-10 col-sm-8 col-xs-8">
                        <ul class="top-navigation pull-right">
                            <h5><?php echo e($site->nome); ?></h5>
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
                            ?><li><a href="<?php echo e(verifica_link($menu->link, $site)); ?>"><?php echo e($menu->nome); ?></a><?php
                                if($submenus != null && array_key_exists($menu->id, $submenus) && count($submenus[$menu->id]) > 0){ ?>
                                    <ul class="dropdown">
                                        <?php foreach($submenus[$menu->id] as $submenu){
                                            ?><li><a href="<?php echo e(verifica_link($submenu->link, $site)); ?>"><?php echo e($submenu->nome); ?></a><?php
                                            if($subsubmenus != null && array_key_exists($submenu->id, $subsubmenus) && count($subsubmenus[$submenu->id]) > 0){ ?>
                                                <ul class="dropdown">
                                                    <?php foreach($subsubmenus[$submenu->id] as $subsubmenu){
                                                        ?> <li><a href="<?php echo e(verifica_link($subsubmenu->link, $site)); ?>"><?php echo e($subsubmenu->nome); ?></a></li> <?php
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
        <?php echo $__env->yieldContent('content'); ?>
        <footer class="site-footer-bottom">
            <div class="container">
            <div class="row">
                <div class="copyrights-col-left col-md-6 col-sm-6">
                <p><?php echo e($site->nome); ?> - <b> powered by hotsystems</b></p>
                </div>
                <div class="copyrights-col-right col-md-6 col-sm-6">
                <div class="social-icons"> 
                    <?php if($site->facebook != null){ ?>
                        <a href="<?php echo e($site->facebook); ?>" target="_blank">
                            <i class="fa fa-facebook"></i></a> 
                    <?php } ?>
                    <?php if($site->twitter != null){ ?>
                        <a href="<?php echo e($site->twitter); ?>" target="_blank">
                            <i class="fa fa-twitter"></i></a> 
                    <?php } ?>
                    <!--<a href="http://www.pinterest.com/" target="_blank">
                        <i class="fa fa-pinterest"></i></a>-->
                    <!--<a href="https://plus.google.com/" target="_blank">
                        <i class="fa fa-google-plus"></i></a>-->
                    <?php if($site->youtube != null){ ?>
                        <a href="<?php echo e($site->youtube); ?>" target="_blank">
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
    <script src="<?php echo e(asset('template_site/template-padrao/js/jquery-2.0.0.min.js')); ?>"></script> 
    <!-- PrettyPhoto Plugin --> 
    <script src="<?php echo e(asset('template_site/template-padrao/plugins/prettyphoto/js/prettyphoto.js')); ?>"></script> 
    <!-- Plugins -->
    <script src="<?php echo e(asset('template_site/template-padrao/js/helper-plugins.js')); ?>"></script> 
    <!-- UI -->
    <script src="<?php echo e(asset('template_site/template-padrao/js/bootstrap.js')); ?>"></script> 
    <!-- Waypoints -->
    <script src="<?php echo e(asset('template_site/template-padrao/js/waypoints.js')); ?>"></script> 
    <!-- MediaElements -->
    <script src="<?php echo e(asset('template_site/template-padrao/plugins/mediaelement/mediaelement-and-player.min.js')); ?>"></script> 
    <!-- All Scripts -->
    <script src="<?php echo e(asset('template_site/template-padrao/js/init.js')); ?>"></script>  
    <!-- Jquery Timer -->
    <script src="<?php echo e(asset('template_site/template-padrao/plugins/countdown/js/jquery.countdown.min.js')); ?>"></script> 
    <!-- Bootstrap Validator -->
    <script src="<?php echo e(asset('template_adm/plugins/bootstrap-validator/validator.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('script'); ?>
</body>
</html>