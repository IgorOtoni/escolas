<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/layouts/template2/eventos.blade.php */ ?>
<?php $__env->startPush('script'); ?>
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
        modal.find('.modal-content #foto').prop('src', '<?php echo e(asset('storage/timeline/')); ?>' + '/' + foto);
    }else{
        modal.find('.modal-content #foto').hide();
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/<?php echo e($igreja->url); ?>"><i class="fa fa-home"></i> Home</a></li>
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
    <div class="upcoming-events-heading bg-img bg-overlay bg-fixed" style="background-image: url(<?php echo e(asset('template_igreja/template-vermelho/img/bg-img/1.jpg')); ?>);">
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
                                    <?php if($evento->foto != null){ ?>
                                        <img src="/storage/timeline/<?php echo e($evento->foto); ?>" alt="">
                                    <?php }else{ ?>
                                        <img src="/storage/no-event.jpg" alt="">
                                    <?php } ?>
                                </div>
                                <!-- Content -->
                                <div class="upcoming-events-content d-flex flex-wrap align-items-center">
                                    <div class="events-text">
                                        <h4><?php echo e($evento->nome); ?></h4>
                                        <div class="events-meta">
                                            <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo e(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')); ?></a>
                                            <?php if($evento->dados_horario_fim != null){ ?>
                                                <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> Final previsto para <?php echo e(\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)); ?></a>
                                            <?php } ?>
                                            <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo e($evento->dados_local); ?></a>
                                        </div>
                                        <p><?php echo e($evento->descricao); ?></p>
                                        <!--<a href="#">Read More <i class="fa fa-angle-double-right"></i></a>-->
                                    </div>
                                    <?php /* ?>
                                    <div class="find-out-more-btn">
                                        <a href="#" data-toggle="modal" data-target="#modal-evento" data-foto="{{$evento->foto}}" data-local="{{$evento->dados_local}}" data-nome="{{$evento->nome}}" data-descricao="{{$evento->descricao}}" data-inicio="{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-fim="{{(($evento->dados_horario_fim != null) ? \Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio) : '')}}" class="btn crose-btn btn-2">Ver em detalhe</a>
                                    </div>
                                    <?php */ ?>
                                    <div class="find-out-more-btn">
                                        <a href="/<?php echo e($igreja->url); ?>/evento/<?php echo e($evento->id); ?>" class="btn crose-btn btn-2">Ver em detalhe</a>
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
<!-- end modals -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>