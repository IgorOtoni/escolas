@extends('layouts.template7')
@push('script')

@endpush
@section('content')
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area">
    <div class="ht__bradcaump__container">
    	<!-- <img src="images/bg-png/6.png" alt="bradcaump images">-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Notícias</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<!-- Start Blog Area -->
<section class="jnr__blog_area section-padding--lg" style="background-color: #0095e8"/*style="background-image: url('{{asset('/storage/no-news.jpg')}}'); background-size: 1920px 1001px;"*/>
	<div class="container">
		<!--<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<div class="section__title text-center white--title">
					<h2 class="title__line">Últimas notícias</h2>
				</div>
			</div>
		</div>-->
		<div class="row blog__wrapper">
			<?php foreach ($noticias as $key => $noticia): ?>
				<!-- Start Single Blog -->
				<div class="col-lg-4 col-md-6 col-sm-12">
					<article class="blog">
						<div class="blog__date">
							<span>Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</span>
						</div>
						<div class="blog__thumb">
							<a href="/{{ $igreja->url }}/noticia/{{ $noticia->id }}">
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
								<li><a href="/{{ $igreja->url }}/noticia/{{ $noticia->id }}">Detalhes</a></li>
							</ul>
						</div>
					</article>
				</div>
				<!-- End Single Blog -->
			<?php endforeach ?>
		</div>
		<div class="row">
			<div class="col-md-12" style="margin-top: 50px;">
		        {{ $noticias->appends(request()->query())->links() }}
		    </div>
	    </div>
	</div>
</section>
<!-- End Blog Area -->
@endsection