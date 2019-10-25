<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template4/apresentacao.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="bg-level-2-full-width-container kids_bottom_content">
	<div class="bg-level-2-page-width-container l-page-width no-padding">
		<section class="kids_bottom_content_container">
			<div class="header_container">  
				<h1>Apresentação</h1>
			</div>
			<div class="entry-container" style="min-height: 150px">

				<h1>Sobre nós</h1>
				
				<p>
					<?php echo e($site->texto_apresentativo); ?>

				</p>

			</div>

	    	<div class="header_container">  
				<h1>Membros</h1>
			</div>

			<div class="gl_col_4">
				<?php if($funcoes != null && sizeof($funcoes) > 0): ?>
	                <ul id="gallery">

	                	<?php $x=0; foreach ($funcoes as $funcao){ $x++; ?>
	                		<?php $__currentLoopData = $membros[$funcao->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	                        <li data-categories="print" class="gallery-item">

		                    	<h3><?php echo e($membro->nome); ?> (<?php echo e($funcao->nome); ?>)</h3>
	                            
	                            <div class="border-shadow">
	                                <figure>
	                                    <a target="_blank" class="prettyPhoto kids_picture" href="/storage/membros/<?php echo e($membro->foto); ?>">
	                                        <img width="202" height="138" src="/storage/membros/<?php echo e($membro->foto); ?>" alt="" />
	                                    </a>										
	                                </figure>
	                            </div>
	                            
		                    	<p><?php echo e($membro->descricao); ?></p>

	                            <?php if($membro->facebook != null): ?>
	                                <a href="<?php echo e($membro->facebook); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
	                            <?php endif; ?>
	                            <?php if($membro->twitter != null): ?>
	                                <a href="<?php echo e($membro->twitter); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
	                            <?php endif; ?>
	                            <?php if($membro->youtube != null): ?>
	                                <a href="<?php echo e($membro->youtube); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a>
	                            <?php endif; ?>
	                            
	                        </li>

	                		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	            		<?php } ?>

	            	</ul>
	            <?php endif; ?>
	        </div>

	    </section>

	</div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>