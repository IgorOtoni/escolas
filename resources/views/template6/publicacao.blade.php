@extends('layouts.template6')
@push('script')
<script type="text/javascript" src="{{asset('template_site/template-branco/vendor/galleria/galleria-1.3.5.min.js')}}"></script><!-- Galleria -->
<script>
	// Galleria Gallery Call
	Galleria.loadTheme('{{asset('template_site/template-branco/vendor/galleria/themes/classic/galleria.classic.min.js')}}');
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
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>{{ $publicacao->nome }}</h1>
  			<hr class="sm">
            <div class="row">
            	<div class="col-md-12">
            		<?php echo $publicacao->html; ?>
        		</div>
    		</div>
		</div>
		<div class="container">
	    	<h3>Fotos</h3>
	  		<hr class="sm">
  		</div>
	  	<ul class="galleria fullheight wheighter">
	  		<?php foreach($galeria_publicacao as $foto){ ?>

	        <li>
	        	<img src="{{ '/carrega_imagem/1300,700,galerias-publicacoes,'.$foto->foto }}">
	        </li>

	        <?php } ?>
	        <li>
	 	</ul>
	</div>
</div>
@endsection