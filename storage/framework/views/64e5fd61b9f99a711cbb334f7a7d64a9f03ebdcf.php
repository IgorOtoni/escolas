<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template7/apresentacao.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Choose Us Area -->
<section class="dcare__choose__us__area section-padding--lg bg--white">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<div class="section__title text-center">
					<h2 class="title__line">Sobre nós</h2>
					<p><?php echo e($site->texto_apresentativo); ?></p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Choose Us Area -->
<?php if($funcoes != null && sizeof($funcoes) > 0){ ?>
	<!-- Start Team Area -->
	<section class="dcare__team__area pb--150 bg--white">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-md-12">
					<div class="section__title text-center">
						<h2 class="title__line">Nossa membros</h2>
					</div>
				</div>
			</div>
			<div class="row mt--40">
				<?php foreach ($funcoes as $funcao){
	            	foreach ($membros[$funcao->id] as $membro){ ?>
						<!-- Start Single Team -->
						<div class="col-lg-4 col-md-6 col-sm-6 col-12">
							<div class="team">
								<div class="team__thumb">
									<a href="#">
										<img width="370" height="377" src="<?php echo e(($membro->foto != null) ? '/storage/membros/'.$membro->foto : '/storage/no-foto.png'); ?>" alt="team images">
									</a>
									<div class="team__hover__action">
										<div class="team__hover__inner">
											<p><?php echo e($membro->descricao); ?></p>
											<ul class="dacre__social__link--2 d-flex justify-content-center">
												<?php if($membro->facebook != null): ?>
													<li class="facebook"><a href="<?php echo e($membro->facebook); ?>"><i class="fa fa-facebook"></i></a></li>
												<?php endif; ?>
												<?php if($membro->twitter != null): ?>
													<li class="twitter"><a href="<?php echo e($membro->twitter); ?>"><i class="fa fa-twitter"></i></a></li>
												<?php endif; ?>
												<?php if($membro->youtube != null): ?>
													<li class="youtube"><a href="<?php echo e($membro->youtube); ?>"><i class="fa fa-youtube"></i></a></li>
												<?php endif; ?>
											</ul>
										</div>
									</div>
								</div>
								<div class="team__details">
									<div class="team__info">
										<h6><a href="#"><?php echo e($membro->nome); ?></a></h6>
										<span><?php echo e($funcao->nome); ?></span>
									</div>
								</div>
							</div>
						</div>
						<!-- End Single Team -->
					<?php }
				} ?>
			</div>
		</div>
	</section>
	<!-- End Team Area -->
<?php } ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template7', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>