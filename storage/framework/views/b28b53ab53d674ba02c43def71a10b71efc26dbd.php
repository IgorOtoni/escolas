<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template7/eventos.blade.php */ ?>
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
                        <h2 class="bradcaump-title">Linha do tempo</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<!-- Start upcomming Area -->
<section class="junior__upcomming__area">
	<div class="container">
		<!--<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<div class="section__title text-center">
					<h2 class="title__line">Últimos eventos</h2>
				</div>
			</div>
		</div>-->
		<div class="row upcomming__wrap mt--40">
			<?php foreach ($eventos as $key => $evento): ?>
				<!-- Start Single Upcomming Event -->
				<div class="col-lg-6 col-md-12 col-sm-12">
					<div class="upcomming__event">
						<div class="upcomming__thumb">
							<img width="100%" style="opacity: 0.5" src="<?php echo e(($evento->foto != null) ? '/storage/timeline/'.$evento->foto : '/storage/no-event.jpg'); ?>" alt="upcomming images">
							<!--<img src="<?php echo e(asset('/template_site/template-padrao-2/images/upcomming/1.png')); ?>" alt="upcomming images">-->
						</div>
						<div class="upcomming__inner">
							<h6><a href="/<?php echo e($site->url); ?>/evento/<?php echo e($evento->id); ?>"><?php echo e($evento->nome); ?></a></h6>
							<p><?php echo e($evento->descricao); ?></p>
							<ul class="event__time">
								<li><i class="fa fa-home"></i><?php echo e($evento->dados_local); ?></li>
								<li><i class="fa fa-clock-o"></i><?php echo e(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YY h:mm A')); ?></li>
							</ul>
						</div>
						<div class="event__occur">
							<img src="<?php echo e(asset('/template_site/template-padrao-2/images/upcomming/shape/1.png')); ?>" alt="shape images">
							<div class="enent__pub">
								<span class="time"><?php echo e(\Carbon\Carbon::parse($evento->dados_horario_inicio)->diffForHumans()); ?></span>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single Upcomming Event -->
			<?php endforeach ?>
		</div>
		<div class="row">
			<div class="col-md-12" style="margin-top: 50px;">
		        <?php echo e($eventos->appends(request()->query())->links()); ?>

		    </div>
	    </div>
	</div>
</section>
<!-- End upcomming Area -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template7', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>