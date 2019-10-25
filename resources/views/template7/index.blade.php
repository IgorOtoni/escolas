@extends('layouts.template7')
@push('script')

@endpush
@section('content')
<!-- Strat Slider Area -->
<div class="slide__carosel owl-carousel owl-theme">
	<?php foreach ($banners as $key => $banner): ?>
		<div class="slider__area d-flex fullscreen justify-content-start align-items-center" style="background-image: url('{{asset('/storage/banners/'.$banner->foto)}}'); background-size: 1920px 772px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12">
						<div class="slider__activation">
							<!-- Start Single Slide -->
							<div class="slide">
								<div class="slide__inner">
									<h1>{{ $banner->nome }}</h1>
									<div class="slider__text">
										<h2>{{ $banner->descricao }}</h2>
									</div>
									<?php if($banner->link != null){
			                            ?> <div class="slider__btn">
											<a class="dcare__btn" href="{{verifica_link($banner->link, $site)}}">Detalhes</a>
										</div> <?php
			                        } ?>
								</div>
							</div>
							<!-- End Single Slide -->
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>
<!-- End Slider Area -->

<!-- Start Blog Area -->
<section class="jnr__blog_area section-padding--lg" style="background-color: #0095e8"/*style="background-image: url('{{asset('/storage/no-news.jpg')}}'); background-size: 1920px 1001px;"*/>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<div class="section__title text-center white--title">
					<h2 class="title__line">Últimas notícias</h2>
				</div>
			</div>
		</div>
		<div class="row blog__wrapper mt--40">
			<?php foreach ($noticias as $key => $noticia): ?>
				<!-- Start Single Blog -->
				<div class="col-lg-4 col-md-6 col-sm-12">
					<article class="blog">
						<div class="blog__date">
							<span>Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</span>
						</div>
						<div class="blog__thumb">
							<a href="/{{ $site->url }}/noticia/{{ $noticia->id }}">
								<img width="370" height="215" src="{{($noticia->foto != null) ? '/storage/noticias/'.$noticia->foto : '/storage/no-news.jpg'}}" alt="blog images">
							</a>
						</div>
						<div class="blog__inner">
							<?php
	                        if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
	                            ?>
	                            <span>Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</span>
	                            <?php
	                        }
	                        ?>
							<h4><a href="blog-details.html">{{ $noticia->nome }}</a></h4>
							<p>{{ $noticia->descricao }}</p>
							<ul class="blog__meta d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
								<li><a href="/{{ $site->url }}/noticia/{{ $noticia->id }}">Detalhes</a></li>
							</ul>
						</div>
					</article>
				</div>
				<!-- End Single Blog -->
			<?php endforeach ?>
		</div>
	</div>
</section>
<!-- End Blog Area -->

<!-- Start upcomming Area -->
<section class="junior__upcomming__area section-padding--lg ">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<div class="section__title text-center">
					<h2 class="title__line">Últimos eventos</h2>
				</div>
			</div>
		</div>
		<div class="row upcomming__wrap mt--40">
			<?php foreach ($eventos as $key => $evento): ?>
				<!-- Start Single Upcomming Event -->
				<div class="col-lg-6 col-md-12 col-sm-12">
					<div class="upcomming__event">
						<div class="upcomming__thumb">
							<img src="{{($evento->foto != null) ? '/storage/timeline/'.$evento->foto : '/storage/no-event.jpg'}}" alt="upcomming images">
							<!--<img src="{{asset('/template_site/template-padrao-2/images/upcomming/1.png')}}" alt="upcomming images">-->
						</div>
						<div class="upcomming__inner">
							<h6><a href="/{{ $site->url }}/evento/{{ $evento->id }}">{{ $evento->nome }}</a></h6>
							<p>{{ $evento->descricao }}</p>
							<ul class="event__time">
								<li><i class="fa fa-home"></i>{{ $evento->dados_local }}</li>
								<li><i class="fa fa-clock-o"></i>{{ \Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YY h:mm A') }}</li>
							</ul>
						</div>
						<div class="event__occur">
							<img src="{{asset('/template_site/template-padrao-2/images/upcomming/shape/1.png')}}" alt="shape images">
							<div class="enent__pub">
								<span class="time">21st </span>
								<span class="bate">Dec,2017</span>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single Upcomming Event -->
			<?php endforeach ?>
		</div>
	</div>
</section>
<!-- End upcomming Area -->

<!-- Start Our Gallery Area -->
<section class="junior__gallery__area bg--white section-padding--lg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<div class="section__title text-center">
					<h2 class="title__line">Últimos álbuns</h2>
				</div>
			</div>
		</div>
		<div class="row galler__wrap mt--40">
			<?php foreach($galerias as $galeria){
	            $fotos_ = $fotos[$galeria->id];
	            $x = 0;
	            foreach($fotos_ as $foto){ ?>
					<!-- Start Single Gallery -->
					<div class="col-lg-4 col-md-6 col-sm-6 col-12">
						<div class="gallery wow fadeInUp">
							<div class="gallery__thumb">
								<a href="#">
									<img width="370" height="370" src="/storage/galerias/{{ $foto->foto }}" alt="gallery images">
								</a>
							</div>
							<div class="gallery__hover__inner">
								<div class="gallery__hover__action">
									<ul class="gallery__zoom">
										<li><a href="/storage/galerias/{{ $foto->foto }}" data-lightbox="grportimg" data-title="My caption"><i class="fa fa-search"></i></a></li>
										<li><a href="/{{ $site->url }}/galeria"><i class="fa fa-link"></i></a></li>
									</ul>
									<h4 class="gallery__title"><a href="/{{ $site->url }}/galeria">{{ $galeria->nome }}</a></h4>
								</div>
							</div>
						</div>	
					</div>	
					<!-- End Single Gallery -->
				<?php $x++; }
            } ?>
		</div>	
	</div>
</section>
<!-- End Our Gallery Area -->
@endsection