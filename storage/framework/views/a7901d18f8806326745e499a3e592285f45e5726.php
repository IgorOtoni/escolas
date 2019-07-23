<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template5/eventosfixos.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Detalhes do evento</h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list blog-posts">
            	<?php foreach($eventos_fixos as $evento){ ?>
	                <div class="post" style="min-height: 225px;">
	                    <a href="<?php echo e(($evento->foto != null) ? "/storage/eventos/".$evento->foto : "/storage/no-event.jpg"); ?>" class="image" rel="example_group">
	                    	<span class="post-image-mask"></span>
	                        <img src="<?php echo e(($evento->foto != null) ? "/storage/eventos/".$evento->foto : "/storage/no-event.jpg"); ?>" width="172" height="140" alt="" title="" />
	                    </a>
	                    <h2 class="title"><a href="/<?php echo e($igreja->url); ?>/eventofixo/<?php echo e($evento->id); ?>"><?php echo e($evento->nome); ?></a></h2>
	                    <p class="meta">
                            <span>Horário e local: <a class="author" title="" href="#"><?php echo e($evento->dados_horario_local); ?></a></span>
	                    </p>
	                    <div class="excerpt">
	                        <p><?php echo e($evento->descricao); ?></p>
	                    </div>
	                    <p class="actions">
	                    	<a href="/<?php echo e($igreja->url); ?>/eventofixo/<?php echo e($evento->id); ?>" class="read-more">Detalhes<span class="circle-arrow"></span></a>
	                    </p>
	                </div>
            	<?php } ?>
            	<?php echo e($eventos_fixos->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template5', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>