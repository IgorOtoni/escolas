<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template3\eventofixodetalhado.blade.php */ ?>
<?php $__env->startPush('script'); ?>

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
                            <h2 class="post-title"><?php echo e($eventofixo->nome); ?></h2>
                            <p><?php echo e($eventofixo->descricao); ?></p>
                            <p><i class="fa fa-calendar"></i> <i class="fa fa-map-marker"></i> <?php echo e($eventofixo->dados_horario_local); ?></li></p>
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
</section>
<!-- ##### Blog Content Area End ##### -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>