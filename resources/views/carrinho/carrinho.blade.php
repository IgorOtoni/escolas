@extends('layouts.carrinho')
@push('script')

@endpush
@section('content')
<div class="page-header">
    <h1>CARRINHO</h1>
</div>

<div style="display: none;" class="alert alert-warning" id="msg_login"><strong>Aviso!</strong> Para finalizar a compra é necessário login.</div>
<div style="display: none;" id="msg_add_sucesso" class='alert alert-success' role='alert'><strong>Produto adicionado.</strong> </div>
<div style="display: none;" id="msg_remover_sucesso" class='alert alert-success' role='alert'><strong>Produto removido.</strong> </div>
<div style="display: none;" id="msg_qtd_sucesso" class='alert alert-success' role='alert'><strong>Quantidade alterada.</strong> </div>
<div style="display: none;" id="msg_qtd_erro" class='alert alert-danger' role='alert'><strong>Erro!</strong> Quantidade inválida.</div>

<h3>Produtos adicionados:</h3>
<?php

if(null !== \Session()->get('carrinho') && is_array(\Session()->get('carrinho'))){

    echo '<table class="table table-striped table-bordered">';
    echo '<thead>'
            . '<tr>'
                . '<th style="text-align: center;">Produto</th>'
                . '<th style="text-align: center;">Valor unitário</th>'
                . '<th style="text-align: center;">Quantidade</th>'
                . '<th style="text-align: center;">Subtotal</th>'
                . '<th style="text-align: center;">Opção:</th>'
            . '</tr>'
        . '</thead>';
    
    $vltotal = 0;
    $x = 0;
    if($produtos != null) foreach($produtos as $produto){
        
        $oferta = ($ofertas != null && array_key_exists($produto->id, $ofertas)) ? $ofertas[$produto->id] : null;
        
        echo '<tr>';
        
        echo '<td width="20%">';
        
            echo '<table width="100%">';
                echo '<tr width="100%">';

                    echo '<td width="100%">';
                    echo '<center><img class="img-thumbnail" width="100px" height="100px" src="/storage/produtos/'.$produto->icone.'"></center>';
                    echo '</td>';

                echo '</tr>';
                echo '<tr width="100%">';

                    echo '<td style="text-align: center;" width="100%">';
                    echo '<strong>'.$produto->nome.'</strong>';
                    echo '</td>';

                echo '</tr>';
            echo '</table>';
        
        echo '</td>';
        
        echo '<td style="text-align: center; font-size: 24px;" width="20%">';
        if($oferta == null){
            echo '<strong>R$ '.  str_replace('.', ',', $produto->valor.'</strong>');
        }else{
            echo '<span class="label label-primary">Em oferta!</span><br>';
            echo '<strong>R$ '.  str_replace('.', ',', ($produto->valor - $produto->valor*$oferta->desconto/100)).'</strong>';
        }
        echo '</td>';
        
        echo '<td style="text-align: center;" width="20%">';
        echo '<div class="form_settings">'
                . '<form method="get" action="/'.$igreja->url.'/alterarProduto" name="form'.$x.'">'
                        . '<input type="hidden" name="id" value="'.$produto->id.'">'
                        . '<div class="input-group">'
                            . '<input name="qtd" class="form-control" type="number" value="'.\Session()->get('carrinho_qtd')[$x].'">'
                            . '<div class="input-group-btn">'
                                . '<input type="submit" value="Alterar" class="btn btn-warning">'
                            . '</div>'
                        . '</div>'
                . '</form>'
            . '</div>';
        echo '</td>';
        
        echo '<td style="text-align: center; font-size: 24px;" width="20%">';
        if($oferta == null){
            echo '<span class="label label-success">R$ '.\Session()->get('carrinho_qtd')[$x] * $produto->valor.'</span>';
        }else{
            echo '<span class="label label-success">R$ '.\Session()->get('carrinho_qtd')[$x] * ($produto->valor - $produto->valor*$oferta->desconto/100).'</span>';
        }
        echo '</td>';

        echo '<td style="text-align: center;" width="20%">'
                . '<form style="padding-bottom: 5px;" method="get" action="/'.$igreja->url.'/removerProduto">'
                    . '<input type="hidden" name="id" value="'.$produto->id.'">'
                    . '<input type="submit" value="Remover" class="btn btn-danger">'
                . '</form>';
        echo '</td>';
        
        echo '</tr>';
        
        if($oferta == null){
            $vltotal += \Session()->get('carrinho_qtd')[$x] * $produto->valor;
        }else{
            $vltotal += \Session()->get('carrinho_qtd')[$x] * ($produto->valor - $produto->valor*$oferta->desconto/100);
        }

        $x++;
    }
    
    echo '<tfoot>';
        echo '<tr>';
            echo '<td colspan="5" style="text-align: right; font-size: 24px;">';
            echo '<span class="label label-success">Total: R$ '.str_replace('.', ',', $vltotal).'</span>';
            echo '</td>';
        echo '</tr>';
    echo '</tfoot>';
    
    echo '</table>';
    
    if(null !== \Session()->get('carrinho_qtd')){
        if(isset(\Auth::user()->id_perfil) && \Auth::user()->id_perfil == 100){
            ?>
            <form method="post">
                <div class="bggray">
                    <div class="form_settings">
                        <center>
                            <a href="{{ route('igreja.limparCarrinho', $igreja->url) }}" class="btn btn-danger">Cancelar compra</a>
                            <a class="btn btn-info" href="{{ route('igreja.finalizarCompra', $igreja->url) }}">Finalizar compra</a>
                        </center>
                    </div>
                </div>
            </form>
            <?php
        }else{
            echo '<div class="alert alert-warning"><strong>É necessário autenticar para finalizar a compra.</strong> </div>';
        }
    }
    
}else{
    echo '<div class="alert alert-warning"><strong>Não há produtos no carrinho.</strong> </div>';
}
?>
@endsection