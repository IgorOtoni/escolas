@extends('layouts.template2')
@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/{{$igreja->url}}"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/{{$igreja->url}}/noticias">Notícias</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Notícia</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Blog Content Area Start ##### -->
<section class="blog-content-area section-padding-100">
    <div class="container">
        <div class="row justify-content-between">
            <!-- Blog Posts Area -->
            <div class="col-12 col-lg-8">
                <div class="blog-posts-area">

                    <!-- Post Details Area -->
                    <div class="single-post-details-area">
                        <div class="post-content">
                            <h2 class="post-title">{{$noticia->nome}}</h2>
                            <p>{{$noticia->descricao}}</p>
                            <p><i class="fa fa-calendar" id="dth_publicacao"></i> Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</p>
                            <?php
                            if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                                ?>
                                <p><i class="fa fa-clock-o" id="dth_atualizacao"></i> Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="post-thumbnail mb-30">
                            @if ($noticia->foto != null)
                            <img src="/storage/{{($noticia->foto != null) ? "noticias/".$noticia->foto : "no-news.jpg"}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->
@endsection