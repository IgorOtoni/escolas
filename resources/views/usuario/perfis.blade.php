@extends('layouts.usuario.index')
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
    url: '/usuario/switchStatusPerfil/'+id,
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
            '<th>Descrição:</th>'+
            '</tr>'+
        '<tr>'+
            '<td>'+valida(d.nome)+'</td>'+
            '<td>'+valida(d.descricao)+'</td>'+
            '</tr>'+
        '</table></div>';
}

function valida(txt){
  return (txt ? txt : '<span class="label bg-red">Não informado</span>')
}

$(function(){

    $('#select_2_modulos').select2();

    var vetor = [];

    <?php
    foreach($modulos_igreja as $modulo){
        ?> vetor.push({{$modulo->id}}); <?php
    }
    ?>

    $.ajax({
        url: '/usuario/carregarModulosIgreja/'+{{$igreja->id}},
        type: 'get',
        dataType: 'json',
        success: function(response){

            var len = 0;

            if(response['data'] != null){
            len = response['data'].length;
            }

            if(len > 0){
            for(var i=0; i<len; i++){

                var id = response['data'][i].id;
                var nome = response['data'][i].nome;
                var sistema = response['data'][i].sistema;
                var gerencial = response['data'][i].gerencial;

                if(gerencial == true){
                    if(vetor.includes(id)){
                        var result = "<option value="+id+" selected>"+nome+" - "+sistema+"</option>";
                        $("#select_2_modulos").append(result);
                    }else{
                        var result = "<option value="+id+">"+nome+" - "+sistema+"</option>";
                        $("#select_2_modulos").append(result);
                    }
                }
            }
            }

        }
    });

    $('#incluirPerfilFormulario').validator('update');
    $('#incluirPerfilFormulario').validator('validate');

    $('#incluirPerfilFormulario').validator({
        update: true,
        ignore: [],       
        rules: {
        //Rules
        },
        messages: {
        //messages
        }
    });

    $('#select_2_modulos').select2();
});

$(function () {
    
    $('#incluirPerfilFormulario').validator('update');
    $('#incluirPerfilFormulario').validator('validate');

    $('#incluirPerfilFormulario').validator({
      update: true,
      ignore: [],       
      rules: {
        //Rules
      },
      messages: {
        //messages
      }
    });

    $('#select_2_modulos').select2();

    var table = $('#tbl_perfis').DataTable({
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
    'ajax': '/usuario/tbl_perfis',
    'columns': [
            {
            "className":      'details-control',
            "orderable":      false,
            "data":           null,
            "defaultContent": ''
            },
            { data: 'id', name: 'id' },
            { data: 'nome', name: 'nome' },
            { data: 'descricao', name: 'descricao' },
            { data: 'action', name: 'action' },
          ],
          order: [[1, 'asc']]
  });

  // Add event listener for opening and closing details
  $('#tbl_perfis tbody').on('click', 'td.details-control', function () {
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
    Perfis
    <small>Lista de todos os perfis</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
      <div class="pull-right">
        <a class="btn btn-success" data-toggle="modal" data-target="#modal-incluir"><i class="fa fa-plus"></i>&nbspIncluír perfil</a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table id="tbl_perfis" class="table table-bordered table-striped">
      <thead>
      <tr>
          <th>Expandir</th>
          <th>#</th>
          <th>Nome</th>
          <th>Descrição</th>
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
  <form id="incluirPerfilFormulario" data-toggle="validator" method="POST" role="form" action="{{route('usuario.incluirPerfil')}}" enctype="multipart/form-data">
  @csrf
    <input type="hidden" name="igreja" value="{{$igreja->id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Incluir perfil</h4>
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
                      <div class="form-group">
                        <label >Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
                      </div>
                  </div>
                  <div class="col-md-12" id="list-area">
                    <div class="form-group has-feedback">
                      <label>Selecione quais módulos da igreja o perfil irá acessar:</label>
                      <select id="select_2_modulos" name="modulos[]" data-placeholder="Selecione os módulos" class="form-control select2" style="width: 100%;" multiple="multiple" required></select>
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