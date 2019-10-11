@extends('layouts.usuario.index')
@push('script')
<!-- DataTables -->
<script src="{{asset('template_adm/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template_adm/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<!-- InputMask -->
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

<script>
$(function(){
    $('#tbl_produtos').DataTable({
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
        'processing': true,
        'autoWidth': false,
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
    Editar venda
    <!--<small>it all starts here</small>-->
    </h1>
</section>

<!-- Main content -->
<section class="content">

	<form id="editarVendaFormulario" data-toggle="validator" method="POST" role="form" action="{{route('usuario.atualizarVenda')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$venda->id}}">
    <div class="box">
    	<div class="box-header with-border">
    		<h3 class="box-title">Produtos: {{(isset($produtos)) ? sizeof($produtos) : "0"}}</h3>
		</div>
        <div class="box-body">
        	<div class="row">
            <div class="col-md-12">
                <table id="tbl_produtos" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Valor único</th>
                    <th>Oferta</th>
                    <th>Quantidade</th>
                    <th>Tipo de venda</th>
                    <th>Sub-total</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($produtos) && sizeof($produtos) > 0) foreach($produtos as $produto){
                        ?>
                        <tr>
                            <td>{{$produto->id}}</td>
                            <td>{{$produto->nome}}</td>
                            <td>{{$produto->valor}}</td>
                            <td>{{$produto->oferta}}</td>
                            <td>{{$produto->qtd}}</td>
                            <td>{{$produto->tipo}}</td>
                            <td>
                            	{{($produto->oferta != null && $produto->oferta > 0) ? ($produto->qtd*($produto->valor-$produto->oferta*$produto->valor/100)) : $produto->qtd*$produto->valor}}
                            </td>
                        <?php
                    }
                    ?>
                </tbody>
                </table>
            </div>
            </div>
        </div>
    	<div class="box-footer">
    		<h3>
    			R$ {{$venda->valor_total}} <?php if($venda->oferta != null && $venda->oferta > 0){ ?> - Com desconto: R$ {{$venda->valor_total-$venda->valor_total*$venda->oferta/100}} <?php } ?>
    		</h3>
    	</div>
    </div>
    <div class="box">
    	<div class="box-header with-border">
    		<h3 class="box-title">Endereço da entrega</h3>
		</div>
		<div class="box-body">
			<div class="row">
			<div class="col-md-4">
	            <div class="form-group has-feedback">
	                <label >CEP</label>
	                <input id="cep" name="cep" type="text" class="form-control" placeholder="CEP" data-inputmask='"mask": "99.999-999"' value="{{$venda->cep}}" data-mask required>
	                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                <div class="help-block with-errors"></div>
	            </div>
	        </div>
	        <div class="col-md-4">
	            <div class="form-group has-feedback">
	                <label >Cidade</label>
	                <input id="cidade" name="cidade" type="text" class="form-control" placeholder="Cidade" value="{{$venda->cidade}}" required>
	                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                <div class="help-block with-errors"></div>
	            </div>
	        </div>
	        <div class="col-md-4">
	            <div class="form-group has-feedback">
	                <label >Bairro</label>
	                <input id="bairro" name="bairro" type="text" class="form-control" placeholder="Bairro" value="{{$venda->bairro}}" required>
	                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                <div class="help-block with-errors"></div>
	            </div>
	        </div>
	        <div class="col-md-4">
	            <div class="form-group has-feedback">
	                <label >Rua</label>
	                <input id="rua" name="rua" type="text" class="form-control" placeholder="Rua" value="{{$venda->rua}}" required>
	                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                <div class="help-block with-errors"></div>
	            </div>
	        </div>
	        <div class="col-md-8">
	            <div class="form-group">
	                <label >Complemento</label>
	                <input name="complemento" type="text" class="form-control" placeholder="Complemento" value="{{$venda->complemento}}">
	            </div>
	        </div>
	        <div class="col-md-4">
	            <div class="form-group has-feedback">
	                <label >Número</label>
	                <input name="num" type="number" class="form-control" placeholder="Número" value="{{$venda->num}}" required>
	                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                <div class="help-block with-errors"></div>
	            </div>
	        </div>
	        </div>
		</div>
	</div>
    <div class="box">
    	<div class="box-header with-border">
    		<h3 class="box-title">Situação da entrega e desconto</h3>
		</div>
        <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
            		<select id="situacao" name="situacao" class="form-control select2" style="width: 100%;" required>
                        <?php $situacoes = App\TblSituacoesEntregas::orderBy('nome','ASC')->get(); ?>
                        @foreach ($situacoes as $situacao)
                        <option value="{{$situacao->id}}" {{$venda->id_situacao == $situacao->id ? "selected" : ""}}>{{$situacao->nome}}</option>
                        @endforeach
                  	</select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <label >Desconto</label>
                    <input name="desconto" type="number" class="form-control" placeholder="Desconto" min="1" max="100" value="{{$venda->desconto}}" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            </div>
                            
        </div>
        <div class="box-footer">
            <a href="{{route('usuario.vendas')}}" class="btn btn-warning pull-left">Cancelar</a>
            <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
        </div>
        </div>
    </form>

</section>

</div>
@endsection