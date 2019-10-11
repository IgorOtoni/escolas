@extends('layouts.admin_site.index')
@push('script')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/select2/dist/css/select2.min.css')}}">
<!-- InputFilePTBR -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/input.file.js/fileinput.min.css')}}">

<!-- Select2 -->
<script src="{{asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
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
    url: '{{route('igrejas.switchStatus',['id'=>''])}}/'+id,
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
            '<th>Estado:</th>'+
            '<th>Cidade:</th>'+
            '<th>Bairro:</th>'+
            '<th>Rua:</th>'+
            '<th>Número:</th>'+
            '<th>Complemento:</th>'+
            '<th>Telefone:</th>'+
            '<th>Email:</th>'+
            '</tr>'+
        '<tr>'+
            '<td>'+valida(d.nome)+'</td>'+
            '<td>'+valida(d.estado)+'</td>'+
            '<td>'+valida(d.cidade)+'</td>'+
            '<td>'+valida(d.bairro)+'</td>'+
            '<td>'+valida(d.rua)+'</td>'+
            '<td>'+valida(d.num)+'</td>'+
            '<td>'+valida(d.complemento)+'</td>'+
            '<td>'+valida(d.telefone)+'</td>'+
            '<td>'+valida(d.email)+'</td>'+
            '</tr>'+
        '</table></div>';
}

function valida(txt){
  return (txt ? txt : '<span class="label bg-red">Não informado</span>')
}

$(function () {
  $('.select2').select2();

  $('[data-mask]').inputmask();

  $('input[type=file]').fileinput({
      language: "pt-BR",
      //minImageCount: 1,
      //maxImageCount: 1,
      //uploadUrl: "/file-upload-batch/2",
      
  });

  function limpa_formulário_cep() {
      // Limpa valores do formulário de cep.
      $("#cep").val("");
      $("#rua").val("");
      $("#bairro").val("");
      $("#cidade").val("");
      $("#uf").val("");
      //$("#ibge").val("");
  }

  $("#cep").keypress(function() {

    var cep = $(this).val().replace(/\D/g, '');
    
    //Preenche os campos com "..." enquanto consulta webservice.
    $("#rua").val("...");
    $("#bairro").val("...");
    $("#cidade").val("...");
    $("#uf").val("...");
    //$("#ibge").val("...");

    //Consulta o webservice viacep.com.br/
    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
        
        if (!("erro" in dados)) {
            //Atualiza os campos com os valores da consulta.
            $("#rua").val(dados.logradouro);
            $("#bairro").val(dados.bairro);
            $("#cidade").val(dados.localidade);
            $("#uf").val(dados.uf);
            //$("#ibge").val(dados.ibge);
        } //end if.
        else {
            //CEP pesquisado não foi encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    });
  })

  var table = $('#tbl_igrejas').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : true,

    /*"columnDefs": [
      { "width": "5%", "targets": 0 },
      { "width": "8%", "targets": 5 },
    ],*/
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
    processing: true,
    autoWidth: false,
  //serverSide: true,
    'ajax': '{{route('igrejas.tbl_igrejas')}}',
    'columns': [
            {
              "className":      'details-control',
              "orderable":      false,
              "data":           null,
              "defaultContent": ''
            },
            { data: 'id', name: 'id' },
            { data: 'nome', name: 'nome' },
            { data: 'action', name: 'action' },
            ],
            order: [[1, 'asc']]
    });

    // Add event listener for opening and closing details
    $('#tbl_igrejas tbody').on('click', 'td.details-control', function () {
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

    $('#configuracoesIgrejaFormulario').validator('update');

    $('#incluirIgrejaFormulario').validator({
      update: true,
      ignore: [],       
      rules: {
        //Rules
      },
      messages: {
        //messages
      }
    });

    
});

$('#modal-configuracoes').on('hide.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;

  var modal = $(this);

  modal.find('.modal-body #id').val(null);
  modal.find('.modal-body #url').val(null);
  modal.find('.modal-body #template').val(null);
});

$('#modal-configuracoes').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
  var id = button.data('id');
  var url = button.data('url');
  var template = button.data('template');

  var modal = $(this);

  if(id != null) modal.find('.modal-body #id').val(id);
  if(url != null) modal.find('.modal-body #url').val(url);
  if(template != null) modal.find('.modal-body #template').val(template);

  $('#configuracoesIgrejaFormulario').validator('validate');
});
</script>
@endpush
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Escolas
        <small>Lista de todas as escolas</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
          <div class="pull-right">
            <a class="btn btn-success" data-toggle="modal" data-target="#modal-incluir"><i class="fa fa-plus"></i>&nbspIncluir igreja</a>
          </div>
        </div>
        <div class="box-body table-responsive">
            <table id="tbl_igrejas" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Nome</th>
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

  <!-- modals -->
  <div class="modal fade" id="modal-configuracoes">
    <form id="configuracoesIgrejaFormulario" data-toggle="validator" method="POST" role="form" action="{{route('igrejas.salvarConfiguracoes')}}" enctype="multipart/form-data">
    @csrf
      <input type="hidden" name="id" id="id">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Configurações</h4>
          </div>
          <div class="modal-body">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group has-feedback">
                    <label >URL</label>
                    <input id="url" name="url" type="text" class="form-control" placeholder="URL" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group has-feedback">
                    <label >Template</label>
                    <select id="template" name="template" class="form-control" required>
                        <?php $templates = App\TblTemplates::orderBy('nome','ASC')->get(); ?>
                        @foreach ($templates as $template)
                          <option value="{{$template->id}}">{{$template->nome}}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <div class="modal fade" id="modal-incluir">
    <form id="incluirIgrejaFormulario" data-toggle="validator" method="POST" role="form" action="{{route('igrejas.incluir')}}" enctype="multipart/form-data">
    @csrf
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Incluir igreja</h4>
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
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <label >CEP</label>
                            <input id="cep" name="cep" type="text" class="form-control" placeholder="CEP" data-inputmask='"mask": "99.999-999"' data-mask required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <label >Estado</label>
                            <input id="uf" name="estado" type="text" class="form-control" placeholder="Estado" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <label >Cidade</label>
                            <input id="cidade" name="cidade" type="text" class="form-control" placeholder="Cidade" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <label >Bairro</label>
                            <input id="bairro" name="bairro" type="text" class="form-control" placeholder="Bairro" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <label >Rua</label>
                            <input id="rua" name="rua" type="text" class="form-control" placeholder="Rua" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label >Complemento</label>
                            <input name="complemento" type="text" class="form-control" placeholder="Complemento">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <label >Número</label>
                            <input name="num" type="number" class="form-control" placeholder="Número" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback">
                            <label >Telefone</label>
                            <input name="telefone" type="text" class="form-control" placeholder="Telefone" data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group has-feedback">
                            <label >Email</label>
                            <input name="email" type="text" class="form-control" placeholder="Email" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-feedback">
                          <label >Logo</label>
                          <input name="logo" type="file" id="input_img" required>
                          <div class="help-block with-errors"></div>
                        </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group has-feedback">
                        <label>Módulos do sistema</label>
                        <select name="modulos[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione os módulos"
                                style="width: 100%;" required>
                          <?php $modulos = App\TblModulo::orderBy('nome','ASC')->get(); ?>
                          @foreach ($modulos as $modulo)
                            <option value="{{$modulo->id}}">{{$modulo->nome}} - {{$modulo->sistema}} - {{($modulo->gerencial) ? 'Gerencial' : 'Apresentativo'}}</option>
                          @endforeach
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                      </div>
                      <!-- /.form-group -->
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