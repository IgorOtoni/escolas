@extends('layouts.template4')
@push('script')

@endpush
@section('content')
<div id="kids_middle_container">

	 <div class="kids_bottom_content">

		<div class="bg-level-2-page-width-container l-page-width no-padding">
    
            <section class="kids_bottom_content_container">
    
                <div class="header_container">
                    <h1>Últimas galerias</h1>
                </div>
    
                <div class="gl_col_4">
    
                    <?php foreach($galerias as $galeria){
                        $fotos_ = $fotos[$galeria->id]; ?>
                        <ul id="gallery">

                        	<h3>Publicada {{\Carbon\Carbon::parse($galeria->data)->diffForHumans()}}</h3>
                        	<p>{{ $galeria->descricao }}</p>
                        	
                            <?php foreach($fotos_ as $foto){ ?>

                            <li data-categories="print" class="gallery-item">
                                
                                <div class="border-shadow">
                                    <figure>
                                        <a target="_blank" class="prettyPhoto kids_picture" href="/storage/galerias/{{$foto->foto}}">
                                            <img width="202" height="138" src="/storage/galerias/{{$foto->foto}}" alt="" />
                                        </a>										
                                    </figure>
                                </div>
                                
                            </li>

                        	<?php } ?>

                    	</ul>
                    <?php } ?>
    
                    <div class="kids_clear"></div>
    
                </div>
    
            </section>
    
        </div>

    </div>

</div>
@endsection