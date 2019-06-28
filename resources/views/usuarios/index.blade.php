@extends('layouts.admin_site.index')
@push('script')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/select2/dist/css/select2.min.css')}}">

<!-- Select2 -->
<script src="{{asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
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
    background: url('/images/details_open.jpeg') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('/images/details_close.jpeg') no-repeat center center;
}
</style>

<script>
function switch_status(comp){
  var id = $(comp).prop('id');
  var nome = $(comp).prop('name');
  $.ajax({
    url: '/admin/usuarios/switchStatus/'+id,
    type: 'GET'
  });
  if($(comp).prop('checked') == true){
    toastr.success(nome + " teve seu status ativado!");
  }else{
    toastr.error(nome + " teve seu status desativado!");
  }
}

function format ( d ) {
    // `d` is the original data object for the row
    return '<div class="table-responsive"><table class="table table-bordered">'+
        '<tr>'+
            '<th>Nome:</th>'+
            '<th>Email:</th>'+
            '<th>Perfil:</th>'+
            '<th>Igreja:</th>'+
            '<th>Data de criação:</th>'+
            '</tr>'+
        '<tr>'+
            '<td>'+valida(d.nome)+'</td>'+
            '<td>'+valida(d.email)+'</td>'+
            '<td>'+valida(d.perfil)+'</td>'+
            '<td>'+valida_congregacao(d.igreja)+'</td>'+
            '<td>'+valida(d.created_at)+'</td>'+
            '</tr>'+
        '</table></div>';
}

function valida(txt){
  return (txt ? txt : '<span class="label bg-red">Não informado</span>')
}

function valida_congregacao(txt){
  return (txt != 'Administrador da Plataforma' ? txt : '<span class="label bg-yellow">' + txt + '</span>')
}

$(function () {

  $('.select2').select2();

  var table = $('#tbl_usuarios').DataTable({
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
    'ajax': '/admin/usuarios/tbl_usuarios',
    'columns': [
            {
              "className":      'details-control',
              "orderable":      false,
              "data":           null,
              "defaultContent": ''
            },
            { data: 'id', name: 'id' },
            { data: 'nome', name: 'nome' },
            { data: 'perfil', name: 'perfil' },
            { data: 'igreja', name: 'igreja' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' },
          ],
          order: [[1, 'asc']]
  });

  // Add event listener for opening and closing details
  $('#tbl_usuarios tbody').on('click', 'td.details-control', function () {
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

})
</script>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Usuários
    <small>Lista de todos os usuários</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="pull-right">
        <a class="btn btn-success" data-toggle="modal" data-target="#modal-incluir"><i class="fa fa-plus"></i>&nbspIncluír usuário</a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table id="tbl_usuarios" class="table table-bordered table-striped">
      <thead>
      <tr>
          <th></th>
          <th>#</th>
          <th>Nome</th>
          <th>Perfil</th>
          <th>Igreja</th>
          <th>Situação</th>
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

<div class="modal fade" id="modal-incluir">
  <form id="incluirUsuarioFormulario" data-toggle="validator" method="POST" role="form" action="{{route('usuarios.incluir')}}" enctype="multipart/form-data">
  @csrf
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Incluir usuário</h4>
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
                        <label >Email</label>
                        <input name="email" type="text" class="form-control" placeholder="Email" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label >Senha</label>
                        <input minlength="8" maxlength="32" name="senha" type="password" class="form-control" placeholder="Senha">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label >Confirmação da senha</label>
                        <input minlength="8" maxlength="32" name="senhac" type="password" class="form-control" placeholder="Confirmação da senha">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group has-feedback">
                      <label>Selecione o perfil do usuário:</label>
                      <select id="perfil" name="perfil" class="form-control select2" style="width: 100%;" required>
                        <?php 
                        //$perfis = App\TblPerfil::orderBy('nome','ASC')->get();
                        $perfis = \DB::table('tbl_perfis')
                            ->select('tbl_perfis.*', 'tbl_igrejas.nome as nome_congregacao')
                            ->leftJoin('tbl_igrejas','tbl_igrejas.id','=','tbl_perfis.id_igreja')
                            ->orderBy('nome', 'ASC')
                            ->get();
                        ?>
                        @foreach ($perfis as $perfil)
                        <option value="{{$perfil->id}}">{{$perfil->nome}} - {{($perfil->id_igreja == null || $perfil->id_igreja == 1) ? "Administador" : $perfil->nome_congregacao}}</option>
                        @endforeach
                      </select>
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