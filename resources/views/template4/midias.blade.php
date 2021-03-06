@extends('layouts.template4')
@push('script')

@endpush
@section('banner')

@endsection
@section('content')
<div id="kids_middle_container">

	<div class="bg-level-2-full-width-container kids_bottom_content">

		<div class="bg-level-2-page-width-container l-page-width no-padding">

			<section class="kids_bottom_content_container">

				<div class="header_container">

					<h1>Vídeos</h1>

				</div>

				<div id="sbr" class="entry-container gl_col_1">
							
					<div class="gallery">
						
						<ul id="gallery">

							<?php foreach($midias as $midia){ ?>

								<li data-categories="web" class="gallery-item">

									<div class="border-shadow alignleft">
										<figure>
											<iframe frameborder="0" src="{{$midia->link}}"></iframe>
										</figure>
									</div><!--/ gallery-image-->

									<div class="gallery-text">
										<h1><a class="link" href="#">{{ $midia->nome }}</a></h1>
	                                    <p class="date"><i>{{\Carbon\Carbon::parse($midia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}</i></p>
										<p>{{$midia->descricao}}</p>
										<p><a href="/{{$site->url}}/midia/{{$midia->id}}" class="button medium button-style1 align-btn-right">Detalhes</a></p>
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
@endsection