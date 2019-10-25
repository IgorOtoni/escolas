<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/layouts/template2/eventosfixos.blade.php */ ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/<?php echo e($site->url); ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Eventos fixos</li>
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
    <div class="upcoming-events-heading bg-img bg-overlay bg-fixed" style="background-image: url(<?php echo e(asset('template_site/template-vermelho/img/bg-img/1.jpg')); ?>);">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-left white">
                        <h2>Eventos fixos</h2>
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
                        foreach($eventos_fixos as $evento){
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
                                        <img src="/storage/eventos/<?php echo e($evento->foto); ?>" alt="">
                                    <?php }else{ ?>
                                        <img src="/storage/no-event.jpg" alt="">
                                    <?php } ?>
                                </div>
                                <!-- Content -->
                                <div class="upcoming-events-content d-flex flex-wrap align-items-center">
                                    <div class="events-text">
                                        <h4><?php echo e($evento->nome); ?></h4>
                                        <div class="events-meta">
                                            <a href="#"><i class="fa fa-calendar"></i><i class="fa fa-map-marker"></i> <?php echo e($evento->dados_horario_local); ?></a>
                                        </div>
                                        <p><?php echo e($evento->descricao); ?></p>
                                        <!--<a href="#">Read More <i class="fa fa-angle-double-right"></i></a>-->
                                    </div>
                                    <div class="find-out-more-btn">
                                        <a href="/<?php echo e($site->url); ?>/eventofixo/<?php echo e($evento->id); ?>" class="btn crose-btn btn-2">Ver em detalhe</a>
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
<?php echo $__env->make('layouts.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>