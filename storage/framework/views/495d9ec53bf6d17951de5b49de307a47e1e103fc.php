<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template1\midias.blade.php */ ?>
<?php $__env->startSection('content'); ?>
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="/<?php echo e($site->url); ?>/">Home</a></li>
        <li class="active">Sermões</li>
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
        <h1>Sermões</h1>
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
        <?php echo e($midias->appends(request()->query())->links()); ?>

    </center>
    <div class="row">
        <div class="col-md-12 sermon-archive"> 
        <!-- Sermons Listing -->
        <?php foreach($midias as $midia){ ?>
            <article class="post sermon">
                <header class="post-title">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                    <h3><a href="/<?php echo e($site->url); ?>/midia/<?php echo e($midia->id); ?>"><?php echo e($midia->nome); ?></a></h3>
                    <span class="meta-data"><i class="fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($midia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')); ?> </div>
                </div>
                </header>
                <div class="post-content">
                <div class="row">
                    <div class="col-md-5"> <iframe frameborder="0" src="<?php echo e($midia->link); ?>"></iframe> </div>
                    <div class="col-md-7">
                    <p><?php echo e($midia->descricao); ?></p>
                    <p><a href="<?php echo e($midia->link); ?>" class="btn btn-primary">Assistir sermão <i class="fa fa-long-arrow-right"></i></a></p>
                    </div>
                </div>
                </div>
            </article>
        <?php } ?>
        </div>
    </div>
    <center>
        <?php echo e($midias->appends(request()->query())->links()); ?>

    </center>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>