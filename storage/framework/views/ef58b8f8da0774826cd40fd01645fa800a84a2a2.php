<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template7/contato.blade.php */ ?>
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
                        <h2 class="bradcaump-title">Contato</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<section class="page__contact bg--white pb--150 pt--180">
	<div class="container">
		<div class="row">
			<!-- Start Single Address -->
			<div class="col-md-6 col-sm-6 col-12 col-lg-4">
				<div class="address location">
					<div class="ct__icon">
						<i class="fa fa-home"></i>
					</div>
					<div class="address__inner">
						<h2>Endereço</h2>
						<p>Cidade: <?php echo e($site->cidade); ?> - <?php echo e($site->estado); ?>, bairro: <?php echo e($site->bairro); ?>, rua: <?php echo e($site->rua); ?>, n°: <?php echo e($site->num); ?></p>
					</div>
				</div>
			</div>
			<!-- End Single Address -->
			<?php if($site->telefone != null): ?>
				<!-- Start Single Address -->
				<div class="col-md-6 col-sm-6 col-12 col-lg-4 xs-mt-60">
					<div class="address phone">
						<div class="ct__icon">
							<i class="fa fa-phone"></i>
						</div>
						<div class="address__inner">
							<h2>Telefone</h2>
							<p><?php echo e($site->telefone); ?></p>
						</div>
					</div>
				</div>
				<!-- End Single Address -->
			<?php endif; ?>
			<?php if($site->email != null): ?>
				<!-- Start Single Address -->
				<div class="col-md-6 col-sm-6 col-12 col-lg-4 md-mt-60 sm-mt-60">
					<div class="address email">
						<div class="ct__icon">
							<i class="fa fa-envelope"></i>
						</div>
						<div class="address__inner">
							<h2>Email</h2>
							<p><?php echo e($site->email); ?></p>
						</div>
					</div>
				</div>
				<!-- End Single Address -->
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- Start Contact Form -->
<section class="contact__box section-padding--lg" style="background-color: #0095e8;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<div class="section__title text-center">
					<h2 class="title__line">Envie uma mensagem</h2>
				</div>
			</div>
		</div>
		<div class="row mt--80">
			<div class="col-lg-12">
			<div class="contact-form-wrap">
                    <form id="contact-form" action="/<?php echo e($site->url); ?>/enviaContato" method="get">
                        <div class="single-contact-form name">
                            <input type="text" name="nome" placeholder="Nome" required>
                            <input type="email" name="email" placeholder="Email" required>
                            <input type="email" name="telefone" placeholder="Telefone" required>
                        </div>
                        <div class="single-contact-form message">
                            <textarea name="mensagem"  placeholder="Mensagem" required=""></textarea>
                        </div>
                        <div class="contact-btn">
                            <button type="submit" class="dcare__btn">Enviar</button>
                        </div>
                    </form>
                </div> 
                <div class="form-output">
                    <p class="form-messege"></p>
                </div>
			</div>
		</div>
	</div>
</section>
<!-- End Contact Form -->

<div class="contact__map">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="google__map">
					<iframe width="100%" height="500px" src="https://maps.google.com/?ie=UTF8&amp;q=<?php echo e(muda_cep($site->cep)); ?>&amp;t=m&amp;z=14&amp;output=embed"></iframe>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template7', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>