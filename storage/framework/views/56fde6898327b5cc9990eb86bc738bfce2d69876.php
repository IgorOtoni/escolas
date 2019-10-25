<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template2\midiadetalhado.blade.php */ ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/<?php echo e($site->url); ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/<?php echo e($site->url); ?>/midias">Sermões</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sermão</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Sermons Area Start ##### -->
<div class="sermons-details-area section-padding-100">
    <div class="container">
        <div class="row justify-content-between">
            <!-- Blog Posts Area -->
            <div class="col-12 col-lg-8">
                <div class="sermons-details-area">

                    <!-- Sermons Details Area -->
                    <div class="single-post-details-area">
                        <div class="post-content">
                            <h2 class="post-title mb-30"><?php echo e($midia->nome); ?></h2>
                            <iframe frameborder="0" src="<?php echo e($midia->link); ?>"></iframe>
                            <h6>Publicado <?php echo e(\Carbon\Carbon::parse($midia->created_at)->diffForHumans()); ?></h6>
                            <?php
                            if($midia->updated_at != null && $midia->updated_at != $midia->created_at){
                                ?>
                                <h6> Editado <?php echo e(\Carbon\Carbon::parse($midia->updated_at)->diffForHumans()); ?></h6>
                                <?php
                            }
                            ?>
                            <p><?php echo e($midia->descricao); ?></p>
                            <a class="btn crose-btn mt-15" href="<?php echo e($midia->link); ?>">Assistir</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Sermons End Start ##### -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>