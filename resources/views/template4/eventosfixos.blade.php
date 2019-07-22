@extends('layouts.template4')
@push('script')

@endpush
@section('content')
<div class="kids_bottom_content">

    <div class="l-page-width">

        <div class="kids_bottom_content_container clearfix">

            <div class="recent_projects">

                <h3 class="section-title">Eventos fixos</h3>
                <div class="kids_clear"></div>
                <ul class="projects_carousel clearfix">

                    <?php foreach($eventos_fixos as $eventofixo){ ?>

                        <li>
                            <div class="border-shadow">
                                <figure>
                                    <a class="prettyPhoto kids_picture" href="{{($eventofixo->foto != null) ? '/storage/eventos/'.$eventofixo->foto : '/storage/no-news.jpg'}}">
                                        <img width="214" height="178" src="{{($eventofixo->foto != null) ? '/storage/eventos/'.$eventofixo->foto : '/storage/no-news.jpg'}}" alt="" />
                                    </a>
                                </figure>
                            </div>
                            <h1 class="title">{{$eventofixo->nome}}</h1>
                            <h4>{{ $eventofixo->dados_horario_local }}</h4>
                            <p>
                                {{$eventofixo->descricao}}
                            </p>
                            <footer class="aligncenter">
                                <a href="/{{$igreja->url}}/eventofixo/{{$eventofixo->id}}" class="button button-centering medium button-style1">Detalhes</a>
                            </footer>
                        </li>

                    <?php } ?>

                </ul><!--/ .projects-carousel -->

            </div><!--/ .work-carousel-->		

        </div><!--/ .kids_bottom_content_container-->

    </div><!--/ .l-page-width-->

</div>
@endsection