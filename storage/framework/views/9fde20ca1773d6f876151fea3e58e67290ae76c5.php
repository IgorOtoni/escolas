<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template1\eventosfixos.blade.php */ ?>
<?php $__env->startSection('content'); ?>
<!-- Start Nav Backed Header -->
<<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="/<?php echo e($igreja->url); ?>/">Home</a></li>
        <li class="active">Eventos fixos</li>
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
        <h1>Eventos fixos</h1>
    </div>
    </div>
</div>
</div>
<!-- End Page Header --> 
<!-- Start Content -->
<div class="main" role="main">
<div id="content" class="content full">
    <div class="container">
    <center>
        <?php echo e($eventos_fixos->appends(request()->query())->links()); ?>

    </center>
    <div class="row">
        <div class="col-md-12">
        <ul class="grid-holder col-3 events-grid">
            <?php
            foreach($eventos_fixos as $evento){
                ?>
                <li class="grid-item format-standard">
                <div class="grid-item-inner"> 
                    <?php if($evento->foto != null){ ?>
                        <img src="/storage/eventos/<?php echo e($evento->foto); ?>" alt="">
                    <?php }else{ ?>
                        <img src="/storage/no-event.jpg" alt="">
                    <?php } ?>
                    <div class="grid-content">
                    <h3><a href="/<?php echo e($igreja->url); ?>/eventofixo/<?php echo e($evento->id); ?>"><?php echo e($evento->nome); ?></a></h3>
                    <?php if($evento->descricao != null){ ?> <p><?php echo e($evento->descricao); ?></p> <?php } ?>
                    </div>
                    <ul class="info-table">
                    <li><i class="fa fa-calendar"></i><i class="fa fa-map-marker"></i> <?php echo e($evento->dados_horario_local); ?></li>
                    </ul>
                </div>
                </li>
                <?php
            }
            ?>
        </ul>
        </div>
    </div>
    <center>
        <?php echo e($eventos_fixos->appends(request()->query())->links()); ?>

    </center>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>