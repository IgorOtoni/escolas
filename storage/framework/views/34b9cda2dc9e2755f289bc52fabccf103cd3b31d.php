<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><?php echo e($produto->nome); ?></h1>
</div>

<div class="panel">
	<div class="panel-body">
		<div class="row">
		<div class="col-md-12">
            <center>
    			<a href="<?php echo e('data:image;base64,'.base64_encode($produto->icone)); ?>">
                    <img class="img-thumbnail" width="40%" src="<?php echo e('data:image;base64,'.base64_encode($produto->icone)); ?>">
                </a>
            </center>
		</div>
		<div class="col-md-12">
			<p><strong>Valor:</strong> <span class='label label-success'>R$ <?php echo e(str_replace('.', ',', $produto->valor)); ?></span></p>
		</div>
		<?php if($oferta != null){ ?>
			<div class="col-md-12">
            	<p><span class="label label-primary">Em oferta: <?php echo e($oferta->desconto); ?>% de desconto!</span></p>
        	</div>
        <?php } ?>
        <?php if($produto->descricao != null){ ?>
	    	<div class="col-md-12">
	    		<p>Descrição: <?php echo e($produto->descricao); ?></p>
			</div>
		<?php } ?>
		<div class="col-md-12">
    		<p>Categoria: <?php echo e($categoria->nome); ?></p>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.carrinho', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/carrinho/produto.blade.php ENDPATH**/ ?>