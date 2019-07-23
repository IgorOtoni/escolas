<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template2\noticiadetalhada.blade.php */ ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/<?php echo e($igreja->url); ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/<?php echo e($igreja->url); ?>/noticias">Notícias</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Notícia</li>
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
                            <h2 class="post-title"><?php echo e($noticia->nome); ?></h2>
                            <p><?php echo e($noticia->descricao); ?></p>
                            <p><i class="fa fa-calendar" id="dth_publicacao"></i> Publicada <?php echo e(\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()); ?></p>
                            <?php
                            if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                                ?>
                                <p><i class="fa fa-clock-o" id="dth_atualizacao"></i> Atualizada <?php echo e(\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()); ?></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="post-thumbnail mb-30">
                            <?php if($noticia->foto != null): ?>
                            <img src="/storage/<?php echo e(($noticia->foto != null) ? "noticias/".$noticia->foto : "no-news.jpg"); ?>" alt="">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>