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
                        <span>Data: <a class="date" title="" href="#">{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YY h:mm A')}}</a></span>
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
        </div>
    </div>
</div>
@endsection