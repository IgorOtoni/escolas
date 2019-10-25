<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template6/apresentacao.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="spacer-50"></div>
<div class="main" role="main">
<div id="content" class="content full">
	<div class="container">
       	<h2>Sobre nós</h2>
      	<hr class="sm">
       	<p><?php echo e($site->texto_apresentativo); ?></p>
       	<?php if($funcoes != null && sizeof($funcoes) > 0): ?>
        	<hr class="fw">
	        <h3>Nossa membros</h3>
	        <div class="spacer-10"></div>
	        <div class="row">
        		<?php $x=0; foreach ($funcoes as $funcao){ $x++; ?>
            		<?php $__currentLoopData = $membros[$funcao->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		            <div class="col-md-4 col-sm-4">
		              	<div class="grid-item staff-item format-standard">
		                	<div class="grid-item-inner">
		                  		<a href="<?php echo e(($membro->foto == null) ? '/storage/no-foto.png' : '/storage/membros/'.$membro->foto); ?>" class="media-box">
		                        	<?php if($membro->foto != null): ?>
	                                    <img src="/carrega_imagem/300,198,membros,<?php echo e($membro->foto); ?>" alt=""> 
	                                <?php else: ?>
	                                    <img src="/carrega_imagem/300,198,X,no-foto.png" alt=""> 
	                                <?php endif; ?>
		                       	</a>
		                  		<div class="grid-content">
		                        	<div class="staff-item-name">
		                    			<h5><?php echo e($membro->nome); ?></h5>
		                                <span class="meta-data"><?php echo e($funcao->nome); ?></span>
		                            </div>
		                            <ul class="social-icons-colored">
		                            	<?php if($membro->facebook != null): ?>
		                                	<li class="facebook"><a href="<?php echo e($membro->facebook); ?>"><i class="fa fa-facebook"></i></a></li>
	                                	<?php endif; ?>
	                            		<?php if($membro->youtube != null): ?>
		                                	<li class="vimeo"><a href="<?php echo e($membro->youtube); ?>"><i class="fa fa-vimeo-square"></i></a></li>
		                                <?php endif; ?>
	                            		<?php if($membro->twitter != null): ?>
		                                	<li class="twitter"><a href="<?php echo e($membro->twitter); ?>"><i class="fa fa-twitter"></i></a></li>
		                                <?php endif; ?>
		                            </ul>
		                    		<p><?php echo e($membro->descricao); ?></p>
		                  		</div>
		                	</div>
		              	</div>
		            </div>

		            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        		<?php } ?>
        	</div>
		<?php endif; ?>
        <div class="spacer-20"></div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template6', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>