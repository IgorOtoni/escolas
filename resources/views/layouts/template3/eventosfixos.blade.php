@extends('layouts.template3')
@push('script')

@endpush
@section('content')
<!-- ##### Church Activities Area Start ##### -->
<section class="church-activities-area section-padding-50-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3>Eventos fixos</h3>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            {{ $eventos_fixos->appends(request()->query())->links() }}
        </div>

        <div class="row">
            <div class="col-12 col-lg-12">
                <!-- Upcoming Events -->
                <div class="upcoming-events mb-100">

                    <?php 
                    $x = 0;
                    foreach($eventos_fixos as $evento){
                        ?>

                        <!-- Single Upcoming Events -->
                        <div class="single-upcoming-events d-flex align-items-center">
                            <!-- Events Date & Thumbnail -->
                            <div class="event-date-thumbnail d-flex align-items-center">
                                <div class="event-date"><h6>{{$evento->nome}}</h6></div>
                                <div class="event-thumbnail bg-img" style="background-image: url({{(($evento->foto != null) ? "/storage/eventos/".$evento->foto : "/storage/no-event.jpg")}});"></div>
                            </div>
                            <!-- Events Content -->
                            <div class="events-content">
                                <a href="/{{$igreja->url}}/eventofixo/{{$evento->id}}"><h6>{{$evento->nome}}</h6></a>
                                <p>{{$evento->dados_horario_local}}</p>
                                <p>{{$evento->descricao}}</p>
                            </div>
                        </div>

                        <?php
                        $x++;
                    }
                    ?>

                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            {{ $eventos_fixos->appends(request()->query())->links() }}
        </div>
    </div>
</section>
<!-- ##### Church Activities Area End ##### -->
@endsection