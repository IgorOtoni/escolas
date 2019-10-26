@extends('layouts.template1')
@push('script')
<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="{{asset('template_site/template-padrao/plugins/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>

<script type="text/javascript" src="{{asset('template_site/template-padrao/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>

<script src="{{asset('template_site/template-padrao/plugins/flexslider/js/jquery.flexslider.js')}}"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.tp-banner').show().revolution(
        {
            dottedOverlay:"none",
            delay:6000,
            startwidth:1060,
            startheight:500,
            hideThumbs:200,
            
            thumbWidth:100,
            thumbHeight:50,
            thumbAmount:5,
            
            navigationType:"none",
            navigationArrows:"solo",
            navigationStyle:"preview2",
            
            touchenabled:"on",
            onHoverStop:"on",
            
            swipe_velocity: 0.7,
            swipe_min_touches: 1,
            swipe_max_touches: 1,
            drag_block_vertical: false,
                                    
                                    
            keyboardNavigation:"on",
            
            navigationHAlign:"center",
            navigationVAlign:"bottom",
            navigationHOffset:0,
            navigationVOffset:20,

            soloArrowLeftHalign:"left",
            soloArrowLeftValign:"center",
            soloArrowLeftHOffset:20,
            soloArrowLeftVOffset:0,

            soloArrowRightHalign:"right",
            soloArrowRightValign:"center",
            soloArrowRightHOffset:20,
            soloArrowRightVOffset:0,
                    
            shadow:0,
            fullWidth:"on",
            fullScreen:"off",

            spinner:"spinner0",
            
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,

            shuffle:"off",
            
            autoHeight:"off",						
            forceFullWidth:"off",						
                                    
                                    
                                    
            hideThumbsOnMobile:"off",
            hideNavDelayOnMobile:1500,						
            hideBulletsOnMobile:"off",
            hideArrowsOnMobile:"off",
            hideThumbsUnderResolution:0,
            
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            startWithSlide:0
        });				
    });
</script>

@endpush
@section('content')
<?php
if($banners != null && sizeof($banners)){
    ?>
    <!-- Start Hero Slider -->
    <div class="slider-rev-cont">
    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul style="display:none;">
                <?php
                $x = 1;
                foreach($banners as $banner){
                    ?>
                    <!-- SLIDE  -->
                    <li data-transition="fade" data-slotamount="1" data-masterspeed="1000"  data-saveperformance="off" data-title="{{$x++}}">
                        <!-- MAIN IMAGE -->
                        <img src="{{'data:image;base64,'.base64_encode($banner->foto)}}"  alt="fullslide1"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
            
                        <?php
                        if($banner->link != null){
                            ?> <a href="{{verifica_link($banner->link, $site)}}"> <?php
                        }
                        ?>
                        <!-- LAYER NR. 1 --><!--data-end="3000"-->
                        <div class="tp-caption large_text randomrotate tp-resizeme" 
                                data-x="100" 
                                data-y="300"  
                            data-speed="300" 
                            data-start="500" 
                            data-easing="Power3.easeInOut" 
                            data-splitin="none" 
                            data-splitout="none" 
                            data-elementdelay="0.1" 
                            data-endelementdelay="0.1" 
                                
                    data-endspeed="300" 
                
                            style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;"><?php echo htmlentities($banner->nome); ?> 
                        </div>
                        <?php
                        if($banner->link != null){
                            ?> </a> <?php
                        }
                        
                        if($banner->link != null){
                            ?> <a href="{{verifica_link($banner->link, $site)}}"> <?php
                        }
                        ?>
                        <!-- LAYER NR. 2 --><!--data-end="4000"-->
                        <div class="tp-caption medium_text randomrotate tp-resizeme" 
                                data-x="100" 
                                data-y="350"  
                            data-speed="300" 
                            data-start="800" 
                            data-easing="Power3.easeInOut" 
                            data-splitin="none" 
                            data-splitout="none" 
                            data-elementdelay="0.1" 
                            data-endelementdelay="0.1" 
                            
                    data-endspeed="300" 
                
                            style="z-index: 6; max-width: auto; max-height: auto; white-space: nowrap;"><?php echo htmlentities($banner->descricao); ?> 
                        </div>
                        <?php
                        if($banner->link != null){
                            ?> </a> <?php
                        }
                        ?>
                    </li>
                    <?php
                }
                ?>
            </ul>	
            <div class="tp-bannertimer" style="display:none;"></div>	
        </div>
    </div>
    </div>
    <?php
}
?>

<?php
if($noticias != null && sizeof($noticias) != 0){
    ?>
    <!-- End Hero Slider -->
    <!-- Start Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Últimas notícias</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Start Content -->
    <div class="main" role="main">
    <div id="content" class="content full">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
            <ul class="grid-holder col-3 events-grid">
                <?php foreach($noticias as $noticia){ ?>
                    <li class="grid-item post format-standard">
                    <div class="grid-item-inner">  
                        <?php if($noticia->foto != null){ ?>
                            <img src="{{'data:image;base64,'.base64_encode($noticia->foto)}}" alt=""> 
                        <?php }else{ ?>
                            <img src="{{asset('/storage/no-news.jpg')}}" alt=""> 
                        <?php } ?>
                        <div class="grid-content">
                        <h3><a href="{{route('site.noticia', ['url'=>$site->url,'id'=>$noticia->id])}}"><?php echo htmlentities($noticia->nome); ?></a></h3>
                        <span class="meta-data"><span><i class="fa fa-calendar"></i> Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</span><!--<span><a href="#"><i class="fa fa-tag"></i>Uncategoried</a></span>--></span>
                        <?php
                        if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                            ?>
                            <span class="meta-data"><span><i class="fa fa-calendar"></i> Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</span></span>
                            <?php
                        }
                        ?>
                        <p><?php echo htmlentities($noticia->descricao) ?></p>
                        </div>
                    </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        </div>
    </div>
    </div>
    <?php
}
?>

<?php
if($eventos != null && sizeof($eventos) != 0){
    ?>
    <!-- Start Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Últimos eventos</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Start Content -->
    <div class="main" role="main">
    <div id="content" class="content full">
        <div class="container">
        <ul class="timeline">
            <?php 
            $x = 0;
            for($x_ = sizeof($eventos) - 1; $x_ >= 0; $x_--){
                $evento = $eventos[$x_];
                $class = ($x % 2 == 0) ? "timeline-inverted" : "";
                $x++;
                ?>
                <li class="{{$class}}">
                    <div class="timeline-badge">{{strtoupper(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('MMM YYYY'))}}</div>
                    <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h3 class="timeline-title">
                        <a href="{{route('site.evento', ['url'=>$site->url,'id'=>$evento->id])}}"><?php echo htmlentities($evento->nome); ?></a>
                        </h3>
                    </div>
                    <div class="timeline-body">
                        <ul class="info-table">
                            <li><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}</li>
                            <?php if($evento->dados_horario_fim != null){ ?>
                                <li><i class="fa fa-clock-o"></i> Final previsto para {{\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)}}</li>
                            <?php } ?>
                            <li><i class="fa fa-map-marker"></i> <?php echo htmlentities($evento->dados_local); ?></li>
                            <!--<li><i class="fa fa-phone"></i> 1 800 321 4321</li>-->
                        </ul>
                    </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
        </div>
    </div>
    </div>
    <?php
}
?>

<?php
if($galerias != null && sizeof($galerias) != 0){
    ?>
    <!-- Start Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Últimos álbuns</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Start Content -->
    <div class="main" role="main">
    <div id="content" class="content full">
        <div class="container">
        <div class="row">
            <?php foreach($galerias as $galeria){ 
                if(count($fotos[$galeria->id]) == 1){
                    $foto = $fotos[$galeria->id][0]; ?>
                    <div class="col-md-4 col-sm-4">
                        <h3><?php echo htmlentities($galeria->nome); ?></h3>
                        <a href="{{'data:image;base64,'.base64_encode($foto->foto)}}" data-rel="prettyPhoto" class="media-box">
                            <img src="{{'data:image;base64,'.base64_encode($foto->foto)}}" alt="">
                        </a>
                    </div>
                <?php }else{ ?>
                    <div class="col-md-4 col-sm-4"><h3><?php echo htmlentities($galeria->nome); ?></h3>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="flexslider" data-autoplay="yes" data-pagination="yes" data-arrows="yes" data-style="slide" data-pause="yes">
                                    <ul class="slides">
                                        <?php $fotos_ = $fotos[$galeria->id];
                                        foreach($fotos_ as $foto){ ?>
                                            <li>
                                                <a href="{{'data:image;base64,'.base64_encode($foto->foto)}}" data-rel="prettyPhoto" >
                                                    <img src="{{'data:image;base64,'.base64_encode($foto->foto)}}">
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
        </div>
    </div>
    </div>
    <?php
}
?>
@endsection