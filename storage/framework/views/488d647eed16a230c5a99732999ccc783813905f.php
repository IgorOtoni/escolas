<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/template8/sermoes.blade.php */ ?>
<?php $__env->startPush('script-x'); ?>
<script type="text/javascript">
(function($) {
    $(document).ready(function () {
	    $('.page-link').each(function(index) {
	    	if($(this).text() == '<'){
	    		$('nav #pagination').append('<a class="page_prev"></a>');
			}else if($(this).text() == '>'){
				$('nav #pagination').append('<a class="page_next"></a>');
			}else{
				num = $(this).text();
				$('nav #pagination').append('<a class="page_next">' + num + '</a>');
			}
		});
	});
})(jQuery);
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content-c'); ?>
<!-- Page title -->
<div class="page_top_wrap page_top_title page_top_breadcrumbs sc_pt_st1">
    <div class="content_wrap">
        <h1 class="page_title">Vídeos</h1>
    </div>
</div>
<!-- /Page title -->
<!-- Content without sidebar -->
<div class="page_content_wrap">
    <div class="content_wrap">
        <div class="content">
            <article class="post_item post_item_single page">
                <section class="post_content">
                	<?php for($x = 0; $x < sizeof($sermoes); $x += 2){
                		$sermao_1 = $sermoes[$x];
                		$sermao_2 = (isset($sermoes[$x + 1])) ? $sermoes[$x + 1] : null; ?>
						<div class="columns_wrap sc_columns columns_nofluid sc_columns_count_2">
							<div class="column-1_2 sc_column_item sc_column_item_1 odd first">
								<h4 class="sc_title sc_title_regular margin_top_0 margin_bottom_075em"><?php echo e($sermao_1->nome); ?></h4>
								<div class="sc_video_player">
									<iframe alt="" width="515" height="290" src="<?php echo e($sermao_1->link); ?>"></iframe>
								</div>
							</div>
							<?php if($sermao_2 != null) { ?>
								<div class="column-1_2 sc_column_item sc_column_item_2 even">
									<h4 class="sc_title sc_title_regular margin_top_0 margin_bottom_075em"><?php echo e($sermao_2->nome); ?></h4>
									<div class="sc_video_player">
										<iframe alt="" width="515" height="290" src="<?php echo e($sermao_2->link); ?>"></iframe>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="sc_line sc_line_style_solid margin_top_3em"></div>
					<?php } ?>
					<nav id="pagination" class="pagination_wrap pagination_pages">
						<!--<a href="#" class="pager_first "></a>
						<a href="#" class="pager_prev "></a>
						<span class="pager_current active ">1</span>
						<a href="#" class="">2</a>
                        <a href="#" class="pager_next "></a>
                        <a href="#" class="pager_last "></a>-->
                    </nav>
					<center id="pagination_area">
				        <?php echo e($sermoes->appends(request()->query())->links()); ?>

				    </center>
                </section>
            </article>
        </div>
    </div>
</div>
<!-- /Content without sidebar -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template8normal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>