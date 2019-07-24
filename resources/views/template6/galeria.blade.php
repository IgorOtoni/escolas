@extends('layouts.template6')
@push('script')
<script type="text/javascript" src="{{asset('template_igreja/template-branco/vendor/galleria/galleria-1.3.5.min.js')}}"></script><!-- Galleria -->
<script>
	// Galleria Gallery Call
	Galleria.loadTheme('{{asset('template_igreja/template-branco/vendor/galleria/themes/classic/galleria.classic.min.js')}}');
	Galleria.configure({
		imageCrop: true,
		lightbox: true
	});
	Galleria.run('.galleria', {
		dataConfig: function(img) {
			return {
				description: $(img).next('p').html()
			}
		}
	});
</script>
@endpush
@section('content')
<!-- Start Content -->
<div class="main" role="main">
<div id="content" style="padding:0;" class="content full">
	<div class="container">
	  	<h1>Galerias</h1>
	  	<hr class="sm">
	</div>
  	<?php
  	if($galerias != null && sizeof($galerias) != 0){
		foreach($galerias as $galeria){
    	?>
    	<div class="container">
	    	<h3>{{ $galeria->nome }}</h3>
	  		<hr class="sm">
	  		<p>{{ $galeria->descricao }}<br><span class="meta-data"><i class="fa fa-calendar"></i> Adicionada {{\Carbon\Carbon::parse($galeria->data)->diffForHumans()}}</span></p>
  		</div>
	  	<ul class="galleria fullheight wheighter">
	  		<?php 
            $fotos_ = $fotos[$galeria->id];
            $x = 0;
            foreach($fotos_ as $foto){ ?>

		        <li>
		        	<img src="{{ '/carrega_imagem/1300,700,galerias,'.$foto->foto }}">
		        </li>

		        <?php $x++;
            }
            ?>
	        <li>
	 	</ul>

	 	<?php
		}
	}
	?>
	<div class="container">
 		{{ $galerias->appends(request()->query())->links() }}
	</div>
</div>
</div>
@endsection