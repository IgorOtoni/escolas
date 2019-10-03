@extends('layouts.template5')
@push('script')

@endpush
@section('content')
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Contato</h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="wrap">
        <div class="c-8">
            <div class="page">
                <form method="get" action="/{{$igreja->url}}/enviaContato" id="contactform">
                    <div class="send-form">   
	                      <p>
	                      	<label>Nome:</label>
	                      	<input class="u-4" name="nome" id="name" required />
	                      </p>
	                      <p>
	                      	<label>Email:</label>
	                      	<input class="u-4" name="email" id="email" required />
	                      </p>
	                      <p>
	                      	<label>Telefone:</label>
	                      	<input class="u-4" name="telefone" id="telefone" required />
	                      </p>
	                      <p>
	                      <label>Mensagem:</label>
	                      	<textarea class="u-6" name="mensagem" id="mensagem" cols="80" rows="5" required></textarea>
	                      </p>
	                      <p>
	                      	<input type="submit" name="" class="submit" value="Enviar" />
	                      </p>
                 	</div>
             	</form>
             	<div class="google-map">
                    <iframe width="100%" height="400px" id="googleMap" src="https://maps.google.com/?ie=UTF8&amp;q={{muda_cep($igreja->cep)}}&amp;t=m&amp;z=14&amp;output=embed" allowfullscreen></iframe>
             	</div>
            </div>
        </div>
        <div class="c-4 sidebar">
            <div class="widget widget-address">
                <h3 class="widget-title">Informações de contato</h3>
                <ul>
                    <li>
                        <p class="meta">Endereço: </p>
                        <p>
                        	Cidade: {{$igreja->cidade}} - {{$igreja->estado}}<br />
                            Bairro: {{$igreja->bairro}}<br />
                            Rua: {{$igreja->rua}}, {{$igreja->num}}
                        </p>
                    </li>
                    <?php if($igreja->telefone != null){ ?>  
	                    <li>
	                        <p class="meta">Telefone: </p>
	                        <p>{{$igreja->telefone}}</p>
	                    </li>
                    <?php } ?>  
                    <li>    
                        <p class="meta">Email: </p>
                        <p><a href="mailto:{{$igreja->email}}">{{$igreja->email}}</a></p>
                    </li>
                </ul>
            </div><!--end widget-address-->
                
        </div><!-- end sidebar -->
    </div><!-- end wrap -->
    
</div><!-- end content -->
@endsection