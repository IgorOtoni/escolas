<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template6/contato.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container" style="margin-bottom: 20px">
            <div class="row">
            	<div class="col-md-4 col-sm-5">
                	<h2>Informações de contato</h2>
                	<hr class="sm">
                	<h4 class="short accent-color">Endereço:</h4>
                	<p>
                		Cidade: <?php echo e($igreja->cidade); ?> - <?php echo e($igreja->estado); ?><br />
                        Bairro: <?php echo e($igreja->bairro); ?><br />
                        Rua: <?php echo e($igreja->rua); ?>, n°: <?php echo e($igreja->num); ?>

                    </p>
                    <hr class="fw cont">
                    <h4 class="short accent-color">Telefone:</h4>
                	<p><?php echo e($igreja->telefone); ?></p>
                    <hr class="fw cont">
                    <h4 class="short accent-color">Email:</h4>
                	<p><?php echo e($igreja->email); ?></p>
               	</div>
                <div class="col-md-8 col-sm-7">
                	<h3>Enviar uma mensagem</h3>
                   	<form method="get" class="contact-form clearfix" action="/<?php echo e($igreja->url); ?>/enviaContato">
                    	<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="nome"  class="form-control input-lg" placeholder="Nome" required>
                                </div>
                            </div>
                       	</div>
                    	<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" name="email"  class="form-control input-lg" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="telefone" class="form-control input-lg" placeholder="Telefone" required>
                                </div>
                            </div>
                      	</div>
                    	<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea cols="6" rows="7" name="mensagem" class="form-control input-lg" placeholder="Message" required></textarea>
                                </div>
                            </div>
                      	</div>
                    	<div class="row">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Enviar">
                            </div>
                      	</div>
            		</form>
                    <div class="clearfix"></div>
                </div>
           	</div>
       	</div>
       	<div class="container">
       		<div class="row">
                <div class="col-md-12">
		            <div id=gmap>
		            	<iframe width="100%" height="400px" id="googleMap" src="https://maps.google.com/?ie=UTF8&amp;q=<?php echo e(muda_cep($igreja->cep)); ?>&amp;t=m&amp;z=14&amp;output=embed" allowfullscreen></iframe>
		            </div>
	            </div>
            </div>
       	</div>
    </div>
</div>
<!-- End Body Content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template6', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>