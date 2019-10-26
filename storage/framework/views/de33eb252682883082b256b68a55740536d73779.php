<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('banner'); ?>
<div class="bg-level-2-page-width-container l-page-width">
                
    <div class="kids_slider_bg">

        <div class="kids_slider_wrapper">

            <div class="kids_slider_inner_wrapper">

                <div class="camera_wrap camera_azure_skin" id="camera_wrap">

                    <?php
                    $x = 1;
                    foreach($banners as $banner){
                        ?>
                        <div data-src="/storage/banners/<?php echo e($banner->foto); ?>"></div>
                        <?php
                    }
                    ?>
                    
                 </div><!-- #camera_wrap -->

            </div><!--/ .kids_slider_inner_wrapper-->

        </div><!--/ .kids_slider_wrapper-->

    </div><!--/ .kids_slider_bg--> 
        
</div><!-- .l-page-width -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="kids_middle_container">

    <div class="kids_top_content">

        <div class="kids_top_content_head">

            <div class="kids_top_content_head_body"></div>

        </div><!-- .kids_top_content_head -->

        <div class="kids_top_content_middle">

            <div class="l-page-width"> 

                <section class="kids_posts_container clearfix">

                    <?php 
                    $x = 0;
                    foreach($eventos as $evento){
                        if($x < 3){
                            ?>

                            <article class="kids_post_block l-grid-4">
                                <h1><img width="71" height="41" class="icon" src="<?php echo e(($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg"); ?>" alt="" /><a class="link" href="#"><?php echo e($evento->nome); ?></a></h1>
                                <div class="kids_post_content">
                                    <p><?php echo e($evento->descricao); ?></p> <h3 class="l-float-right"><a class="link" href="/<?php echo e($site->url); ?>/evento/<?php echo e($evento->id); ?>">Detalhes</a></h3>
                                </div>
                            </article>

                            <?php
                        }else{
                            break;
                        }
                        $x++;
                    }
                    ?>

                </section><!-- .kids_posts_container -->

            </div><!--/ l-page-width-->

        </div><!-- .kids_top_content_middle -->

        <div class="kids_top_content_footer"></div>

    </div><!-- .kids_top_content -->

    <div class="kids_bottom_content">

        <div class="l-page-width">

            <div class="kids_bottom_content_container clearfix">

                <div class="recent_projects">

                    <h3 class="section-title">Últimas notícias</h3>
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
                                <p>
                                    <?php echo e($noticia->descricao); ?>

                                </p>
                                <footer class="aligncenter">
                                    <a href="/<?php echo e($site->url); ?>/noticia/<?php echo e($noticia->id); ?>" class="button button-centering medium button-style1">Detalhes</a>
                                </footer>
                            </li>

                        <?php } ?>

                    </ul><!--/ .projects-carousel -->

                </div><!--/ .work-carousel-->		

            </div><!--/ .kids_bottom_content_container-->

        </div><!--/ .l-page-width-->

        <div class="bg-level-2-page-width-container l-page-width no-padding">
    
            <section class="kids_bottom_content_container">
    
                <div class="header_container">
                    <h1>Últimas galerias</h1>
                </div>
    
                <div class="gl_col_4">
    
                    <ul id="gallery">
                        <?php foreach($galerias as $galeria){
                            $fotos_ = $fotos[$galeria->id];
                                foreach($fotos_ as $foto){ ?>
    
                                <li data-categories="print" class="gallery-item">
                                    
                                    <div class="border-shadow">
                                        <figure>
                                            <a target="_blank" class="prettyPhoto kids_picture" href="/storage/galerias/<?php echo e($foto->foto); ?>">
                                                <img width="202" height="138" src="/storage/galerias/<?php echo e($foto->foto); ?>" alt="" />
                                            </a>										
                                        </figure>
                                    </div>
                                    
                                </li>
    
                            <?php }
                        } ?>
                    </ul><!--/ gl_col_4-->
    
                    <div class="kids_clear"></div>
    
                </div><!-- .gl_col_4 -->
    
            </section><!-- .bottom_content_container -->
    
        </div>

    </div><!--/ .kids_bottom_content-->

</div><!-- #kids_middle_container -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template4/index.blade.php ENDPATH**/ ?>