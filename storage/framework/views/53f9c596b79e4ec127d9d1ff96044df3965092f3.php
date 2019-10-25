<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/layouts/template2/contato.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- InputMask -->
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>

<script>
$(function(){
    $('[data-mask]').inputmask();
});
</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/<?php echo e($site->url); ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contato</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Google Maps Start ##### -->
<div class="map-area mt-30">
    <iframe src="https://maps.google.com/?ie=UTF8&amp;q=<?php echo e(muda_cep($site->cep)); ?>&amp;t=m&amp;z=14&amp;output=embed" allowfullscreen></iframe>
</div>
<!-- ##### Google Maps End ##### -->

<!-- ##### Contact Area Start ##### -->
<section class="contact-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-content-area">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="contact-content contact-information">
                                <h4>Contatos</h4>
                                <p>Email: <?php if($site->email != null){ echo $site->email; }else{ ?> <span class="text-red">Não informado</span> <?php } ?> </p>
                                <p>Telefone: <?php if($site->telefone != null){ echo $site->telefone; }else{ ?> <span class="text-red">Não informado</span> <?php } ?> </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="contact-content contact-information">
                                <h4>Endereço</h4>
                                <p>Cidade: <?php echo e($site->cidade); ?> - <?php echo e($site->estado); ?></p>
                                <p>Bairro: <?php echo e($site->bairro); ?></p>
                                <p>Rua: <?php echo e($site->rua); ?>, n°: <?php echo e($site->num); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Contact Area End ##### -->

<!-- ##### Contact Form Area Start ##### -->
<div class="contact-form section-padding-0-100">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-12">
                <div class="section-heading">
                    <h2>Envie uma mensagem</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Contact Form Area -->
                <div class="contact-form-area">
                    <form action="/<?php echo e($site->url); ?>/enviaContato" id="contactForm" name="contactForm" method="get">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="contact-name">Nome completo:</label>
                                    <input name="nome" type="text" class="form-control" id="contact-name" placeholder="Nome completo" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="contact-email">Email:</label>
                                    <input type="email" class="form-control" name="email" id="contact-email" placeholder="exemplo@gmail.com" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="contact-number">Telefone:</label>
                                    <input type="text" class="form-control" name="telefone" id="contact-number" placeholder="(99) 99999-9999" data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message">Mensagem:</label>
                                    <textarea class="form-control" name="mensagem" id="message" cols="30" rows="10" placeholder="Mensagem" required></textarea>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn crose-btn mt-15">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Contact Form Area End ##### -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>