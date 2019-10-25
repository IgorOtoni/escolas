<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1>Produtos</h1>
</div>

<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">Opções de  filtro:</h3></div>
    <div class="panel-body">
        <form class="form-group" action="<?php echo e(route('site.filtrarProdutos', $site->url)); ?>" method="get" name="filtroProdutosNome">
            <div class="row">
                <div class="col-md-2">Nome</div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="nome">
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-sm btn-primary" value="Buscar">
                </div>
            </div>
        </form>
        <form class="form-group" action="<?php echo e(route('site.filtrarProdutos', $site->url)); ?>" method="get" name="filtroProdutosCategoria">
            <div class="row">
                <div class="col-md-2">Categoria</div>
                <div class="col-md-8">
                    <select class="form-control" name="categoria">
                        <?php
                        foreach($categorias as $categoria){
                            echo '<option value="'.$categoria->id.'">'.$categoria->nome.'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-sm btn-primary" value="Buscar">
                </div>
            </div>
        </form>
    </div>
</div>

<?php
if($produtos != null){
echo "<table class='table'>";

	$i = 0;
    foreach($produtos as $produto){

        if(($i) % 2 == 0){
            echo "<tr>";
        }

        $oferta = ($ofertas != null && array_key_exists($produto->id, $ofertas)) ? $ofertas[$produto->id] : null;

        echo '<td>';
        echo '<center>';
        echo '<img class="img-thumbnail" width="175px" src="'.'data:image;base64,'.base64_encode($produto->icone).'">';
        echo '<br>';
        echo "<strong>Nome:</strong> ".$produto->nome;
        echo '<br>';
        echo "<strong>Valor:</strong> <span class='label label-success'>R$ ".str_replace('.', ',', $produto->valor).'</span>';
        echo '<br>';
        if($oferta != null){
            echo '<span class="label label-primary">Em oferta: '.$oferta->desconto.'% de desconto!</span>';
            echo '<br>';
        }
        echo "<strong><a href='".route('site.produto',['url'=>$site->url,'id'=>$produto->id])."'>+ Informações</a></strong>";

        $botaoAdd = true;
        if(null !== \Session()->get('carrinho') && is_array(\Session()->get('carrinho'))){
            for($x = 0; $x < sizeof(\Session()->get('carrinho')) ; $x++){
                if(\Session()->get('carrinho')[$x] == $produto->id){
                    $botaoAdd = false;
                    break;
                }
            }
        }

        if($botaoAdd == true){
            echo '<form method="get" action="'.route('site.adicionarProduto',['url'=>$site->url]).'">'
                    . '<div class="form_settings">'
                    	. '<input type="hidden" name="id" value="'.$produto->id.'">'
                        . '<input class="btn btn-sm btn-primary" type="submit" value="Acidionar ao carrinho">'
                    . '</div>'
                . '</form>';
        }else{
            echo '<br><span class="label label-success">Produto no carrinho</span>';
        }

        echo '</center>';
        echo '</td>';

        $i++;
    }

echo '</table>';
}else{
echo "<br><div class='alert alert-warning' role='alert'><strong>Sem produtos.</strong></div>";
}
?>
<center>
    <?php echo e($produtos->appends(request()->query())->links()); ?>

</center>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.carrinho', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/carrinho/produtos.blade.php ENDPATH**/ ?>