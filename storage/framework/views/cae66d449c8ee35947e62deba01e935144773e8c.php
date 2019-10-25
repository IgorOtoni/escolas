<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/layouts/template2/apresentacao.blade.php */ ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/<?php echo e($site->url); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sobre nós</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### About Us Area Start ##### -->
<div class="about-us-area about-page section-padding-100">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-12 col-lg-12">
                <div class="about-content">
                    <h2>Sobre nós</h2>
                    <p><?php echo e($site->texto_apresentativo); ?></p>
                </div>
            </div>
            <!--<div class="col-12 col-lg-6">
                <div class="about-thumbnail">
                    <img src="img/bg-img/26.jpg" alt="">
                </div>
            </div>-->
        </div>
    </div>
</div>
<!-- ##### About Us Area End ##### -->

<?php if($funcoes != null && sizeof($funcoes) > 0): ?>
    <!-- ##### Team Members Area Start ##### -->
    <div class="team-members-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading">
                        <h2>Membros</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php $__currentLoopData = $funcoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $membros[$funcao->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Team Members Area -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="single-team-members text-center mb-100">
                                <div class="team-thumb" style="background-image: url(<?php echo e(asset('/storage/'.($membro->foto != null ? 'membros/'.$membro->foto : 'no-foto.png'))); ?>); background-repeat: no-repeat; background-size: 200px 200px;">
                                    <div class="team-social-info">
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
                                <h6><?php echo e($membro->nome); ?> (<?php echo e($funcao->nome); ?>)</h6>
                                <span><?php echo e($membro->descricao); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <!-- ##### Team Members Area End ##### -->
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>