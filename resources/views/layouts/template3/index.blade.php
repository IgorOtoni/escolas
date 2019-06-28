@extends('layouts.template3')
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
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            <?php
            $x = 1;
            foreach($banners as $banner){
                if($banner->link != null){
                    ?> <a href="{{verifica_link($banner->link, $igreja)}}"> <?php
                }
                ?>
                <!-- Single Hero Slide -->
                <div class="single-hero-slide bg-img bg-overlay" style="background-image: url(storage/{{(($banner->foto != null) ? "banners/".$banner->foto : "no-event.jpg")}});">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center justify-content-end">
                            <div class="col-12 col-lg-7">
                                <!-- Slides Content -->
                                <div class="hero-slides-content">
                                    <h2 data-animation="fadeInUp" data-delay="100ms">{{$banner->nome}}</h2>
                                    <h3 data-animation="fadeInUp" data-delay="300ms">{{$banner->descricao}}</h3>
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
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->
    <?php
}
?>

<?php
if($noticias != null && sizeof($noticias) != 0){
    ?>
    <!-- ##### Blog Area Start ##### -->
    <div class="faith-blog-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center mx-auto">
                        <h3>Últimas notícias</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php foreach($noticias as $noticia){ ?>
                    <!-- Single Blog Area -->
                    <div class="col-12 col-lg-4">
                        <div class="single-blog-area mb-100">
                            <div class="blog-thumbnail">
                                <?php if($noticia->foto != null){ ?>
                                    <img src="/storage/noticias/{{$noticia->foto}}" alt=""> 
                                <?php }else{ ?>
                                    <img src="/storage/no-news.jpg" alt=""> 
                                <?php } ?>
                                <div class="post-date">
                                    <?php /* ?>
                                    <a data-publicacao="{{\Carbon\Carbon::parse($noticia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-atualizacao="{{(($noticia->updated_at != null) ? \Carbon\Carbon::parse($noticia->updated_at)->diffForHumans() : '')}}" data-foto="{{$noticia->foto}}" data-nome="{{$noticia->nome}}" data-descricao="{{$noticia->descricao}}" data-toggle="modal" data-target="#modal-noticia" href="#"> Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</a>
                                    <?php */ ?>
                                    <a href="#">Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</a>
                                </div>
                            </div>
                            <div class="blog-content">
                                <a href="/{{$igreja->url}}/noticia/{{$noticia->id}}" class="blog-title">{{$noticia->nome}}</a>
                                <p>{{$noticia->descricao}}</p>
                                <?php
                                if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                                    ?>
                                    <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <!-- ##### Blog Area End ##### -->
    <?php
}
?>

<?php
if($eventos != null && sizeof($eventos) != 0){
    ?>
    <!-- ##### Church Activities Area Start ##### -->
    <section class="church-activities-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center mx-auto">
                        <h3>Últimos eventos</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-12">
                    <!-- Upcoming Events -->
                    <div class="upcoming-events mb-100">

                        <?php 
                        $x = 0;
                        foreach($eventos as $evento){
                            ?>

                            <!-- Single Upcoming Events -->
                            <div class="single-upcoming-events d-flex align-items-center">
                                <!-- Events Date & Thumbnail -->
                                <div class="event-date-thumbnail d-flex align-items-center">
                                    <div class="event-date">
                                        <h6>{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YY h:mm A')}}</h6>
                                    </div>
                                    <div class="event-thumbnail bg-img" style="background-image: url({{(($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg")}});"></div>
                                </div>
                                <!-- Events Content -->
                                <div class="events-content">
                                    <?php /* ?>
                                    <a data-toggle="modal" data-target="#modal-evento" data-foto="{{$evento->foto}}" data-local="{{$evento->dados_local}}" data-nome="{{$evento->nome}}" data-descricao="{{$evento->descricao}}" data-inicio="{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-fim="{{(($evento->dados_horario_fim != null) ? \Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio) : '')}}" href="#">
                                        <h6>{{$evento->nome}}</h6>
                                    </a>
                                    <?php */ ?>
                                    <a href="/{{$igreja->url}}/evento/{{$evento->id}}"><h6>{{$evento->nome}}</h6></a>
                                    <p>Final previsto para {{\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)}} @ {{$evento->dados_local}}</p>
                                </div>
                            </div>

                            <?php
                            $x++;
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Church Activities Area End ##### -->
    <?php
}
?>

<?php
if($galerias != null && sizeof($galerias) != 0){
    ?>
    <!-- ##### Donate Area Start ##### -->
    <section class="faith-blog-area section-padding-100-100" >
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center mx-auto">
                        <h3>Últimas Álbuns</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php foreach($galerias as $galeria){ ?>
                    <h4>{{$galeria->nome}}</h4>
                    <div class="col-12">
                        <div class="donate-slides owl-carousel">
                            <?php $fotos_ = $fotos[$galeria->id];
                                foreach($fotos_ as $foto){ ?>
                                <!-- Single Donate Slide Area -->
                                <div class="single-donate-slide">
                                    <img src="/carrega_imagem/480,320,galerias,{{$foto->foto}}" alt="">
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- ##### Donate Area End ##### -->
    <?php
}
?>
@endsection