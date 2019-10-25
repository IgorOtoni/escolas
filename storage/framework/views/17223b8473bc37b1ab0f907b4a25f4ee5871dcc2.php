<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Donate Area Start ##### -->
<div class="faith-blog-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3>Álbuns</h3>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            <?php echo e($galerias->appends(request()->query())->links()); ?>

        </div>

        <div class="row">
            <?php foreach($galerias as $galeria){ ?>
                <h4><?php echo e($galeria->nome); ?></h4>
                <div class="col-12">
                    <h5><i class="fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($galeria->data)->diffForHumans()); ?></h5>
                </div>
                <div class="col-12">
                    <div class="donate-slides owl-carousel">
                        <?php $fotos_ = $fotos[$galeria->id];
                            foreach($fotos_ as $foto){ ?>
                            <!-- Single Donate Slide Area -->
                            <a href="#" data-foto="<?php echo e($foto->foto); ?>" data-toggle="modal" data-target="#modal-galeria"><div class="single-donate-slide">
                                <img width="255" height="255" src="<?php echo e('data:image;base64,'.base64_encode($foto->foto)); ?>" alt="">
                            </div></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-12">
                    <p><?php echo e($galeria->descricao); ?></p>
                </div>
            <?php } ?>
        </div>

        <div class="row d-flex justify-content-center section-padding-50-50">
            <?php echo e($galerias->appends(request()->query())->links()); ?>

        </div>

    </div>
</section>
<!-- ##### Donate Area End ##### -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template3/galeria.blade.php ENDPATH**/ ?>