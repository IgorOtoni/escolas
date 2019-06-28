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

<script>
$('#modal-evento').on('hide.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;

    var modal = $(this);

    modal.find('.modal-content #nome').html("");
    modal.find('.modal-content #descricao').html("");
    modal.find('.modal-content #dth_inicio').html("");
    modal.find('.modal-content #dth_fim').html("");
    modal.find('.modal-content #local').html("");
    modal.find('.modal-content #src').prop('src', '');
    modal.find('.modal-content #dth_fim').show();
    modal.find('.modal-content #foto').show();
});

$('#modal-evento').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    var nome = button.data('nome');
    var descricao = button.data('descricao');
    var inicio = button.data('inicio');
    var fim = button.data('fim');
    var local = button.data('local');
    var foto = button.data('foto');

    var modal = $(this);

    if(nome != null) modal.find('.modal-content #nome').append(nome);
    if(descricao != null) modal.find('.modal-content #descricao').append(descricao);
    if(inicio != null) modal.find('.modal-content #dth_inicio').append(' ' + inicio);
    if(fim != null && fim != ''){
        modal.find('.modal-content #dth_fim').append(' Final previsto para ' + fim);
    }else{
        modal.find('.modal-content #dth_fim').hide();
    }
    if(local != null) modal.find('.modal-content #local').append(' ' + local);
    if(foto != null && foto != ''){
        modal.find('.modal-content #foto').prop('src', '{{asset('storage/timeline/')}}' + '/' + foto);
    }else{
        modal.find('.modal-content #foto').hide();
    }
});
</script>
@endpush
@section('content')
<?php
if($banners != null && sizeof($banners)){
    ?>
    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area hero-post-slides owl-carousel">
        <?php
        $x = 1;
        foreach($banners as $banner){
            if($banner->link != null){
                ?> <a href="{{verifica_link($banner->link, $igreja)}}"> <?php
            }
            ?>
            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(storage/{{(($banner->foto != null) ? "banners/".$banner->foto : "no-event.jpg")}});">
                <!-- Post Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-slides-content">
                                <h2 data-animation="fadeInUp" data-delay="100ms">{{$banner->nome}}</h2>
                                <p data-animation="fadeInUp" data-delay="300ms">{{$banner->descricao}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if($banner->link != null){
                ?> </a> <?php
            }
        }
        ?>
    </section>
    <!-- ##### Hero Area End ##### -->
    <?php
}
?>

<?php
if($noticias != null && sizeof($noticias) != 0){
    ?>
    <!-- ##### Blog Area Start ##### -->
    <section class="blog-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading">
                        <h2>Últimas notícias</h2>
                    </div>
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
        </div>
    </section>
    <!-- ##### Blog Area End ##### -->
    <?php
}
?>

<?php
if($eventos != null && sizeof($eventos) != 0){
    ?>
    <!-- ##### Upcoming Events Area Start ##### -->
    <section class="upcoming-events-area section-padding-0-100">
        <!-- Upcoming Events Heading Area -->
        <div class="upcoming-events-heading bg-img bg-overlay bg-fixed" style="background-image: url(storage/no-event.jpg);">
            <div class="container">
                <div class="row">
                    <!-- Section Heading -->
                    <div class="col-12">
                        <div class="section-heading text-left white">
                            <h2>Últimos eventos</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Events Slide -->
        <div class="upcoming-events-slides-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="upcoming-slides owl-carousel">

                            <?php 
                            $x = 0;
                            foreach($eventos as $evento){
                                if($x % 4 == 0){
                                    ?>
                                    <div class="single-slide">
                                    <?php
                                }
                                ?>

                                <!-- Single Upcoming Events Area -->
                                <div class="single-upcoming-events-area d-flex flex-wrap align-items-center">
                                    <!-- Thumbnail -->
                                    <div class="upcoming-events-thumbnail">
                                        <?php if($evento->foto != null){ ?>
                                            <img src="/storage/timeline/{{$evento->foto}}" alt="">
                                        <?php }else{ ?>
                                            <img src="/storage/no-event.jpg" alt="">
                                        <?php } ?>
                                    </div>
                                    <!-- Content -->
                                    <div class="upcoming-events-content d-flex flex-wrap align-items-center">
                                        <div class="events-text">
                                            <h4>{{$evento->nome}}</h4>
                                            <div class="events-meta">
                                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> {{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}</a>
                                                <?php if($evento->dados_horario_fim != null){ ?>
                                                    <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> Final previsto para {{\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)}}</a>
                                                <?php } ?>
                                                <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$evento->dados_local}}</a>
                                            </div>
                                            <p>{{$evento->descricao}}</p>
                                            <!--<a href="#">Read More <i class="fa fa-angle-double-right"></i></a>-->
                                        </div>
                                        <div class="find-out-more-btn">
                                            <?php /* ?>
                                            <a href="#" data-toggle="modal" data-target="#modal-evento" data-foto="{{$evento->foto}}" data-local="{{$evento->dados_local}}" data-nome="{{$evento->nome}}" data-descricao="{{$evento->descricao}}" data-inicio="{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-fim="{{(($evento->dados_horario_fim != null) ? \Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio) : '')}}" class="btn crose-btn btn-2">Ver em detalhe</a>
                                            <?php */ ?>
                                            <a href="/{{$igreja->url}}/evento/{{$evento->id}}" class="btn crose-btn btn-2">Ver em detalhe</a>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if(($x - 1) % 4 == 0 && $x > 3){
                                    ?>
                                    </div>
                                    <?php
                                }
                                $x++;
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Upcoming Events Area End ##### -->
    <?php
}
?>

<?php
if($galerias != null && sizeof($galerias) != 0){
    ?>
    <!-- ##### Gallery Area Start ##### -->
    <section class="upcoming-events-area section-padding-0-100">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading">
                        <h2>Últimos álbuns</h2>
                    </div>
                </div>
            </div>

        <?php foreach($galerias as $galeria){ ?>
            <h3>{{$galeria->nome}}</h3>
            <!-- ##### Gallery Area Start ##### -->
            <div class="gallery-area d-flex flex-wrap">
                <?php $fotos_ = $fotos[$galeria->id];
                foreach($fotos_ as $foto){ ?>
                    <!-- Single Gallery Area -->
                    <div class="single-gallery-area">
                        <a href="/storage/galerias/{{$foto->foto}}" class="gallery-img" title="{{$galeria->nome}}">
                            <img src="/carrega_imagem/480,320,galerias,{{$foto->foto}}" alt="">
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        </div>
    </section>
    <!-- ##### Gallery Area End ##### -->
    <?php
}
?>
@endsection