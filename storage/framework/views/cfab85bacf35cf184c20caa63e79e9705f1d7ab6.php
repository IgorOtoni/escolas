<?php /* E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/usuario/banners.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/select2/dist/css/select2.min.css')); ?>">
<!-- InputFilePTBR -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.min.css')); ?>">

<!-- Select2 -->
<script src="<?php echo e(asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
<!-- InputFilePTBR -->
<script src="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/input.file.js/locales/pt-BR.js')); ?>"></script>
<!-- DataTables -->
<script src="<?php echo e(asset('template_adm/bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
<!-- DataTables Plugins -->
<script src="<?php echo e(asset('template_adm/bower_components/datatables.plugins/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/datatables.plugins/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/datatables.plugins/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/datatables.plugins/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/datatables.plugins/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/datatables.plugins/buttons.colVis.min.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/datatables.plugins/buttons.bootstrap.min.js')); ?>"></script>

<style>
td.details-control {
    background: url(<?php echo e(asset('/images/details_open.jpeg')); ?>) no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url(<?php echo e(asset('/images/details_close.jpeg')); ?>) no-repeat center center;
}
</style>

<script>
function format ( d ) {
    // `d` is the original data object for the row
    return '<table class="table table-bordered">'+
        '<tr>'+
            '<th>Nome:</th>'+
            '<th>Descrição:</th>'+
            '</tr>'+
        '<tr>'+
            '<td>'+valida(d.nome)+'</td>'+
            '<td>'+valida(d.descricao)+'</td>'+
            '</tr>'+
        '</table>';
}

function valida(txt){
  return (txt ? txt : '<span class="label bg-red">Não informado</span>')
}

$(function(){
    $('.select2').select2();

    $('input[type=file]').fileinput({
        language: "pt-BR",
        //minImageCount: 1,
        //maxImageCount: 1,
        //uploadUrl: "/file-upload-batch/2",
        allowedFileExtensions: ["jpeg", "jpg", "png", "gif"],
    });

    $('#incluirBannerFormulario').validator({
        update: true,
        ignore: [':disabled', ':hidden', ':not(:visible)'],
        rules: {
        //Rules
        },
        messages: {
        //messages
        }
    });

    $("#modal-incluir #modulos_area").css('display', 'none');
    $("#modal-incluir #modulo").attr('data-validate', 'false');

    $("#modal-incluir #publicacoes_area").css('display', 'none');
    $("#modal-incluir #publicacao").attr('data-validate', 'false');

    $("#modal-incluir #eventos_area").css('display', 'none');
    $("#modal-incluir #evento").attr('data-validate', 'false');

    $("#modal-incluir #eventosfixos_area").css('display', 'none');
    $("#modal-incluir #eventofixo").attr('data-validate', 'false');

    $("#modal-incluir #noticias_area").css('display', 'none');
    $("#modal-incluir #noticia").attr('data-validate', 'false');

    $("#modal-incluir #sermoes_area").css('display', 'none');
    $("#modal-incluir #sermao").attr('data-validate', 'false');
    
    $("#modal-incluir #galerias_area").css('display', 'none');
    $("#modal-incluir #galeria").attr('data-validate', 'false');

    $("#modal-incluir #url_externa_area").css('display', 'none');
    $("#modal-incluir #url").attr('data-validate', 'false');

    $('#incluirBannerFormulario').validator('update');
    $('#incluirBannerFormulario').validator('validate');

    $('#modal-incluir #link').on('change', function (event) {
        $("#modal-incluir #modulos_area").css('display', 'none');
        $("#modal-incluir #modulo").attr('data-validate', 'false');

        $("#modal-incluir #publicacoes_area").css('display', 'none');
        $("#modal-incluir #publicacao").attr('data-validate', 'false');

        $("#modal-incluir #eventos_area").css('display', 'none');
        $("#modal-incluir #evento").attr('data-validate', 'false');

        $("#modal-incluir #eventosfixos_area").css('display', 'none');
        $("#modal-incluir #eventofixo").attr('data-validate', 'false');

        $("#modal-incluir #noticias_area").css('display', 'none');
        $("#modal-incluir #noticia").attr('data-validate', 'false');

        $("#modal-incluir #sermoes_area").css('display', 'none');
        $("#modal-incluir #sermao").attr('data-validate', 'false');

        $("#modal-incluir #galerias_area").css('display', 'none');
        $("#modal-incluir #galeria").attr('data-validate', 'false');

        $("#modal-incluir #url_externa_area").css('display', 'none');
        $("#modal-incluir #url").attr('data-validate', 'false');

        op = $("#modal-incluir #link").val();
        if(op == 1){
            $("#modal-incluir #modulos_area").css('display', 'block');
            $("#modal-incluir #modulo").attr('data-validate', 'true');
        }else if(op == 2){
            $("#modal-incluir #publicacoes_area").css('display', 'block');
            $("#modal-incluir #publicacao").attr('data-validate', 'true');
        }else if(op == 3){
            $("#modal-incluir #eventos_area").css('display', 'block');
            $("#modal-incluir #evento").attr('data-validate', 'true');
        }else if(op == 4){
            $("#modal-incluir #eventosfixos_area").css('display', 'block');
            $("#modal-incluir #eventofixo").attr('data-validate', 'true');
        }else if(op == 5){
            $("#modal-incluir #noticias_area").css('display', 'block');
            $("#modal-incluir #noticia").attr('data-validate', 'true');
        }else if(op == 6){
            $("#modal-incluir #sermoes_area").css('display', 'block');
            $("#modal-incluir #sermao").attr('data-validate', 'true');
        }else if(op == 7){
            $("#modal-incluir #galerias_area").css('display', 'block');
            $("#modal-incluir #galeria").attr('data-validate', 'true');
        }else if(op == 8){
            $("#modal-incluir #url_externa_area").css('display', 'block');
            $("#modal-incluir #url").attr('data-validate', 'true');
        }

        $('#incluirBannerFormulario').validator('update');
        $('#incluirBannerFormulario').validator('validate');
    });

    var table = $('#tbl_banners').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
    
        "language": {            
        "sEmptyTable":   "Nenhum registro encontrado",
        "sProcessing":   "Carregando,aguarde...",
        "sLengthMenu":   "Mostrar _MENU_ registos",
        "sZeroRecords":  "A busca não retornou nehum registro",
        "sInfo":         "Mostrando de _START_ à _END_ de um total de _TOTAL_ registros",
        "sInfoEmpty":    "Mostrando de 0 à 0 de um total 0 registros",
        "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
        "sInfoPostFix":  "",
        "sSearch":       "Pesquisar:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Primeiro",
            "sPrevious": "Anterior",
            "sNext":     "Próximo",
            "sLast":     "Último"
        },
        "oAria": {
            "sSortAscending":  ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
        },
        dom: 'Bfrtip',
        buttons: [
        { "extend": 'excelHtml5', "text":'<i class="fa fa-file-excel-o"></i>&nbsp;EXCEL',"className": 'btn btn-success' },
        { "extend": 'csvHtml5', "text":'<i class="fa fa-file-code-o"></i>&nbsp;CSV',"className": 'btn btn-warning' },
        { "extend": 'pdfHtml5', "text":'<i class="fa fa-file-pdf-o"></i>&nbsp;PDF',"className": 'btn btn-danger' },
        { "extend": 'colvis', "text":'<i class="fa fa-eye-slash"></i>&nbsp;Visibilidade',"className": 'btn btn-primary' },
            //'excelHtml5','csvHtml5','pdfHtml5'
        ],
        'processing': true,
        'autoWidth': false,
        //'serverSide': false,
        'ajax': '<?php echo e(route('usuario.tbl_banners')); ?>',
        'columns': [
                {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
                },
                { data: 'id', name: 'id' },
                { data: 'nome', name: 'nome' },
                { data: 'ordem', name: 'ordem' },
                { data: 'action', name: 'action' },
                ],
                order: [[1, 'asc']]
    });

    // Add event listener for opening and closing details
    $('#tbl_banners tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
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
    Banners
    <small>Lista de todos os banners</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
        <?php if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.bannersg'), \Config::get('constants.permissoes.incluir'))[2] == true){ ?>
            <div class="pull-right">
            <a class="btn btn-success" data-toggle="modal" data-target="#modal-incluir"><i class="fa fa-plus"></i>&nbspIncluir banner</a>
            </div>
        <?php } ?>
    </div>
    <div class="box-body table-responsive">
        <table id="tbl_banners" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Expandir</th>
            <th>#</th>
            <th>Nome</th>
            <th>Ordem</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        
        </tbody>
        </table>
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
<form id="incluirBannerFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('usuario.incluirBanner')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
    <input type="hidden" name="igreja" id="igreja" value="<?php echo e($igreja->id); ?>">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Incluir banner</h4>
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
                    <label >Ordem</label>
                    <input id="ordem" name="ordem" type="number" min="1" class="form-control" placeholder="Ordem" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição" required></textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
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
                        <option value="6">Link para vídeo</option>
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
                    <label >Vídeos</label>
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
                        <input name="foto" type="file" id="input_img" required>
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