<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template6/noticias.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Notícias</h1>
      		<hr class="sm">
            <div class="row">
                <ul class="sort-destination" data-sort-id="events">
                	<?php foreach($noticias as $noticia){ ?>

	                    <li class="col-md-4 col-sm-6 event-list-item event-item event-dynamic grid-item format-standard celebrations">
	                        <div class="grid-item-inner">
	                         	<a href="/storage/<?php echo e(($noticia->foto != null) ? 'noticias/'.$noticia->foto  : 'no-news.jpg'); ?>" class="media-box">
	                            	<img src="<?php echo e(($noticia->foto != null) ? '/carrega_imagem/330,206,noticias,'.$noticia->foto : '/carrega_imagem/330,206,X,no-news.jpg'); ?>" alt="">
	                            </a>
	                            <div class="grid-content">
	                            	<h3><a href="/<?php echo e($igreja->url); ?>/noticia/<?php echo e($noticia->id); ?>" class="event-title"><?php echo e($noticia->nome); ?></a></h3>
	                                <span class="meta-data"><i class="fa fa-calendar"></i>
	                                	Publicada <?php echo e(\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()); ?>

	                                </span>
	                                <?php if($noticia->updated_at != null){ ?>
		                                <span class="meta-data"><i class="fa fa-calendar"></i>
		                                	Atualizada <?php echo e(\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()); ?>

		                                </span>
	                                <?php } ?>
	                            </div>
	                            <div class="grid-footer clearfix">
	                        		<a href="/<?php echo e($igreja->url); ?>/noticia/<?php echo e($noticia->id); ?>" class="pull-right btn btn-primary btn-sm">Detalhes</a>
	                            </div>
	                        </div>
	                    </li>
                    
                    <?php } ?>
                </ul>
            </div>
            <?php echo e($noticias->appends(request()->query())->links()); ?>

     	</div>
    </div>
	</div>
<!-- End Body Content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template6', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>