<?php /* E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/usuario/vendas.blade.php */ ?>
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
    return '<div class=" table-responsive"><table class="table table-bordered">'+
        '<tr>'+
            '<th>Comprador:</th>'+
            '<th>Valor:</th>'+
            '<th>Data:</th>'+
            '<th>Turno:</th>'+
            '<th>Situação:</th>'+
            '<th>Qtd. produtos:</th>'+
            '<th>Desconto:</th>'+
            '</tr>'+
        '<tr>'+
            '<td>'+valida(d.nome)+'</td>'+
            '<td>R$ '+valida(d.valor)+'</td>'+
            '<td>'+valida(d.data)+'</td>'+
            '<td>'+valida(d.turno)+'</td>'+
            '<td>'+valida(d.situacao)+'</td>'+
            '<td>'+valida(d.oferta)+'</td>'+
            '</tr>'+
        '</table></div>';
}

function valida(txt){
  return (txt ? txt : '<span class="label bg-red">Não informado</span>')
}

$(function(){

    var table = $('#tbl_vendas').DataTable({
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
        'ajax': '<?php echo e(route('usuario.tbl_vendas')); ?>',
        'columns': [
                {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
                },
                { data: 'id', name: 'id' },
                { data: 'comprador', name: 'comprador' },
                { data: 'valor_total', name: 'valor_total' },
                { data: 'data', name: 'data' },
                { data: 'turno', name: 'turno' },
                { data: 'situacao', name: 'situacao' },
                { data: 'qtd_produtos', name: 'qtd_produtos' },
                { data: 'action', name: 'action' },
                ],
                order: [[1, 'asc']]
    });

    // Add event listener for opening and closing details
    $('#tbl_vendas tbody').on('click', 'td.details-control', function () {
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
<div class="content-wrapper">
<section class="content-header">
    <h1>
    Vendas
    <small>Lista de todas as vendas</small>
    </h1>
</section>

<section class="content">

    <div class="box">
    <div class="box-header with-border">

	</div>
    <div class="box-body">
        <table id="tbl_vendas" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Expandir</th>
            <th>#</th>
            <th>Comprador</th>
            <th>Valor (R$)</th>
            <th>Data</th>
            <th>Turno</th>
            <th>Situação</th>
            <th>Qtd. produtos</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        
        </tbody>
        </table>
    </div>
    <div class="box-footer">
        Footer
    </div>
    </div>

</section>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.usuario.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>