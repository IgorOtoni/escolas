<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/layouts/template1/galeria.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('template_site/template-padrao/plugins/flexslider/js/jquery.flexslider.js')); ?>"></script> <!-- FlexSlider --> 
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="/<?php echo e($site->url); ?>">Home</a></li>
        <li class="active">Álbuns</li>
        </ol>
    </div>
    </div>
</div>
</div>
<!-- End Nav Backed Header --> 
<!-- Start Page Header -->
<div class="page-header">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <h1>Álbuns</h1>
    </div>
    </div>
</div>
</div>
<!-- End Page Header --> 
<!-- Start Content -->
<div class="main" role="main">
<div id="content" class="content full">
    <div class="container">
    <center>
        <?php echo e($galerias->appends(request()->query())->links()); ?>

    </center>
    <div class="row">
        <?php
        if($galerias != null && sizeof($galerias) > 0){
        ?>
            <ul class="isotope-grid" data-sort-id="gallery">
            <?php foreach($galerias as $galeria){ 
                if(count($fotos[$galeria->id]) == 1){
                    $foto = $fotos[$galeria->id][0]; ?>
                    <li class="col-md-3 col-sm-3 grid-item post format-image"><h3><?php echo e($galeria->nome); ?></h3>
                        <h4><i class="fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($galeria->data)->diffForHumans()); ?></h4>
                        <div class="grid-item-inner"> <a href="/storage/galerias/<?php echo e($foto->foto); ?>" data-rel="prettyPhoto" class="media-box"> <img src="/carrega_imagem/480,320,galerias,<?php echo e($foto->foto); ?>" alt=""> <!--<img src="/storage/galerias/<?php echo e($foto->foto); ?>" alt="">--> </a> </div>
                        <p><?php echo e($galeria->descricao); ?></p>
                    </li>
                <?php }else{ ?>
                    <li class="col-md-3 col-sm-3 grid-item post format-gallery"><h3><?php echo e($galeria->nome); ?></h3>
                        <h4><i class="fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($galeria->data)->diffForHumans()); ?></h4>
                        <div class="grid-item-inner">
                        <div class="media-box">
                            <div class="flexslider" data-autoplay="yes" data-pagination="yes" data-arrows="yes" data-style="slide" data-pause="yes">
                            <ul class="slides">
                                <?php $fotos_ = $fotos[$galeria->id];
                                    foreach($fotos_ as $foto){ ?>
                                    <li class="item"><a href="/storage/galerias/<?php echo e($foto->foto); ?>" data-rel="prettyPhoto[postname]"><img src="/carrega_imagem/480,320,galerias,<?php echo e($foto->foto); ?>" alt=""></a></li>
                                <?php } ?>
                            </ul>
                            </div>
                        </div>
                        <p><?php echo e($galeria->descricao); ?></p>
                        </div>
                    </li>
                <?php }
            } ?>
            </ul>
        <?php
        }else{
            ?>
            <center>
                <span class="label label-warning">Nenhuma galeria para mostrar.</span>
            </center>
            <?php
        }
        ?>
    </div>
    <center>
        <?php echo e($galerias->appends(request()->query())->links()); ?>

    </center>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>