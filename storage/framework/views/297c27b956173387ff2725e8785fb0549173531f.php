<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template5/sermoes.blade.php */ ?>
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
            	<?php foreach($sermoes as $sermao){ ?>
	                <div class="post" style="min-height: 225px;">
	                	<a href="<?php echo e($sermao->link); ?>" class="image" rel="example_group">
	                    	<iframe frameborder="0" width="300" height="170" src="<?php echo e($sermao->link); ?>"></iframe>
                    	</a>
	                    <h2 class="title"><a href="/<?php echo e($igreja->url); ?>/sermao/<?php echo e($sermao->id); ?>"><?php echo e($sermao->nome); ?></a></h2>
	                    <p class="meta">
	                        <span>Adicionado: <a class="date" title="" href="#"> <?php echo e(\Carbon\Carbon::parse($sermao->created_at)->diffForHumans()); ?></a></span>
	                    </p>
	                    <div class="excerpt">
	                        <p><?php echo e($sermao->descricao); ?></p>
	                    </div>
	                    <p class="actions">
	                    	<a href="/<?php echo e($igreja->url); ?>/sermao/<?php echo e($sermao->id); ?>" class="read-more">Detalhes<span class="circle-arrow"></span></a>
	                    </p>
	                </div>
            	<?php } ?>
            	<?php echo e($sermoes->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template5', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>