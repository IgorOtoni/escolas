<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template4/galeria.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="kids_middle_container">

	 <div class="kids_bottom_content">

		<div class="bg-level-2-page-width-container l-page-width no-padding">
    
            <section class="kids_bottom_content_container">
    
                <div class="header_container">
                    <h1>Últimas galerias</h1>
                </div>
    
                <div class="gl_col_4">
    
                    <?php foreach($galerias as $galeria){
                        $fotos_ = $fotos[$galeria->id]; ?>
                        <ul id="gallery">

                        	<h3>Publicada <?php echo e(\Carbon\Carbon::parse($galeria->data)->diffForHumans()); ?></h3>
                        	<p><?php echo e($galeria->descricao); ?></p>
                        	
                            <?php foreach($fotos_ as $foto){ ?>

                            <li data-categories="print" class="gallery-item">
                                
                                <div class="border-shadow">
                                    <figure>
                                        <a target="_blank" class="prettyPhoto kids_picture" href="/storage/galerias/<?php echo e($foto->foto); ?>">
                                            <img width="202" height="138" src="/storage/galerias/<?php echo e($foto->foto); ?>" alt="" />
                                        </a>										
                                    </figure>
                                </div>
                                
                            </li>

                        	<?php } ?>

                    	</ul>
                    <?php } ?>
                    <!--/ gl_col_4-->
    
                    <div class="kids_clear"></div>
    
                </div><!-- .gl_col_4 -->
    
            </section><!-- .bottom_content_container -->
    
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>