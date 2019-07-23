<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/eglise/index.blade.php */ ?>
<?php $__env->startSection('content'); ?>
<!-- Full Width Column -->
<div class="content-wrapper">
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
    </section>

    <div class="row" style="margin-top: 50px;">
        <div class="col-xs-12 col-md-6 text-justify" style="margin-bottom: 30px;">
            <h1>
                Plataforma para as escolas
                <!--<small>Example 2.0</small>-->
            </h1>
            <h3>Divulge sua escola pela nossa plataforma. Temos uma variedade de templates para agradar seu estilo. Possibilitamos que você apresente sua escola, divulgue contatos, notícias, vídeos, eventos e galerias para todo o público virtual.</h3>
            <a class="btn btn-primary btn-lg" href="<?php echo e(route('plataforma.formulario')); ?>"><b>CLIQUE AQUI PARA SABER MAIS</b></a>
        </div>
        <div class="col-xs-12 col-md-6">
            <center><img style="width: 85%;" src="/storage/bg-escolas.jpg"></center>
        </div>
    </div>
</div>
<!-- /.container -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('eglise.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>