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
        <li><a href="<?php echo e(route('site.index',['url'=>$site->url])); ?>">Home</a></li>
        <li><a href="<?php echo e(route('site.eventosfixos',['url'=>$site->url])); ?>">Eventos fixos</a></li>
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
        <h1><?php echo $eventofixo->nome ?></h1>
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
                        <p><?php echo $eventofixo->descricao ?></p>
                        <ul class="info-table">
                        <li><i class="fa fa-calendar"></i><i class="fa fa-map-marker"></i> <?php echo $eventofixo->dados_horario_local ?></li>
                        </ul>
                    </div>
                    <div class="post-thumbnail mb-30">
                        <img src="<?php echo e(($eventofixo->foto != null) ? 'data:image;base64,'.base64_encode($eventofixo->foto) : asset('/storage/no-event.jpg')); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template1/eventofixodetalhado.blade.php ENDPATH**/ ?>