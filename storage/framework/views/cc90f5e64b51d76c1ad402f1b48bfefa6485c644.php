<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template4/noticiadetalhada.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="kids_middle_container">

	<div class="bg-level-2-full-width-container kids_bottom_content">

		<div class="bg-level-2-page-width-container l-page-width no-padding">

			<section class="kids_bottom_content_container">

				<div class="header_container"> 

					<h1>Detalhes da notícia</h1>

				</div><!--/ .header_container-->

				<div id="sbr" class="entry-container">

					<div id="post-content">

						<article class="post-item">

							<div class="post-entry">

								<div class="post-title">

									<h1><?php echo e($noticia->nome); ?></h1>
								</div><!--/ post-title-->

								<div class="border-shadow">
									<figure>
										<img width="544" height="255" src="/storage/<?php echo e(($noticia->foto != null) ? "noticias/".$noticia->foto : "no-news.jpg"); ?>" alt="">
									</figure>
								</div><!--/ post-thumb-->

								<div class="entry">
                                    <p>
                                    	<?php echo e($noticia->descricao); ?>

                                    </p>
								</div><!--/ entry--> 

							</div><!--/ post-entry -->

							<div class="post-footer clearfix">

								Publicada <?php echo e(\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()); ?>

                            <?php
                            if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                                ?>
                                Atualizada <?php echo e(\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()); ?>

                                <?php
                            }
                            ?>

							</div><!--/ post-footer-->

						</article>

					</div>

				</div>

			</section>

			<div class="kids_clear"></div>

		</div>

	</div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>