@extends('layouts.template6')
@push('script')

@endpush
@section('content')
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Notícias</h1>
      		<hr class="sm">
            <div class="row">
                <ul class="sort-destination" data-sort-id="events">
                	<?php foreach($noticias as $noticia){ ?>

	                    <li class="col-md-4 col-sm-6 event-list-item event-item event-dynamic grid-item format-standard celebrations">
	                        <div class="grid-item-inner">
	                         	<a href="/storage/{{($noticia->foto != null) ? 'noticias/'.$noticia->foto  : 'no-news.jpg'}}" class="media-box">
	                            	<img src="{{($noticia->foto != null) ? '/carrega_imagem/330,206,noticias,'.$noticia->foto : '/carrega_imagem/330,206,X,no-news.jpg'}}" alt="">
	                            </a>
	                            <div class="grid-content">
	                            	<h3><a href="/{{$igreja->url}}/noticia/{{$noticia->id}}" class="event-title">{{$noticia->nome}}</a></h3>
	                                <span class="meta-data"><i class="fa fa-calendar"></i>
	                                	Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}
	                                </span>
	                                <?php if($noticia->updated_at != null){ ?>
		                                <span class="meta-data"><i class="fa fa-calendar"></i>
		                                	Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}
		                                </span>
	                                <?php } ?>
	                            </div>
	                            <div class="grid-footer clearfix">
	                        		<a href="/{{$igreja->url}}/noticia/{{$noticia->id}}" class="pull-right btn btn-primary btn-sm">Detalhes</a>
	                            </div>
	                        </div>
	                    </li>
                    
                    <?php } ?>
                </ul>
            </div>
            {{ $noticias->appends(request()->query())->links() }}
     	</div>
    </div>
	</div>
<!-- End Body Content -->
@endsection