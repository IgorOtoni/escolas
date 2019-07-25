<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template5/galeria.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Galerias</h1>
        </div>
    </div>
</div>

<?php
if($galerias != null && sizeof($galerias) != 0){
	foreach($galerias as $galeria){
    ?>
    <div class="kids_bottom_container">
    <div class="l-page-width clearfix">
        <div class="wrap">
            <h3 style="font-family: TOONISH,Georgia,'Times New Roman',Times,serif;
            text-transform: uppercase;
            color: #f55029;">Publicada <?php echo e(\Carbon\Carbon::parse($galeria->data)->diffForHumans()); ?></h3>
            <p><?php echo e($galeria->descricao); ?></p>
        </div>
        <div class="wrap">
            <div class="c-12">
                
                <ul class="portfolio-menu">
                    <?php 
                    $fotos_ = $fotos[$galeria->id];
                    $x = 0;
                    foreach($fotos_ as $foto){ ?>

                        <li class="c-6 two-column <?php echo e(($x % 2 == 0) ? 'clearfix' : ''); ?>" style="min-height: 200px;">
                            <p class="image">
                                <a href="/storage/galerias/<?php echo e($foto->foto); ?>" rel="example_group">
                                    <span class="gallery-2col-mask"></span>
                                    <img height="182" width="446" title="" alt="" src="/storage/galerias/<?php echo e($foto->foto); ?>" />
                                </a>
                            </p>
                        </li>

                        <?php $x++;
                    }
                    ?>
                </ul>
            
            </div>    
        </div>
    </div>
    </div>
    <?php
	}
}
?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template5', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>