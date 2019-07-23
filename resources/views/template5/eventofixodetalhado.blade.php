@extends('layouts.template5')
@push('script')

@endpush
@section('content')
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Detalhes do evento fixo</h1>
        </div>
    </div>
</div>

<div id="content">	
    <div class="wrap">
        <div class="c-12 divider">
            <div class="post-list">
                <div class="post">
                    <h2 class="title">{{$eventofixo->nome}}</h2>
                    <p class="meta">
                        <span>Horário e local: <a class="author" title="" href="#">{{$eventofixo->dados_horario_local}}</a></span>
                    </p>
                    <p class="image"> 
                        <a href="{{($eventofixo->foto != null) ? "/storage/eventos/".$eventofixo->foto : "/storage/no-event.jpg"}}" rel="example_group">
                            <img src="{{($eventofixo->foto != null) ? "/storage/eventos/".$eventofixo->foto : "/storage/no-event.jpg"}}" width="628" height="242" alt="" title="" />
                        </a>
                    </p>
                    <p>{{$eventofixo->descricao}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection