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
                        <li class="breadcrumb-item"><a href="<?php echo e(route('site.index',['url'=>$site->url])); ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Galeria</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Gallery Area Start ##### -->
<section class="upcoming-events-area section-padding-0-100">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-12">
                <div class="section-heading">
                    <h2>Álbuns</h2>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-100">
            <div class="pagination-area mt-70">
                <nav aria-label="Page navigation example">
                    <?php echo e($galerias->appends(request()->query())->links()); ?>

                </nav>
            </div>
        </div>

        <?php foreach($galerias as $galeria){ ?>
            <h3><?php echo e($galeria->nome); ?></h3>
            <div class="col-12">
                <h4><i class="fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($galeria->data)->diffForHumans()); ?></h4>
            </div>
            <!-- ##### Gallery Area Start ##### -->
            <div class="gallery-area d-flex flex-wrap">
                <?php $fotos_ = $fotos[$galeria->id];
                foreach($fotos_ as $foto){ ?>
                    <!-- Single Gallery Area -->
                    <div class="single-gallery-area">
                        <a href="<?php echo e('data:image;base64,'.base64_encode($foto->foto)); ?>" class="gallery-img" title="<?php echo e($galeria->nome); ?>">
                            <img width="480" height="320" src="<?php echo e('data:image;base64,'.base64_encode($foto->foto)); ?>">
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="col-12">
                <p><?php echo e($galeria->descricao); ?></p>
            </div>
        <?php } ?>

        <div class="row d-flex justify-content-center section-padding-0-100">
            <div class="pagination-area mt-70">
                <nav aria-label="Page navigation example">
                    <?php echo e($galerias->appends(request()->query())->links()); ?>

                </nav>
            </div>
        </div>

    </div>
</section>
<!-- ##### Gallery Area End ##### -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template2/galeria.blade.php ENDPATH**/ ?>