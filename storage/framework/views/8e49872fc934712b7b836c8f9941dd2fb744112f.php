<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template2\galeria.blade.php */ ?>
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
                        <li class="breadcrumb-item"><a href="/<?php echo e($site->url); ?>"><i class="fa fa-home"></i> Home</a></li>
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
            <!-- ##### Gallery Area Start ##### -->
            <div class="gallery-area d-flex flex-wrap">
                <?php $fotos_ = $fotos[$galeria->id];
                foreach($fotos_ as $foto){ ?>
                    <!-- Single Gallery Area -->
                    <div class="single-gallery-area">
                        <a href="/storage/galerias/<?php echo e($foto->foto); ?>" class="gallery-img" title="<?php echo e($galeria->nome); ?>">
                            <img src="/carrega_imagem/480,320,galerias,<?php echo e($foto->foto); ?>" alt="">
                        </a>
                    </div>
                <?php } ?>
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
<?php echo $__env->make('layouts.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>