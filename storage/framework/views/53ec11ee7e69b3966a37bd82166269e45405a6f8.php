<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template7/eventodetalhado.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area">
    <div class="ht__bradcaump__container">
    	<!-- <img src="images/bg-png/6.png" alt="bradcaump images">-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Evento detalhado</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<!-- Start Blog Grid Area -->
<div class="dcare__blog__list bg--white">
    <div class="container">
        <div class="row">
            <!-- Start BLog Details -->
            <div class="col-lg-12">
                <div class="page__blog__details">
                    <article class="dacre__blog__details">
                        <div class="blog__thumb">
                            <img width="839" height="600" src="<?php echo e(($evento->foto != null) ? '/storage/timeline/'.$evento->foto : '/storage/no-event.jpg'); ?>" alt="upcomming images">
                        </div>
                        <div class="blog__inner">
                            <h2><?php echo e($evento->nome); ?></h2>
                            <ul>
                                <li><i class="fa fa-home"></i> <?php echo e($evento->dados_local); ?></li>
                                <li><i class="fa fa-clock-o"></i> <?php echo e(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YY h:mm A')); ?></li>
                            </ul>

                            <p><?php echo e($evento->descricao); ?></p>

                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template7', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>