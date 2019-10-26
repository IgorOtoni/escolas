@extends('layouts.template4')
@push('script')

@endpush
@section('content')
<div id="kids_middle_container">

	<div class="bg-level-2-full-width-container kids_bottom_content">

		<div class="bg-level-2-page-width-container l-page-width no-padding">

			<section class="kids_bottom_content_container">

				<div class="header_container"> 

					<h1>Detalhes do vídeo</h1>

				</div><!--/ .header_container-->

				<div id="sbr" class="entry-container">

					<div id="post-content">

						<article class="post-item">

							<div class="post-entry">

								<div class="post-title">

									<h1><a href="{{$midia->link}}">{{ $midia->nome }}<a></h1>
								</div><!--/ post-title-->

								<div class="border-shadow">
									<figure>
										<iframe width="544" height="255" frameborder="0" src="{{$midia->link}}"></iframe>
									</figure>
								</div><!--/ post-thumb-->

								<div class="entry">
                                    <p>
                                    	{{ $midia->descricao }}
                                    </p>
								</div><!--/ entry--> 

							</div><!--/ post-entry -->

							<div class="post-footer clearfix">

								Adicionado em {{\Carbon\Carbon::parse($midia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}

							</div><!--/ post-footer-->

						</article>

					</div>

				</div>

			</section>

			<div class="kids_clear"></div>

		</div>

	</div>

</div>
@endsection