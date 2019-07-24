@extends('layouts.template5')
@push('script')

@endpush
@section('content')
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Detalhes do evento</h1>
        </div>
    </div>
</div>

<div id="content">	
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list">
                <div class="post">
                    <h2 class="title">{{$evento->nome}}</h2>
                    <p class="meta">
                        <span>Início: <a class="date" title="" href="#">{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YY h:mm A')}}</a></span>
                        <span>Fim: <a class="date" title="" href="#">{{\Carbon\Carbon::parse($evento->dados_horario_fim, 'UTC')->isoFormat('Do MMMM YY h:mm A')}}</a></span>
                        <span>Local: <a class="author" title="" href="#">{{$evento->dados_local}}</a></span>
                    </p>
                    <p class="image"> 
                        <a href="{{($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg"}}" rel="example_group">
                            <img src="{{($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg"}}" width="628" height="242" alt="" title="" />
                        </a>
                    </p>
                    <p>{{$evento->descricao}}</p>
                </div>
            </div>
            <h2>Inscrição</h2>
            <div class="page">
                <form method="get" action="/{{$igreja->url}}/inscreveEnvento" id="contactform">
                    <div class="send-form">
                          <p>
                            <label>Email:</label>
                            <input class="u-4" name="email" id="email" required />
                          </p>
                          <p>
                            <label>Telefone:</label>
                            <input class="u-4" name="telefone" id="telefone" required />
                          </p>
                          <p>
                            <input type="submit" name="" class="submit" value="Inscrever" />
                          </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection