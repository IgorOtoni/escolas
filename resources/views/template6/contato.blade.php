@extends('layouts.template6')
@push('script')

@endpush
@section('content')
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container" style="margin-bottom: 20px">
            <div class="row">
            	<div class="col-md-4 col-sm-5">
                	<h2>Informações de contato</h2>
                	<hr class="sm">
                	<h4 class="short accent-color">Endereço:</h4>
                	<p>
                		Cidade: {{$site->cidade}} - {{$site->estado}}<br />
                        Bairro: {{$site->bairro}}<br />
                        Rua: {{$site->rua}}, {{$site->num}}
                    </p>
                    <hr class="fw cont">
                    <h4 class="short accent-color">Telefone:</h4>
                	<p>{{$site->telefone}}</p>
                    <hr class="fw cont">
                    <h4 class="short accent-color">Email:</h4>
                	<p>{{$site->email}}</p>
               	</div>
                <div class="col-md-8 col-sm-7">
                	<h3>Enviar uma mensagem</h3>
                   	<form method="get" class="contact-form clearfix" action="/{{$site->url}}/enviaContato">
                    	<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="nome"  class="form-control input-lg" placeholder="Nome" required>
                                </div>
                            </div>
                       	</div>
                    	<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" name="email"  class="form-control input-lg" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="telefone" class="form-control input-lg" placeholder="Telefone" required>
                                </div>
                            </div>
                      	</div>
                    	<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea cols="6" rows="7" name="mensagem" class="form-control input-lg" placeholder="Message" required></textarea>
                                </div>
                            </div>
                      	</div>
                    	<div class="row">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Enviar">
                            </div>
                      	</div>
            		</form>
                    <div class="clearfix"></div>
                </div>
           	</div>
       	</div>
       	<div class="container">
       		<div class="row">
                <div class="col-md-12">
		            <div id=gmap>
		            	<iframe width="100%" height="400px" id="googleMap" src="https://maps.google.com/?ie=UTF8&amp;q={{muda_cep($site->cep)}}&amp;t=m&amp;z=14&amp;output=embed" allowfullscreen></iframe>
		            </div>
	            </div>
            </div>
       	</div>
    </div>
</div>
<!-- End Body Content -->
@endsection