@extends('layouts.template3')
@push('script')

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
                    ?> <a href="{{verifica_link($banner->link, $site)}}"> <?php
                }
                ?>
                <!-- Single Hero Slide -->
                <div class="single-hero-slide bg-img bg-overlay" style="background-image: url({{'data:image;base64,'.base64_encode($banner->foto)}});">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center justify-content-end">
                            <div class="col-12 col-lg-7">
                                <!-- Slides Content -->
                                <div class="hero-slides-content">
                                    <h2 data-animation="fadeInUp" data-delay="100ms"><?php echo htmlentities($banner->nome); ?></h2>
                                    <h3 data-animation="fadeInUp" data-delay="300ms"><?php echo htmlentities($banner->descricao); ?></h3>
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
                                    <img src="{{'data:image;base64,'.base64_encode($noticia->foto)}}" alt=""> 
                                <?php }else{ ?>
                                    <img src="{{asset('/storage/no-news.jpg')}}" alt=""> 
                                <?php } ?>
                                <div class="post-date">
                                    <a href="#">Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</a>
                                </div>
                            </div>
                            <div class="blog-content">
                                <a href="{{route('sites.noticias',['url'=>$site->url,'id'=>$noticia->id])}}" class="blog-title"><?php echo htmlentities($noticia->nome); ?></a>
                                <p><?php echo htmlentities($noticia->descricao); ?></p>
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
                        for($x_ = sizeof($eventos) - 1; $x_ >= 0; $x_--){
                            $evento = $eventos[$x_];
                            ?>

                            <!-- Single Upcoming Events -->
                            <div class="single-upcoming-events d-flex align-items-center">
                                <!-- Events Date & Thumbnail -->
                                <div class="event-date-thumbnail d-flex align-items-center">
                                    <div class="event-date">
                                        <h6>{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YY h:mm A')}}</h6>
                                    </div>
                                    <div class="event-thumbnail bg-img" style="background-image: url({{($evento->foto != null) ? 'data:image;base64,'.base64_encode($evento->foto) : asset('/storage/no-event.jpg')}});"></div>
                                </div>
                                <!-- Events Content -->
                                <div class="events-content">
                                    <a href="{{route('site.evento', ['url'=>$site->url,'id'=>$evento->id])}}"><h6><?php echo htmlentities($evento->nome); ?></h6></a>
                                    <p>Final previsto para {{\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)}} @ <?php echo htmlentities($evento->dados_local); ?></p>
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
                    <h4><?php echo htmlentities($galeria->nome); ?></h4>
                    <div class="col-12">
                        <div class="donate-slides owl-carousel">
                            <?php $fotos_ = $fotos[$galeria->id];
                                foreach($fotos_ as $foto){ ?>
                                <!-- Single Donate Slide Area -->
                                <div class="single-donate-slide">
                                    <img width="480" height="320" src="{{'data:image;base64,'.base64_encode($foto->foto)}}" alt="">
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