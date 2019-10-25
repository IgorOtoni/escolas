<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template3\midias.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Church Activities Area Start ##### -->
<section class="church-activities-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3>Sermões</h3>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            <?php echo e($midias->appends(request()->query())->links()); ?>

        </div>

        <div class="row">

            <?php foreach($midias as $midia){ ?>
                <div class="col-12 col-lg-12">
                    <!-- Latest Sermons -->
                    <div class="latest-sermons mb-50">
                        <!-- Single Sermons Area -->
                        <div class="single-sermons">
                            <div class="sermons-content d-flex align-items-center">
                                <!-- Sermons Thumbnail -->
                                <iframe frameborder="0" src="<?php echo e($midia->link); ?>"></iframe>
                                <!-- Sermons Content -->
                                <div class="sermons-text">
                                    <a href="/<?php echo e($site->url); ?>/midia/<?php echo e($midia->id); ?>">
                                        <h6><?php echo e($midia->nome); ?></h6>
                                    </a>
                                    <p><?php echo e($midia->descricao); ?></p>
                                    <p class="date"><?php echo e(\Carbon\Carbon::parse($midia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')); ?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>
            
        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            <?php echo e($midias->appends(request()->query())->links()); ?>

        </div>

    </div>
</section>
<!-- ##### Church Activities Area End ##### -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>