<?php $__env->startPush('script'); ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/select2/dist/css/select2.min.css')); ?>">

<!-- Select2 -->
<script src="<?php echo e(asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>

<script>
$(function () {

    $('#perfil').select2();
  
    $('#membro').select2();

});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Editar usuário
    <!--<small>it all starts here</small>-->
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <form id="editarUsuarioFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('usuario.atualizarUsuario')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="id" value="<?php echo e($usuario->id); ?>">
    <div class="box">
        <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <label >Nome</label>
                    <input value="<?php echo e($usuario->nome); ?>" name="nome" type="text" class="form-control" placeholder="Nome" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <label >Email</label>
                    <input value="<?php echo e($usuario->email); ?>" name="email" type="text" class="form-control" placeholder="Email" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <label >Senha</label>
                    <input minlength="8" maxlength="32" name="senha" type="password" class="form-control" placeholder="Senha">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <label >Confirmação da senha</label>
                    <input minlength="8" maxlength="32" name="senhac" type="password" class="form-control" placeholder="Confirmação da senha">
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label>Selecione o perfil do usuário:</label>
                <select id="perfil" name="perfil" class="form-control select2" required>
                    <?php $perfis = App\TblPerfil::where('id_site','=',$site->id)->orderBy('nome','ASC')->get(); ?>
                    <?php $__currentLoopData = $perfis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perfil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($perfil->id); ?>" <?php echo e(($perfil->id == $usuario->id_perfil) ? 'selected' : ''); ?>><?php echo e($perfil->nome); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
            <div class="form-group has-feedback">
                <label>Selecione o membro do usuário:</label>
                <select id="membro" name="membro" class="form-control select2" style="width: 100%;" required>
                <?php $membros = App\TblMembros::where('id_site','=',$site->id)->orderBy('nome','ASC')->get(); ?>
                <option value="0" <?php echo e($usuario->id_membro == null ? "selected" : ""); ?>>Sem membro</option>
                <?php $__currentLoopData = $membros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($membro->id); ?>" <?php echo e($usuario->id_membro == $membro->id ? "selected" : ""); ?>><?php echo e($membro->nome); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="help-block with-errors"></div>
            </div>
            </div>
            </div>
        </div>
        <div class="box-footer">
            <a href="<?php echo e(route('usuario.usuarios')); ?>" class="btn btn-warning pull-left">Cancelar</a>
            <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
        </div>
    </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.usuario.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/usuario/editarusuario.blade.php ENDPATH**/ ?>