<?php $__env->startPush('script'); ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/select2/dist/css/select2.min.css')); ?>">

<!-- Select2 -->
<script src="<?php echo e(asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>

<script>

$("#site").on("change", function(){

    var id_site = $("#site").val();

    $("#list-area").html("");

    $("#list-area").append("<div class='form-group has-feedback'><label>Selecione quais módulos da site o perfil irá acessar:</label><select id='select_2_modulos' name='modulos[]' data-placeholder='Selecione os módulos' class='form-control select2' style='width: 100%;' multiple='multiple' required></select><div class='help-block with-errors'></div></div>");

    if(id_site > 0){
        $.ajax({
            url: '<?php echo e(route('sites.carregarModulos',['id'=>''])); ?>/'+id_site,
            type: 'get',
            dataType: 'json',
            success: function(response){

                var len = 0;

                if(response['data'] != null){
                len = response['data'].length;
                }

                if(len > 0){
                for(var i=0; i<len; i++){

                    var id = response['data'][i].id;
                    var nome = response['data'][i].nome;
                    var sistema = response['data'][i].sistema;
                    var gerencial = response['data'][i].gerencial;

                    if(gerencial == true){
                    var result = "<option value="+id+">"+nome+" - "+sistema+"</option>";
                    $("#select_2_modulos").append(result);
                    }
                }
                }

            }
        });
    }

    $('#editarPerfilFormulario').validator('update');
    $('#editarPerfilFormulario').validator('validate');

    $('#editarPerfilFormulario').validator({
        update: true,
        ignore: [],       
        rules: {
            //Rules
        },
        messages: {
            //messages
        }
    });

    $('#select_2_modulos').select2();
});

$(function(){

    $('#select_2_modulos').select2();

    <?php if($perfil->id_site != null){ ?>
        var vetor = [];

        <?php
        foreach($modulos as $modulo){
            ?> vetor.push(<?php echo e($modulo->id); ?>); <?php
        }
        ?>

        $.ajax({
            url: '<?php echo e(route('sites.carregarModulos',['id'=>''])); ?>/'+<?php echo e($perfil->id_site); ?>,
            type: 'get',
            dataType: 'json',
            success: function(response){

                var len = 0;

                if(response['data'] != null){
                len = response['data'].length;
                }

                if(len > 0){
                for(var i=0; i<len; i++){

                    var id = response['data'][i].id;
                    var nome = response['data'][i].nome;
                    var sistema = response['data'][i].sistema;
                    var gerencial = response['data'][i].gerencial;

                    if(gerencial == true){
                        if(vetor.includes(id)){
                            var result = "<option value="+id+" selected>"+nome+" - "+sistema+"</option>";
                            $("#select_2_modulos").append(result);
                        }else{
                            var result = "<option value="+id+">"+nome+" - "+sistema+"</option>";
                            $("#select_2_modulos").append(result);
                        }
                    }
                }
                }

            }
        });
    <?php } ?>

    $('#editarPerfilFormulario').validator('update');
    $('#editarPerfilFormulario').validator('validate');

    $('#editarPerfilFormulario').validator({
        update: true,
        ignore: [],       
        rules: {
        //Rules
        },
        messages: {
        //messages
        }
    });

    $('#select_2_modulos').select2();
});
</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Editar perfil
        <!--<small>it all starts here</small>-->
        </h1>
    </section>
    
    <!-- Main content -->
    <section class="content">
    
        <form id="editarPerfilFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('perfis.atualizar')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" value="<?php echo e($perfil->id); ?>">
        <div class="box">
            <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input value="<?php echo e($perfil->nome); ?>" name="nome" type="text" class="form-control" placeholder="Nome" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label >Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição"><?php echo e($perfil->descricao); ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                    <label>Selecione a Site associada ao perfil:</label>
                    <select id="site" name="site" class="form-control" required>
                        <option value="-1" selected>Administrador da plataforma Église</option>
                        <?php $__currentLoopData = $sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($site->id); ?>" <?php echo e(($site->id == $perfil->id_site) ? 'selected' : ''); ?>><?php echo e($site->nome); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12" id="list-area">
                    <div class="form-group has-feedback">
                    <label>Selecione quais módulos da site o perfil irá acessar:</label>
                    <select id="select_2_modulos" name="modulos[]" data-placeholder="Selecione os módulos" class="form-control select2" style="width: 100%;" multiple="multiple" required></select>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="<?php echo e(route('perfis')); ?>" class="btn btn-warning pull-left">Cancelar</a>
                <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
            </div>
        </div>
    
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_site.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/admin/perfis/edit.blade.php ENDPATH**/ ?>