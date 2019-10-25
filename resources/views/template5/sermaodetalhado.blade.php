@extends('layouts.template5')
@push('script')
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Detalhes do vídeo</h1>
        </div>
    </div>
</div>
@endpush
@section('content')
<div id="content">	
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list">
                <div class="post">
                    <h2 class="title">{{$midia->nome}}</h2>
                    <p class="meta">
                        <span>Adicionado: <a class="date" title="" href="#"> {{\Carbon\Carbon::parse($midia->created_at)->diffForHumans()}}</a></span>
                    </p>
                    <p class="image"> 
                        <a href="{{$midia->link}}" class="image" rel="example_group">
	                    	<iframe frameborder="0" width="800" height="400" src="{{$midia->link}}"></iframe>
                    	</a>
                    </p>
                    <p>{{$midia->descricao}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection