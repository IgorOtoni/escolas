@extends('layouts.template2')
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
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/{{$igreja->url}}"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Notícias</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Blog Area Start ##### -->
<section class="blog-area section-padding-0-0">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-12">
                <div class="section-heading">
                    <h2>Notícias</h2>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-100">
            <div class="pagination-area mt-70">
                <nav aria-label="Page navigation example">
                    {{ $noticias->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>

        <div class="row justify-content-center">
            <?php foreach($noticias as $noticia){ ?>
                <!-- Single Blog Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-blog-post mb-100">
                        <div class="post-thumbnail">
                            <a href="single-post.html">
                                <?php if($noticia->foto != null){ ?>
                                    <img src="/storage/noticias/{{$noticia->foto}}" alt=""> 
                                <?php }else{ ?>
                                    <img src="/storage/no-news.jpg" alt=""> 
                                <?php } ?>
                            </a>
                        </div>
                        <div class="post-content">
                            <?php /* ?>
                            <a data-publicacao="{{\Carbon\Carbon::parse($noticia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-atualizacao="{{(($noticia->updated_at != null) ? \Carbon\Carbon::parse($noticia->updated_at)->diffForHumans() : '')}}" data-foto="{{$noticia->foto}}" data-nome="{{$noticia->nome}}" data-descricao="{{$noticia->descricao}}" data-toggle="modal" data-target="#modal-noticia" href="#" class="post-title">
                                <h4>{{$noticia->nome}}</h4>
                            </a>
                            <?php */ ?>
                            <a href="/{{$igreja->url}}/noticia/{{$noticia->id}}"><h4>{{$noticia->nome}}</h4></a>
                            <div class="post-meta d-flex">
                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</a>
                                <?php
                                if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                                    ?>
                                    <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</a>
                                    <?php
                                }
                                ?>
                            </div>
                            <p class="post-excerpt">{{$noticia->descricao}}</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-100">
            <div class="pagination-area mt-70">
                <nav aria-label="Page navigation example">
                    {{ $noticias->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Area End ##### -->

<!-- modals -->
<div class="modal fade" id="modal-noticia">
    <input type="hidden" name="id" id="id">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="nome"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
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
            <button type="button" class="btn crose-btn btn-2" data-dismiss="modal">Fechar</button>
        </div>
        </div>
    </div>
    </div>
</div>
<!-- end modals -->
@endsection