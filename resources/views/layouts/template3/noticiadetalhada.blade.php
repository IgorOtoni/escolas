@extends('layouts.template3')
@push('script')

@endpush
@section('content')
<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url({{asset('storage/no-news.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6">
                <div class="breadcumb-text">
                    <h2>Notícia</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

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