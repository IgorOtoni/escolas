@extends('layouts.template1')
@push('script')

@endpush
@section('content')
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="{{route('site.index',['url'=>$site->url])}}">Home</a></li>
        <li class="active">Notícias</li>
        </ol>
    </div>
    </div>
</div>
</div>
<!-- End Nav Backed Header --> 
<!-- Start Page Header -->
<div class="page-header">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <h1>Notícias</h1>
    </div>
    </div>
</div>
</div>
<!-- End Page Header --> 
<!-- Start Content -->
<div class="main" role="main">
<div id="content" class="content full">
    <div class="container">
    <center>
        {{ $noticias->appends(request()->query())->links() }}
    </center>
    <div class="row">
        <div class="col-md-12">
        <ul class="grid-holder col-3 events-grid">
            <?php foreach($noticias as $noticia){ ?>
                <li class="grid-item post format-standard">
                <div class="grid-item-inner">  
                    <?php if($noticia->foto != null){ ?>
                        <img src="{{'data:image;base64,'.base64_encode($noticia->foto)}}" alt=""> 
                    <?php }else{ ?>
                        <img src="{{asset('/storage/no-news.jpg')}}" alt=""> 
                    <?php } ?>
                    <div class="grid-content">
                    <?php /* ?>
                    <h3><a data-publicacao="{{\Carbon\Carbon::parse($noticia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-atualizacao="{{(($noticia->updated_at != null) ? \Carbon\Carbon::parse($noticia->updated_at)->diffForHumans() : '')}}" data-foto="{{$noticia->foto}}" data-nome="{{$noticia->nome}}" data-descricao="{{$noticia->descricao}}" data-toggle="modal" data-target="#modal-noticia" href="">{{$noticia->nome}}</a></h3>
                    <?php */ ?>
                    <h3><a href="{{route('site.noticia', ['url'=>$site->url,'id'=>$noticia->id])}}"><?php echo htmlentities($noticia->nome); ?></a></h3>
                    <span class="meta-data"><span><i class="fa fa-calendar"></i> Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</span><!--<span><a href="#"><i class="fa fa-tag"></i>Uncategoried</a></span>--></span>
                    <?php
                    if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                        ?>
                        <span class="meta-data"><span><i class="fa fa-calendar"></i> Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</span></span>
                        <?php
                    }
                    ?>
                    <p><?php echo htmlentities($noticia->descricao); ?></p>
                    </div>
                </div>
                </li>
            <?php } ?>
        </ul>
        </div>
    </div>
    <center>
        {{ $noticias->appends(request()->query())->links() }}
    </center>
    </div>
</div>
</div>

@endsection