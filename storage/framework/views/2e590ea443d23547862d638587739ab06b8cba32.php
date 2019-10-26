<?php $__env->startSection('content'); ?>
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="<?php echo e(route('site.index',['url'=>$site->url])); ?>">Home</a></li>
        <li class="active">Vídeos</li>
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
        <h1>Vídeos</h1>
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
        <?php
        if($midias != null && sizeof($midias) > 0){
        ?>
            <?php foreach($midias as $midia){ ?>
                <article class="post sermon">
                    <header class="post-title">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                        <h3>
                            <a href="<?php echo e(route('site.midia', ['url'=>$site->url,'id'=>$midia->id])); ?>"><?php echo $midia->nome ?>
                            </a>
                        </h3>
                        <span class="meta-data"><i class="fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($midia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')); ?> </div>
                    </div>
                    </header>
                    <div class="post-content">
                    <div class="row">
                        <div class="col-md-5"> <iframe frameborder="0" src="<?php echo e($midia->link); ?>"></iframe> </div>
                        <div class="col-md-7">
                        <p><?php echo $midia->descricao ?></p>
                        <p><a href="<?php echo e($midia->link); ?>" class="btn btn-primary">Assistir vídeo <i class="fa fa-long-arrow-right"></i></a></p>
                        </div>
                    </div>
                    </div>
                </article>
            <?php } ?>
            </div>
            <?php
        }else{
            ?>
            <center>
                <span class="label label-warning">Nenhum vídeo para mostrar.</span>
            </center>
            <?php
        }
        ?>
    </div>
    <center>
        <?php echo e($midias->appends(request()->query())->links()); ?>

    </center>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template1/midias.blade.php ENDPATH**/ ?>