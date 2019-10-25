<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/layouts/template8normal.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<?php echo $__env->yieldPushContent('script-x'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<body class="archive category body_style_wide body_filled article_style_stretch template_portfolio top_panel_style_dark top_panel_opacity_solid top_panel_above menu_right sidebar_hide">
    <a id="toc_top" class="sc_anchor" title="To Top" data-description="&lt;i&gt;Back to top&lt;/i&gt; - &lt;br&gt;scroll to top of the page" data-icon="icon-angle-double-up" data-url="" data-separator="yes"></a>
	<!-- Body -->
    <div class="body_wrap">
        <div class="page_wrap">
            <div class="top_panel_fixed_wrap"></div>
            <header class="top_panel_wrap bg_tint_dark">
				
				<!-- Main menu -->
                <div class="menu_main_wrap logo_left">					
                    <div class="content_wrap clearfix">
						<!-- Logo -->
                        <div class="logo">
                            <a href="/<?php echo e($site->url); ?>">
								<img style="width: 125px; height: 80px;" src="<?php echo e(asset('/storage/'.(($site->logo != null) ? 'sites/'.$site->logo : 'no-logo.jpg' ))); ?>" class="logo_main" alt="">
								<img style="width: 105px; height: 80px;" src="<?php echo e(asset('/storage/'.(($site->logo != null) ? 'sites/'.$site->logo : 'no-logo.jpg' ))); ?>" class="logo_fixed" alt="">
							</a>
                        </div>
						<!-- Logo -->

						<!-- Navigation -->
                        <a href="#" class="menu_main_responsive_button icon-menu-1"></a>
						<nav class="menu_main_nav_area">
							<ul id="menu_main" class="menu_main_nav">
								<?php
								foreach($menus as $menu){
									?><li class="menu-item menu-item-has-children"><a href="<?php echo e(verifica_link($menu->link, $site)); ?>"><?php echo e($menu->nome); ?></a><?php
										if($submenus != null && array_key_exists($menu->id, $submenus) && count($submenus[$menu->id]) > 0){ ?>
											<ul class="sub-menu">
												<?php foreach($submenus[$menu->id] as $submenu){
													?><li class="menu-item menu-item-has-children"><a href="<?php echo e(verifica_link($submenu->link, $site)); ?>"><?php echo e($submenu->nome); ?></a><?php
													if($subsubmenus != null && array_key_exists($submenu->id, $subsubmenus) && count($subsubmenus[$submenu->id]) > 0){ ?>
														<ul class="sub-menu">
															<?php foreach($subsubmenus[$submenu->id] as $subsubmenu){
																?> <li><a href="<?php echo e(verifica_link($subsubmenu->link, $site)); ?>"><?php echo e($subsubmenu->nome); ?></a></li> <?php
															} ?>
														</ul>
													<?php
													}
													?></li><?php
												} ?>
											</ul>
											<?php
										}
									?></li><?php
								}
								?>
							</ul>
						</nav>
						<!-- /Navigation -->
                    </div>
                </div>
				<!-- /Main menu -->
            </header>

            <?php echo $__env->yieldContent('content-c'); ?>

            <!-- Content -->
            <div class="page_content_wrap">
                <div class="content">
                    <article class="post_item post_item_single page">
						<section class="post_content">

            				<?php echo $__env->yieldContent('content-x'); ?>

                        </section>
                    </article>
                </div>
            </div>
            <!-- /Content without sidebar -->

            <?php echo $__env->yieldContent('content-b'); ?>
			
			<!-- Copyright -->
            <div class="copyright_wrap">
                <div class="content_wrap">
                    <p>© <?php echo e($site->nome); ?> - <b> powered by hotsystems</b></p>
                </div>
            </div>
			<!-- /Copyright -->
        </div>
    </div>
    <!-- /Body -->

    <a href="#" class="scroll_to_top icon-up-2" title="Scroll to top"></a>

    <div class="custom_html_section"></div>

</body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template8', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>