@extends('layouts.template4')
@push('script')

@endpush
@section('content')
<div class="kids_bottom_content">

    <div class="l-page-width">

        <div class="kids_bottom_content_container clearfix">

            <div class="recent_projects">

                <h3 class="section-title">Notícias</h3>
                <div class="kids_clear"></div>
                <ul class="projects_carousel clearfix">

                    <?php foreach($noticias as $noticia){ ?>

                        <li>
                            <div class="border-shadow">
                                <figure>
                                    <a class="prettyPhoto kids_picture" href="{{($noticia->foto != null) ? '/storage/noticias/'.$noticia->foto : '/storage/no-news.jpg'}}">
                                        <img width="214" height="178" src="{{($noticia->foto != null) ? '/storage/noticias/'.$noticia->foto : '/storage/no-news.jpg'}}" alt="" />
                                    </a>
                                </figure>
                            </div>
                            <h1 class="title">{{$noticia->nome}}</h1>
                            <h4>Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</h4>
                            <p>
                                {{$noticia->descricao}}
                            </p>
                            <footer class="aligncenter">
                                <a href="/{{$igreja->url}}/noticia/{{$noticia->id}}" class="button button-centering medium button-style1">Detalhes</a>
                            </footer>
                        </li>

                    <?php } ?>

                </ul><!--/ .projects-carousel -->

            </div><!--/ .work-carousel-->		

        </div><!--/ .kids_bottom_content_container-->

    </div><!--/ .l-page-width-->

</div>
@endsection