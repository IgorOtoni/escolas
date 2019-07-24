<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template5/eventofixodetalhado.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Detalhes do evento fixo</h1>
        </div>
    </div>
</div>

<div id="content">	
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list">
                <div class="post">
                    <h2 class="title"><?php echo e($eventofixo->nome); ?></h2>
                    <p class="meta">
                        <span>Horário e local: <a class="author" title="" href="#"><?php echo e($eventofixo->dados_horario_local); ?></a></span>
                    </p>
                    <p class="image"> 
                        <a href="<?php echo e(($eventofixo->foto != null) ? "/storage/eventos/".$eventofixo->foto : "/storage/no-event.jpg"); ?>" rel="example_group">
                            <img src="<?php echo e(($eventofixo->foto != null) ? "/storage/eventos/".$eventofixo->foto : "/storage/no-event.jpg"); ?>" width="628" height="242" alt="" title="" />
                        </a>
                    </p>
                    <p><?php echo e($eventofixo->descricao); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template5', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>