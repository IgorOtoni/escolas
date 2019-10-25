@extends('layouts.template6')
@push('script')

@endpush
@section('content')
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Detalhes do evento</h1>
  			<hr class="sm">
  			<h3>{{ $evento->nome }}</h3>
  			<hr class="sm">
            <div class="row">
            	<div class="col-md-12">
            		<a href="/storage/{{($evento->foto != null) ? 'timeline/'.$evento->foto  : 'no-event.jpg'}}" class="media-box">
	                	<img src="{{($evento->foto != null) ? '/carrega_imagem/800,400,timeline,'.$evento->foto : '/carrega_imagem/800,400,X,no-event.jpg'}}" alt="">
	                </a>
	                <p>
	                	{{ $evento->descricao }}<br/>
	        			<span class="meta-data"><i class="fa fa-calendar"></i> Incício: {{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YY h:mm A')}}</span><br/>
                    	<span class="meta-data"><i class="fa fa-calendar"></i> Fim: {{\Carbon\Carbon::parse($evento->dados_horario_fim, 'UTC')->isoFormat('Do MMMM YY h:mm A')}}</span><br/>
                        <span class="meta-data event-location-address"> <i class="fa fa-map-marker"></i> {{$evento->dados_local}}</span>
	        		</p>
        		</div>
        		<h3>Inscrição</h3>
               	<form method="get" class="contact-form clearfix" action="/{{$site->url}}/inscreveEnvento">
                	<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="email" name="email"  class="form-control input-lg" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="telefone" class="form-control input-lg" placeholder="Telefone" required>
                            </div>
                        </div>
                  	</div>
                	<div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary btn-lg btn-block" value="Inscrever">
                        </div>
                  	</div>
        		</form>
        	</div>
    	</div>
	</div>
</div>
@endsection