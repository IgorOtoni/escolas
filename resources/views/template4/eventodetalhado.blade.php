@extends('layouts.template4')
@push('script')

@endpush
@section('content')
<div id="kids_middle_container">

	<div class="bg-level-2-full-width-container kids_bottom_content">

		<div class="bg-level-2-page-width-container l-page-width no-padding">

			<section class="kids_bottom_content_container">

				<div class="header_container"> 

					<h1>Detalhes do evento</h1>

				</div><!--/ .header_container-->

				<div id="sbr" class="entry-container">

					<div id="post-content">

						<article class="post-item">

							<div class="post-entry">

								<div class="post-title">

									<h1>{{ $evento->nome }}</h1>
								</div><!--/ post-title-->

								<div class="border-shadow">
									<figure>
										<img width="544" height="255" src="/storage/{{($evento->foto != null) ? "timeline/".$evento->foto : "no-news.jpg"}}" alt="">
									</figure>
								</div><!--/ post-thumb-->

								<div class="entry">
                                    <p>
                                    	{{ $evento->descricao }}
                                    </p>
								</div><!--/ entry--> 

							</div><!--/ post-entry -->

							<div class="post-footer clearfix">

							{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}<br>
                            <?php if($evento->dados_horario_fim != null){ ?>
                                Final previsto para {{\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)}}
                            <?php } ?>

							</div><!--/ post-footer-->

						</article>

					</div>

					<h3>Inscrição</h3>

					<div class="entry-container">
					
					<div class="l-grid-9 l-float-left">

						<form method="get" action="/{{$igreja->url}}/inscreveEnvento" id="contactform" class="contactForm">
							
							<fieldset>
								
								<div class="row">
									<label for="wmail">Email:</label>
									<input name="email" id="wmail" type="text" required>
								</div>

								<div class="row">
									<label for="wtel">Telefone:</label>
									<input name="Telefone" id="wtel" type="text" required>
								</div>
								
								<div class="row">
									<button type="submit" class="button medium button-style1 l-float-right-send">Inscrever</button>
									<div class="clear"></div>
								</div>
								
							</fieldset>
							
						</form><!--/ #contactform-->
						
					</div><!--/ .l-grid-9-->

					</div>

				</div>

			</section>

			<div class="kids_clear"></div>

		</div>

	</div>

</div>
@endsection