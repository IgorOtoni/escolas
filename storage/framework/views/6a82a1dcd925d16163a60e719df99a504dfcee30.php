<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template5/eventodetalhado.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Evento detalhado</h1>
        </div>
    </div>
</div>

<div id="content">	
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list">
                <div class="post">
                    <h2 class="title"><?php echo e($evento->nome); ?></h2>
                    <p class="meta">
                        <span>Data: <a class="date" title="" href="#"><?php echo e(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YY h:mm A')); ?></a></span>
                        <span>Local: <a class="author" title="" href="#"><?php echo e($evento->dados_local); ?></a></span>
                    </p>
                    <p class="image"> 
                        <a href="<?php echo e(($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg"); ?>" rel="example_group">
                            <img src="<?php echo e(($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg"); ?>" width="628" height="242" alt="" title="" />
                        </a>
                    </p>
                    <p><?php echo e($evento->descricao); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template5', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>