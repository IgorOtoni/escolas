<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template6/index.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('template_igreja/template-branco/js/home.js')); ?>"></script> 
<?php $__env->stopPush(); ?>
<?php $__env->startSection('banner'); ?>
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
                <li class="parallax" style="background-image:url(/storage/banners/<?php echo e($banner->foto); ?>);">
                    <div class="flex-caption" data-appear-animation="fadeInRight" data-appear-animation-delay="500">
                        <?php
                        if($banner->link != null){
                            ?> <a href="<?php echo e(verifica_link($banner->link, $igreja)); ?>"> <?php
                        }
                        ?>
                        <strong><?php echo e($banner->nome); ?></strong>
                        <p><?php echo e($banner->descricao); ?></p>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
if($noticias != null && sizeof($noticias) != 0){
    ?>
    <!-- Lead Content -->
    <div class="lead-content clearfix" style="100%">
        <div class="lead-content-wrapper">
            <div class="container">
                <div class="row">
                    <?php $x = 0;
                    foreach($noticias as $noticia){
                        if($x < 3){
                            ?>

                            <div class="col-md-4 col-sm-4 featured-block">
                                <h3><?php echo e($noticia->nome); ?></h3>
                                <h4>Publicada <?php echo e(\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()); ?></h4>
                                <figure>
                                    <a href="about.html">
                                        <?php if($noticia->foto != null){ ?>
                                            <img src="/storage/noticias/<?php echo e($noticia->foto); ?>" alt=""> 
                                        <?php }else{ ?>
                                            <img src="/storage/no-news.jpg" alt=""> 
                                        <?php } ?>
                                    </a>
                                </figure>
                                <p><?php echo e($noticia->descricao); ?></p>
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
                                            <img src="<?php echo e(($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg"); ?>" width="95" height="100" alt="" title="" />
                                        </div>
                                        <div class="event-list-item-info">
                                            <div class="lined-info">
                                                <h4><a href="/<?php echo e($igreja->url); ?>/evento/<?php echo e($evento->id); ?>" class="event-title"><?php echo e($evento->nome); ?></a></h4>
                                            </div>
                                            <div class="lined-info">
                                                <span class="meta-data"><i class="fa fa-clock-o"></i> <?php echo e(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')); ?></span>
                                            </div>
                                            <div class="lined-info event-location">
                                                <span class="meta-data"><i class="fa fa-map-marker"></i> <span class="event-location-address"><?php echo e($evento->dados_local); ?></span></span>
                                            </div>
                                        </div>
                                        <div class="event-list-item-actions">
                                            <a href="/<?php echo e($igreja->url); ?>/evento/<?php echo e($evento->id); ?>" class="btn btn-default btn-transparent event-tickets event-register-button">Detalhes</a>
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
                                <li class="item"><a href="/storage/galerias/<?php echo e($foto->foto); ?>" data-rel="prettyPhoto[postname1]"><img src="/carrega_imagem/300,198,galerias,<?php echo e($foto->foto); ?>" alt=""></a></li>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template6', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>