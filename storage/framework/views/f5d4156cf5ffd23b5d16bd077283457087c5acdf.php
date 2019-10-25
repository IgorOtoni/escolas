<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template6/midiadetalhado.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Detalhes do sermão</h1>
  			<hr class="sm">
  			<h3><?php echo e($midia->nome); ?></h3>
  			<hr class="sm">
            <div class="row">
            	<div class="col-md-12">
	        		<a href="<?php echo e($midia->link); ?>"><iframe frameborder="0" width="800" height="400" src="<?php echo e($midia->link); ?>"></iframe></a>
	                <p>
	                	<?php echo e($midia->descricao); ?><br/>
	        			<span class="meta-data"><i class="fa fa-calendar"></i> Adicionado <?php echo e(\Carbon\Carbon::parse($midia->created_at)->diffForHumans()); ?></span>
	        		</p>
        		</div>
        	</div>
    	</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template6', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>