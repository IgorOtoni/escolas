@extends('layouts.template5')
@push('script')

@endpush
@section('content')
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>{{$publicacao->nome}}</h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="wrap">
        <div class="c-8 divider">
            <div class="post-list">
                <div class="post">
                	<?php echo $publicacao->html; ?>
                </div>
            </div>
            
            <h1>Fotos</h1>

            <div class="gl_col_4">
    
                <ul id="gallery">
                	
                    <?php foreach($galeria_publicacao as $foto){ ?>

                    <li data-categories="print" class="gallery-item">
                        
                        <div class="border-shadow">
                            <figure>
                                <a target="_blank" class="prettyPhoto kids_picture" href="/storage/galerias-publicacoes/{{$foto->foto}}">
                                    <img width="202" height="138" src="/storage/galerias-publicacoes/{{$foto->foto}}" alt="" />
                                </a>										
                            </figure>
                        </div>
                        
                    </li>

                	<?php } ?>

            	</ul>

                <div class="kids_clear"></div>

            </div>

        </div>
    </div>
</div>
@endsection