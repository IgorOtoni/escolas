<?php $__env->startPush('script'); ?>
<!-- InputFilePTBR -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.min.css')); ?>">
<!-- InputFilePTBR Confirm Dialog -->
<link href="<?php echo e(asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.css')); ?>" rel="stylesheet" type="text/css" />

<!-- SummerNote -->
<link href="<?php echo e(asset('template_adm/bower_components/summernote/summernote-bs4.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('template_adm/bower_components/summernote/summernote-bs4.min.js')); ?>"></script>

<!-- CKEditor -->
<!--<script src="<?php echo e(asset('template_adm/bower_components/ckeditor/ckeditor.js')); ?>"></script>-->
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
        allowedFileExtensions: ["jpeg", "jpg", "png", "gif"],
        initialPreview: [
            <?php foreach($fotos as $foto){ ?>
                "<?php echo e('data:image;base64,'.base64_encode($foto->foto)); ?>",
            <?php } ?>
        ],
        //deleteUrl: "<?php echo e('/storage'); ?>",
        //uploadExtraData:{'_token':$("#csrf_token").val()},
        initialPreviewAsData: true,
        //initialPreviewFileType: "image",
        initialPreviewConfig: [
            <?php $x = 0; foreach($fotos as $foto){ $x++; ?>
                {caption: "<?php echo e($foto->foto); ?>", extra: {id: <?php echo e($foto->id); ?>, foto: "<?php echo e($foto->foto); ?>", _token: $("#csrf_token").val()}, size: 215000, width: "120px", url: "<?php echo e(route('usuario.excluirFotoPublicacao')); ?>", key: <?php echo e($x); ?>},
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

    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    /*var editor = CKEDITOR.replace('editor', {
        language: 'pt-br',
        //filebrowserBrowseUrl: '/template_adm/bower_components/ckeditor/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '/template_adm/bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        //filebrowserWindowWidth: '1000',
        //filebrowserWindowHeight: '700'
    });*/
    /*CKEDITOR.instances.editor.setData( "<?php echo e(limpa_html($publicacao->html)); ?>", function()
    {
        this.checkDirty();  // true
    });*/
    //CKFinder.setupCKEditor( editor );

    $('.summernote').summernote({
        height: 500,
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
        Editar publicação
        <!--<small>it all starts here</small>-->
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form id="editarPublicacaoFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('usuario.atualizarPublicacao')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" id="id" value="<?php echo e($publicacao->id); ?>">
        <div class="box">
            <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input value="<?php echo e($publicacao->nome); ?>" name="nome" type="text" class="form-control" placeholder="Nome" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label >Conteúdo da publicação</label>
                        <textarea name="html" id="editor" class="form-control summernote"><?php echo e(limpa_html($publicacao->html)); ?></textarea>
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Galeria</label>
                        <input type="hidden" id="csrf_token" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input name="galeria[]" type="file" id="input_img" multiple>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="<?php echo e(route('usuario.publicacoes')); ?>" class="btn btn-warning pull-left">Cancelar</a>
                <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
            </div>
        </div>
        </form>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.usuario.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/usuario/editarpublicacao.blade.php ENDPATH**/ ?>