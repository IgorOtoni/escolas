@extends('layouts.template7')
@push('script')

@endpush
@section('content')
<!-- Start Choose Us Area -->
<section class="dcare__choose__us__area section-padding--lg bg--white">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<div class="section__title text-center">
					<h2 class="title__line">Sobre nós/Visões e valores</h2>
					<p>{{ $site->texto_apresentativo }}</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Choose Us Area -->
<?php if($funcoes != null && sizeof($funcoes) > 0){ ?>
	<!-- Start Team Area -->
	<section class="dcare__team__area pb--150 bg--white">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-md-12">
					<div class="section__title text-center">
						<h2 class="title__line">Nossa membros</h2>
					</div>
				</div>
			</div>
			<div class="row mt--40">
				<?php foreach ($funcoes as $funcao){
	            	foreach ($membros[$funcao->id] as $membro){ ?>
						<!-- Start Single Team -->
						<div class="col-lg-4 col-md-6 col-sm-6 col-12">
							<div class="team">
								<div class="team__thumb">
									<a href="#">
										<img width="370" height="377" src="{{ ($membro->foto != null) ? '/storage/membros/'.$membro->foto : '/storage/no-foto.png' }}" alt="team images">
									</a>
									<div class="team__hover__action">
										<div class="team__hover__inner">
											<p>{{ $membro->descricao }}</p>
											<ul class="dacre__social__link--2 d-flex justify-content-center">
												@if ($membro->facebook != null)
													<li class="facebook"><a href="{{$membro->facebook}}"><i class="fa fa-facebook"></i></a></li>
												@endif
												@if ($membro->twitter != null)
													<li class="twitter"><a href="{{$membro->twitter}}"><i class="fa fa-twitter"></i></a></li>
												@endif
												@if ($membro->youtube != null)
													<li class="youtube"><a href="{{$membro->youtube}}"><i class="fa fa-youtube"></i></a></li>
												@endif
											</ul>
										</div>
									</div>
								</div>
								<div class="team__details">
									<div class="team__info">
										<h6><a href="#">{{$membro->nome}}</a></h6>
										<span>{{$funcao->nome}}</span>
									</div>
								</div>
							</div>
						</div>
						<!-- End Single Team -->
					<?php }
				} ?>
			</div>
		</div>
	</section>
	<!-- End Team Area -->
<?php } ?>
@endsection