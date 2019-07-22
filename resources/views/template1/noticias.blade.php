@extends('layouts.template1')
@push('script')
<script>
$('#modal-noticia').on('hide.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;

  var modal = $(this);

  modal.find('.modal-content #nome').html("");
  modal.find('.modal-content #descricao').html("");
  modal.find('.modal-content #dth_publicacao').html("");
  modal.find('.modal-content #dth_atualizacao').html("");
  modal.find('.modal-content #foto').show();
  modal.find('.modal-content #dth_atualizacao').show();
});

$('#modal-noticia').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    var nome = button.data('nome');
    var descricao = button.data('descricao');
    var publicacao = button.data('publicacao');
    var atualizacao = button.data('atualizacao');
    var foto = button.data('foto');

    var modal = $(this);

    if(nome != null) modal.find('.modal-content #nome').append(nome);
    if(descricao != null) modal.find('.modal-content #descricao').append(descricao);
    if(publicacao != null) modal.find('.modal-content #dth_publicacao').append(' ' + publicacao);
    if(atualizacao != null && atualizacao != ''){
        modal.find('.modal-content #dth_atualizacao').append(' Atualizada ' + atualizacao);
    }else{
        modal.find('.modal-content #dth_atualizacao').hide();
    }
    if(foto != null && foto != ''){
        modal.find('.modal-content #foto').prop('src', '{{asset('storage/noticias/')}}' + '/' + foto);
    }else{
        modal.find('.modal-content #foto').prop('src', '{{asset('storage/')}}' + '/no-news.jpg');
    }
});
</script>
@endpush
@section('content')
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="/{{$igreja->url}}/">Home</a></li>
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
                        <img src="/storage/noticias/{{$noticia->foto}}" alt=""> 
                    <?php }else{ ?>
                        <img src="/storage/no-news.jpg" alt=""> 
                    <?php } ?>
                    <div class="grid-content">
                    <?php /* ?>
                    <h3><a data-publicacao="{{\Carbon\Carbon::parse($noticia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-atualizacao="{{(($noticia->updated_at != null) ? \Carbon\Carbon::parse($noticia->updated_at)->diffForHumans() : '')}}" data-foto="{{$noticia->foto}}" data-nome="{{$noticia->nome}}" data-descricao="{{$noticia->descricao}}" data-toggle="modal" data-target="#modal-noticia" href="">{{$noticia->nome}}</a></h3>
                    <?php */ ?>
                    <h3><a href="/{{$igreja->url}}/noticia/{{$noticia->id}}">{{$noticia->nome}}</a></h3>
                    <span class="meta-data"><span><i class="fa fa-calendar"></i> Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</span><!--<span><a href="#"><i class="fa fa-tag"></i>Uncategoried</a></span>--></span>
                    <?php
                    if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                        ?>
                        <span class="meta-data"><span><i class="fa fa-calendar"></i> Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</span></span>
                        <?php
                    }
                    ?>
                    <p>{{$noticia->descricao}}</p>
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

<!-- modals -->
<div class="modal fade" id="modal-noticia">
    <input type="hidden" name="id" id="id">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="nome"></h4>
        </div>
        <div class="modal-body">
        <div class="box-body">
            <!--<article class="post-content">-->
            <div class="event-description"> <img id="foto" src="" class="img-responsive">
                <div class="spacer-20"></div>
                <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Detalhes da notícia</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="info-table">
                        <li><i class="fa fa-calendar" id="dth_publicacao"></i> </li>
                        <li><i class="fa fa-clock-o" id="dth_atualizacao"></i> </li>
                        <!--<li><i class="fa fa-phone"></i> 1 800 321 4321</li>-->
                        </ul>
                    </div>
                    </div>
                </div>
                </div>
                <p id="descricao"></p>
            </div>
            <!--</article>-->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
        </div>
        </div>
    </div>
    </div>
</div>
<!-- end modals -->
@endsection