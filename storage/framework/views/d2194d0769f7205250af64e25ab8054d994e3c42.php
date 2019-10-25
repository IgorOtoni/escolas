<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template3\midiadetalhado.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url(<?php echo e(asset('template_site/template-escuro/img/bg-img/bg-6.jpg')); ?>);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6">
                <div class="breadcumb-text">
                    <h2>Sermão</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Sermons Area Start ##### -->
<div class="sermons-details-area section-padding-100">
    <div class="container">
        <div class="row justify-content-between">
            <!-- Blog Posts Area -->
            <div class="col-12 col-lg-8">
                <div class="sermons-details-area">

                    <!-- Sermons Details Area -->
                    <div class="single-post-details-area">
                        <div class="post-content">
                            <h2 class="post-title mb-30"><?php echo e($midia->nome); ?></h2>
                            <iframe frameborder="0" src="<?php echo e($midia->link); ?>"></iframe>
                            <h6>Publicado <?php echo e(\Carbon\Carbon::parse($midia->created_at)->diffForHumans()); ?></h6>
                            <?php
                            if($midia->updated_at != null && $midia->updated_at != $midia->created_at){
                                ?>
                                <h6> Editado <?php echo e(\Carbon\Carbon::parse($midia->updated_at)->diffForHumans()); ?></h6>
                                <?php
                            }
                            ?>
                            <p><?php echo e($midia->descricao); ?></p>
                            <a href="<?php echo e($midia->link); ?>">Assistir</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Sermons End Start ##### -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>