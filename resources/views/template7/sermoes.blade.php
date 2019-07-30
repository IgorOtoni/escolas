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
                        <h2 class="bradcaump-title">Vídeos</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<!-- Start Our Gallery Area -->
<section class="junior__gallery__area bg--white">
	<div class="container">
		<!--<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<div class="section__title text-center">
					<h2 class="title__line">Vídeos</h2>
				</div>
			</div>
		</div>-->
		<div class="row galler__wrap mt--40">
			<?php foreach($sermoes as $sermao){ ?>
				<!-- Start Single Gallery -->
				<div class="col-lg-4 col-md-6 col-sm-6 col-12">
					<div class="gallery wow fadeInUp">
						<div class="gallery__thumb text-center">
							<a href="{{$sermao->link}}">
								<iframe width="360" height="360" frameborder="0" src="{{$sermao->link}}"></iframe>
							</a>
						</div>
						<div class="gallery__hover__inner">
							<div class="gallery__hover__action">
								<ul class="gallery__zoom">
									<li><a href="/{{ $igreja->url }}/sermao/{{ $sermao->id }}"><i class="fa fa-search"></i></a></li>
									<li><a href="/{{ $sermao->link }}"><i class="fa fa-link"></i></a></li>
								</ul>
								<h4 class="gallery__title"><a href="/{{ $igreja->url }}/sermao/{{ $sermao->id }}">{{ $sermao->nome }}</a></h4>
							</div>
						</div>
					</div>	
				</div>	
				<!-- End Single Gallery -->
			<?php } ?>
		</div>
		<div class="row">
			<div class="col-md-12" style="margin-top: 50px;">
		        {{ $sermoes->appends(request()->query())->links() }}
		    </div>
	    </div>
	</div>
</section>
<!-- End Our Gallery Area -->
@endsection