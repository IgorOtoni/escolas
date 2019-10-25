@extends('layouts.template6')
@push('script')

@endpush
@section('content')
<div class="spacer-50"></div>
<div class="main" role="main">
<div id="content" class="content full">
	<div class="container">
       	<h2>Sobre nós/Visões e valores</h2>
      	<hr class="sm">
       	<p>{{$site->texto_apresentativo}}</p>
       	@if ($funcoes != null && sizeof($funcoes) > 0)
        	<hr class="fw">
	        <h3>Nossa membros</h3>
	        <div class="spacer-10"></div>
	        <div class="row">
        		<?php $x=0; foreach ($funcoes as $funcao){ $x++; ?>
            		@foreach ($membros[$funcao->id] as $membro)

		            <div class="col-md-4 col-sm-4">
		              	<div class="grid-item staff-item format-standard">
		                	<div class="grid-item-inner">
		                  		<a href="{{($membro->foto == null) ? '/storage/no-foto.png' : '/storage/membros/'.$membro->foto}}" class="media-box">
		                        	@if ($membro->foto != null)
	                                    <img src="/carrega_imagem/300,198,membros,{{$membro->foto}}" alt=""> 
	                                @else
	                                    <img src="/carrega_imagem/300,198,X,no-foto.png" alt=""> 
	                                @endif
		                       	</a>
		                  		<div class="grid-content">
		                        	<div class="staff-item-name">
		                    			<h5>{{$membro->nome}}</h5>
		                                <span class="meta-data">{{$funcao->nome}}</span>
		                            </div>
		                            <ul class="social-icons-colored">
		                            	@if ($membro->facebook != null)
		                                	<li class="facebook"><a href="{{ $membro->facebook }}"><i class="fa fa-facebook"></i></a></li>
	                                	@endif
	                            		@if ($membro->youtube != null)
		                                	<li class="vimeo"><a href="{{ $membro->youtube }}"><i class="fa fa-vimeo-square"></i></a></li>
		                                @endif
	                            		@if ($membro->twitter != null)
		                                	<li class="twitter"><a href="{{ $membro->twitter }}"><i class="fa fa-twitter"></i></a></li>
		                                @endif
		                            </ul>
		                    		<p>{{$membro->descricao}}</p>
		                  		</div>
		                	</div>
		              	</div>
		            </div>

		            @endforeach
        		<?php } ?>
        	</div>
		@endif
        <div class="spacer-20"></div>
    </div>
</div>
</div>
@endsection