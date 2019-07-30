<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template7/noticiadetalhada.blade.php */ ?>
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
                        <h2 class="bradcaump-title">Notícia detalhada</h2>
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
                            <img width="839" height="600" src="<?php echo e(($noticia->foto != null) ? '/storage/noticias/'.$noticia->foto : '/storage/no-news.jpg'); ?>" alt="blog images">
                        </div>
                        <div class="blog__inner">
                            <h2><?php echo e($noticia->nome); ?></h2>
                            <ul>
                                <li>Publicada <?php echo e(\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()); ?></li>
                                <?php
                                if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                                    ?>
                                    Atualizada <?php echo e(\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()); ?>

                                    <?php
                                }
                                ?>
                            </ul>

                            <p><?php echo e($noticia->descricao); ?></p>

                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template7', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>