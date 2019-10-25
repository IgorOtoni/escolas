@extends('layouts.template4')
@push('script')

@endpush
@section('banner')
<div class="bg-level-2-page-width-container l-page-width">
                
    <div class="kids_slider_bg">

        <div class="kids_slider_wrapper">

            <div class="kids_slider_inner_wrapper">

                <div class="camera_wrap camera_azure_skin" id="camera_wrap">

                    <?php
                    $x = 1;
                    foreach($banners as $banner){
                        ?>
                        <div data-src="/storage/banners/{{$banner->foto}}"></div>
                        <?php
                    }
                    ?>
                    
                 </div><!-- #camera_wrap -->

            </div><!--/ .kids_slider_inner_wrapper-->

        </div><!--/ .kids_slider_wrapper-->

    </div><!--/ .kids_slider_bg--> 
        
</div><!-- .l-page-width -->
@endsection
@section('content')
<div id="kids_middle_container">

    <div class="kids_top_content">

        <div class="kids_top_content_head">

            <div class="kids_top_content_head_body"></div>

        </div><!-- .kids_top_content_head -->

        <div class="kids_top_content_middle">

            <div class="l-page-width"> 

                <section class="kids_posts_container clearfix">

                    <?php 
                    $x = 0;
                    foreach($eventos as $evento){
                        if($x < 3){
                            ?>

                            <article class="kids_post_block l-grid-4">
                                <h1><img width="71" height="41" class="icon" src="{{($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg"}}" alt="" /><a class="link" href="#">{{$evento->nome}}</a></h1>
                                <div class="kids_post_content">
                                    <p>{{$evento->descricao}}</p> <h3 class="l-float-right"><a class="link" href="/{{$site->url}}/evento/{{$evento->id}}">Detalhes</a></h3>
                                </div>
                            </article>

                            <?php
                        }else{
                            break;
                        }
                        $x++;
                    }
                    ?>

                </section><!-- .kids_posts_container -->

            </div><!--/ l-page-width-->

        </div><!-- .kids_top_content_middle -->

        <div class="kids_top_content_footer"></div>

    </div><!-- .kids_top_content -->

    <div class="kids_bottom_content">

        <div class="l-page-width">

            <div class="kids_bottom_content_container clearfix">

                <div class="recent_projects">

                    <h3 class="section-title">Últimas notícias</h3>
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
                                <p>
                                    {{$noticia->descricao}}
                                </p>
                                <footer class="aligncenter">
                                    <a href="/{{$site->url}}/noticia/{{$noticia->id}}" class="button button-centering medium button-style1">Detalhes</a>
                                </footer>
                            </li>

                        <?php } ?>

                    </ul><!--/ .projects-carousel -->

                </div><!--/ .work-carousel-->		

            </div><!--/ .kids_bottom_content_container-->

        </div><!--/ .l-page-width-->

        <div class="bg-level-2-page-width-container l-page-width no-padding">
    
            <section class="kids_bottom_content_container">
    
                <div class="header_container">
                    <h1>Últimas galerias</h1>
                </div>
    
                <div class="gl_col_4">
    
                    <ul id="gallery">
                        <?php foreach($galerias as $galeria){
                            $fotos_ = $fotos[$galeria->id];
                                foreach($fotos_ as $foto){ ?>
    
                                <li data-categories="print" class="gallery-item">
                                    
                                    <div class="border-shadow">
                                        <figure>
                                            <a target="_blank" class="prettyPhoto kids_picture" href="/storage/galerias/{{$foto->foto}}">
                                                <img width="202" height="138" src="/storage/galerias/{{$foto->foto}}" alt="" />
                                            </a>										
                                        </figure>
                                    </div>
                                    
                                </li>
    
                            <?php }
                        } ?>
                    </ul><!--/ gl_col_4-->
    
                    <div class="kids_clear"></div>
    
                </div><!-- .gl_col_4 -->
    
            </section><!-- .bottom_content_container -->
    
        </div>

    </div><!--/ .kids_bottom_content-->

</div><!-- #kids_middle_container -->
@endsection