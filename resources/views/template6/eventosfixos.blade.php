@extends('layouts.template6')
@push('script')

@endpush
@section('content')
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Eventos fixos</h1>
  			<hr class="sm">
            <div class="row">
                <ul class="sort-destination" data-sort-id="events">
                	<?php foreach($eventos_fixos as $evento){ ?>
                        <li class="col-md-4 col-sm-6 event-list-item event-item event-dynamic grid-item format-standard celebrations">
                            <div class="grid-item-inner">
                             	<a href="/storage/{{($evento->foto != null) ? 'eventos/'.$evento->foto  : 'no-event.jpg'}}" class="media-box">
                                	<img src="{{($evento->foto != null) ? '/carrega_imagem/330,206,eventos,'.$evento->foto : '/carrega_imagem/330,206,X,no-event.jpg'}}" alt="">
                                </a>
                                <div class="grid-content">
                                	<h3><a href="/{{$site->url}}/eventofixo/{{$evento->id}}" class="event-title">{{$evento->nome}}</a></h3>
                                    <span class="meta-data event-location-address"><i class="fa fa-calendar"></i> <i class="fa fa-map-marker"></i> {{$evento->dados_horario_local}}</span>
                                </div>
                                <div class="grid-footer clearfix">
                            		<a href="/{{$site->url}}/eventofixo/{{$evento->id}}" class="pull-right btn btn-primary btn-sm">Detalhes</a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            {{ $eventos_fixos->appends(request()->query())->links() }}
     	</div>
    </div>
</div>
<!-- End Body Content -->
@endsection