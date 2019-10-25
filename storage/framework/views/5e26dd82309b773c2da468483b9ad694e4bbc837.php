<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template5/noticias.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Notícias</h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list blog-posts">
            	<?php foreach($noticias as $noticia){ ?>
	                <div class="post" style="min-height: 225px;">
	                    <a href="<?php echo e(($noticia->foto != null) ? "/storage/noticias/".$noticia->foto : "/storage/no-news.jpg"); ?>" class="image" rel="example_group">
	                    	<span class="post-image-mask"></span>
	                        <img src="<?php echo e(($noticia->foto != null) ? "/storage/noticias/".$noticia->foto : "/storage/no-news.jpg"); ?>" width="172" height="140" alt="" title="" />
	                    </a>
	                    <h2 class="title"><a href="/<?php echo e($site->url); ?>/noticia/<?php echo e($noticia->id); ?>"><?php echo e($noticia->nome); ?></a></h2>
	                    <p class="meta">
	                        <span>Publicada: <a class="date" title="" href="#"> <?php echo e(\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()); ?></a></span>
                            <span>Atualizada: <a class="date" title="" href="#"> <?php echo e(\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()); ?></a></span>
	                    </p>
	                    <div class="excerpt">
	                        <p><?php echo e($noticia->descricao); ?></p>
	                    </div>
	                    <p class="actions">
	                    	<a href="/<?php echo e($site->url); ?>/noticia/<?php echo e($noticia->id); ?>" class="read-more">Detalhes<span class="circle-arrow"></span></a>
	                    </p>
	                </div>
            	<?php } ?>
            	<?php echo e($noticias->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template5', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>