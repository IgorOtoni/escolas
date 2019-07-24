<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template6/noticiadetalhada.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Detalhes da notícia</h1>
  			<hr class="sm">
  			<h3><?php echo e($noticia->nome); ?></h3>
  			<hr class="sm">
            <div class="row">
            	<div class="col-md-12">
            		<a href="/storage/<?php echo e(($noticia->foto != null) ? 'noticias/'.$noticia->foto  : 'no-news.jpg'); ?>" class="media-box">
                    	<img src="<?php echo e(($noticia->foto != null) ? '/carrega_imagem/800,400,noticias,'.$noticia->foto : '/carrega_imagem/800,400,X,no-news.jpg'); ?>" alt="">
                    </a>
	                <p>
	                	<?php echo e($noticia->descricao); ?><br/>
	        			<span class="meta-data"><i class="fa fa-calendar"></i>
	                                	Publicada <?php echo e(\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()); ?>

                        </span><br/>
                        <?php if($noticia->updated_at != null){ ?>
                            <span class="meta-data"><i class="fa fa-calendar"></i>
                            	Atualizada <?php echo e(\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()); ?>

                            </span>
                        <?php } ?>
	        		</p>
        		</div>
        	</div>
    	</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template6', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>