@extends('layouts.template5')
@push('script')

@endpush
@section('content')
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Notícias</h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list blog-posts">
            	<?php foreach($noticias as $noticia){ ?>
	                <div class="post" style="min-height: 225px;">
	                    <a href="{{($noticia->foto != null) ? "/storage/noticias/".$noticia->foto : "/storage/no-news.jpg"}}" class="image" rel="example_group">
	                    	<span class="post-image-mask"></span>
	                        <img src="{{($noticia->foto != null) ? "/storage/noticias/".$noticia->foto : "/storage/no-news.jpg"}}" width="172" height="140" alt="" title="" />
	                    </a>
	                    <h2 class="title"><a href="/{{$igreja->url}}/noticia/{{$noticia->id}}">{{$noticia->nome}}</a></h2>
	                    <p class="meta">
	                        <span>Publicada: <a class="date" title="" href="#"> {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</a></span>
                            <span>Atualizada: <a class="date" title="" href="#"> {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</a></span>
	                    </p>
	                    <div class="excerpt">
	                        <p>{{$noticia->descricao}}</p>
	                    </div>
	                    <p class="actions">
	                    	<a href="/{{$igreja->url}}/noticia/{{$noticia->id}}" class="read-more">Detalhes<span class="circle-arrow"></span></a>
	                    </p>
	                </div>
            	<?php } ?>
            	{{ $noticias->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection