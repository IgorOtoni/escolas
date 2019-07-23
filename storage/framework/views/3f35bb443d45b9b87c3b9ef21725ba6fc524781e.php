<?php /* C:\xampp\htdocs\adm_eglise\resources\views/usuario/reunioes.blade.php */ ?>
<?php $__env->startPush('script'); ?>
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
    background: url('/images/details_open.jpeg') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('/images/details_close.jpeg') no-repeat center center;
}
</style>

<script>
function format ( d ) {
    // `d` is the original data object for the row
    return '<div class=" table-responsive"><table class="table table-bordered">'+
        '<tr>'+
            '<th>Descrição:</th>'+
            '<th>Observação:</th>'+
            '<th>Data e horário de início:</th>'+
            '<th>Duração:</th>'+
            '</tr>'+
        '<tr>'+
            '<td>'+valida(d.descricao)+'</td>'+
            '<td>'+valida(d.observacao)+'</td>'+
            '<td>'+valida(d.inicio)+'</td>'+
            '<td>'+valida(d.duracao)+'</td>'+
            '</tr>'+
        '</table></div>';
}

function valida(txt){
  return (txt ? txt : '<span class="label bg-red">Não informado</span>')
}

$(function(){

    var table = $('#tbl_reunioes').DataTable({
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
        'ajax': { 
            url: '<?php echo e(route('usuario.tbl_reunioes')); ?>',
            type: 'get',
            data: {
                id: '<?php echo e($comunidade->id); ?>',
            }
        },
        'columns': [
                {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
                },
                { data: 'id', name: 'id' },
                { data: 'inicio', name: 'inicio' },
                { data: 'fim', name: 'fim' },
                { data: 'action', name: 'action' },
                ]/*,
                order: [[1, 'asc']]*/
    });

    // Add event listener for opening and closing details
    $('#tbl_reunioes tbody').on('click', 'td.details-control', function () {
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
    Reuniões
    <small>Lista de todas as reuniões da comunidade: <?php echo e($comunidade->nome); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
    <div class="box-body">
        <table id="tbl_reunioes" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Expandir</th>
            <th>#</th>
            <th>Data e horário de início</th>
            <th>Data e horário de término</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        
        </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        Footer
    </div>
    <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.usuario.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>