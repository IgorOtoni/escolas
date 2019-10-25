<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template4/eventos.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="kids_bottom_content">

    <div class="l-page-width">

        <div class="kids_bottom_content_container clearfix">

            <div class="recent_projects">

                <h3 class="section-title">Linha do tempo</h3>
                <div class="kids_clear"></div>
                <ul class="projects_carousel clearfix">

                    <?php foreach($eventos as $evento){ ?>

                        <li>
                            <div class="border-shadow">
                                <figure>
                                    <a class="prettyPhoto kids_picture" href="<?php echo e(($evento->foto != null) ? '/storage/timeline/'.$evento->foto : '/storage/no-news.jpg'); ?>">
                                        <img width="214" height="178" src="<?php echo e(($evento->foto != null) ? '/storage/timeline/'.$evento->foto : '/storage/no-news.jpg'); ?>" alt="" />
                                    </a>
                                </figure>
                            </div>
                            <h1 class="title"><?php echo e($evento->nome); ?></h1>
                            <h4>Publicada <?php echo e(\Carbon\Carbon::parse($evento->data_horario_inicio)->diffForHumans()); ?></h4>
                            <p>
                                <?php echo e($evento->descricao); ?>

                            </p>
                            <footer class="aligncenter">
                                <a href="/<?php echo e($site->url); ?>/evento/<?php echo e($evento->id); ?>" class="button button-centering medium button-style1">Detalhes</a>
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