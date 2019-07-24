@extends('layouts.template6')
@push('script')

@endpush
@section('content')
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Detalhes do evento fixo</h1>
  			<hr class="sm">
  			<h3>{{ $eventofixo->nome }}</h3>
  			<hr class="sm">
            <div class="row">
            	<div class="col-md-12">
	            	<a href="/storage/{{($eventofixo->foto != null) ? 'eventos/'.$eventofixo->foto  : 'no-event.jpg'}}" class="media-box">
	                	<img src="{{($eventofixo->foto != null) ? '/carrega_imagem/800,400,eventos,'.$eventofixo->foto : '/carrega_imagem/800,400,X,no-event.jpg'}}" alt="">
	                </a>
	                <p>
	                	{{ $eventofixo->descricao }}<br/>
	        			<span class="meta-data event-location-address"><i class="fa fa-calendar"></i> <i class="fa fa-map-marker"></i> {{$eventofixo->dados_horario_local}}</span>
	        		</p>
        		</div>
        	</div>
    	</div>
	</div>
</div>
@endsection