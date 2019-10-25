<?php /* C:\xampp\htdocs\adm_eglise\resources\views\eglise\index.blade.php */ ?>
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
                Programa Église.
                <!--<small>Example 2.0</small>-->
            </h1>
            <h3>Temos uma forma fácil para você, líder, providenciar uma página de internet para sua site. Temos 10 modelos à sua disposição.  Com ela você irá manter seu público informado sobre as programações de sua site e usá-lo como um canal de evangelismo, postando suas mensagens e divulgando o evangelho de Cristo. Você poderá ainda usufruir de vários benefícios que estamos desenvolvendo para facilitar seu trabalho, como o controle do rol de membros, dízimos, etc.</h3>
            <a class="btn btn-primary btn-lg" href="<?php echo e(route('plataforma.formulario')); ?>"><b>CLIQUE AQUI PARA SABER MAIS</b></a>
        </div>
        <div class="col-xs-12 col-md-6">
            <center><img style="width: 60%;" src="/storage/bg-eglise.png"></center>
        </div>
    </div>
</div>
<!-- /.container -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('eglise.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>