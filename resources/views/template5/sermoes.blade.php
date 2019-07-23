@extends('layouts.template5')
@push('script')

@endpush
@section('content')
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Vídeos</h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list blog-posts">
            	<?php foreach($sermoes as $sermao){ ?>
	                <div class="post" style="min-height: 225px;">
	                	<a href="{{$sermao->link}}" class="image" rel="example_group">
	                    	<iframe frameborder="0" width="300" height="170" src="{{$sermao->link}}"></iframe>
                    	</a>
	                    <h2 class="title"><a href="/{{$igreja->url}}/sermao/{{$sermao->id}}">{{$sermao->nome}}</a></h2>
	                    <p class="meta">
	                        <span>Adicionado: <a class="date" title="" href="#"> {{\Carbon\Carbon::parse($sermao->created_at)->diffForHumans()}}</a></span>
	                    </p>
	                    <div class="excerpt">
	                        <p>{{$sermao->descricao}}</p>
	                    </div>
	                    <p class="actions">
	                    	<a href="/{{$igreja->url}}/sermao/{{$sermao->id}}" class="read-more">Detalhes<span class="circle-arrow"></span></a>
	                    </p>
	                </div>
            	<?php } ?>
            	{{ $sermoes->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection