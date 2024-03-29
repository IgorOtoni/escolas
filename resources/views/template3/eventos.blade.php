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
                    <h3>Linha do tempo</h3>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            {{ $eventos->appends(request()->query())->links() }}
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

        <div class="row d-flex justify-content-center section-padding-0-50">
            {{ $eventos->appends(request()->query())->links() }}
        </div>
    </div>
</section>
<!-- ##### Church Activities Area End ##### -->
@endsection