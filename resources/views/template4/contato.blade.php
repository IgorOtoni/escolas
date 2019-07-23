@extends('layouts.template4')
@push('script')

@endpush
@section('content')
<div id="kids_middle_container">

	<div class="bg-level-2-full-width-container kids_bottom_content">
		
		<div class="bg-level-2-page-width-container l-page-width no-padding">
			
			<section class="kids_bottom_content_container">
				
				<div class="header_container">
					
					<h1>Contato</h1>
					
				</div>
				
				<div class="entry-container">
					
					<div class="l-grid-9 l-float-left">

						<form action="/{{$igreja->url}}/enviaContato" id="contactform" class="contactForm">
							
							<fieldset>
								<div class="row"> 
									<label for="wname">Nome:</label>
									<input name="nome" id="wname" type="text" required>
								</div>
								
								<div class="row">
									<label for="wmail">Email:</label>
									<input name="email" id="wmail" type="text" required>
								</div>

								<div class="row">
									<label for="wtel">Telefone:</label>
									<input name="Telefone" id="wtel" type="text" required>
								</div>
								
								<div class="row">
									<label for="wmessage">Message:</label>
									<textarea name="mensagem" id="wmessage" cols="60" rows="10" required></textarea>		
								</div>
								
								<div class="row">
									<button type="submit" class="button medium button-style1 l-float-right-send" value="send">send</button>
									<div class="clear"></div>
								</div>
								
							</fieldset>
							
						</form><!--/ #contactform-->
						
					</div><!--/ .l-grid-9-->
					
					<div class="l-grid-5 l-float-right">
						
						<h1>Mapa</h1>
						
						<div class="map-substrate">
							
							<div class="border-shadow">
								<figure>
									<iframe id="googleMap" src="https://maps.google.com/?ie=UTF8&amp;q={{muda_cep($igreja->cep)}}&amp;t=m&amp;z=14&amp;output=embed" allowfullscreen></iframe>
								</figure>
							</div>
							
						</div> 

						<div class="contact-address">
							<h1>Informações de contato</h1>
							<address>
                                Cidade: {{$igreja->cidade}} - {{$igreja->estado}}<br />
                                Bairro: {{$igreja->bairro}}<br />
                                Rua: {{$igreja->rua}}, n°: {{$igreja->num}}
							</address>
							<address> 
								<?php if($igreja->telefone != null){ ?> <span>{{$igreja->telefone}}</span> <?php } ?>
							</address>
							<address>
								<?php if($igreja->email != null){ ?> <span>{{$igreja->email}}</span> <?php } ?>
							</address>
						</div><!--/ contact-address-->
					</div><!--/ l-grid-5-->
					<div class="kids_clear"></div>                                
				</div><!-- .gallery_container -->
			</section><!-- .bottom_content_container -->
			
		</div>
	</div>

</div><!-- .end_content -->
@endsection