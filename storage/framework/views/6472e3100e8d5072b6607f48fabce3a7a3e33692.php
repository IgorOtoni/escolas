<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template6/eventofixodetalhado.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Detalhes do evento fixo</h1>
  			<hr class="sm">
  			<h3><?php echo e($eventofixo->nome); ?></h3>
  			<hr class="sm">
            <div class="row">
            	<div class="col-md-12">
	            	<a href="/storage/<?php echo e(($eventofixo->foto != null) ? 'eventos/'.$eventofixo->foto  : 'no-event.jpg'); ?>" class="media-box">
	                	<img src="<?php echo e(($eventofixo->foto != null) ? '/carrega_imagem/800,400,eventos,'.$eventofixo->foto : '/carrega_imagem/800,400,X,no-event.jpg'); ?>" alt="">
	                </a>
	                <p>
	                	<?php echo e($eventofixo->descricao); ?><br/>
	        			<span class="meta-data event-location-address"><i class="fa fa-calendar"></i> <i class="fa fa-map-marker"></i> <?php echo e($eventofixo->dados_horario_local); ?></span>
	        		</p>
        		</div>
        	</div>
    	</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template6', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>