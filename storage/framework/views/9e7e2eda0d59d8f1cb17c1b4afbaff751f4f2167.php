<?php /* C:\xampp\htdocs\adm_eglise\resources\views/exemplo2.blade.php */ ?>
<?php
use App\Libs\Canvas;
if($pasta == "X")
  $path = public_path('/storage/' . $arquivo);
else
  $path = public_path('/storage/'. $pasta . '/' . $arquivo);
$img = new Canvas($path);
$img->redimensiona( $largura, $altura, 'crop' )
  ->grava();
exit;
?>