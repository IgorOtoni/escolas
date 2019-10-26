<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title><?php echo strip_tags(htmlentities($site->nome)) ?></title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{asset('template_site/template-escuro/style.css')}}">

    <?php if($site->custom_style != null){ ?>
        <style><?php echo $site->custom_style ?></style>
    <?php } ?>
    
</head>

<body>

    <!-- ##### Preloader ##### -->
    <div id="preloader">
        <div class="circle">
            <img src="{{asset('template_site/template-escuro/img/core-img/holy-star.png')}}" alt="">
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
                        <a class="nav-brand" href="{{route('site.index', ['url' => $site->url])}}"><img style="witdh: 120px; height: 50px;" src="{{($site->logo != null) ? 'data:image;base64,'.base64_encode($site->logo) : asset('/storage/no-logo.jpg')}}" alt=""></a><h3><?php echo htmlentities($site->nome); ?></h3></a>

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

                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    @yield('content')

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <!-- Main Footer Area -->
        <div class="main-footer-area section-padding-100-0 bg-img foo-bg-overlay" style="background-image: url({{asset('template_site/template-escuro/img/bg-img/bg-9.jpg')}});">
            <div class="container">
                <div class="row">
                    <!-- Footer Widget Area -->
                    <div class="col-6 col-sm-6 col-xl-6">
                        <p><?php echo strip_tags(htmlentities($site->nome)); ?></p>
                    </div>

                    <div class="col-6 col-sm-6 col-xl-6">
                        <?php if($site->facebook != null){ ?>
                            <a href="{{$site->facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                        <?php } ?>
                        &NonBreakingSpace;
                        <?php if($site->twitter != null){ ?>
                            <a href="{{$site->twitter}}"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
                        <?php } ?>
                        &NonBreakingSpace;
                        <?php if($site->youtube != null){ ?>
                            <a href="{{$site->youtube}}"><i class="fa fa-youtube" aria-hidden="true"></i> YouTube</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script data-cfasync="false" src="{{asset('template_site/template-escuro/js/plugins/email-decode.min.js')}}"></script><script src="{{asset('template_site/template-escuro/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('template_site/template-escuro/js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('template_site/template-escuro/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- All Plugins js -->
    <script src="{{asset('template_site/template-escuro/js/plugins/plugins.js')}}"></script>
    <script src="{{asset('template_site/template-escuro/js/plugins/audioplayer.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('template_site/template-escuro/js/active.js')}}"></script>
    <!-- Rocket Loader -->
    <script src="{{asset('template_site/template-escuro/js/plugins/rocket-loader.min.js')}}" data-cf-settings="dd394fb7c37d66307a7e0305-|49" defer=""></script></body>
    <!-- Bootstrap Validator -->
    <script src="{{asset('template_adm/plugins/bootstrap-validator/validator.js')}}"></script>

    @stack('script')
</html>