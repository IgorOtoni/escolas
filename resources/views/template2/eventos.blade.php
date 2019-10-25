@extends('layouts.template2')
@push('script')

@endpush
@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('site.index',['url'=>$site->url])}}"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Linha do tempo</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Upcoming Events Area Start ##### -->
<section class="upcoming-events-area section-padding-0-100">
    <!-- Upcoming Events Heading Area -->
    <div class="upcoming-events-heading bg-img bg-overlay bg-fixed" style="background-image: url({{asset('template_site/template-vermelho/img/bg-img/1.jpg')}});">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-left white">
                        <h2>Eventos</h2>
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
                                if($x != 0){
                                    ?> </div> <?php
                                }
                                ?> <div class="single-slide"> <?php
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
                                    <?php /* ?>
                                    <div class="find-out-more-btn">
                                        <a href="#" data-toggle="modal" data-target="#modal-evento" data-foto="{{$evento->foto}}" data-local="{{$evento->dados_local}}" data-nome="{{$evento->nome}}" data-descricao="{{$evento->descricao}}" data-inicio="{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-fim="{{(($evento->dados_horario_fim != null) ? \Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio) : '')}}" class="btn crose-btn btn-2">Ver em detalhe</a>
                                    </div>
                                    <?php */ ?>
                                    <div class="find-out-more-btn">
                                        <a href="{{route('site.evento', ['url'=>$site->url,'id'=>$evento->id])}}" class="btn crose-btn btn-2">Ver em detalhe</a>
                                    </div>
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
    </div>
</section>
<!-- ##### Upcoming Events Area End ##### -->
@endsection