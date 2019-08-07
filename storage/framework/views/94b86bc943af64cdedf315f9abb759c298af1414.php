<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/notaEncomenda.blade.php */ ?>
<?php
use App\Libs\html2pdf\HTML2PDF;

$content = "<h1>Nota de encomenda</h1>
	<p><b>Comprador:</b> ".$comprador->nome."</p>
	<p><b>Vendedor:</b> ".$vendedor->nome."</p>
	<p><b>Endereço da entrega:</b> ".$venda->cidade.", ".$venda->bairro.", ".$venda->rua." nº ".$venda->num."</p>
	<p><b>Valor total:</b> R$".$venda->valor_total."</p>
	<p><b>Data do pedido:</b> ".\Carbon\Carbon::parse($venda->data, 'UTC')->format('d/m/Y')."</p>
	<p><b>Data da entrega:</b> ".\Carbon\Carbon::parse($venda->created_at, 'UTC')->format('d/m/Y')."</p>
	<p><b>Turno para entrega:</b> ".$turno->nome." (".$turno->descricao.")</p>
	<h2>Itens comprados:</h2>
	<table border='1'><thead><tr><th>Nome</th><th>Quanitdade</th><th>Tipo de venda</th><th>Valor</th><th>Desconto</th></tr></thead><tbody>";

if($produtos_vendas != null) foreach ($produtos_vendas as $key => $produto_venda) {
	$content .= "<tr><td>".$produto_venda->nome."</td><td>".$produto_venda->qtd."</td><td>".$produto_venda->tipo."</td><td>".str_replace(".", ",", $produto_venda->valor)."</td><td>".$produto_venda->oferta."%</td></tr>";
}

$content .= "</tbody></table>";

$html2pdf = new HTML2PDF('L','A4','fr');
$html2pdf->WriteHTML($content);
ob_end_clean();
$html2pdf->Output('nota-encomenda.pdf');
die;
?>