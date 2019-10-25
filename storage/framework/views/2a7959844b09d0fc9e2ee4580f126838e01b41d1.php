<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/layouts/template2/eventodetalhado.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- InputMask -->
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>

<script>
$(function(){
    $('[data-mask]').inputmask();
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
                        <li class="breadcrumb-item"><a href="/<?php echo e($site->url); ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/<?php echo e($site->url); ?>/eventos">Linha do tempo</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Evento</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Blog Content Area Start ##### -->
<section class="blog-content-area section-padding-100">
    <div class="container">
        <div class="row justify-content-between">
            <!-- Blog Posts Area -->
            <div class="col-12 col-lg-8">
                <div class="blog-posts-area">

                    <!-- Post Details Area -->
                    <div class="single-post-details-area">
                        <div class="post-content">
                            <h2 class="post-title"><?php echo e($evento->nome); ?></h2>
                            <p><?php echo e($evento->descricao); ?></p>
                            <p><i class="fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')); ?></p>
                            <?php if($evento->dados_horario_fim != null){ ?>
                                <p><i class="fa fa-clock-o"></i> Final previsto para <?php echo e(\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)); ?></p>
                            <?php } ?>
                            <p><i class="fa fa-map-marker"></i> <?php echo e($evento->dados_local); ?></p>
                        </div>
                        <div class="post-thumbnail mb-30">
                            <?php if($evento->foto != null): ?>
                            <img src="/storage/<?php echo e(($evento->foto != null) ? "timeline/".$evento->foto : "no-event.jpg"); ?>" alt="">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->

<!-- ##### Subscribe Area Start ##### -->
<section class="subscribe-area">
    <div class="container">
        <div class="row align-items-center">
            <!-- Subscribe Text -->
            <div class="col-12 col-lg-6">
                <div class="subscribe-text">
                    <h3>Me inscrever no evento</h3>
                    <!--<h6>Subcribe Us And Tell Us About Your Story</h6>-->
                </div>
            </div>
            <!-- Subscribe Form -->
            <div class="col-12 col-lg-6">
                <div class="subscribe-form text-right">
                    <form action="/<?php echo e($site->url); ?>/inscreveEnvento" method="get" id="subscribeForm" name="subscribeForm">
                        <input type="hidden" name="id_evento" value="<?php echo e($evento->id); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="text" data-inputmask='"mask": "(99) 99999-9999"' data-mask name="telefone" id="subscribeTel" placeholder="Telefone" required>
                        <input type="email" name="email" id="subscribeEmail" placeholder="Email" required>
                        <button type="submit" class="btn crose-btn">Increver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Subscribe Area End ##### -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>