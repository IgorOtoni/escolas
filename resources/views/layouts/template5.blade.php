<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<title><?php echo strip_tags($site->nome) ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="A small sentence describing your website's subject" />
	<meta name="keywords" content="some, keywords, separated, by, comas" />
	<meta name="Robots" content="index, follow" />
    
    <!-- Favicon -->
	<link rel="icon" type="image/png" href="{{asset('template_site/template-laranja/favicon.png')}}" />
    
	<!-- Main CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('template_site/template-laranja/style.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('template_site/template-laranja/css/select_color.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('template_site/template-laranja/js/fancybox/jquery.fancybox-1.3.4.css')}}" />

    <?php if($site->custom_style != null){ ?>
        <style><?php echo $site->custom_style ?></style>
    <?php } ?>
    
    <!-- Skin CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('template_site/template-laranja/styles/Yellow-Orange/yellow-orange.css')}}" class="changeme" />
	
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="./css/ie7.css" /><![endif]-->
    <!--[if IE 8]><link rel="stylesheet" type="text/css" href="./css/ie8.css" /><![endif]-->	

    <!-- Scripts -->
    <script type="text/javascript" src="{{asset('template_site/template-laranja/js/jquery-1.6.2.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('template_site/template-laranja/js/jquery.easing.1.3.js')}}"></script>
	<script type="text/javascript" src="{{asset('template_site/template-laranja/js/jquery.cycle.all.js')}}"></script>
    <script type="text/javascript" src="{{asset('template_site/template-laranja/js/fancybox/jquery.fancybox-1.3.4.pack.js')}}"></script>
    <script type="text/javascript" src="{{asset('template_site/template-laranja/js/jquery.cookie.js')}}"></script>

    <!-- Main JS -->
    <script type="text/javascript" src="{{asset('template_site/template-laranja/js/main.js')}}"></script> 
    
    <!-- COLOR NAVIGATOR -->
	<script type="text/javascript">
		var $j = jQuery.noConflict();
		if($j.cookie("css")) {
			$j("link.changeme").attr("href",$j.cookie("css"));
		}
		$j(document).ready(function() { 
			$j("#nav li a").click(function() { 				
				$j("link.changeme").attr("href",$j(this).attr('rel'));
				$j.cookie("css",$j(this).attr('rel'), {expires: 365, path: '/'});
				return false;
			});
		});
        
        $j(document).ready(function () {
            url = window.location.href;
            $j('li a').each(function(index) {
              if(($j(this).attr('href') === url || url.indexOf($j(this).attr('href')) >= 0) && $j(this).attr('href') !== '/{{$site->url}}'){
                $j(this).parent().addClass('current-menu-item');
              }
            });
        });
    </script>

</head>
<body>
	
    <div id="header">
    <div class="wrap">
    	
        <a id="kids_logo_text" href="/{{$site->url}}" title="Happy Kids">
            <img style="witdh: 120px; height: 50px;" src="{{asset('/storage/'.(($site->logo != null) ? 'sites/'.$site->logo : 'no-logo.jpg' ))}}" alt="" />
            <h2 style="font-family: TOONISH,Georgia,'Times New Roman',Times,serif;
                text-transform: uppercase;
                color: #f55029;">
                {{$site->nome}}
            </h2>
        </a>
        
        <div id="main-navigation">
            <ul class="dd-menu">
                <?php
                foreach($menus as $menu){
                    ?><li><a href="{{verifica_link($menu->link, $site)}}"><?php echo $menu->nome ?></a><?php
                        if($submenus != null && array_key_exists($menu->id, $submenus) && count($submenus[$menu->id]) > 0){ ?>
                            <ul class="dropdown">
                                <?php foreach($submenus[$menu->id] as $submenu){
                                    ?><li><a href="{{verifica_link($submenu->link, $site)}}"><?php echo $submenu->nome ?></a><?php
                                    if($subsubmenus != null && array_key_exists($submenu->id, $subsubmenus) && count($subsubmenus[$submenu->id]) > 0){ ?>
                                        <ul class="dropdown">
                                            <?php foreach($subsubmenus[$submenu->id] as $subsubmenu){
                                                ?> <li><a href="{{verifica_link($subsubmenu->link, $site)}}"><?php echo $subsubmenu->nome ?></a></li> <?php
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
            </ul><!-- end dd-menu -->
                    
            </div><!-- end main-navigation -->
        
    </div><!-- end wrap -->
    </div><!-- end header -->

    @yield('content')

    <div class="l-page-width clearfix">
    <div id="footer">
    
        <div id="sub-footer" class="clearfix">
            
            <p id="copyright"><?php echo strip_tags($site->nome) ?> - <b> powered by hotsystems</b></p>
            <ul class="subfooter-menu">
                <?php if($site->twitter != null){ ?>
                    <li><a href="{{$site->twitter}}" title="Twitter">Twitter</a></li>
                <?php } ?>
                <?php if($site->facebook != null){ ?>
                    <li><a href="{{$site->facebook}}" title="Facebook">Facebook</a></li>
                <?php } ?>
                <?php if($site->youtube != null){ ?>
                    <li><a href="{{$site->youtube}}" title="Youtube">Youtube</a></li>
                <?php } ?>
            </ul>
                    
        </div>

    </div>
    </div>

    @stack('script')
    
</body>
</html>