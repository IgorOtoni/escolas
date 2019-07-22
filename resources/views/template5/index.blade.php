@extends('layouts.template5')
@push('script')

@endpush
@section('content')
<div id="content" class="home">
    	
    <div id="slider">
    <div class="wrap">
        
        <div class="c-12">
            <div id="big-slider">
                <div class="slider-mask"></div>
                <ul id="slider-items">
                    <?php
                    $x = 1;
                    foreach($banners as $banner){
                        ?><li><?php
                        if($banner->link != null){
                            ?> <a href="{{verifica_link($banner->link, $igreja)}}"> <?php
                        }
                        ?> <img src="/storage/banners/{{$banner->foto}}" width="650" height="293" alt="Slider Image" title="" /> <?php
                        if($banner->link != null){
                            ?> </a> <?php
                        }
                        ?></li><?php
                    }
                    ?>
                </ul>
                
                <!-- This list is populated by jQuery Cycle -->
                <div id="pagination-container">
                    <span class="previous"></span>
                    <span id="slider-pagination"></span>
                    <span class="next"></span>
                </div>
            </div><!-- END big-slider -->
        </div>
            
    </div><!-- end wrap -->
    
    <div id="slider-bg"></div><!-- END slider-bg // ljulja, togodan, vepak // pronunced by my son Luka :) -->
        
    </div><!-- end slider-->

    <?php
    if($noticias != null && sizeof($noticias) != 0){
        ?>
        <div id="container-middle">
        <div class="wrap">
            <h1 style="font-family: TOONISH,Georgia,'Times New Roman',Times,serif;
            text-transform: uppercase;
            color: #f55029;">Últimas notícias</h1>
        </div>
        <div class="wrap">
        
            <?php 
            $x = 0;
            foreach($noticias as $noticia){
                if($x < 3){
                    ?>

                    <div class="c-4">
                        <h3>{{$noticia->nome}}</h3>
                        <h4>Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</h4>
                        <div class="mask">
                            <a title="" href="{{($noticia->foto != null) ? "/storage/noticias/".$noticia->foto : "/storage/no-news.jpg"}}" rel="example_group">
                                <span class="middle-frame-mask"></span>
                                <img width="300" height="135" src="{{($noticia->foto != null) ? "/storage/noticias/".$noticia->foto : "/storage/no-news.jpg"}}" alt="" title="" />
                            </a>    
                        </div>
                        <p>{{$noticia->descricao}}</p>
                        <a href="/{{$igreja->url}}/noticia/{{$noticia->id}}" class="read-more">Detalhes<span class="circle-arrow"></span></a>
                    </div>

                    <?php
                }else{
                    break;
                }
                $x++;
            }
            ?>
                    
        </div><!-- end wrap -->         
        </div> <!-- end container-middle -->
        <?php
    }
    ?>

    <?php
    if($eventos != null && sizeof($eventos) != 0){
        ?>
        <div class="wrap">
            <br/><h1 style="font-family: TOONISH,Georgia,'Times New Roman',Times,serif;
            text-transform: uppercase;
            color: #f55029;">Últimos eventos</h1>
        </div>
        <div class="wrap">
            <div class="c-12 divider">
            
                <div class="post-list blog-posts">
                    
                    <?php 
                    $x = 0;
                    foreach($eventos as $evento){
                        if($x < 3){
                            ?>

                            <div class="post" style="min-height: 225px;">
                                <a href="{{($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg"}}" class="image" rel="example_group">
                                    <span class="post-image-mask"></span>
                                    <img src="{{($evento->foto != null) ? "/storage/timeline/".$evento->foto : "/storage/no-event.jpg"}}" width="172" height="140" alt="" title="" />
                                </a>
                                <h2 class="title"><a href="">{{$evento->nome}}</a></h2>
                                <p class="meta">
                                    <span>Date: <a class="date" title="" href="#">{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YY h:mm A')}}</a></span>
                                    <span>Local: <a class="author" title="" href="#">{{$evento->dados_local}}</a></span>
                                </p>
                                <div class="excerpt">
                                    <p>{{$evento->descricao}}
                                    </p>
                                </div>
                                <p class="actions">
                                    <a class="read-more">Detalhes<span class="circle-arrow"></span></a>
                                </p>
                            </div><!-- end post -->

                            <?php
                        }else{
                            break;
                        }
                        $x++;
                    }
                    ?>
                    
                </div><!-- end post-list -->
                
            </div>

        </div><!-- end wrap -->
        <?php
    }
    ?>

    <?php
    if($galerias != null && sizeof($galerias) != 0){
        ?>
        <div class="wrap">
            <h1 style="font-family: TOONISH,Georgia,'Times New Roman',Times,serif;
            text-transform: uppercase;
            color: #f55029;">Últimos álbums</h1>
        </div>
        <div class="wrap">
            <div class="c-12">
                
                <ul class="portfolio-menu">
                    <?php foreach($galerias as $galeria){
                        $fotos_ = $fotos[$galeria->id];
                        $x = 0;
                        foreach($fotos_ as $foto){ ?>

                            <li class="c-6 two-column {{($x % 2 == 0) ? 'clearfix' : ''}}" style="min-height: 200px;">
                                <p class="image">
                                    <a href="/storage/galerias/{{$foto->foto}}" rel="example_group">
                                        <span class="gallery-2col-mask"></span>
                                        <img height="182" width="446" title="" alt="" src="/storage/galerias/{{$foto->foto}}" />
                                    </a>
                                </p>
                            </li>

                            <?php $x++;
                        }
                    } ?>
                </ul>
            
            </div>    
        </div><!-- end wrap -->
        <?php
    }
    ?>

</div>
@endsection