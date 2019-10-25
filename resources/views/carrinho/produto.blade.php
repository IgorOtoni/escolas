@extends('layouts.carrinho')
@push('script')

@endpush
@section('content')
<div class="page-header">
    <h1>{{ $produto->nome }}</h1>
</div>

<div class="panel">
	<div class="panel-body">
		<div class="row">
		<div class="col-md-12">
            <center>
    			<a href="{{ 'data:image;base64,'.base64_encode($produto->icone) }}">
                    <img class="img-thumbnail" width="40%" src="{{ 'data:image;base64,'.base64_encode($produto->icone) }}">
                </a>
            </center>
		</div>
		<div class="col-md-12">
			<p><strong>Valor:</strong> <span class='label label-success'>R$ {{ str_replace('.', ',', $produto->valor) }}</span></p>
		</div>
		<?php if($oferta != null){ ?>
			<div class="col-md-12">
            	<p><span class="label label-primary">Em oferta: {{ $oferta->desconto }}% de desconto!</span></p>
        	</div>
        <?php } ?>
        <?php if($produto->descricao != null){ ?>
	    	<div class="col-md-12">
	    		<p>Descrição: {{ $produto->descricao }}</p>
			</div>
		<?php } ?>
		<div class="col-md-12">
    		<p>Categoria: {{ $categoria->nome }}</p>
		</div>

        <?php $botaoAdd = true;
        if(null !== \Session()->get('carrinho') && is_array(\Session()->get('carrinho'))){
            for($x = 0; $x < sizeof(\Session()->get('carrinho')) ; $x++){
                if(\Session()->get('carrinho')[$x] == $produto->id){
                    $botaoAdd = false;
                    break;
                }
            }
        } ?>

        <div class="col-md-12">
	        <?php if($botaoAdd == true){
	            echo '<center><form method="get" action="'.route('site.adicionarProduto',['url'=>$site->url]).'">'
	                    . '<div class="form_settings">'
	                    	. '<input type="hidden" name="id" value="'.$produto->id.'">'
	                        . '<input class="btn btn-sm btn-primary" type="submit" value="Acidionar ao carrinho">'
	                    . '</div>'
	                . '</form></center>';
	        }else{
	            echo '<span class="label label-success">Produto no carrinho</span>';
	        } ?>
        </div>
        </div>
	</div>
</div>

<?php
if($fotos != null){
echo '<h3>Fotos</h3>';
echo "<table class='table'>";

	$i = 0;
    foreach($fotos as $foto){

        if(($i) % 2 == 0){
            echo "<tr>";
        }

        echo '<td>';
        echo '<center>';
        echo '<a href="'.'data:image;base64,'.base64_encode($foto->foto).'"><img class="img-thumbnail" width="175px" src="'.'data:image;base64,'.base64_encode($foto->foto).'"></a>';
        echo '</center>';
        echo '</td>';

        $i++;
    }

echo '</table>';
}else{
echo "<br><div class='alert alert-warning' role='alert'><strong>Sem produtos.</strong></div>";
}
?>
@endsection