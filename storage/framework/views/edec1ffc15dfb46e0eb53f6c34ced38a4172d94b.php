<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template5/noticiadetalhada.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Notícia detalhada</h1>
        </div>
    </div>
</div>

<div id="content">	
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list">
                <div class="post">
                    <h2 class="title"><?php echo e($noticia->nome); ?></h2>
                    <p class="meta">
                        <span>Publicada: <a class="date" title="" href="#"> <?php echo e(\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()); ?></a></span>
                        <span>Atualizada: <a class="date" title="" href="#"> <?php echo e(\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()); ?></a></span>
                    </p>
                    <p class="image"> 
                        <a href="<?php echo e(($noticia->foto != null) ? "/storage/noticias/".$noticia->foto : "/storage/no-news.jpg"); ?>" rel="example_group">
                            <img src="<?php echo e(($noticia->foto != null) ? "/storage/noticias/".$noticia->foto : "/storage/no-news.jpg"); ?>" width="628" height="242" alt="" title="" />
                        </a>
                    </p>
                    <p><?php echo e($noticia->descricao); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template5', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>