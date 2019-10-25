<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template6/midias.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Vídeos</h1>
  			<hr class="sm">
            <div class="row">
            	<div class="col-md-12 col-sm-12">
                    <ul class="sermons-list">
                    	<?php foreach($midias as $midia){ ?>
	                    	<li class="sermon-item format-standard">
	                        	<div class="row">
	                            	<div class="col-md-5">
	                                	<a href="<?php echo e($midia->link); ?>"><iframe frameborder="0" width="400" height="200" src="<?php echo e($midia->link); ?>"></iframe></a>
	                                    <a href="/<?php echo e($site->url); ?>/midia/<?php echo e($midia->id); ?>" class="basic-link">Detalhes</a>
	                                </div>
	                                <div class="col-md-7">
	                                	<h3><a href="/<?php echo e($site->url); ?>/midia/<?php echo e($midia->id); ?>"><?php echo e($midia->nome); ?></a></h3>
	                                    <span class="meta-data"><i class="fa fa-calendar"></i> Adicionado <?php echo e(\Carbon\Carbon::parse($midia->created_at)->diffForHumans()); ?></span>
	                                    <p><?php echo e($midia->descricao); ?></p>
	                                </div>
	                            </div>
	                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php echo e($midias->appends(request()->query())->links()); ?>

            </div>
     	</div>
    </div>
</div>
<!-- End Body Content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template6', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>