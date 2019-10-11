@extends('layouts.carrinho')
@push('script')

@endpush
@section('content')
<div class="page-header">
    <h1>Compras realizadas</h1>
</div>

<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">Minhas compras</h3></div>
    <div class="panel-body">
    	<table class="table">
    		<thead>
    			<tr>
    				<th>Data pedido</th>
    				<th>Data entrega</th>
    				<th>Valor total</th>
    				<th>Situação</th>
    				<th></th>
    			</tr>
    		</thead>
    		<tbody>
		    	<?php foreach ($compras as $key => $compra): ?>
					<tr>
						<td>{{ \Carbon\Carbon::parse($compra->created_at)->format('d/m/Y') }}</td>
						<td>{{ \Carbon\Carbon::parse($compra->data)->format('d/m/Y') }}</td>
						<td><span class="label label-success">R$ {{ str_replace(".", ",", $compra->valor_total) }}</span></td>
						<td>
							<?php
							switch($compra->id_situacao){
								case 1:
									echo '<span class="label label-warning">Pendente</span>';
									break;
								case 2:
									echo '<span class="label label-danger">Atrasada</span>';
									break;
								case 3:
									echo '<span class="label label-success">Realizada</span>';
									break;
								case 4:
									echo '<span class="label label-info">Cancelada</span>';
									break;
								default:
									echo 'Não especificada';
									break;
							}
							?>
						</td>
						<td><a href="{{ route('igreja.nota_encomenda',['id'=>$compra->id]) }}" class="btn btn-primary">Emitir nota</a></td>
					</tr>
		    	<?php endforeach ?>
	    	</tbody>
    	</table>
    	<center>
	        {{ $compras->appends(request()->query())->links() }}
	    </center>
	</div>
	<div class="panel-footer">
		
	</div>
</div>
@endsection