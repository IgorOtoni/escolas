<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template7/sermoes.blade.php */ ?>
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
                        <h2 class="bradcaump-title">Vídeos</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<!-- Start Our Gallery Area -->
<section class="junior__gallery__area bg--white">
	<div class="container">
		<!--<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<div class="section__title text-center">
					<h2 class="title__line">Vídeos</h2>
				</div>
			</div>
		</div>-->
		<div class="row galler__wrap mt--40">
			<?php foreach($sermoes as $sermao){ ?>
				<!-- Start Single Gallery -->
				<div class="col-lg-4 col-md-6 col-sm-6 col-12">
					<div class="gallery wow fadeInUp">
						<div class="gallery__thumb text-center">
							<a href="<?php echo e($sermao->link); ?>">
								<iframe width="360" height="360" frameborder="0" src="<?php echo e($sermao->link); ?>"></iframe>
							</a>
						</div>
						<div class="gallery__hover__inner">
							<div class="gallery__hover__action">
								<ul class="gallery__zoom">
									<li><a href="/<?php echo e($igreja->url); ?>/sermao/<?php echo e($sermao->id); ?>"><i class="fa fa-search"></i></a></li>
									<li><a href="/<?php echo e($sermao->link); ?>"><i class="fa fa-link"></i></a></li>
								</ul>
								<h4 class="gallery__title"><a href="/<?php echo e($igreja->url); ?>/sermao/<?php echo e($sermao->id); ?>"><?php echo e($sermao->nome); ?></a></h4>
							</div>
						</div>
					</div>	
				</div>	
				<!-- End Single Gallery -->
			<?php } ?>
		</div>
		<div class="row">
			<div class="col-md-12" style="margin-top: 50px;">
		        <?php echo e($sermoes->appends(request()->query())->links()); ?>

		    </div>
	    </div>
	</div>
</section>
<!-- End Our Gallery Area -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template7', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>