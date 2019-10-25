<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template6/eventosfixos.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Eventos fixos</h1>
  			<hr class="sm">
            <div class="row">
                <ul class="sort-destination" data-sort-id="events">
                	<?php foreach($eventos_fixos as $evento){ ?>
                        <li class="col-md-4 col-sm-6 event-list-item event-item event-dynamic grid-item format-standard celebrations">
                            <div class="grid-item-inner">
                             	<a href="/storage/<?php echo e(($evento->foto != null) ? 'eventos/'.$evento->foto  : 'no-event.jpg'); ?>" class="media-box">
                                	<img src="<?php echo e(($evento->foto != null) ? '/carrega_imagem/330,206,eventos,'.$evento->foto : '/carrega_imagem/330,206,X,no-event.jpg'); ?>" alt="">
                                </a>
                                <div class="grid-content">
                                	<h3><a href="/<?php echo e($site->url); ?>/eventofixo/<?php echo e($evento->id); ?>" class="event-title"><?php echo e($evento->nome); ?></a></h3>
                                    <span class="meta-data event-location-address"><i class="fa fa-calendar"></i> <i class="fa fa-map-marker"></i> <?php echo e($evento->dados_horario_local); ?></span>
                                </div>
                                <div class="grid-footer clearfix">
                            		<a href="/<?php echo e($site->url); ?>/eventofixo/<?php echo e($evento->id); ?>" class="pull-right btn btn-primary btn-sm">Detalhes</a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php echo e($eventos_fixos->appends(request()->query())->links()); ?>

     	</div>
    </div>
</div>
<!-- End Body Content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template6', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>