<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template6/galeria.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<script type="text/javascript" src="<?php echo e(asset('template_site/template-branco/vendor/galleria/galleria-1.3.5.min.js')); ?>"></script><!-- Galleria -->
<script>
	// Galleria Gallery Call
	Galleria.loadTheme('<?php echo e(asset('template_site/template-branco/vendor/galleria/themes/classic/galleria.classic.min.js')); ?>');
	Galleria.configure({
		imageCrop: true,
		lightbox: true
	});
	Galleria.run('.galleria', {
		dataConfig: function(img) {
			return {
				description: $(img).next('p').html()
			}
		}
	});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Content -->
<div class="main" role="main">
<div id="content" style="padding:0;" class="content full">
	<div class="container">
	  	<h1>Galerias</h1>
	  	<hr class="sm">
	</div>
  	<?php
  	if($galerias != null && sizeof($galerias) != 0){
		foreach($galerias as $galeria){
    	?>
    	<div class="container">
	    	<h3><?php echo e($galeria->nome); ?></h3>
	  		<hr class="sm">
	  		<p><?php echo e($galeria->descricao); ?><br><span class="meta-data"><i class="fa fa-calendar"></i> Adicionada <?php echo e(\Carbon\Carbon::parse($galeria->data)->diffForHumans()); ?></span></p>
  		</div>
	  	<ul class="galleria fullheight wheighter">
	  		<?php 
            $fotos_ = $fotos[$galeria->id];
            $x = 0;
            foreach($fotos_ as $foto){ ?>

		        <li>
		        	<img src="<?php echo e('/carrega_imagem/1300,700,galerias,'.$foto->foto); ?>">
		        </li>

		        <?php $x++;
            }
            ?>
	        <li>
	 	</ul>

	 	<?php
		}
	}
	?>
	<div class="container">
 		<?php echo e($galerias->appends(request()->query())->links()); ?>

	</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template6', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>