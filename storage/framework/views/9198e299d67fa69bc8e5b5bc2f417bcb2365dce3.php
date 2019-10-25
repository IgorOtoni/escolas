<?php /* E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template1/contato.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- InputMask -->
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>

<script>
$(function(){
    $('[data-mask]').inputmask();

    $('#contactform').validator('update');
});
</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- End Site Header --> 
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="/<?php echo e($site->url); ?>">Home</a></li>
        <li class="active">Contato</li>
        </ol>
    </div>
    </div>
</div>
</div>
<!-- End Nav Backed Header -->
<!-- Start Page Header -->
<div class="page-header">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <h1>Contato</h1>
    </div>
    </div>
</div>
</div>
<!-- End Page Header --> 
<!-- Start Content -->
<div class="main" role="main">
    <div id="content" class="content full">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header class="single-post-header clearfix">
                    <h2 class="post-title">Nossos contatos</h2>
                </header>
                <div class="post-content">
                    <p>Email: <?php if($site->email != null){ echo $site->email; }else{ ?> <span class="label label-danger">Não informado</span> <?php } ?> </p>
                    <p>Telefone: <?php if($site->telefone != null){ echo $site->telefone; }else{ ?> <span class="label label-danger">Não informado</span> <?php } ?> </p>
                </div>
                <header class="single-post-header clearfix">
                    <h2 class="post-title">Nossa localização</h2>
                </header>
                    <div class="post-content">
                    <p>Cidade: <?php echo e($site->cidade); ?> - <?php echo e($site->estado); ?>, bairro: <?php echo e($site->bairro); ?>, rua: <?php echo e($site->rua); ?>, <?php echo e($site->num); ?></p>
                    <div id="gmap">
                    <iframe src="https://maps.google.com/?ie=UTF8&amp;q=<?php echo e(muda_cep($site->cep)); ?>&amp;t=m&amp;z=14&amp;output=embed"></iframe>
                    </div>
                    <div class="row">
                    <h2>Envie uma mensagem</h2>
                    <form method="get" data-toggle="validator" id="contactform" name="contactform" action="/<?php echo e($site->url); ?>/enviaContato">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-6 margin-15">
                        <div class="form-group has-feedback">
                            <input type="text" id="name" name="nome"  class="form-control input-lg" placeholder="Nome" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="email" id="email" name="email"  class="form-control input-lg" placeholder="Email" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="telefone" name="telefone" class="form-control input-lg" placeholder="Telefone" data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <textarea cols="6" rows="7" id="mensagem" name="mensagem" class="form-control input-lg" placeholder="Mensagem" required></textarea>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        </div>
                        <div class="col-md-12">
                        <input type="submit" class="btn btn-primary btn-lg pull-right" value="Enviar">
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>