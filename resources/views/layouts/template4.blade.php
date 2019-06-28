<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Title -->
    <title>{{$igreja->nome}}</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="../../favicon.ico"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Barlow:300,400,400i,500,700%7CAlegreya:400" rel="stylesheet">

	<link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/icon-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/icon-line-pro/style.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/icon-hs/style.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/icon-material/material-icons.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/animate.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/hs-megamenu/src/hs.megamenu.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/hamburgers/hamburgers.min.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/slick-carousel/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/fancybox/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/dzsparallaxer/dzsparallaxer.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/dzsparallaxer/dzsscroller/scroller.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/dzsparallaxer/advancedscroller/plugin.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/hs-bg-video/hs-bg-video.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/chosen/chosen.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/jquery-ui/themes/base/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/vendor/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/css/styles.multipage-education.css')}}">
    <link rel="stylesheet" href="{{asset('template_igreja/template-azul/assets/css/custom.css')}}">
	
  </head>

  <body>
    <main>
      <!-- Header -->
      <header id="js-header" class="u-header">
        <div class="u-header__section g-bg-main">

          <div class="container">
            <!-- Nav -->
            <nav class="js-mega-menu navbar navbar-expand-lg g-px-0 g-py-5 g-py-0--lg">
              <!-- Logo -->
              <a class="navbar-brand g-max-width-170 g-max-width-200--lg" href="home-page-1.html">
                <img width="70px" class="img-fluid g-hidden-lg-down" src="/storage/igrejas/{{$igreja->logo}}" alt="Logo">
                <img class="img-fluid g-width-80 g-hidden-md-down g-hidden-xl-up" src="assets/img/logo/logo-mini.png" alt="Logo">
                <img class="img-fluid g-hidden-lg-up" src="assets/img/logo/logo.png" alt="Logo">
              </a>
              <!-- End Logo -->

              <h3 class="g-color-white">{{$igreja->nome}}</h3>

              <!-- Responsive Toggle Button -->
              <button class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0" type="button"
                      aria-label="Toggle navigation"
                      aria-expanded="false"
                      aria-controls="navBar"
                      data-toggle="collapse"
                      data-target="#navBar">
                <span class="hamburger hamburger--slider g-px-0">
                  <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                  </span>
                </span>
              </button>
              <!-- End Responsive Toggle Button -->

              <!-- Navigation -->
              <div id="navBar" class="collapse navbar-collapse">
                <ul class="navbar-nav align-items-lg-center g-py-30 g-py-0--lg ml-auto">
                  
                    <?php
                    $x = 1;
                    $dropdowm_name = "menu-";
                    foreach($menus as $menu){
                        if($submenus != null && array_key_exists($menu->id, $submenus) && count($submenus[$menu->id]) > 0){ ?>
                            <li class="list-inline-item g-pos-rel ml-lg-auto"><a id="{{$dropdowm_name.$x."-invoker"}}" href="/{{$igreja->url}}/{{($menu->link != null) ? $menu->link != null : "#"}}" class="nav-link g-color-white-opacity-0_7 g-color-white--hover g-font-size-15 g-font-size-17--xl g-px-15--lg g-py-10 g-py-30--lg"
                                aria-controls="{{$dropdowm_name.$x}}"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-dropdown-event="hover"
                                data-dropdown-target="#{{$dropdowm_name.$x}}"
                                data-dropdown-type="css-animation"
                                data-dropdown-duration="100"
                                data-dropdown-hide-on-scroll="true"
                                data-dropdown-animation-in="fadeIn"
                                data-dropdown-animation-out="fadeOut">{{$menu->nome}}<i class="g-ml-3 fa fa-angle-down"></i></a>
                            
                                <ul id="{{$dropdowm_name.$x}}" class="list-unstyled u-shadow-v39 g-brd-around g-brd-4 g-brd-white g-bg-secondary g-pos-abs g-left-0 g-z-index-99 g-mt-5"
                                    aria-labelledby="{{$dropdowm_name.$x."-invoker"}}">
                                    <?php foreach($submenus[$menu->id] as $submenu){
                                        if($subsubmenus != null && array_key_exists($submenu->id, $subsubmenus) && count($subsubmenus[$submenu->id]) > 0){ ?>
                                            <li class="dropdown-item g-brd-bottom g-brd-2 g-brd-white g-px-0 g-py-2">
                                                <a href="/{{$igreja->url}}/{{($submenu->link != null) ? $submenu->link != null : "#"}}" class="nav-link g-color-white-opacity-0_7 g-color-white--hover g-font-size-15 g-font-size-17--xl g-px-15--lg g-py-10 g-py-30--lg">{{$submenu->nome}}</a></li>
                                        <?php }else if($submenu->link != null){
                                            ?> <li class="dropdown-item g-brd-bottom g-brd-2 g-brd-white g-px-0 g-py-2"><a href="/{{$igreja->url}}/{{$submenu->link}}" class="nav-link g-color-white-opacity-0_7 g-color-white--hover g-font-size-15 g-font-size-17--xl g-px-15--lg g-py-10 g-py-30--lg">{{$submenu->nome}}</a></li> <?php
                                        }else{
                                            ?> <li class="dropdown-item g-brd-bottom g-brd-2 g-brd-white g-px-0 g-py-2"><a href="/{{$igreja->url}}/#" class="nav-link g-color-white-opacity-0_7 g-color-white--hover g-font-size-15 g-font-size-17--xl g-px-15--lg g-py-10 g-py-30--lg">{{$submenu->nome}}</a></li> <?php
                                        }
                                    } ?>
                                </ul>
                            
                            </li>
                            <?php
                        }else if($menu->link != null){
                            ?> <li><a href="/{{$igreja->url}}/{{$menu->link}}">{{$menu->nome}}</a></li> <?php
                        }else{
                            ?> <li><a href="/{{$igreja->url}}/#">{{$menu->nome}}</a></li> <?php
                        }
                        $x++;
                    }
                    ?>

                    <?php
                    /*$x = 1;
                    foreach($menus as $menu){
                        if($submenus != null && array_key_exists($menu->id, $submenus) && count($submenus[$menu->id]) > 0){ ?>
                            
                        <?php }
                        $x++;
                    }*/
                    ?>

                    <?php /*foreach($subsubmenus[$submenu->id] as $subsubmenu){
                        if($subsubmenu->link != null){
                            ?> <li><a href="/{{$igreja->url}}/{{$subsubmenu->link}}" class="nav-link g-color-white-opacity-0_7 g-color-white--hover g-font-size-15 g-font-size-17--xl g-px-15--lg g-py-10 g-py-30--lg">{{$subsubmenu->nome}}</a></li> <?php
                        }else{
                            ?> <li><a href="/{{$igreja->url}}/#" class="nav-link g-color-white-opacity-0_7 g-color-white--hover g-font-size-15 g-font-size-17--xl g-px-15--lg g-py-10 g-py-30--lg">{{$subsubmenu->nome}}</a></li> <?php
                        }
                    } */?>
                </ul>
              </div>
              <!-- End Navigation -->
            </nav>
            <!-- End Nav -->
          </div>
        </div>
      </header>
      <!-- End Header -->

      @yield('content')

      <!-- Footer -->
      <footer class="g-bg-secondary g-pt-100 g-pb-50">
        <div class="container">
          <div class="row g-mb-40">

          <!-- Footer Copyright -->
          <div class="row justify-content-lg-center align-items-center text-center">
            <div class="col-sm-6 col-md-4 col-lg-3 order-md-3 g-mb-30">
              <a class="u-link-v5 g-color-text g-color-primary--hover" href="#">
                <i class="align-middle mr-2 icon-real-estate-027 u-line-icon-pro"></i>
                Kingston, Ontario, Canada
              </a>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3 order-md-2 g-mb-30">
              <!-- Social Icons -->
              <ul class="list-inline mb-0">
                <li class="list-inline-item g-mx-2">
                  <a class="u-icon-v1 u-icon-size--sm u-shadow-v32 g-color-primary g-color-white--hover g-bg-white g-bg-primary--hover rounded-circle" href="#">
                    <i class="g-font-size-default fa fa-twitter"></i>
                  </a>
                </li>
                <li class="list-inline-item g-mx-2">
                  <a class="u-icon-v1 u-icon-size--sm u-shadow-v32 g-color-primary g-color-white--hover g-bg-white g-bg-primary--hover rounded-circle" href="#">
                    <i class="g-font-size-default fa fa-facebook"></i>
                  </a>
                </li>
                <li class="list-inline-item g-mx-2">
                  <a class="u-icon-v1 u-icon-size--sm u-shadow-v32 g-color-primary g-color-white--hover g-bg-white g-bg-primary--hover rounded-circle" href="#">
                    <i class="g-font-size-default fa fa-instagram"></i>
                  </a>
                </li>
                <li class="list-inline-item g-mx-2">
                  <a class="u-icon-v1 u-icon-size--sm u-shadow-v32 g-color-primary g-color-white--hover g-bg-white g-bg-primary--hover rounded-circle" href="#">
                    <i class="g-font-size-default fa fa-youtube"></i>
                  </a>
                </li>
                <li class="list-inline-item g-mx-2">
                  <a class="u-icon-v1 u-icon-size--sm u-shadow-v32 g-color-primary g-color-white--hover g-bg-white g-bg-primary--hover rounded-circle" href="#">
                    <i class="g-font-size-default fa fa-linkedin"></i>
                  </a>
                </li>
              </ul>
              <!-- End Social Icons -->
            </div>

            <div class="col-md-4 col-lg-3 order-md-1 g-mb-30">
              <p class="g-color-text mb-0">University of Unify - Since 1978</p>
            </div>
          </div>
          <!-- End Footer Copyright -->
        </div>
      </footer>
      <!-- End Footer -->

      <!-- Go to Top -->
      <a class="js-go-to u-go-to-v1 u-shadow-v32 g-width-40 g-height-40 g-color-primary g-color-white--hover g-bg-white g-bg-main--hover g-bg-main--focus g-font-size-12 rounded-circle" href="#" data-type="fixed" data-position='{
       "bottom": 15,
       "right": 15
     }' data-offset-top="400"
        data-compensation="#js-header"
        data-show-effect="slideInUp"
        data-hide-effect="slideInDown">
        <i class="hs-icon hs-icon-arrow-top"></i>
      </a>
      <!-- End Go to Top -->
    </main>

    @stack('script')

    <script src="{{asset('template_igreja/template-azul/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/jquery-migrate/jquery-migrate.min.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/popper.js/popper.min.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/hs-megamenu/src/hs.megamenu.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/fancybox/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/slick-carousel/slick/slick.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/hs-bg-video/hs-bg-video.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/hs-bg-video/vendor/player.min.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/dzsparallaxer/dzsparallaxer.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/dzsparallaxer/dzsscroller/scroller.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/vendor/dzsparallaxer/advancedscroller/plugin.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/hs.core.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/helpers/hs.bg-video.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/helpers/hs.hamburgers.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/helpers/hs.height-calc.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/components/hs.header.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/components/hs.popup.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/components/hs.dropdown.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/components/hs.select.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/components/hs.scroll-nav.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/components/hs.sticky-block.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/components/hs.go-to.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/components/hs.carousel.js')}}"></script>
    <script src="{{asset('template_igreja/template-azul/assets/js/components/hs.datepicker.js')}}"></script>
	<script src="{{asset('template_igreja/template-azul/assets/js/custom.js')}}"></script>

    <!-- JS Plugins Init. -->
    <script>
      $(document).on('ready', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($('#js-header'));
        $.HSCore.helpers.HSHamburgers.init('.hamburger');

        // initialization of HSMegaMenu component
        $('.js-mega-menu').HSMegaMenu({
          event: 'hover',
          pageContainer: $('.container'),
          breakpoint: 991
        });

        // initialization of HSDropdown component
        $.HSCore.components.HSDropdown.init($('[data-dropdown-target]'), {
          afterOpen: function () {
            $(this).find('input[type="search"]').focus();
          }
        });

        // initialization of carousel
        $.HSCore.components.HSCarousel.init('[class*="js-carousel"]');

        // initialization of header's height equal offset
        $.HSCore.helpers.HSHeightCalc.init();

        // initialization of popups
        $.HSCore.components.HSPopup.init('.js-fancybox');

        // initialization of go to
        $.HSCore.components.HSGoTo.init('.js-go-to');
      });
    </script>
  </body>
</html>
