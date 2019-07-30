<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>{{ $igreja->nome }}</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicons -->
	<link rel="shortcut icon" href="{{asset('/template_igreja/template-padrao-2/images/favicon.ico')}}">
	<link rel="apple-touch-icon" href="{{asset('/template_igreja/template-padrao-2/images/icon.png')}}">
	<!-- Google font (font-family: 'Dosis', Roboto;) -->
	<link href="https://fonts.googleapis.com/css?family=Dosis:400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
	 

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{asset('/template_igreja/template-padrao-2/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('/template_igreja/template-padrao-2/css/plugins.css')}}">
	<link rel="stylesheet" href="{{asset('/template_igreja/template-padrao-2/style.css')}}">

	<!-- Cusom css -->
   <link rel="stylesheet" href="{{asset('/template_igreja/template-padrao-2/css/custom.css')}}">

	<!-- Modernizer js -->
	<script src="{{asset('/template_igreja/template-padrao-2/js/vendor/modernizr-3.5.0.min.js')}}"></script>
</head>
<body>
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<!-- Add your site or application content here -->
	
	<!-- <div class="fakeloader"></div> -->

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- Header -->
		<header id="header" class="jnr__header header--one clearfix">
			<!-- Start Mainmenu Area -->
			<div class="mainmenu__wrapper bg__cat--1 poss-relative header_top_line sticky__header">
				<div class="container">
					<div class="row d-none d-lg-flex">
						<div class="col-sm-4 col-md-6 col-lg-2 order-1 order-lg-1">
							<div class="logo">
								<a href="index.html">
									<img src="{{asset('/storage/igrejas/'.$igreja->logo)}}" alt="logo images" width="135px">
								</a>
							</div>
						</div>
						<div class="col-sm-4 col-md-2 col-lg-9 order-3 order-lg-2">
							<div class="mainmenu__wrap">
								<nav class="mainmenu__nav">
                                    <ul class="mainmenu">
					                    <?php
					                    foreach($menus as $menu){
					                        ?><li class="drop"><a href="{{verifica_link($menu->link, $igreja)}}">{{$menu->nome}}</a><?php
					                            if($submenus != null && array_key_exists($menu->id, $submenus) && count($submenus[$menu->id]) > 0){ ?>
					                                <ul class="dropdown__menu">
					                                    <?php foreach($submenus[$menu->id] as $submenu){
					                                        ?><li class="drop"><a href="{{verifica_link($submenu->link, $igreja)}}">{{$submenu->nome}}</a><?php
					                                        if($subsubmenus != null && array_key_exists($submenu->id, $subsubmenus) && count($subsubmenus[$submenu->id]) > 0){ ?>
					                                            <ul class="dropdown__menu">
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
							</div>
						</div>
					</div>
					<!-- Mobile Menu -->
                    <div class="mobile-menu d-block d-lg-none">
                    	<div class="logo">
                    		<a href="index.html"><img src="{{asset('/template_igreja/template-padrao-2/images/logo/junior.png')}}" alt="logo"></a>
                    	</div>
                    	<a class="minicart-trigger" href="#">
                    		<i class="fa fa-shopping-basket"></i>
                    	</a>
                    </div>
                    <!-- Mobile Menu -->
				</div>
			</div>
			<!-- End Mainmenu Area -->
		</header>
		<!-- //Header -->

		@yield('content')

	</div><!-- //Main wrapper -->

	<!-- Footer Area -->
	<footer id="footer" class="footer-area footer--2">
		<!-- .End Footer Contact Area -->
		<div class="copyright  bg--theme">
			<div class="container">
				<div class="row align-items-center copyright__wrapper justify-content-center">
					<div class="col-lg-12 col-sm-12 col-md-12">
						<div class="coppy__right__inner text-center">
							<p><i class="fa fa-copyright"></i>{{$igreja->nome}} - <b> powered by hotsystems</b></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- //Footer Area -->

	<!-- JS Files -->
	<script src="{{asset('/template_igreja/template-padrao-2/js/vendor/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('/template_igreja/template-padrao-2/js/popper.min.js')}}"></script>
	<script src="{{asset('/template_igreja/template-padrao-2/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/template_igreja/template-padrao-2/js/plugins.js')}}"></script>
	<script src="{{asset('/template_igreja/template-padrao-2/js/active.js')}}"></script>

	@stack('script')
</body>
</html>
