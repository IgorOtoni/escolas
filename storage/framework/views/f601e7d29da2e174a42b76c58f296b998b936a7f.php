<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template4/sermoes.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('banner'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="kids_middle_container">

	<!--<div class="kids_top_content">

		<div class="kids_top_content_head">
			<div class="kids_top_content_head_body"></div>
		</div>

		<div class="kids_top_content_middle">

			<div class="l-page-width"></div>

		</div>

		<div class="kids_top_content_footer"></div>

	</div>-->

	<div class="bg-level-2-full-width-container kids_bottom_content">

		<div class="bg-level-2-page-width-container l-page-width no-padding">

			<section class="kids_bottom_content_container">

				<div class="header_container">

					<h1>Vídeos</h1>

				</div>

				<div id="sbr" class="entry-container gl_col_1">
							
					<div class="gallery">
						
						<ul id="gallery">

							<?php foreach($sermoes as $sermao){ ?>

								<li data-categories="web" class="gallery-item">

									<div class="border-shadow alignleft">
										<figure>
											<iframe frameborder="0" src="<?php echo e($sermao->link); ?>"></iframe>
										</figure>
									</div><!--/ gallery-image-->

									<div class="gallery-text">
										<h1><a class="link" href="#"><?php echo e($sermao->nome); ?></a></h1>
	                                    <p class="date"><i><?php echo e(\Carbon\Carbon::parse($sermao->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')); ?></i></p>
										<p><?php echo e($sermao->descricao); ?></p>
										<p><a href="/<?php echo e($igreja->url); ?>/sermao/<?php echo e($sermao->id); ?>" class="button medium button-style1 align-btn-right">Detalhes</a></p>
									</div><!--/ gallery-text-->

									<div class="kids_clear"></div>
								</li>

							<?php } ?>

						</ul>

					</div>

				</div>

			</section>

		</div>

	</div>


</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>