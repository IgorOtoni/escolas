@extends('layouts.template1')
@push('script')
<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="{{asset('template_igreja/template-padrao/plugins/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>   
<script type="text/javascript" src="{{asset('template_igreja/template-padrao/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
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
    });	//ready
</script>
<!-- FlexSlider --> 
<script src="{{asset('template_igreja/template-padrao/plugins/flexslider/js/jquery.flexslider.js')}}"></script>
<script>
$('#modal-noticia').on('hide.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;

    var modal = $(this);

    modal.find('.modal-content #nome').html("");
    modal.find('.modal-content #descricao').html("");
    modal.find('.modal-content #dth_publicacao').html("");
    modal.find('.modal-content #dth_atualizacao').html("");
    modal.find('.modal-content #foto').show();
    modal.find('.modal-content #dth_atualizacao').show();
});

$('#modal-noticia').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    var nome = button.data('nome');
    var descricao = button.data('descricao');
    var publicacao = button.data('publicacao');
    var atualizacao = button.data('atualizacao');
    var foto = button.data('foto');

    var modal = $(this);

    if(nome != null) modal.find('.modal-content #nome').append(nome);
    if(descricao != null) modal.find('.modal-content #descricao').append(descricao);
    if(publicacao != null) modal.find('.modal-content #dth_publicacao').append(' ' + publicacao);
    if(atualizacao != null && atualizacao != ''){
        modal.find('.modal-content #dth_atualizacao').append(' Atualizada ' + atualizacao);
    }else{
        modal.find('.modal-content #dth_atualizacao').hide();
    }
    if(foto != null && foto != ''){
        modal.find('.modal-content #foto').prop('src', '{{asset('storage/noticias/')}}' + '/' + foto);
    }else{
        modal.find('.modal-content #foto').prop('src', '{{asset('storage/')}}' + '/no-news.jpg');
    }
});
</script>
<script>
$('#modal-evento').on('hide.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;

    var modal = $(this);

    modal.find('.modal-content #nome').html("");
    modal.find('.modal-content #descricao').html("");
    modal.find('.modal-content #dth_inicio').html("");
    modal.find('.modal-content #dth_fim').html("");
    modal.find('.modal-content #local').html("");
    modal.find('.modal-content #src').prop('src', '');
    modal.find('.modal-content #dth_fim').show();
    modal.find('.modal-content #foto').show();
});

$('#modal-evento').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    var nome = button.data('nome');
    var descricao = button.data('descricao');
    var inicio = button.data('inicio');
    var fim = button.data('fim');
    var local = button.data('local');
    var foto = button.data('foto');

    var modal = $(this);

    if(nome != null) modal.find('.modal-content #nome').append(nome);
    if(descricao != null) modal.find('.modal-content #descricao').append(descricao);
    if(inicio != null) modal.find('.modal-content #dth_inicio').append(' ' + inicio);
    if(fim != null && fim != ''){
        modal.find('.modal-content #dth_fim').append(' Final previsto para ' + fim);
    }else{
        modal.find('.modal-content #dth_fim').hide();
    }
    if(local != null) modal.find('.modal-content #local').append(' ' + local);
    if(foto != null && foto != ''){
        modal.find('.modal-content #foto').prop('src', '{{asset('storage/timeline/')}}' + '/' + foto);
    }else{
        modal.find('.modal-content #foto').hide();
    }
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
                        <img src="/storage/banners/{{$banner->foto}}"  alt="fullslide1"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
            
                        <?php
                        if($banner->link != null){
                            ?> <a href="{{verifica_link($banner->link, $igreja)}}"> <?php
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
                
                            style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">{{$banner->nome}} 
                        </div>
                        <?php
                        if($banner->link != null){
                            ?> </a> <?php
                        }
                        
                        if($banner->link != null){
                            ?> <a href="{{verifica_link($banner->link, $igreja)}}"> <?php
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
                
                            style="z-index: 6; max-width: auto; max-height: auto; white-space: nowrap;">{{$banner->descricao}} 
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
                            <img src="/storage/noticias/{{$noticia->foto}}" alt=""> 
                        <?php }else{ ?>
                            <img src="/storage/no-news.jpg" alt=""> 
                        <?php } ?>
                        <div class="grid-content">
                        <?php /* ?>
                        <h3><a data-publicacao="{{\Carbon\Carbon::parse($noticia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-atualizacao="{{(($noticia->updated_at != null) ? \Carbon\Carbon::parse($noticia->updated_at)->diffForHumans() : '')}}" data-foto="{{$noticia->foto}}" data-nome="{{$noticia->nome}}" data-descricao="{{$noticia->descricao}}" data-toggle="modal" data-target="#modal-noticia" href="">{{$noticia->nome}}</a></h3>
                        <?php */ ?>
                        <h3><a href="/{{$igreja->url}}/noticia/{{$noticia->id}}">{{$noticia->nome}}</a></h3>
                        <span class="meta-data"><span><i class="fa fa-calendar"></i> Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</span><!--<span><a href="#"><i class="fa fa-tag"></i>Uncategoried</a></span>--></span>
                        <?php
                        if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                            ?>
                            <span class="meta-data"><span><i class="fa fa-calendar"></i> Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</span></span>
                            <?php
                        }
                        ?>
                        <p>{{$noticia->descricao}}</p>
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
            foreach($eventos as $evento){
                $class = ($x % 2 == 0) ? "timeline-inverted" : "";
                $x++;
                ?>
                <li class="{{$class}}">
                    <div class="timeline-badge">{{strtoupper(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('MMM YYYY'))}}</div>
                    <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h3 class="timeline-title">
                        <a data-toggle="modal" data-target="#modal-evento" data-foto="{{$evento->foto}}" data-local="{{$evento->dados_local}}" data-nome="{{$evento->nome}}" data-descricao="{{$evento->descricao}}" data-inicio="{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-fim="{{(($evento->dados_horario_fim != null) ? \Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio) : '')}}">{{$evento->nome}}</a>
                        </h3>
                    </div>
                    <div class="timeline-body">
                        <ul class="info-table">
                            <li><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}</li>
                            <?php if($evento->dados_horario_fim != null){ ?>
                                <li><i class="fa fa-clock-o"></i> Final previsto para {{\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)}}</li>
                            <?php } ?>
                            <li><i class="fa fa-map-marker"></i> {{$evento->dados_local}}</li>
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
            <ul class="isotope-grid" data-sort-id="gallery">
            <?php foreach($galerias as $galeria){ 
                if(count($fotos[$galeria->id]) == 1){
                    $foto = $fotos[$galeria->id][0]; ?>
                    <li class="col-md-3 col-sm-3 grid-item post format-image"><h3>{{$galeria->nome}}</h3>
                        <div class="grid-item-inner"> <a href="/storage/galerias/{{$foto->foto}}" data-rel="prettyPhoto" class="media-box"> <img src="/carrega_imagem/480,320,galerias,{{$foto->foto}}" alt=""> <!--<img src="/storage/galerias/{{$foto->foto}}" alt="">--> </a> </div>
                    </li>
                <?php }else{ ?>
                    <li class="col-md-3 col-sm-3 grid-item post format-gallery"><h3>{{$galeria->nome}}</h3>
                        <div class="grid-item-inner">
                        <div class="media-box">
                            <div class="flexslider" data-autoplay="yes" data-pagination="yes" data-arrows="yes" data-style="slide" data-pause="yes">
                            <ul class="slides">
                                <?php $fotos_ = $fotos[$galeria->id];
                                    foreach($fotos_ as $foto){ ?>
                                    <li class="item"><a href="/storage/galerias/{{$foto->foto}}" data-rel="prettyPhoto[postname]"><img src="/carrega_imagem/480,320,galerias,{{$foto->foto}}" alt=""></a></li>
                                <?php } ?>
                            </ul>
                            </div>
                        </div>
                        </div>
                    </li>
                <?php }
            } ?>
            </ul>
        </div>
        </div>
    </div>
    </div>
    <?php
}
?>
@endsection