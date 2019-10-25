<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Breadcumb Area Start ##### -->
<!--<div class="breadcumb-area bg-img" style="background-image: url(<?php echo e(asset('template_site/template-escuro/img/bg-img/bg-4.jpg')); ?>);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6">
                <div class="breadcumb-text">
                    <h2>Visões e valores</h2>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Ministries Area Start ##### -->
<section class="ministries-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3>Sobre nós/Visões e valores</h3>
                    <p><?php echo e($site->texto_apresentativo); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Ministries Area End ##### -->

<!-- ##### Pastors Area Start ##### -->
<section class="pastors-area section-padding-100-0 bg-img bg-overlay" style="background-image: url(<?php echo e(asset('/template_site/template-escuro/img/bg-img/bg-5.jpg')); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading white text-center mx-auto">
                    <!-- <img src="<?php echo e(asset('/template_site/template-escuro/img/core-img/cross.png')); ?>" alt=""> -->
                    <h3>Membros</h3>
                </div>
            </div>
        </div>

        <?php if($funcoes != null && sizeof($funcoes) > 0): ?>
            <div class="row">
                <?php $__currentLoopData = $funcoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $membros[$funcao->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Single Pastors Area -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="single-pastor-area mb-100">
                                <img width="250" height="250" src="<?php echo e($membro->foto != null ? 'data:image;base64,'.base64_encode($membro->foto) : asset('/storage/no-foto.png')); ?>" alt="">
                                <div class="pastor-content">
                                    <h5><?php echo e($membro->nome); ?> (<?php echo e($funcao->nome); ?>)</h5>
                                    <h6><?php echo e($membro->descricao); ?></h6>
                                    <div class="pastor-meta d-flex align-items-center justify-content-between">
                                        <?php if($membro->facebook != null): ?>
                                            <a href="<?php echo e($membro->facebook); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <?php endif; ?>
                                        <?php if($membro->twitter != null): ?>
                                            <a href="<?php echo e($membro->twitter); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <?php endif; ?>
                                        <?php if($membro->youtube != null): ?>
                                            <a href="<?php echo e($membro->youtube); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- ##### Pastors Area End ##### -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template3/apresentacao.blade.php ENDPATH**/ ?>