<?php /* C:\xampp\htdocs\adm_eglise\resources\views\usuario\editarbanner.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/select2/dist/css/select2.min.css')); ?>">
<!-- InputFilePTBR -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.min.css')); ?>">
<!-- InputFilePTBR Confirm Dialog -->
<link href="<?php echo e(asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.css')); ?>" rel="stylesheet" type="text/css" />

<!-- Select2 -->
<script src="<?php echo e(asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
<!-- InputFilePTBR -->
<script src="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/input.file.js/locales/pt-BR.js')); ?>"></script>
<!-- InputFilePTBR Confirm Dialog -->
<script src="<?php echo e(asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.js')); ?>"></script>

<script>
$(function(){
    $('.select2').select2();

    $('input[type=file]').fileinput({
        language: "pt-BR",
        //minImageCount: 0,
        //maxImageCount: 1,
        allowedFileExtensions: ["jpg", "png", "gif"],
        initialPreview: [
            "<?php echo e('/storage/banners/'.$banner->foto); ?>",
        ],
        deleteUrl: "<?php echo e('/storage'); ?>",
        uploadExtraData:{'_token':$("#csrf_token").val()},
        initialPreviewAsData: true,
        //initialPreviewFileType: "image",
        initialPreviewConfig: [
            {caption: "<?php echo e($banner->foto); ?>", extra: {id: <?php echo e($banner->id); ?>, foto: "<?php echo e($banner->foto); ?>", _token: $("#csrf_token").val()}, size: 215000, width: "120px", url: "/usuario/excluirFotoBanner", key: 1},
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

    $('#editarBannerFormulario').validator({
        update: true,
        ignore: [':disabled', ':hidden', ':not(:visible)'],
        rules: {
        //Rules
        },
        messages: {
        //messages
        }
    });

    $("#editarBannerFormulario #modulos_area").css('display', 'none');
    $("#editarBannerFormulario #modulo").attr('data-validate', 'false');

    $("#editarBannerFormulario #publicacoes_area").css('display', 'none');
    $("#editarBannerFormulario #publicacao").attr('data-validate', 'false');

    $("#editarBannerFormulario #eventos_area").css('display', 'none');
    $("#editarBannerFormulario #evento").attr('data-validate', 'false');

    $("#editarBannerFormulario #eventosfixos_area").css('display', 'none');
    $("#editarBannerFormulario #eventofixo").attr('data-validate', 'false');

    $("#editarBannerFormulario #noticias_area").css('display', 'none');
    $("#editarBannerFormulario #noticia").attr('data-validate', 'false');

    $("#editarBannerFormulario #sermoes_area").css('display', 'none');
    $("#editarBannerFormulario #sermao").attr('data-validate', 'false');

    $("#editarBannerFormulario #url_externa_area").css('display', 'none');
    $("#editarBannerFormulario #url").attr('data-validate', 'false');

    $('#editarBannerFormulario #link').on('change', function (event) {
        $("#editarBannerFormulario #modulos_area").css('display', 'none');
        $("#editarBannerFormulario #modulo").attr('data-validate', 'false');

        $("#editarBannerFormulario #publicacoes_area").css('display', 'none');
        $("#editarBannerFormulario #publicacao").attr('data-validate', 'false');

        $("#editarBannerFormulario #eventos_area").css('display', 'none');
        $("#editarBannerFormulario #evento").attr('data-validate', 'false');

        $("#editarBannerFormulario #eventosfixos_area").css('display', 'none');
        $("#editarBannerFormulario #eventofixo").attr('data-validate', 'false');

        $("#editarBannerFormulario #noticias_area").css('display', 'none');
        $("#editarBannerFormulario #noticia").attr('data-validate', 'false');

        $("#editarBannerFormulario #sermoes_area").css('display', 'none');
        $("#editarBannerFormulario #sermao").attr('data-validate', 'false');

        $("#editarBannerFormulario #galerias_area").css('display', 'none');
        $("#editarBannerFormulario #galeria").attr('data-validate', 'false');

        $("#editarBannerFormulario #url_externa_area").css('display', 'none');
        $("#editarBannerFormulario #url").attr('data-validate', 'false');

        op = $("#editarBannerFormulario #link").css('display', 'block');
        if(op == 1){
            $("#editarBannerFormulario #modulos_area").css('display', 'block');
            $("#editarBannerFormulario #modulo").attr('data-validate', 'true');
        }else if(op == 2){
            $("#editarBannerFormulario #publicacoes_area").css('display', 'block');
            $("#editarBannerFormulario #publicacao").attr('data-validate', 'true');
        }else if(op == 3){
            $("#editarBannerFormulario #eventos_area").css('display', 'block');
            $("#editarBannerFormulario #evento").attr('data-validate', 'true');
        }else if(op == 4){
            $("#editarBannerFormulario #eventosfixos_area").css('display', 'block');
            $("#editarBannerFormulario #eventos").attr('data-validate', 'true');
        }else if(op == 5){
            $("#editarBannerFormulario #noticias_area").css('display', 'block');
            $("#editarBannerFormulario #noticia").attr('data-validate', 'true');
        }else if(op == 6){
            $("#editarBannerFormulario #sermoes_area").css('display', 'block');
            $("#editarBannerFormulario #sermao").attr('data-validate', 'true');
        }else if(op == 7){
            $("#editarBannerFormulario #galerias_area").css('display', 'block');
            $("#editarBannerFormulario #galeria").attr('data-validate', 'true');
        }else if(op == 8){
            $("#editarBannerFormulario #url_externa_area").css('display', 'block');
            $("#editarBannerFormulario #url").attr('data-validate', 'true');
        }

        $('#editarBannerFormulario').validator('update');
        $('#editarBannerFormulario').validator('validate');
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
        Editar banner
        <!--<small>it all starts here</small>-->
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form id="editarBannerFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('usuario.atualizarBanner')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" id="id" value="<?php echo e($banner->id); ?>">
        <div class="box">
            <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nome" value="<?php echo e($banner->nome); ?>" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                    <label >Ordem</label>
                    <input id="ordem" name="ordem" type="number" min="1" class="form-control" placeholder="Ordem" value="<?php echo e($banner->ordem); ?>" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição" required><?php echo e($banner->descricao); ?></textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label >Link atual</label>
                    <input value="<?php echo e($banner->link); ?>" id="link_atual" type="text" class="form-control" placeholder="Link atual" disabled>
                    </div>
                </div>
                <div id="link_area" class="col-md-12">
                    <div class="form-group has-feedback">
                    <label >Tipo de link</label>
                    <select id="link" name="link" class="form-control select2" style="width: 100%;" required>
                        <option value="0" selected>Sem link</option>
                        <option value="1">Link para módulo do sistema</option>
                        <option value="2">Link para publicação</option>
                        <option value="3">Link para evento</option>
                        <option value="4">Link para evento fixo</option>
                        <option value="5">Link para notícia</option>
                        <option value="6">Link para sermão</option>
                        <option value="7">Link para galeria</option>
                        <option value="8">Link externo</option>
                    </select>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div id="modulos_area" class="col-md-12">
                    <div class="form-group has-feedback">
                    <label >Módulos</label>
                    <select id="modulo" name="modulo" class="form-control select2" style="width: 100%;" required>
                        <?php $__currentLoopData = $modulos_igreja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modulo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($modulo->id); ?>"><?php echo e($modulo->nome); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div id="publicacoes_area" class="col-md-12">
                    <div class="form-group has-feedback">
                    <label >Publicações</label>
                    <select id="publicacao" name="publicacao" class="form-control select2" style="width: 100%;" required>
                        <?php $publicacoes = App\TblPublicacoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                        <?php $__currentLoopData = $publicacoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicacao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($publicacao->id); ?>"><?php echo e($publicacao->nome); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div id="eventos_area" class="col-md-12">
                    <div class="form-group has-feedback">
                    <label >Eventos</label>
                    <select id="evento" name="evento" class="form-control select2" style="width: 100%;" required>
                        <?php $eventos = App\TblEventos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                        <?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($evento->id); ?>"><?php echo e($evento->nome); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div id="eventosfixos_area" class="col-md-12">
                    <div class="form-group has-feedback">
                    <label >Eventos fixos</label>
                    <select id="eventofixo" name="eventofixo" class="form-control select2" style="width: 100%;" required>
                        <?php $eventosfixos = App\TblEventosFixos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                        <?php $__currentLoopData = $eventosfixos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eventofixo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($eventofixo->id); ?>"><?php echo e($eventofixo->nome); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div id="noticias_area" class="col-md-12">
                    <div class="form-group has-feedback">
                    <label >Notícias</label>
                    <select id="noticia" name="noticia" class="form-control select2" style="width: 100%;" required>
                        <?php $noticias = App\TblNoticias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                        <?php $__currentLoopData = $noticias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noticia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($noticia->id); ?>"><?php echo e($noticia->nome); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div id="sermoes_area" class="col-md-12">
                    <div class="form-group has-feedback">
                    <label >Sermões</label>
                    <select id="sermao" name="sermao" class="form-control select2" style="width: 100%;" required>
                        <?php $sermoes = App\TblSermoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                        <?php $__currentLoopData = $sermoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sermao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sermao->id); ?>"><?php echo e($sermao->nome); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div id="galerias_area" class="col-md-12">
                    <div class="form-group has-feedback">
                    <label >Galerias</label>
                    <select id="galeria" name="galeria" class="form-control select2" style="width: 100%;" required>
                        <?php $galerias = App\TblGalerias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                        <?php $__currentLoopData = $galerias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galeria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($galeria->id); ?>"><?php echo e($galeria->nome); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div id="url_externa_area" class="col-md-12">
                    <div class="form-group has-feedback">
                    <label >Url externa</label>
                    <input id="url" name="url" type="text" class="form-control" placeholder="Url externa" required>
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
                        <input src="<?php echo e('/storage/banners/'.$banner->foto); ?>" name="foto" type="file" id="input_img">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>
                
            </div>
            <div class="box-footer">
                <a href="/usuario/banners" class="btn btn-warning pull-left">Cancelar</a>
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