<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/usuario/editargaleria.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
<!-- InputFilePTBR -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.min.css')); ?>">
<!-- InputFilePTBR Confirm Dialog -->
<link href="<?php echo e(asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.css')); ?>" rel="stylesheet" type="text/css" />

<!-- InputFilePTBR -->
<script src="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/input.file.js/locales/pt-BR.js')); ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset('template_adm/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
<!-- InputFilePTBR Confirm Dialog -->
<script src="<?php echo e(asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.js')); ?>"></script>

<script>

$(function(){

    //Date picker
    $('#datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    }).datepicker("update", "<?php echo e(muda_data_($galeria->data)); ?>");

    $('input[type=file]').fileinput({
        language: "pt-BR",
        //minImageCount: 0,
        //maxImageCount: 1,
        allowedFileExtensions: ["jpeg", "jpg", "png", "gif"],
        initialPreview: [
            <?php foreach($fotos as $foto){ ?>
                "<?php echo e('/storage/galerias/'.$foto->foto); ?>",
            <?php } ?>
        ],
        //deleteUrl: "<?php echo e('/storage'); ?>",
        //uploadExtraData:{'_token':$("#csrf_token").val()},
        initialPreviewAsData: true,
        //initialPreviewFileType: "image",
        initialPreviewConfig: [
            <?php $x = 0; foreach($fotos as $foto){ $x++; ?>
                {caption: "<?php echo e($foto->foto); ?>", extra: {id: <?php echo e($foto->id); ?>, foto: "<?php echo e($foto->foto); ?>", _token: $("#csrf_token").val()}, size: 215000, width: "120px", url: "/usuario/excluirFotoGaleria", key: <?php echo e($x); ?>},
            <?php } ?>
        ],
        overwriteInitial: false,
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
        Editar galeria
        <!--<small>it all starts here</small>-->
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form id="editarGaleriaFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('usuario.atualizarGaleria')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" id="id" value="<?php echo e($galeria->id); ?>">
        <div class="box">
            <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input value="<?php echo e($galeria->nome); ?>" name="nome" type="text" class="form-control" placeholder="Nome" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label >Data:</label>
                    <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input name="data" type="text" class="form-control pull-right" id="datepicker">
                    </div>
                    <!--<input id="data" name="data" type="date" class="form-control" placeholder="Ordem">-->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label >Descrição</label>
                        <textarea value="<?php echo e($galeria->descricao); ?>" name="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Fotos</label>
                        <input type="hidden" id="csrf_token" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input name="fotos[]" type="file" id="input_img" multiple>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="/usuario/galerias" class="btn btn-warning pull-left">Cancelar</a>
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