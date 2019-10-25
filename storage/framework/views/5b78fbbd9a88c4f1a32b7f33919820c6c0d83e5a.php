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
        <li><a href="<?php echo e(route('site.index',['url'=>$site->url])); ?>">Home</a></li>
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
            foreach($galerias as $galeria){ 
                if(count($fotos[$galeria->id]) == 1){
                    $foto = $fotos[$galeria->id][0]; ?>
                    <div class="col-md-4 col-sm-4">
                        <h3><?php echo $galeria->nome ?></h3>
                        <h4>
                            <i class="fa fa-calendar"></i> 
                            <?php echo e(\Carbon\Carbon::parse($galeria->data)->diffForHumans()); ?>

                        </h4>
                        <div class="grid-item-inner"> 
                            <a href="<?php echo e('data:image;base64,'.base64_encode($foto->foto)); ?>" data-rel="prettyPhoto" class="media-box">
                                <img width="480" height="320" src="<?php echo e('data:image;base64,'.base64_encode($foto->foto)); ?>"> <!--<img src="/storage/galerias/<?php echo e($foto->foto); ?>" alt="">-->
                            </a>
                        </div>
                        <p><?php echo $galeria->descricao ?></p>
                    </div>
                <?php }else{ ?>
                    <div class="col-md-4 col-sm-4">
                        <h3><?php echo $galeria->nome ?></h3>
                        <h4>
                            <i class="fa fa-calendar"></i> 
                            <?php echo e(\Carbon\Carbon::parse($galeria->data)->diffForHumans()); ?>

                        </h4>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="flexslider" data-autoplay="yes" data-pagination="yes" data-arrows="yes" data-style="slide" data-pause="yes">
                                    <ul class="slides">
                                    <?php $fotos_ = $fotos[$galeria->id];
                                        foreach($fotos_ as $foto){ ?>
                                        <li>
                                            <a href="<?php echo e('data:image;base64,'.base64_encode($foto->foto)); ?>" data-rel="prettyPhoto">
                                                <img src="<?php echo e('data:image;base64,'.base64_encode($foto->foto)); ?>">
                                            </a>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                                <p><?php echo $galeria->descricao ?></p>
                            </div>
                        </div>
                    </div>
                <?php }
            }
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
<?php echo $__env->make('layouts.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template1/galeria.blade.php ENDPATH**/ ?>