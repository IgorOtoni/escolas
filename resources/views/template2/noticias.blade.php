@extends('layouts.template2')
@push('script')

@endpush
@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('site.index',['url'=>$site->url])}}"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Notícias</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Blog Area Start ##### -->
<section class="blog-area section-padding-0-0">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-12">
                <div class="section-heading">
                    <h2>Notícias</h2>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-100">
            <div class="pagination-area mt-70">
                <nav aria-label="Page navigation example">
                    {{ $noticias->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>

        <div class="row justify-content-center">
            <?php foreach($noticias as $noticia){ ?>
                <!-- Single Blog Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-blog-post mb-100">
                        <div class="post-thumbnail">
                            <a href="single-post.html">
                                <?php if($noticia->foto != null){ ?>
                                    <img src="{{'data:image;base64,'.base64_encode($noticia->foto)}}" alt=""> 
                                <?php }else{ ?>
                                    <img src="{{asset('/storage/no-news.jpg')}}" alt=""> 
                                <?php } ?>
                            </a>
                        </div>
                        <div class="post-content">
                            <?php /* ?>
                            <a data-publicacao="{{\Carbon\Carbon::parse($noticia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-atualizacao="{{(($noticia->updated_at != null) ? \Carbon\Carbon::parse($noticia->updated_at)->diffForHumans() : '')}}" data-foto="{{$noticia->foto}}" data-nome="{{$noticia->nome}}" data-descricao="{{$noticia->descricao}}" data-toggle="modal" data-target="#modal-noticia" href="#" class="post-title">
                                <h4>{{$noticia->nome}}</h4>
                            </a>
                            <?php */ ?>
                            <a href="{{route('site.noticia', ['url'=>$site->url,'id'=>$noticia->id])}}"><h4><?php echo htmlentities($noticia->nome); ?></h4></a>
                            <div class="post-meta d-flex">
                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</a>
                                <?php
                                if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                                    ?>
                                    <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</a>
                                    <?php
                                }
                                ?>
                            </div>
                            <p class="post-excerpt"><?php echo htmlentities($noticia->descricao); ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-100">
            <div class="pagination-area mt-70">
                <nav aria-label="Page navigation example">
                    {{ $noticias->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Area End ##### -->
@endsection