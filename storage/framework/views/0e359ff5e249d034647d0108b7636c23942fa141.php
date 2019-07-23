<?php /* C:\xampp\htdocs\adm_eglise\resources\views\usuario\editareventofixo.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- InputFilePTBR -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.min.css')); ?>">
<!-- InputFilePTBR Confirm Dialog -->
<link href="<?php echo e(asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.css')); ?>" rel="stylesheet" type="text/css" />

<!-- InputFilePTBR -->
<script src="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/input.file.js/locales/pt-BR.js')); ?>"></script>
<!-- InputFilePTBR Confirm Dialog -->
<script src="<?php echo e(asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.js')); ?>"></script>

<script>

$(function(){
    $('input[type=file]').fileinput({
        language: "pt-BR",
        //minImageCount: 0,
        //maxImageCount: 1,
        allowedFileExtensions: ["jpg", "png", "gif"],
        initialPreview: [
            <?php if($eventofixo->foto != null){ ?>
                "<?php echo e('/storage/eventos/'.$eventofixo->foto); ?>",
            <?php } ?>
        ],
        deleteUrl: "<?php echo e('/storage'); ?>",
        uploadExtraData:{'_token':$("#csrf_token").val()},
        initialPreviewAsData: true,
        //initialPreviewFileType: "image",
        initialPreviewConfig: [
            <?php if($eventofixo->foto != null){ ?>
                {caption: "<?php echo e($eventofixo->foto); ?>", extra: {id: <?php echo e($eventofixo->id); ?>, foto: "<?php echo e($eventofixo->foto); ?>", _token: $("#csrf_token").val()}, size: 215000, width: "120px", url: "/usuario/excluirFotoEventoFixo", key: 1},
            <?php } ?>
        ],
        //overwriteInitial: false,
        //purifyHtml: true,
    }).on('filebeforedelete', function() {
            return new Promise(function(resolve, reject) {
                $.confirm({
                    title: 'Confirmação!',
                    content: 'A foto será excluída e <b>não poderá ser recuperada</b>, deseja realmente excluír a foto?',
                    type: 'red',
                    buttons: {   
                        ok: {
                            btnClass: 'btn-primary text-white',
                            keys: ['enter'],
                            action: function(){
                                resolve();
                            }
                        },
                        cancel: function(){
                            //$.alert('File deletion was aborted! ' + krajeeGetCount('file-6'));
                        }
                    }
                });
            });
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
        Editar evento fixo
        <!--<small>it all starts here</small>-->
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form id="editarEventoFixoFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('usuario.atualizarEventoFixo')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" id="id" value="<?php echo e($eventofixo->id); ?>">
        <div class="box">
            <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nome" value="<?php echo e($eventofixo->nome); ?>" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                    <label >Data e local</label>
                    <input id="dados_horario_local" name="dados_horario_local" type="text" class="form-control" placeholder="Data e local" value="<?php echo e($eventofixo->dados_horario_local); ?>" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição"><?php echo e($eventofixo->descricao); ?></textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Foto</label>
                        <input type="hidden" id="csrf_token" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input src="<?php echo e('/storage/eventosfixos/'.$eventofixo->foto); ?>" name="foto" type="file" id="input_img">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>
                
            </div>
            <div class="box-footer">
                <a href="/usuario/eventosfixos" class="btn btn-warning pull-left">Cancelar</a>
                <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
            </div>
            </div>
        </form>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.usuario.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>