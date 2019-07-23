@extends('layouts.template5')
@push('script')

@endpush
@section('content')
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Detalhes da notícia</h1>
        </div>
    </div>
</div>

<div id="content">	
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list">
                <div class="post">
                    <h2 class="title">{{$noticia->nome}}</h2>
                    <p class="meta">
                        <span>Publicada: <a class="date" title="" href="#"> {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</a></span>
                        <span>Atualizada: <a class="date" title="" href="#"> {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</a></span>
                    </p>
                    <p class="image"> 
                        <a href="{{($noticia->foto != null) ? "/storage/noticias/".$noticia->foto : "/storage/no-news.jpg"}}" rel="example_group">
                            <img src="{{($noticia->foto != null) ? "/storage/noticias/".$noticia->foto : "/storage/no-news.jpg"}}" width="628" height="242" alt="" title="" />
                        </a>
                    </p>
                    <p>{{$noticia->descricao}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection