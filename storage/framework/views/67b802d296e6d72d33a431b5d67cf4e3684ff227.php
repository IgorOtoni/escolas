<?php /* C:\xampp\htdocs\adm_eglise\resources\views\usuarios\edit.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/select2/dist/css/select2.min.css')); ?>">

<!-- Select2 -->
<script src="<?php echo e(asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>

<script>
$(function(){
    $('.select2').select2();
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

    <form id="editarUsuarioFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('usuarios.atualizar')); ?>" enctype="multipart/form-data">
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
                <select id="perfil" name="perfil" class="form-control select2" style="width: 100%;" required>
                    <?php 
                    //$perfis = App\TblPerfil::orderBy('nome','ASC')->get();
                    $perfis = \DB::table('tbl_perfis')
                        ->select('tbl_perfis.*', 'tbl_igrejas.nome as nome_congregacao')
                        ->leftJoin('tbl_igrejas','tbl_igrejas.id','=','tbl_perfis.id_igreja')
                        ->orderBy('nome', 'ASC')
                        ->get();
                    ?>
                    <?php $__currentLoopData = $perfis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perfil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($perfil->id); ?>" <?php echo e(($perfil->id == $usuario->id_perfil) ? 'selected' : ''); ?>><?php echo e($perfil->nome); ?> - <?php echo e(($perfil->id_igreja == null || $perfil->id_igreja == 1) ? "Administador" : $perfil->nome_congregacao); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            </div>
        </div>
        <div class="box-footer">
            <a href="/admin/usuarios" class="btn btn-warning pull-left">Cancelar</a>
            <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
        </div>
    </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_site.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>