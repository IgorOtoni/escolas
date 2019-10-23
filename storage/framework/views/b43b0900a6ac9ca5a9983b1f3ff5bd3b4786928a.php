<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('igreja.index',['url'=>$igreja->url])); ?>"><i class="fa fa-home"></i> Home</a></li>
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
                                    <img src="<?php echo e(($evento->foto != null) ? 'data:image;base64,'.base64_encode($evento->foto) : asset('/storage/no-event.jpg')); ?>" alt="">
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
                                        <a href="<?php echo e(route('igreja.evento', ['url'=>$igreja->url,'id'=>$evento->id])); ?>" class="btn crose-btn btn-2">Ver em detalhe</a>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template2/eventos.blade.php ENDPATH**/ ?>