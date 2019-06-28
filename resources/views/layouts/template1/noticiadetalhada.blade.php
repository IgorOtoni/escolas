@extends('layouts.template1')
@push('script')
<script>

</script>
@endpush
@section('content')
<!-- End Site Header --> 
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="/{{$igreja->url}}/">Home</a></li>
        <li><a href="/{{$igreja->url}}/noticias">Notícias</a></li>
        <li class="active">Notícia</li>
        </ol>
    </div>
    </div>
</div>
</div>
<!-- End Nav Backed Header -->
<!-- Start Page Header -->
<div class="page-header">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <h1>{{$noticia->nome}}</h1>
    </div>
    </div>
</div>
</div>
<!-- End Page Header -->
<!-- Start Content -->
<div class="main" role="main">
    <div id="content" class="content full">
        <div class="container">
            <div class="blog-posts-area">
                <!-- Post Details Area -->
                <div class="single-post-details-area">
                    <div class="post-content">
                        <p>{{$noticia->descricao}}</p>
                        <ul class="info-table">
                        <li><i class="fa fa-calendar" id="dth_publicacao"></i> Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</li>
                        <?php
                        if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                            ?>
                            <li><i class="fa fa-clock-o" id="dth_atualizacao"></i> Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</li>
                            <?php
                        }
                        ?>
                        <!--<li><i class="fa fa-phone"></i> 1 800 321 4321</li>-->
                        </ul>
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
<!-- End Content -->
@endsection