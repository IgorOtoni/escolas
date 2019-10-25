<?php /* C:\xampp\htdocs\adm_eglise\resources\views\usuario\eventos.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>">
<!-- InputFilePTBR -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.min.css')); ?>">
<!-- fullCalendar -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/fullcalendar/dist/fullcalendar.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/fullcalendar/dist/fullcalendar.print.min.css')); ?>" media="print">

<!-- bootstrap time picker -->
<script src="<?php echo e(asset('template_adm/plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
<!-- date-range-picker -->
<script src="<?php echo e(asset('template_adm/bower_components/moment/min/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<!-- InputFilePTBR -->
<script src="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/input.file.js/locales/pt-BR.js')); ?>"></script>
<!-- fullCalendar -->
<script src="<?php echo e(asset('template_adm/bower_components/moment/moment.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/fullcalendar/dist/fullcalendar.min.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/fullcalendar/dist/locale/pt-br.js')); ?>"></script>
<?php echo $calendar->script(); ?>


<script>
$(function(){

    $('input[type=file]').fileinput({
        language: "pt-BR",
        //minImageCount: 1,
        //maxImageCount: 1,
        //uploadUrl: "/file-upload-batch/2",
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

    $('#duracao').daterangepicker({ 
        timePicker24Hour: true,
        timePicker: true,
        timePickerIncrement: 30, 
        locale: {
            format: 'DD/MM/YYYY H:mm'
        },
    })

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
})
</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Linha do tempo
        <small>Lista de todos os eventos da congregação</small>
        </h1>
    </section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
        <?php if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosg'), \Config::get('constants.permissoes.incluir'))[2] == true){ ?>
            <div class="pull-right">
            <a class="btn btn-success" data-toggle="modal" data-target="#modal-incluir"><i class="fa fa-plus"></i>&nbspIncluir evento</a>
            </div>
        <?php } ?>
    </div>
    <div class="box-body">
        <?php echo $calendar->calendar(); ?>

    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modals -->
<div class="modal fade" id="modal-incluir">
<form id="incluirEventoFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('usuario.incluirEvento')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
    <input type="hidden" name="site" id="site" value="<?php echo e($site->id); ?>">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Incluir evento</h4>
        </div>
        <div class="modal-body">
        <!-- form start -->
        
            <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nome" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Data e horário de início e término:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input name="data" type="text" class="form-control pull-right" id="duracao">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors">
                        </div>
                    </div>
                    <!--<input id="data" name="data" type="date" class="form-control" placeholder="Ordem">-->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Local:</label>
                        <input name="local" type="text" class="form-control" placeholder="Local" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label >Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Foto</label>
                        <input name="foto" type="file" id="input_img">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Incluir</button>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
</div>
<!-- /.modal -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.usuario.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>