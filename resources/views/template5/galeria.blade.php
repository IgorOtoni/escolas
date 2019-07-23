@extends('layouts.template5')
@push('script')

@endpush
@section('content')
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Galerias</h1>
        </div>
    </div>
</div>

<?php
if($galerias != null && sizeof($galerias) != 0){
	foreach($galerias as $galeria){
    ?>
    <div class="kids_bottom_container">
    <div class="l-page-width clearfix">
        <div class="wrap">
            <h3 style="font-family: TOONISH,Georgia,'Times New Roman',Times,serif;
            text-transform: uppercase;
            color: #f55029;">Publicada {{\Carbon\Carbon::parse($galeria->data)->diffForHumans()}}</h3>
            <p>{{ $galeria->descricao }}</p>
        </div>
        <div class="wrap">
            <div class="c-12">
                
                <ul class="portfolio-menu">
                    <?php 
                    $fotos_ = $fotos[$galeria->id];
                    $x = 0;
                    foreach($fotos_ as $foto){ ?>

                        <li class="c-6 two-column {{($x % 2 == 0) ? 'clearfix' : ''}}" style="min-height: 200px;">
                            <p class="image">
                                <a href="/storage/galerias/{{$foto->foto}}" rel="example_group">
                                    <span class="gallery-2col-mask"></span>
                                    <img height="182" width="446" title="" alt="" src="/storage/galerias/{{$foto->foto}}" />
                                </a>
                            </p>
                        </li>

                        <?php $x++;
                    }
                     ?>
                </ul>
            
            </div>    
        </div>
    </div>
    </div>
    <?php
	}
}
?>
@endsection