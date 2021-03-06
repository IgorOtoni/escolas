<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/layouts/template3.blade.php */ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title><?php echo e($site->nome); ?></title>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('template_site/template-escuro/img/core-img/favicon.ico')); ?>">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('template_site/template-escuro/style.css')); ?>">
</head>

<body>

    <!-- ##### Preloader ##### -->
    <div id="preloader">
        <div class="circle">
            <img src="<?php echo e(asset('template_site/template-escuro/img/core-img/holy-star.png')); ?>" alt="">
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Navbar Area -->
        <div class="faith-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="faithNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="/<?php echo e($site->url); ?>"><img style="witdh: 120px; height: 50px;" src="<?php echo e(asset('/storage/'.(($site->logo != null) ? 'sites/'.$site->logo : 'no-logo.jpg' ))); ?>" alt=""></a><h3><?php echo e($site->nome); ?></h3></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
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
                                                                    ?> <li><a href="/<?php echo e(verifica_link($subsubmenu->link, $site)); ?>"><?php echo e($subsubmenu->nome); ?></a></li> <?php
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

                                <!-- Donate Button -->
                                <?php /* ?>
                                <div class="donate-btn">
                                <a href="/{{$site->url}}/login">Login</a>
                                </div>
                                <?php */ ?>

                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <?php echo $__env->yieldContent('content'); ?>

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <!-- Main Footer Area -->
        <div class="main-footer-area section-padding-100-0 bg-img foo-bg-overlay" style="background-image: url(template_site/template-escuro/img/bg-img/bg-9.jpg);">
            <div class="container">
                <div class="row">
                    <!-- Footer Widget Area -->
                    <div class="col-6 col-sm-6 col-xl-6">
                        <p><?php echo e($site->nome); ?> - <b> powered by hotsystems</b></p>
                    </div>

                    <div class="col-6 col-sm-6 col-xl-6">
                        <?php if($site->facebook != null){ ?>
                            <a href="<?php echo e($site->facebook); ?>"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                        <?php } ?>
                        &NonBreakingSpace;
                        <?php if($site->twitter != null){ ?>
                            <a href="<?php echo e($site->twitter); ?>"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
                        <?php } ?>
                        &NonBreakingSpace;
                        <?php if($site->youtube != null){ ?>
                            <a href="<?php echo e($site->youtube); ?>"><i class="fa fa-youtube" aria-hidden="true"></i> YouTube</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script data-cfasync="false" src="<?php echo e(asset('template_site/template-escuro/js/plugins/email-decode.min.js')); ?>"></script><script src="<?php echo e(asset('template_site/template-escuro/js/jquery/jquery-2.2.4.min.js')); ?>"></script>
    <!-- Popper js -->
    <script src="<?php echo e(asset('template_site/template-escuro/js/bootstrap/popper.min.js')); ?>"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo e(asset('template_site/template-escuro/js/bootstrap/bootstrap.min.js')); ?>"></script>
    <!-- All Plugins js -->
    <script src="<?php echo e(asset('template_site/template-escuro/js/plugins/plugins.js')); ?>"></script>
    <script src="<?php echo e(asset('template_site/template-escuro/js/plugins/audioplayer.js')); ?>"></script>
    <!-- Active js -->
    <script src="<?php echo e(asset('template_site/template-escuro/js/active.js')); ?>"></script>
    <!-- Rocket Loader -->
    <script src="<?php echo e(asset('template_site/template-escuro/js/plugins/rocket-loader.min.js')); ?>" data-cf-settings="dd394fb7c37d66307a7e0305-|49" defer=""></script></body>
    <!-- Bootstrap Validator -->
    <script src="<?php echo e(asset('template_adm/plugins/bootstrap-validator/validator.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('script'); ?>
</html>