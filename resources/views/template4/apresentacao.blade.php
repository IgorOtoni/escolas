@extends('layouts.template4')
@push('script')

@endpush
@section('content')
<div class="bg-level-2-full-width-container kids_bottom_content">
	<div class="bg-level-2-page-width-container l-page-width no-padding">
		<section class="kids_bottom_content_container">
			<div class="header_container">  
				<h1>Apresentação</h1>
			</div>
			<div class="entry-container" style="min-height: 150px">

				<h1>Sobre nós/Visões e valores</h1>
				
				<p>
					{{$site->texto_apresentativo}}
				</p>

			</div>

	    	<div class="header_container">  
				<h1>Membros</h1>
			</div>

			<div class="gl_col_4">
				@if ($funcoes != null && sizeof($funcoes) > 0)
	                <ul id="gallery">

	                	<?php $x=0; foreach ($funcoes as $funcao){ $x++; ?>
	                		@foreach ($membros[$funcao->id] as $membro)

	                        <li data-categories="print" class="gallery-item">

		                    	<h3>{{$membro->nome}} ({{$funcao->nome}})</h3>
	                            
	                            <div class="border-shadow">
	                                <figure>
	                                    <a target="_blank" class="prettyPhoto kids_picture" href="{{($membro->foto != null) ? '/storage/no-foto.png' : '/storage/membros/'.$membro->foto}}">
	                                        <img width="202" height="138" src="{{($membro->foto != null) ? '/storage/no-foto.png' : '/storage/membros/'.$membro->foto}}" alt="" />
	                                    </a>										
	                                </figure>
	                            </div>
	                            
		                    	<p>{{$membro->descricao}}</p>

	                            @if ($membro->facebook != null)
	                                <a href="{{$membro->facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
	                            @endif
	                            @if ($membro->twitter != null)
	                                <a href="{{$membro->twitter}}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
	                            @endif
	                            @if ($membro->youtube != null)
	                                <a href="{{$membro->youtube}}"><i class="fa fa-youtube" aria-hidden="true"></i></a>
	                            @endif
	                            
	                        </li>

	                		@endforeach
	            		<?php } ?>

	            	</ul>
	            @endif
	        </div>

	    </section>

	</div>

</div>
@endsection