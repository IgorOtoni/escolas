<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/layouts/template1/eventofixodetalhado.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<script>

</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- End Site Header --> 
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="/<?php echo e($site->url); ?>/">Home</a></li>
        <li><a href="/<?php echo e($site->url); ?>/eventosfixos">Eventos fixos</a></li>
        <li class="active">Evento fixo</li>
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
        <h1><?php echo e($eventofixo->nome); ?></h1>
    </div>
    </div>
</div>
</div>
<!-- End Page Header -->
<!-- Start Content -->
<div class="main" role="main">
    <div id="content" class="content full">
        <div class="container">
            <div class="blog-posts-area">
                <!-- Post Details Area -->
                <div class="single-post-details-area">
                    <div class="post-content">
                        <p><?php echo e($eventofixo->descricao); ?></p>
                        <ul class="info-table">
                        <li><i class="fa fa-calendar"></i><i class="fa fa-map-marker"></i> <?php echo e($eventofixo->dados_horario_local); ?></li>
                        </ul>
                    </div>
                    <div class="post-thumbnail mb-30">
                        <?php if($eventofixo->foto != null): ?>
                        <img src="/storage/<?php echo e(($eventofixo->foto != null) ? "eventos/".$eventofixo->foto : "no-event.jpg"); ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>