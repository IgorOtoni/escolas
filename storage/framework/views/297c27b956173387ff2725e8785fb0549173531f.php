<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template5/midias.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Vídeos</h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list blog-posts">
            	<?php foreach($midias as $midia){ ?>
	                <div class="post" style="min-height: 225px;">
	                	<a href="<?php echo e($midia->link); ?>" class="image" rel="example_group">
	                    	<iframe frameborder="0" width="300" height="170" src="<?php echo e($midia->link); ?>"></iframe>
                    	</a>
	                    <h2 class="title"><a href="/<?php echo e($site->url); ?>/midia/<?php echo e($midia->id); ?>"><?php echo e($midia->nome); ?></a></h2>
	                    <p class="meta">
	                        <span>Adicionado: <a class="date" title="" href="#"> <?php echo e(\Carbon\Carbon::parse($midia->created_at)->diffForHumans()); ?></a></span>
	                    </p>
	                    <div class="excerpt">
	                        <p><?php echo e($midia->descricao); ?></p>
	                    </div>
	                    <p class="actions">
	                    	<a href="/<?php echo e($site->url); ?>/midia/<?php echo e($midia->id); ?>" class="read-more">Detalhes<span class="circle-arrow"></span></a>
	                    </p>
	                </div>
            	<?php } ?>
            	<?php echo e($midias->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template5', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>