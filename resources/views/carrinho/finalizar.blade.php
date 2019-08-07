@extends('layouts.carrinho')
@push('script')
<!-- InputMask -->
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

<script type="text/javascript">

$(document).ready(function () {
    $('[data-mask]').inputmask();
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

$("#cep").on('keyup', function() {
    var cep = $(this).val().replace(/\D/g, '');

    //Preenche os campos com "..." enquanto consulta webservice.
    /*$("#rua").val("...");
    $("#bairro").val("...");
    $("#cidade").val("...");
    $("#uf").val("...");*/
    //$("#ibge").val("...");

    //Consulta o webservice viacep.com.br/
    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
        
        if (!("erro" in dados)) {
            //Atualiza os campos com os valores da consulta.
            $("#rua").val(dados.logradouro);
            $("#bairro").val(dados.bairro);
            $("#cidade").val(dados.localidade);
            //$("#ibge").val(dados.ibge);
        } //end if.
        else {
            //CEP pesquisado não foi encontrado.
            limpa_formulário_cep();
        }
    });
});
</script>
@endpush
@section('content')
<?php
if(isset(\Auth::user()->id_perfil) && \Auth::user()->id_perfil == 100){
    if(null !== \Session()->get('carrinho') && is_array(\Session()->get('carrinho'))){
        ?>
        <div id="pgFinalizarPedido">
            <div class="page-header">
                <h1>Finalizar pedido</h1>
            </div>
            <div>
                <form data-toggle="validator" method="POST" action="{{ route('igreja.salvarCompra', $igreja->url) }}" class="form-group">
                @csrf

                    <?php /* ?><div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title">Sobre o pagamento:</h3></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">Forma de pagamento:</div>
                                <div class="col-md-8">
                                    <select name="pagamento" class="form-control">
                                        
                                        <?php
                                        require_once(__ROOT__.'/classes/bll/PagamentoBLL.php');
                                        
                                        $pagamentobll = new PagamentoBLL();
                                        $pagamentos = $pagamentobll->sqlPersonalizada("SISTEMA = 'WEB'");

                                        for($x = 0 ; $x < count($pagamentos) ; $x++){
                                            echo '<option value="'.$pagamentos[$x]->getId().'" title = "'.$pagamentos[$x]->getDescricao().'">'.$pagamentos[$x]->getNome().'</option>';
                                        }
                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div><?php */ ?>

                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title">Sobre a entrega:</h3></div>
                        <div class="panel-body">
                            <h4>Endereço para entrega:</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label >CEP</label>
                                        <input id="cep" name="cep" type="text" class="form-control" placeholder="CEP" data-inputmask='"mask": "99.999-999"' data-mask required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label >Cidade</label>
                                        <input id="cidade" name="cidade" type="text" class="form-control" placeholder="Cidade" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label >Bairro</label>
                                        <input id="bairro" name="bairro" type="text" class="form-control" placeholder="Bairro" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label >Rua</label>
                                        <input id="rua" name="rua" type="text" class="form-control" placeholder="Rua" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
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
                                    </div>
                                </div>
                            </div>

                            <h4>Data da entrega:</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <input class="form-control" min="{{ date('Y-m-d') }}" name="dtentrega" type="date" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>

                            <h4>Turno da entrega:</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <?php foreach ($turnos as $key => $turno): ?>
                                            <div class="class="radio">
                                                <label><input name="turno" type="radio" value="{{ $turno->id }}" required> {{ $turno->nome }} ({{ $turno->descricao }})</label>
                                            </div>
                                        <?php endforeach ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a class="btn btn-danger" href="{{ route('igreja.finalizarCompra', $igreja->url) }}">Cancelar compra</a>
                            <input class="btn btn-warning" type="reset" value="Limpar campos">
                            <input class="btn btn-success" type="submit" value="Realizar compra">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }else{
        $notification = array(
            'message' => 'Seu carrinho de compras está vazio!', 
            'alert-type' => 'warning'
        );

        return redirect('igrejas.produtos', $igreja->url)->with($notification);
    }
}else{
    $notification = array(
        'message' => 'Faça o login para finalizar o pedido!', 
        'alert-type' => 'warning'
    );

    return redirect('igrejas.carrinho', $igreja->url)->with($notification);
}
?>
@endsection