@extends('layouts.template3')
@push('script')
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

        <div class="row d-flex justify-content-center section-padding-0-50">
            {{ $eventos->appends(request()->query())->links() }}
        </div>
    </div>
</section>
<!-- ##### Church Activities Area End ##### -->

<!-- modals -->
<div class="modal fade" id="modal-evento">
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
                        <h3 class="panel-title">Detalhes do evento</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="info-table">
                        <li><i class="fa fa-calendar" id="dth_inicio"></i> </li>
                        <li><i class="fa fa-clock-o" id="dth_fim"></i> </li>
                        <li><i class="fa fa-map-marker" id="local"></i> </li>
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
<!-- modals end -->
@endsection