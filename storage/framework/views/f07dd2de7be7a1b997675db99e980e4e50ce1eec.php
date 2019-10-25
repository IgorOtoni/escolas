<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template7/galeria.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area">
    <div class="ht__bradcaump__container">
    	<!-- <img src="images/bg-png/6.png" alt="bradcaump images">-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Galeria</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<?php foreach($galerias as $galeria){ ?>
	<!-- Start Our Gallery Area -->
	<section class="junior__gallery__area bg--white section-padding--lg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-md-12">
					<div class="section__title text-center">
						<h2 class="title__line"><?php echo e($galeria->nome); ?></h2>
						<p><?php echo e($galeria->descricao); ?><br><?php echo e(\Carbon\Carbon::parse($galeria->data)->diffForHumans()); ?></p>
					</div>
				</div>
			</div>
			<div class="row galler__wrap mt--40">
				<?php $fotos_ = $fotos[$galeria->id];
		            $x = 0;
		            foreach($fotos_ as $foto){ ?>
						<!-- Start Single Gallery -->
						<div class="col-lg-4 col-md-6 col-sm-6 col-12">
							<div class="gallery wow fadeInUp">
								<div class="gallery__thumb">
									<a href="#">
										<img width="370" height="370" src="/storage/galerias/<?php echo e($foto->foto); ?>" alt="gallery images">
									</a>
								</div>
								<div class="gallery__hover__inner">
									<div class="gallery__hover__action">
										<ul class="gallery__zoom">
											<li><a href="/storage/galerias/<?php echo e($foto->foto); ?>" data-lightbox="grportimg" data-title="My caption"><i class="fa fa-search"></i></a></li>
											<li><a href="/<?php echo e($site->url); ?>/galeria"><i class="fa fa-link"></i></a></li>
										</ul>
										<h4 class="gallery__title"><a href="/<?php echo e($site->url); ?>/galeria"><?php echo e($galeria->nome); ?></a></h4>
									</div>
								</div>
							</div>	
						</div>	
						<!-- End Single Gallery -->
				<?php $x++; } ?>
			</div>	
		</div>
	</section>
	<!-- End Our Gallery Area -->

	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<center>
					<?php echo e($galerias->appends(request()->query())->links()); ?>

				</center>
			</div>
		</div>
	</div>
<?php } ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template7', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>