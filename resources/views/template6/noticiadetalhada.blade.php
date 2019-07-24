@extends('layouts.template6')
@push('script')

@endpush
@section('content')
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Detalhes da notícia</h1>
  			<hr class="sm">
  			<h3>{{ $noticia->nome }}</h3>
  			<hr class="sm">
            <div class="row">
            	<div class="col-md-12">
            		<a href="/storage/{{($noticia->foto != null) ? 'noticias/'.$noticia->foto  : 'no-news.jpg'}}" class="media-box">
                    	<img src="{{($noticia->foto != null) ? '/carrega_imagem/800,400,noticias,'.$noticia->foto : '/carrega_imagem/800,400,X,no-news.jpg'}}" alt="">
                    </a>
	                <p>
	                	{{ $noticia->descricao }}<br/>
	        			<span class="meta-data"><i class="fa fa-calendar"></i>
	                                	Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}
                        </span><br/>
                        <?php if($noticia->updated_at != null){ ?>
                            <span class="meta-data"><i class="fa fa-calendar"></i>
                            	Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}
                            </span>
                        <?php } ?>
	        		</p>
        		</div>
        	</div>
    	</div>
	</div>
</div>
@endsection