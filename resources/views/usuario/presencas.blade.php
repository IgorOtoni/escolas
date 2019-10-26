@extends('layouts.usuario.index')
@push('script')
<!-- DataTables -->
<script src="{{asset('template_adm/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template_adm/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- DataTables Plugins -->
<script src="{{asset('template_adm/bower_components/datatables.plugins/dataTables.buttons.min.js') }}"></script>
<script src="{{asset('template_adm/bower_components/datatables.plugins/buttons.html5.min.js') }}"></script>
<script src="{{asset('template_adm/bower_components/datatables.plugins/jszip.min.js') }}"></script>
<script src="{{asset('template_adm/bower_components/datatables.plugins/pdfmake.min.js') }}"></script>
<script src="{{asset('template_adm/bower_components/datatables.plugins/vfs_fonts.js') }}"></script>
<script src="{{asset('template_adm/bower_components/datatables.plugins/buttons.colVis.min.js') }}"></script>
<script src="{{asset('template_adm/bower_components/datatables.plugins/buttons.bootstrap.min.js') }}"></script>

<style>
td.details-control {
    background: url({{asset('/images/details_open.jpeg')}}) no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url({{asset('/images/details_close.jpeg')}}) no-repeat center center;
}
</style>

<script>
function format ( d ) {
    // `d` is the original data object for the row
    return '<div class=" table-responsive"><table class="table table-bordered">'+
        '<tr>'+
            '<th>Nome:</th>'+
            '<th>Parecer:</th>'+
            '</tr>'+
        '<tr>'+
            '<td>'+valida(d.nome)+'</td>'+
            '<td>'+valida(d.parecer)+'</td>'+
            '</tr>'+
        '</table></div>';
}

function valida(txt){
  return (txt ? txt : '<span class="label bg-red">Não informado</span>')
}

$(function(){

    var table = $('#tbl_presencas').DataTable({
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
            url: '{{route('usuario.tbl_presencas')}}',
            type: 'get',
            data: {
                id: '{{$reuniao->id}}',
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
                { data: 'nome', name: 'nome' },
                { data: 'parecer', name: 'parecer' },
                ],
                order: [[1, 'asc']]
    });

    // Add event listener for opening and closing details
    $('#tbl_presencas tbody').on('click', 'td.details-control', function () {
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

@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Presenças
    <small>Lista de presença da reunião: {{\Carbon\Carbon::parse($reuniao->inicio)->format('d/m/Y H:m')}} - {{\Carbon\Carbon::parse($reuniao->fim)->format('d/m/Y H:m')}}</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <h3><label>Sobre<label></h3>
            </div>
            <div class="col-md-12">
                @if($reuniao->descricao != null)
                    <h4><label>Descrição:</label> {{$reuniao->descricao}}</h4>
                @else
                    <h4><label>Descrição:</label> <span class="label bg-red">Não informado</span></h4>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if($reuniao->observacao != null)
                    <h4><label>Observação:</label> {{$reuniao->observacao}}</h4>
                @else
                    <h4><label>Observação:</label> <span class="label bg-red">Não informado</span></h4>
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h3><label>Dados de endereço<label></h3>
            </div>
            <div class="col-md-3">
                @if($reuniao->cidade != null)
                    <h4><label>Cidade:</label> {{$reuniao->cidade}}</h4>
                @else
                    <h4><label>Cidade:</label> <span class="label bg-red">Não informado</span></h4>
                @endif
            </div>
            <div class="col-md-3">
                @if($reuniao->cidade != null)
                    <h4><label>Bairro:</label> {{$reuniao->bairro}}</h4>
                @else
                    <h4><label>Bairro:</label> <span class="label bg-red">Não informado</span></h4>
                @endif
            </div>
            <div class="col-md-3">
                @if($reuniao->rua != null)
                    <h4><label>Rua:</label> {{$reuniao->rua}}</h4>
                @else
                    <h4><label>Rua:</label> <span class="label bg-red">Não informado</span></h4>
                @endif
            </div>
            <div class="col-md-3">
                @if($reuniao->num != null)
                    <h4><label>Número:</label> {{$reuniao->num}}</h4>
                @else
                    <h4><label>Número:</label> <span class="label bg-red">Não informado</span></h4>
                @endif
            </div>
            <div class="col-md-3">
                @if($reuniao->complemento != null)
                    <h4><label>Complemento:</label> {{$reuniao->complemento}}</h4>
                @else
                    <h4><label>Complemento:</label> <span class="label bg-red">Não informado</span></h4>
                @endif
            </div>
            <div class="col-md-3">
                @if($reuniao->cep != null)
                    <h4><label>Cep:</label> {{$reuniao->cep}}</h4>
                @else
                    <h4><label>Cpe:</label> <span class="label bg-red">Não informado</span></h4>
                @endif
            </div>
        </div>
        <hr>
        <table id="tbl_presencas" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Expandir</th>
            <th>#</th>
            <th>Nome</th>
            <th>Parecer</th>
            <!--<th>Ações</th>-->
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
@endsection