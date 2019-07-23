@extends('layouts.template5')
@push('script')

@endpush
@section('content')
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Linha do tempo</h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list blog-posts">
            	<?php foreach($eventos as $evento){ ?>
	                <div class="post" style="min-height: 225px;">
	                    <a href="{{($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg"}}" class="image" rel="example_group">
	                    	<span class="post-image-mask"></span>
	                        <img src="{{($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg"}}" width="172" height="140" alt="" title="" />
	                    </a>
	                    <h2 class="title"><a href="/{{$igreja->url}}/evento/{{$evento->id}}">{{$evento->nome}}</a></h2>
	                    <p class="meta">
	                        <span>Data: <a class="date" title="" href="#">{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YY h:mm A')}}</a></span>
                            <span>Local: <a class="author" title="" href="#">{{$evento->dados_local}}</a></span>
	                    </p>
	                    <div class="excerpt">
	                        <p>{{$evento->descricao}}</p>
	                    </div>
	                    <p class="actions">
	                    	<a href="/{{$igreja->url}}/evento/{{$evento->id}}" class="read-more">Detalhes<span class="circle-arrow"></span></a>
	                    </p>
	                </div>
            	<?php } ?>
            	{{ $eventos->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection