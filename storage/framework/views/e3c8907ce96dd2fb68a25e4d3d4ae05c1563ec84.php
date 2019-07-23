<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template4/noticias.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="kids_bottom_content">

    <div class="l-page-width">

        <div class="kids_bottom_content_container clearfix">

            <div class="recent_projects">

                <h3 class="section-title">Notícias</h3>
                <div class="kids_clear"></div>
                <ul class="projects_carousel clearfix">

                    <?php foreach($noticias as $noticia){ ?>

                        <li>
                            <div class="border-shadow">
                                <figure>
                                    <a class="prettyPhoto kids_picture" href="<?php echo e(($noticia->foto != null) ? '/storage/noticias/'.$noticia->foto : '/storage/no-news.jpg'); ?>">
                                        <img width="214" height="178" src="<?php echo e(($noticia->foto != null) ? '/storage/noticias/'.$noticia->foto : '/storage/no-news.jpg'); ?>" alt="" />
                                    </a>
                                </figure>
                            </div>
                            <h1 class="title"><?php echo e($noticia->nome); ?></h1>
                            <h4>Publicada <?php echo e(\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()); ?></h4>
                            <p>
                                <?php echo e($noticia->descricao); ?>

                            </p>
                            <footer class="aligncenter">
                                <a href="/<?php echo e($igreja->url); ?>/noticia/<?php echo e($noticia->id); ?>" class="button button-centering medium button-style1">Detalhes</a>
                            </footer>
                        </li>

                    <?php } ?>

                </ul><!--/ .projects-carousel -->

            </div><!--/ .work-carousel-->		

        </div><!--/ .kids_bottom_content_container-->

    </div><!--/ .l-page-width-->

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>