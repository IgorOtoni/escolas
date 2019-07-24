@extends('layouts.template5')
@push('script')

@endpush
@section('content')
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Visões e valores</h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="wrap">
        <div class="c-12">
            <div class="page">
                <h2>Sobre nós</h2>
                <p>
                	{{$igreja->texto_apresentativo}}
                </p>
            </div>
        </div>
    </div>

    @if ($funcoes != null && sizeof($funcoes) > 0)
    	<div class="kids_bottom_container">
    	<div class="l-page-width clearfix">
		    <div class="wrap">
		        <div class="c-12">
	                <h2>Nossa equipe</h2>
	                
	                <ul class="portfolio-menu">
		                <?php $x=0; foreach ($funcoes as $funcao){ $x++; ?>
	                		@foreach ($membros[$funcao->id] as $membro)

	                		<li class="c-6 two-column {{($x % 2 == 0) ? 'clearfix' : ''}}" style="min-height: 200px;">
	                			<h3>{{$membro->nome}} ({{$funcao->nome}})</h3>
	                            <p class="image" style="width: 210">
	                                <a href="{{($membro->foto != null) ? '/storage/no-foto.png' : '/storage/membros/'.$membro->foto}}" rel="example_group">
	                                    <span class="gallery-2col-mask"></span>
	                                    <img height="182" width="250" title="" alt="" src="{{($membro->foto != null) ? '/storage/no-foto.png' : '/storage/membros/'.$membro->foto}}" />
	                                </a>
	                            </p>
	                            <p>{{$membro->descricao}}</p>
	                        </li>

	                		@endforeach
	            		<?php } ?>
            		</ul>
		        </div>
		    </div>
	    </div>
	    </div>
    @endif
</div>
@endsection