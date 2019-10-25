@extends('layouts.template8banner')
@push('script-x')

@endpush
@section('banner')
<?php
if($banners != null && sizeof($banners)){
    ?>
	<!-- Revolution slider -->
	<section class="slider_wrap slider_fullwide slider_engine_revo slider_alias_education_home_slider_3">
	    <div id="rev_slider_3_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container">
	        <div id="rev_slider_3_1" class="rev_slider fullwidthabanner disp_none max-height_630">
	            <ul>
	            	<?php
	                $x = 1;
	                foreach($banners as $banner){
	                    ?>
		                <!-- Slide 1  -->
		                <li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="off" class="texture_bg_slider_full slide1">
		                    <img width="1920" height="630" src="/storage/banners/{{$banner->foto}}" alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="repeat">
		                    <div class="tp-caption titlecentered lfr stb tp-resizeme cust-z-index-5 rs-cust-style7" data-x="center" data-hoffset="0" data-y="center" data-voffset="-40" data-speed="500" data-start="650" data-easing="Power3.easeInOut" data-splitin="lines" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-end="8150" data-endspeed="300">{{$banner->nome}}
		                    </div>
		                    <div class="tp-caption slidetextcentered lfl stb tp-resizeme cust-z-index-6 rs-cust-style2" data-x="center" data-hoffset="0" data-y="center" data-voffset="85" data-speed="500" data-start="1000" data-easing="Power3.easeInOut" data-splitin="lines" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-end="8300" data-endspeed="300">
								<span class="font-w_400">{{$banner->descricao}}</span>
		                    </div>
		                    <?php
	                        if($banner->link != null){
	                            ?>
			                    <div class="tp-caption slide_button customin stb tp-resizeme cust-z-index-7 rs-cust-style3" data-x="center" data-hoffset="0" data-y="center" data-voffset="200" data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:20;transformOrigin:50% 100%;" data-speed="500" data-start="1350" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-end="8450" data-endspeed="300">
									<a href="{{verifica_link($banner->link, $site)}}" class="slide_button_white">Detalhes</a>
			                    </div>
			                    <?php
	                    	}
		                    ?>
		                </li>
		                <?php
	                }
	                ?>
	            </ul>
	            <div class="tp-bannertimer"></div>
	        </div>
	    </div>
	</section>			
	<!-- /Revolution slider -->
	<?php
}
?>
@endsection
@section('content-x')
<?php
if($noticias != null && sizeof($noticias) != 0){
    ?>
	<!-- Courses section -->
	<div class="sc_section accent_top bg_tint_light sc_bg1" data-animation="animated zoomIn normal">
		<div class="sc_section_overlay">
			<div class="sc_section_content">
				<div class="sc_content content_wrap margin_top_2_5em_imp margin_bottom_2_5em_imp">
					<h2 class="sc_title sc_title_regular sc_align_center margin_top_0 margin_bottom_085em text_center">Últimas notícias</h2>
					<div class="sc_blogger layout_courses_3 template_portfolio sc_blogger_horizontal no_description">
						<div class="isotope_wrap" data-columns="3">
							<?php foreach($noticias as $noticia){ ?>
								<!-- Courses item -->
								<div class="isotope_item isotope_item_courses isotope_column_3">
									<div class="post_item post_item_courses odd">
										<div class="post_content isotope_item_content ih-item colored square effect_dir left_to_right">
											<div class="post_featured img" style="width: 350; height: 350px">
												<a href="{{ $site->url }}/noticia/{{ $noticia->id }}">
													<img height="400" width="400" alt="" src="{{ ($noticia->foto != null) ? '/storage/noticias/'.$noticia->foto : '/storage/noticias/no-news.jpg'}}">
												</a>
												<h4 class="post_title">
													<a href="{{ $site->url }}/noticia/{{ $noticia->id }}">{{$noticia->nome}}</a>
												</h4>
												<div class="post_descr">
													<div class="post_category">
														<a href="{{ $site->url }}/noticia/{{ $noticia->id }}">{{$noticia->descricao}}</a>
													</div>
												</div>
											</div>
											<div class="post_info_wrap info">
												<div class="info-back">
													<h4 class="post_title">
														<a href="{{ $site->url }}/noticia/{{ $noticia->id }}">{{$noticia->nome}}</a>
													</h4>
													<div class="post_descr">
														<p>
															<a href="{{ $site->url }}/noticia/{{ $noticia->id }}">{{$noticia->descricao}}</a>
														</p>
														<div class="post_buttons">
															<div class="post_button">
																<a href="{{ $site->url }}/noticia/{{ $noticia->id }}" class="sc_button sc_button_square sc_button_style_filled sc_button_bg_link sc_button_size_small">Detalhes</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Courses item -->
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Courses section -->
	<?php
}
?>

<?php
if($galerias != null && sizeof($galerias) != 0){
    ?>
    <div class="page_content_wrap">
    <div class="content_wrap">
    <div class="content">
    	<h2 class="sc_title sc_title_regular sc_align_center margin_top_2_5em_imp margin_bottom_085em text_center">Últimos álbuns</h2>
        <div class="isotope_wrap " data-columns="3">
        	<?php foreach($galerias as $galeria){ ?>
        		<?php $fotos_ = $fotos[$galeria->id];
                foreach($fotos_ as $foto){ ?>
                    <div class="isotope_item isotope_item_square isotope_item_square_3 isotope_column_3	flt_34">
                        <article class="post_item post_item_square post_item_square_3 odd">
                            <div class="post_content isotope_item_content ih-item colored square effect_shift left_to_right">
                                <div class="post_featured img">
                                    <a href="post-with-sidebar.html">
										<img width="400px" height="400px" alt="" src="/storage/galerias/{{ $foto->foto }}">
									</a>
                                </div>
                                <div class="post_info_wrap info">
                                    <div class="info-back">
                                        <h4 class="post_title">
											<a href="/storage/galerias/{{ $foto->foto }}">{{$galeria->nome}}</a>
										</h4>
                                        <div class="post_descr">
                                            <p>
												<a href="post-with-sidebar.html">{{$galeria->descricao}}<br>{{\Carbon\Carbon::parse($galeria->data)->diffForHumans()}}</a>
											</p>
                                            <a href="/storage/galerias/{{ $foto->foto }}"><span class="hover_icon hover_icon_view"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                     </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    </div>
    </div>
    <?php
}
?>
@endsection
@section('content-c')
<?php
if($eventos != null && sizeof($eventos) != 0){
    ?>
	<!-- Testimonials footer -->
	<footer class="testimonials_wrap sc_section bg_tint_dark post_ts_bg3">
	    <div class="sc_section_overlay" data-bg_color="#1eaace" data-overlay="0">
	        <div class="content_wrap">
				<!-- Testimonials section -->
				<div class="sc_testimonials sc_slider_swiper swiper-slider-container sc_slider_nopagination sc_slider_controls sc_slider_height_fixed aligncenter height_12em width_100per" data-old-height="12em" data-interval="7000">
					<div class="slides swiper-wrapper">
						<?php for($x_ = sizeof($eventos) - 1; $x_ >= 0; $x_--){
							$evento = $eventos[$x_]; ?>
							<div class="swiper-slide height_12em width_100per" data-style="width:100%;height:12em;">
								<div class="sc_testimonial_item">
									<div class="sc_testimonial_avatar">
										<img alt="" src="{{ ($evento->foto != null) ? '/storage/timeline/'.$evento->foto : '/storage/no-event.jpg' }}"></div>
									<div class="sc_testimonial_content">
										<p><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}} - {{\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)}}</p>
										<p>{{$evento->dados_local}}</p>
										<p>{{$evento->descricao}}</p>
									</div>
									<div class="sc_testimonial_author">
										<a href="#">Detalhes</a>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="sc_slider_controls_wrap">
						<a class="sc_slider_prev" href="#"></a>
						<a class="sc_slider_next" href="#"></a>
					</div>
				</div>
				<!-- /Testimonials section -->
	        </div>
	    </div>
	</footer>
	<!-- /Testimonials footer -->
	<?php
}
?>
@endsection