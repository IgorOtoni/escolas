<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/carrinho/compraFinalizada.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1>Finalizar pedido</h1>
</div>

<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">Compra concluída</h3></div>
    <div class="panel-body">
    	<p>A entrega irá aconteceer na data marcada ou posterior, caso ocorra o atraso ou algum outro problmea por favor entre em contato. O pagamento pode ser feito em dinheiro ou cartão no momento da entrega.</p>
	</div>
	<div class="panel-footer">
		<a href="/nota_encomenda/<?php echo e($venda->id); ?>" class="btn btn-primary">Emitir nota</a>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.carrinho', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>