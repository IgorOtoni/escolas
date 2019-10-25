<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/layouts/template1/eventodetalhado.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- InputMask -->
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>

<script>
$(function(){
    $('[data-mask]').inputmask();

    $('#subscribeForm').validator('update');
});
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
        <li><a href="/<?php echo e($site->url); ?>/eventos">Linha do tempo</a></li>
        <li class="active">Evento</li>
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
        <h1><?php echo e($evento->nome); ?></h1>
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
                        <p><?php echo e($evento->descricao); ?></p>
                        <ul class="info-table">
                            <li><i class="fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')); ?></li>
                            <?php if($evento->dados_horario_fim != null){ ?>
                                <li><i class="fa fa-clock-o"></i> Final previsto para <?php echo e(\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)); ?></li>
                            <?php } ?>
                            <li><i class="fa fa-map-marker"></i> <?php echo e($evento->dados_local); ?></li>
                            <!--<li><i class="fa fa-phone"></i> 1 800 321 4321</li>-->
                        </ul>
                    </div>
                    <div class="post-thumbnail mb-30">
                        <?php if($evento->foto != null): ?>
                        <img src="/storage/<?php echo e(($evento->foto != null) ? "timeline/".$evento->foto : "no-event.jpg"); ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <section class="post-comment-form">
            <h3><i class="fa fa-share"></i> Inscrever me</h3>
            <form action="/<?php echo e($site->url); ?>/inscreveEnvento" method="get" data-toggle="validator" id="subscribeForm">
                <input type="hidden" name="id_evento" value="<?php echo e($evento->id); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                    <input type="text" data-inputmask='"mask": "(99) 99999-9999"' data-mask name="telefone" class="form-control input-lg" placeholder="Telefone" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                    <input type="email" name="email" class="form-control input-lg" placeholder="Email" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg">Inscrever</button>
                    </div>
                </div>
                </div>
            </form>
            </section>
        </div>
    </div>
</div>
<!-- End Content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>