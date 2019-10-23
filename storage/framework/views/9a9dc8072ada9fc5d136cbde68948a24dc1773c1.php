<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('template_igreja/template-padrao/plugins/flexslider/js/jquery.flexslider.js')); ?>"></script> <!-- FlexSlider --> 
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="/<?php echo e($igreja->url); ?>/">Home</a></li>
        <li class="active">Publicação</li>
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
        <h1><?php echo e($publicacao->nome); ?></h1>
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
        <div class="col-md-12 sermon-archive" id="html-append">
            <?php echo $publicacao->html; ?>
        </div>
    </div>
    <div class="row">
        <ul class="isotope-grid" data-sort-id="gallery">
        <?php foreach($galeria_publicacao as $foto){ ?>
            <li class="col-md-3 col-sm-3 grid-item post format-image">
                <div class="grid-item-inner"> <a href="<?php echo e('data:image;base64,'.base64_encode($foto->foto)); ?>" data-rel="prettyPhoto" class="media-box"> <img width="480" height="320" src="'data:image;base64,'.base64_encode($foto->foto)" alt=""> <!--<img src="/storage/galerias/<?php echo e($foto->foto); ?>" alt="">--> </a> </div>
            </li>
        <?php } ?>
        </ul>
    </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template1/publicacao.blade.php ENDPATH**/ ?>