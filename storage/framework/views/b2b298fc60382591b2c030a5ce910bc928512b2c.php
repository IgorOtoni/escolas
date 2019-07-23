<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/error.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="error-page">
        <h2 class="headline text-red">Erro</h2>

        <div class="error-content">
        <h3><i class="fa fa-warning text-red"></i>Você não possui acesso à página solicitada ou ela está indisponível. Em caso de dúvida procure o administrador do sistema.</h3>

        </div>
    </div>
    <!-- /.error-page -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.usuario.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>