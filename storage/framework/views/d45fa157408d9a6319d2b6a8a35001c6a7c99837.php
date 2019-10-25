<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/usuario/editaroferta.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/select2/dist/css/select2.min.css')); ?>">
<!-- Select2 -->
<script src="<?php echo e(asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset('template_adm/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>

<script>
$(function(){
	$('.select2').select2();

	//Date picker
    $('#datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    }).datepicker("update", "<?php echo e(muda_data_($oferta->data_inicio)); ?>");

    //Date picker
    $('#datepicker_').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    }).datepicker("update", "<?php echo e(muda_data_($oferta->data_fim)); ?>");
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Editar oferta
    <!--<small>it all starts here</small>-->
    </h1>
</section>

<!-- Main content -->
<section class="content">

	<form id="editarOfertaFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('usuario.atualizarOferta')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="id" id="id" value="<?php echo e($oferta->id); ?>">
    <div class="box">
        <div class="box-body">
        	<div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <label >Desconto</label>
                    <input name="desconto" type="number" class="form-control" placeholder="Desconto" min="1" max="100" value="<?php echo e($oferta->desconto); ?>" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
            		<select id="produto" name="produto" class="form-control select2" style="width: 100%;" required>
                        <?php $produtos = App\TblProdutos::where('id_site','=',$site->id)->orderBy('nome','ASC')->get(); ?>
                        <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($produto->id); ?>" <?php echo e($oferta->id_produto == $produto->id ? "selected" : ""); ?>><?php echo e($produto->nome); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  	</select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label >Data início:</label>
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input name="data_inicio" type="text" class="form-control pull-right datepicker" id="datepicker">
                </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label >Data fim:</label>
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input name="data_fim" type="text" class="form-control pull-right datepicker" id="datepicker_">
                </div>
                </div>
            </div>
        	</div>
    	</div>
        <div class="box-footer">
            <a href="/usuario/ofertas" class="btn btn-warning pull-left">Cancelar</a>
            <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
        </div>
	</div>
    </form>

</section>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.usuario.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>