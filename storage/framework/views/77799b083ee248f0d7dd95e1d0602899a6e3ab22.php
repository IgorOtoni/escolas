<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template1\apresentacao.blade.php */ ?>
<?php $__env->startSection('content'); ?>
<!-- End Site Header --> 
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="/<?php echo e($igreja->url); ?>/">Home</a></li>
        <li class="active">Sobre nós</li>
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
        <h1>Sobre nós</h1>
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
        <div class="col-md-12">
        <p><?php echo e($igreja->texto_apresentativo); ?></p>
        <hr>
        <?php if($funcoes != null && sizeof($funcoes) > 0): ?>
            <h3>Ministros</h3>
        <?php endif; ?>
        </div>
        <?php $__currentLoopData = $funcoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $membros[$funcao->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 col-sm-4">
                <div class="grid-item staff-item">
                    <div class="grid-item-inner">
                    <div class="media-box"> 
                        <?php if($membro->foto != null): ?>
                            <img src="/carrega_imagem/250,250,membros,<?php echo e($membro->foto); ?>" alt=""> 
                        <?php else: ?>
                            <img src="/carrega_imagem/250,250,X,no-foto.png" alt=""> 
                        <?php endif; ?>
                    </div>
                    <div class="grid-content">
                        <h3><?php echo e($membro->nome); ?> (<?php echo e($funcao->nome); ?>)</h3>
                        <nav class="social-icons"> 
                            <?php if($membro->facebook != null): ?>
                                <a href="<?php echo e($membro->facebook); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                            <?php endif; ?>
                            <?php if($membro->twitter != null): ?>
                                <a href="<?php echo e($membro->twitter); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                            <?php endif; ?>
                            <?php if($membro->youtube != null): ?>
                                <a href="<?php echo e($membro->youtube); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
                            <?php endif; ?>
                        </nav>
                        <p><?php echo e($membro->descricao); ?></p>
                    </div>
                    </div>
                </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>