<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/usuario/editarProduto.blade.php */ ?>
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
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/select2/dist/css/select2.min.css')); ?>">
<!-- Select2 -->
<script src="<?php echo e(asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>

<script>

$(function(){
    $('#input_img').fileinput({
        language: "pt-BR",
        //minImageCount: 0,
        //maxImageCount: 1,
        initialPreview: [
            <?php if($produto->icone != null){ ?>
                "<?php echo e('/storage/produtos/'.$produto->icone); ?>",
            <?php } ?>
        ],
        deleteUrl: "<?php echo e('/storage'); ?>",
        uploadExtraData:{'_token':$("#csrf_token").val()},
        initialPreviewAsData: true,
        //initialPreviewFileType: "image",
        initialPreviewConfig: [
            <?php if($produto->icone != null){ ?>
                {caption: "<?php echo e($produto->icone); ?>", extra: {id: <?php echo e($produto->id); ?>, foto: "<?php echo e($produto->icone); ?>", _token: $("#csrf_token").val()}, size: 215000, width: "120px", url: "/usuario/excluirIconeProduto", key: 1},
            <?php } ?>
        ],
        //overwriteInitial: false,
        //purifyHtml: true,
    }).on('filebeforedelete', function() {
        return new Promise(function(resolve, reject) {
            $.confirm({
                title: 'Confirmação!',
                content: 'O ícone será excluído e <b>não poderá ser recuperado</b>, deseja realmente excluír o ícone?',
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

    $('#input_img_').fileinput({
        language: "pt-BR",
        //minImageCount: 0,
        //maxImageCount: 1,
        allowedFileExtensions: ["jpeg", "jpg", "png", "gif"],
        initialPreview: [
            <?php foreach($fotos as $foto){ ?>
                "<?php echo e('/storage/fotos-produtos/'.$foto->foto); ?>",
            <?php } ?>
        ],
        //deleteUrl: "<?php echo e('/storage'); ?>",
        //uploadExtraData:{'_token':$("#csrf_token").val()},
        initialPreviewAsData: true,
        //initialPreviewFileType: "image",
        initialPreviewConfig: [
            <?php $x = 0; foreach($fotos as $foto){ $x++; ?>
                {caption: "<?php echo e($foto->foto); ?>", extra: {id: <?php echo e($foto->id); ?>, foto: "<?php echo e($foto->foto); ?>", _token: $("#csrf_token").val()}, size: 215000, width: "120px", url: "/usuario/excluirFotoProduto", key: <?php echo e($x); ?>},
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
    Editar produto
    <!--<small>it all starts here</small>-->
    </h1>
</section>

<!-- Main content -->
<section class="content">

	<form id="editarProdutoFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('usuario.atualizarProduto')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="id" id="id" value="<?php echo e($produto->id); ?>">
    <div class="box">
        <div class="box-body">
        	<div class="row">
            	<div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nome" value="<?php echo e($produto->nome); ?>" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Ícone</label>
                        <input name="icone" type="file" id="input_img" required="">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição"><?php echo e($produto->descricao); ?></textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Valor</label>
                        <input name="valor" type="number" class="form-control" placeholder="Valor" min="1" max="100" step="0.01" value="<?php echo e($produto->valor); ?>" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                		<select id="categoria" name="categoria" class="form-control select2" style="width: 100%;" required>
	                        <?php $categorias = App\TblCategoriasProdutos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
	                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                        <option value="<?php echo e($categoria->id); ?>" <?php echo e(($produto->id_categoria == $categoria->id) ? 'selected' : ''); ?>><?php echo e($categoria->nome); ?></option>
	                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      	</select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                		<select id="tipo" name="tipo" class="form-control select2" style="width: 100%;" required>
	                        <?php $tipos = App\TblTiposVendas::orderBy('nome','ASC')->get(); ?>
	                        <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                        <option value="<?php echo e($tipo->id); ?>" <?php echo e(($produto->id_tipo_venda == $tipo->id) ? 'selected' : ''); ?>><?php echo e($tipo->nome); ?></option>
	                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      	</select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                	<div class="form-group has-feedback">
                		<label>Situação</label>
                		<div class="checkbox">
		                    <label>
		                      	<input type="checkbox" name="situacao" id="situacao" value="option1" <?php echo e(($produto->situacao == true) ? 'checked' : ''); ?>>
		                      	Disnponível para venda
		                    </label>
	                  	</div>
                		<div class="help-block with-errors"></div>
            		</div>
        		</div>
        		<div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Fotos</label>
                        <input name="fotos[]" type="file" id="input_img_" multiple>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <a href="/usuario/produtos" class="btn btn-warning pull-left">Cancelar</a>
            <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
        </div>
	</div>
	</form>

</section>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.usuario.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>