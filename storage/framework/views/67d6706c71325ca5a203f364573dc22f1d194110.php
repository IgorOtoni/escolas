<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/usuario/permissoesperfil.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<script>
  $(document).ready(function() {
      $(".selecao").on("change", function () {
          if($(this).is(':checked')){
            $(this).closest('.row').find('[type=checkbox]').prop('checked', true);
          }else{
            $(this).closest('.row').find('[type=checkbox]').prop('checked', false);
          }
      });
  });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Permissões do perfil
        <!--<small>it all starts here</small>-->
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

            <form id="permissoesPerfilFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('usuario.atualizarPermissoesPerfil')); ?>" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="id_perfil" value="<?php echo e($perfil->id); ?>">
              <div class="box">
                <div class="box-body">
                
                <?php $__currentLoopData = $modulos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modulo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label ><?php echo e($modulo->nome); ?></label>&nbsp;<input type="checkbox" class="selecao" id="selecao_<?php echo e($modulo->id); ?>" style="margin: 0px 800px 2px 6px;">
                                <br>
                                <?php $__currentLoopData = $permissoes[$modulo->id]['todas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permissao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php
                                  $marcacao = '';
                                  foreach($permissoes[$modulo->id]['ativas'] as $permissao_){
                                    if($permissao->id == $permissao_->id){
                                      $marcacao = 'checked';
                                      break;
                                    }
                                  }
                                  ?>
                                  <input name="<?php echo e($modulo->id_perfis_igrejas_modulos); ?>[]" value="<?php echo e($permissao->id); ?>" type="checkbox" <?php echo e($marcacao); ?>> <?php echo e($permissao->nome); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
                </div>
                <div class="box-footer">
                  <a href="/usuario/perfis" class="btn btn-warning pull-left">Cancelar</a>
                  <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
                </div>
              </div>
      
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.usuario.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>