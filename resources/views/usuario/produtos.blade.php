@extends('layouts.usuario.index')
@push('script')
<!-- InputFilePTBR -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/input.file.js/fileinput.min.css')}}">
<!-- InputFilePTBR -->
<script src="{{asset('template_adm/bower_components/input.file.js/fileinput.js')}}"></script>
<script src="{{asset('template_adm/bower_components/input.file.js/locales/pt-BR.js')}}"></script>
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
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/select2/dist/css/select2.min.css')}}">
<!-- Select2 -->
<script src="{{asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

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
            '<th>Valor:</th>'+
            '<th>Tipo:</th>'+
            '<th>Categoria:</th>'+
            '<th>Situação:</th>'+
            '<th>Descrição:</th>'+
            '</tr>'+
        '<tr>'+
            '<td>'+valida(d.nome)+'</td>'+
            '<td>R$ '+valida(d.valor)+'</td>'+
            '<td>'+valida(d.tipo)+'</td>'+
            '<td>'+valida(d.categoria)+'</td>'+
            '<td>'+valida(d.situacao)+'</td>'+
            '<td>'+valida(d.descricao)+'</td>'+
            '</tr>'+
        '</table></div>';
}

function valida(txt){
  return (txt ? txt : '<span class="label bg-red">Não informado</span>')
}

$(function(){

    var table = $('#tbl_produtos').DataTable({
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
        'ajax': '{{route('usuario.tbl_produtos')}}',
        'columns': [
                {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
                },
                { data: 'id', name: 'id' },
                { data: 'nome', name: 'nome' },
                { data: 'valor', name: 'valor' },
                { data: 'tipo', name: 'tipo' },
                { data: 'categoria', name: 'categoria' },
                { data: 'situacao', name: 'situacao' },
                { data: 'action', name: 'action' },
                ],
                order: [[1, 'asc']]
    });

    // Add event listener for opening and closing details
    $('#tbl_produtos tbody').on('click', 'td.details-control', function () {
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

    $('.select2').select2();
    
    $('#incluirProdutoFormulario').validator({
        update: true,
        ignore: [],       
        rules: {
        //Rules
        },
        messages: {
        //messages
        }
    });

    $('input[type=file]').fileinput({
        language: "pt-BR",
        //minImageCount: 1,
        //maxImageCount: 1,
        //uploadUrl: "/file-upload-batch/2",
        
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
    Produtos
    <small>Lista de todos as produtos</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

	<!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
        <?php if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.incluir'))[2] == true){ ?>
            <div class="pull-right">
            <a class="btn btn-success" data-toggle="modal" data-target="#modal-incluir"><i class="fa fa-plus"></i>&nbspIncluir produto</a>
            </div>
        <?php } ?>
    </div>
    <div class="box-body">
        <table id="tbl_produtos" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Expandir</th>
            <th>#</th>
            <th>Nome</th>
            <th>Valor (R$)</th>
            <th>Tipo</th>
            <th>Categoria</th>
            <th>Situação</th>
            <th></th>
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

</div>

<!-- Modals -->
<div class="modal fade" id="modal-incluir">
<form id="incluirProdutoFormulario" data-toggle="validator" method="POST" role="form" action="{{route('usuario.incluirProduto')}}" enctype="multipart/form-data">
@csrf
    <input type="hidden" name="site" id="site" value="{{$site->id}}">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Incluir produto</h4>
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
                        <label >Ícone</label>
                        <input name="icone" type="file" id="input_img" required="">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Valor</label>
                        <input name="valor" type="number" class="form-control" placeholder="Valor" min="1" max="100" step="0.01" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                		<select id="categoria" name="categoria" class="form-control select2" style="width: 100%;" required>
	                        @foreach ($categorias as $categoria)
	                        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
	                        @endforeach
                      	</select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                		<select id="tipo" name="tipo" class="form-control select2" style="width: 100%;" required>
	                        <?php $tipos = App\TblTiposVendas::orderBy('nome','ASC')->get(); ?>
	                        @foreach ($tipos as $tipo)
	                        <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
	                        @endforeach
                      	</select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                	<div class="form-group has-feedback">
                		<label>Situação</label>
                		<div class="checkbox">
		                    <label>
		                      	<input type="checkbox" name="situacao" id="situacao" value="option1">
		                      	Disnponível para venda
		                    </label>
	                  	</div>
                		<div class="help-block with-errors"></div>
            		</div>
        		</div>
        		<div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Fotos</label>
                        <input name="fotos[]" type="file" id="input_img" multiple>
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
@endsection