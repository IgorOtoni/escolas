@extends('layouts.template6')
@push('script')

@endpush
@section('banner')
<?php
if($banners != null && sizeof($banners)){
    ?>
    <!-- Start Hero Slider -->
    <div class="hero-slider heroflex flexslider clearfix" data-autoplay="yes" data-pagination="no" data-arrows="yes" data-style="fade" data-speed="7000" data-pause="yes">
        <ul class="slides">
            <?php
            $x = 1;
            foreach($banners as $banner){
                ?>
                <li class="parallax" style="background-image:url(/storage/banners/{{$banner->foto}});">
                    <div class="flex-caption" data-appear-animation="fadeInRight" data-appear-animation-delay="500">
                        <?php
                        if($banner->link != null){
                            ?> <a href="{{verifica_link($banner->link, $igreja)}}"> <?php
                        }
                        ?>
                        <strong>{{$banner->nome}}</strong>
                        <p>{{$banner->descricao}}</p>
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
        <canvas id="canvas-animation"></canvas>
    </div>
    <!-- End Hero Slider -->
    <?php
}
?>
@endsection
@section('content')
<?php
if($noticias != null && sizeof($noticias) != 0){
    ?>
    <!-- Lead Content -->
    <div class="lead-content clearfix">
        <div class="lead-content-wrapper">
            <div class="container">
                <div class="row">
                    <?php $x = 0;
                    foreach($noticias as $noticia){
                        if($x < 3){
                            ?>

                            <div class="col-md-4 col-sm-4 featured-block">
                                <h3>{{$noticia->nome}}</h3>
                                <h4>Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</h4>
                                <figure>
                                    <a href="about.html">
                                        <?php if($noticia->foto != null){ ?>
                                            <img src="/storage/noticias/{{$noticia->foto}}" alt=""> 
                                        <?php }else{ ?>
                                            <img src="/storage/no-news.jpg" alt=""> 
                                        <?php } ?>
                                    </a>
                                </figure>
                                <p>{{$noticia->descricao}}</p>
                            </div>
                            
                            <?php
                            }
                        $x++;
                    } ?>
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
    <!-- Start Body Content -->
    <div class="main" role="main">
        <div id="content" class="content full">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="element-block events-listing">
                            <div class="events-listing-header">
                                <h3 class="element-title">Últimos eventos</h3>
                                <hr class="sm">
                            </div>
                            <div class="events-listing-content">
                                <?php 
                                $x = 0;
                                foreach($eventos as $evento){
                                    $x++;
                                    ?>
                                    <div class="event-list-item event-dynamic">
                                        <div class="event-list-item-date">
                                            <img src="{{($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg"}}" width="95" height="100" alt="" title="" />
                                        </div>
                                        <div class="event-list-item-info">
                                            <div class="lined-info">
                                                <h4><a href="/{{$igreja->url}}/evento/{{$evento->id}}" class="event-title">{{$evento->nome}}</a></h4>
                                            </div>
                                            <div class="lined-info">
                                                <span class="meta-data"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}</span>
                                            </div>
                                            <div class="lined-info event-location">
                                                <span class="meta-data"><i class="fa fa-map-marker"></i> <span class="event-location-address">{{$evento->dados_local}}</span></span>
                                            </div>
                                        </div>
                                        <div class="event-list-item-actions">
                                            <a href="/{{$igreja->url}}/evento/{{$evento->id}}" class="btn btn-default btn-transparent event-tickets event-register-button">Detalhes</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Body Content -->
    <?php
}
?>
<?php
if($galerias != null && sizeof($galerias) != 0){
    ?>
    <!-- Gallery updates -->
    <div class="gallery-updates cols5 clearfix">
        <ul>
            <?php foreach($galerias as $galeria){ ?>
                <li class="format-standard">
                    <div class="flexslider galleryflex" data-autoplay="yes" data-pagination="yes" data-arrows="no" data-style="slide" data-pause="yes">
                        <ul class="slides">
                            <?php $fotos_ = $fotos[$galeria->id];
                            foreach($fotos_ as $foto){ ?>
                                <li class="item"><a href="/storage/galerias/{{$foto->foto}}" data-rel="prettyPhoto[postname1]"><img src="/storage/galerias/{{$foto->foto}}" alt=""></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <div class="gallery-updates-overlay">
            <div class="container">
                <i class="icon-multiple-image"></i>
                <h2>Últimos álbuns</h2>
            </div>
        </div>
    </div>
    <?php
}
?>
@endsection