<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template3\eventodetalhado.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- InputMask -->
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>

<script>
$(function(){
    $('[data-mask]').inputmask();
});
</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url(<?php echo e(asset('storage/no-event.jpg')); ?>);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6">
                <div class="breadcumb-text">
                    <h2>Evento</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Blog Content Area Start ##### -->
<section class="blog-content-area section-padding-100">
    <div class="container">
        <div class="row justify-content-between">
            <!-- Blog Posts Area -->
            <div class="col-12 col-lg-8">
                <div class="blog-posts-area">

                    <!-- Post Details Area -->
                    <div class="single-post-details-area">
                        <div class="post-content">
                            <h2 class="post-title"><?php echo e($evento->nome); ?></h2>
                            <p><?php echo e($evento->descricao); ?></p>
                            <p><i class="fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')); ?></p>
                            <?php if($evento->dados_horario_fim != null){ ?>
                                <p><i class="fa fa-clock-o"></i> Final previsto para <?php echo e(\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)); ?></p>
                            <?php } ?>
                            <p><i class="fa fa-map-marker"></i> <?php echo e($evento->dados_local); ?></p>
                        </div>
                        <div class="post-thumbnail mb-30">
                            <?php if($evento->foto != null): ?>
                            <img src="/storage/<?php echo e(($evento->foto != null) ? "timeline/".$evento->foto : "no-event.jpg"); ?>" alt="">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->

<!-- ##### CTA Area Start ##### -->
<div class="faith-cta-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cta-text d-flex justify-content-between align-items-center">
                    <form id="subscribeForm" name="subscribeForm" method="get" action="/<?php echo e($site->url); ?>/inscreveEnvento" class="contact-form-area">
                        <input type="hidden" name="id_evento" value="<?php echo e($evento->id); ?>">
                        <?php echo csrf_field(); ?>
                        <h5>Me inscrever</h5>
                        <input class="form-control" type="text" data-inputmask='"mask": "(99) 99999-9999"' data-mask name="telefone" placeholder="Telefone" required> 
                        <input class="form-control" type="email" name="email" placeholder="Email" required> 
                        <input type="submit" class="btn faith-btn" value="Inscrever">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### CTA Area End ##### -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>