<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/carrinho/compras.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
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
						<td><?php echo e(\Carbon\Carbon::parse($compra->created_at)->format('d/m/Y')); ?></td>
						<td><?php echo e(\Carbon\Carbon::parse($compra->data)->format('d/m/Y')); ?></td>
						<td><span class="label label-success">R$ <?php echo e(str_replace(".", ",", $compra->valor_total)); ?></span></td>
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
						<td><a href="/nota_encomenda/<?php echo e($compra->id); ?>" class="btn btn-primary">Emitir nota</a></td>
					</tr>
		    	<?php endforeach ?>
	    	</tbody>
    	</table>
    	<center>
	        <?php echo e($compras->appends(request()->query())->links()); ?>

	    </center>
	</div>
	<div class="panel-footer">
		
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.carrinho', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>