@extends('layouts.template2')
@push('script')

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
                ?> <a href="{{verifica_link($banner->link, $site)}}"> <?php
            }
            ?>
            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url({{'data:image;base64,'.base64_encode($banner->foto)}});">
                <!-- Post Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-slides-content">
                                <h2 data-animation="fadeInUp" data-delay="100ms"><?php echo htmlentities($banner->nome); ?></h2>
                                <p data-animation="fadeInUp" data-delay="300ms"><?php echo htmlentities($banner->descricao); ?></p>
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
                                        <img src="{{'data:image;base64,'.base64_encode($noticia->foto)}}" alt=""> 
                                    <?php }else{ ?>
                                        <img src="{{asset('/storage/no-news.jpg')}}" alt=""> 
                                    <?php } ?>
                                </a>
                            </div>
                            <div class="post-content">
                                <a href="{{route('site.noticia', ['url'=>$site->url,'id'=>$noticia->id])}}"><h4><?php echo htmlentities($noticia->nome); ?></h4></a>
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
                                <p class="post-excerpt"><?php echo htmlentities($noticia->descricao); ?></p>
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
                            for($x_ = sizeof($eventos) - 1; $x_ >= 0; $x_--){
                                $evento = $eventos[$x_];
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
                                        <img src="{{($evento->foto != null) ? 'data:image;base64,'.base64_encode($evento->foto) : asset('/storage/no-event.jpg')}}" alt="">
                                    </div>
                                    <!-- Content -->
                                    <div class="upcoming-events-content d-flex flex-wrap align-items-center">
                                        <div class="events-text">
                                            <h4><?php echo htmlentities($evento->nome); ?></h4>
                                            <div class="events-meta">
                                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> {{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}</a>
                                                <?php if($evento->dados_horario_fim != null){ ?>
                                                    <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> Final previsto para {{\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)}}</a>
                                                <?php } ?>
                                                <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo htmlentities($evento->dados_local); ?></a>
                                            </div>
                                            <p><?php echo htmlentities($evento->descricao); ?></p>
                                            <!--<a href="#">Read More <i class="fa fa-angle-double-right"></i></a>-->
                                        </div>
                                        <div class="find-out-more-btn">
                                            <?php /* ?>
                                            <a href="#" data-toggle="modal" data-target="#modal-evento" data-foto="{{$evento->foto}}" data-local="{{$evento->dados_local}}" data-nome="{{$evento->nome}}" data-descricao="{{$evento->descricao}}" data-inicio="{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-fim="{{(($evento->dados_horario_fim != null) ? \Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio) : '')}}" class="btn crose-btn btn-2">Ver em detalhe</a>
                                            <?php */ ?>
                                            <a href="{{route('site.evento', ['url'=>$site->url,'id'=>$evento->id])}}" class="btn crose-btn btn-2">Ver em detalhe</a>
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
            <h3><?php echo htmlentities($galeria->nome); ?></h3>
            <!-- ##### Gallery Area Start ##### -->
            <div class="gallery-area d-flex flex-wrap">
                <?php $fotos_ = $fotos[$galeria->id];
                foreach($fotos_ as $foto){ ?>
                    <!-- Single Gallery Area -->
                    <div class="single-gallery-area">
                        <a href="{{'data:image;base64,'.base64_encode($foto->foto)}}" class="gallery-img" title="{{$galeria->nome}}">
                            <img src="{{'data:image;base64,'.base64_encode($foto->foto)}}" alt="">
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