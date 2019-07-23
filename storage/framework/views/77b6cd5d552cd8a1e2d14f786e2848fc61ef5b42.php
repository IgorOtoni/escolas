<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template5/sermaodetalhado.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Detalhes do vídeo</h1>
        </div>
    </div>
</div>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="content">	
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list">
                <div class="post">
                    <h2 class="title"><?php echo e($sermao->nome); ?></h2>
                    <p class="meta">
                        <span>Adicionado: <a class="date" title="" href="#"> <?php echo e(\Carbon\Carbon::parse($sermao->created_at)->diffForHumans()); ?></a></span>
                    </p>
                    <p class="image"> 
                        <a href="<?php echo e($sermao->link); ?>" class="image" rel="example_group">
	                    	<iframe frameborder="0" width="800" height="400" src="<?php echo e($sermao->link); ?>"></iframe>
                    	</a>
                    </p>
                    <p><?php echo e($sermao->descricao); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template5', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>