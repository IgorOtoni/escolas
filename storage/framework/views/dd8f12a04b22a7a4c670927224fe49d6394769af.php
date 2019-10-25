<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template5/apresentacao.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Visões e valores</h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="wrap">
        <div class="c-12">
            <div class="page">
                <h2>Sobre nós</h2>
                <p>
                	<?php echo e($site->texto_apresentativo); ?>

                </p>
            </div>
        </div>
    </div>

    <?php if($funcoes != null && sizeof($funcoes) > 0): ?>
    	<div class="kids_bottom_container">
    	<div class="l-page-width clearfix">
		    <div class="wrap">
		        <div class="c-12">
	                <h2>Nossa membros</h2>
	                
	                <ul class="portfolio-menu">
		                <?php $x=0; foreach ($funcoes as $funcao){ $x++; ?>
	                		<?php $__currentLoopData = $membros[$funcao->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	                		<li class="c-6 two-column <?php echo e(($x % 2 == 0) ? 'clearfix' : ''); ?>" style="min-height: 200px;">
	                			<h3><?php echo e($membro->nome); ?> (<?php echo e($funcao->nome); ?>)</h3>
	                            <p class="image" style="width: 210">
	                                <a href="<?php echo e(($membro->foto != null) ? '/storage/no-foto.png' : '/storage/membros/'.$membro->foto); ?>" rel="example_group">
	                                    <span class="gallery-2col-mask"></span>
	                                    <img height="182" width="250" title="" alt="" src="<?php echo e(($membro->foto != null) ? '/storage/no-foto.png' : '/storage/membros/'.$membro->foto); ?>" />
	                                </a>
	                            </p>
	                            <p><?php echo e($membro->descricao); ?></p>
	                        </li>

	                		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	            		<?php } ?>
            		</ul>
		        </div>
		    </div>
	    </div>
	    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template5', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>