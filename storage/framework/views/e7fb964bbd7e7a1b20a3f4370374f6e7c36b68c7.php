<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
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
            <?php echo e($eventos_fixos->appends(request()->query())->links()); ?>

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
                                <div class="event-date"><h6><?php echo e($evento->nome); ?></h6></div>
                                <div class="event-thumbnail bg-img" style="background-image: url(<?php echo e($evento->foto != null ? 'data:image;base64,'.base64_encode($evento->foto) : asset('/storage/no-event.jpg')); ?>);"></div>
                            </div>
                            <!-- Events Content -->
                            <div class="events-content">
                                <a href="<?php echo e(route('site.eventofixo', ['url'=>$site->url,'id'=>$evento->id])); ?>"><h6><?php echo e($evento->nome); ?></h6></a>
                                <p><?php echo e($evento->dados_horario_local); ?></p>
                                <p><?php echo e($evento->descricao); ?></p>
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
            <?php echo e($eventos_fixos->appends(request()->query())->links()); ?>

        </div>
    </div>
</section>
<!-- ##### Church Activities Area End ##### -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template3/eventosfixos.blade.php ENDPATH**/ ?>