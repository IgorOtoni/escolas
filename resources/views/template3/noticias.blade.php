@extends('layouts.template3')
@push('script')

@endpush
@section('content')
<!-- ##### Blog Area Start ##### -->
<div class="faith-blog-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3>Últimas notícias</h3>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            {{ $noticias->appends(request()->query())->links() }}
        </div>

        <div class="row">

            <?php foreach($noticias as $noticia){ ?>
                <!-- Single Blog Area -->
                <div class="col-12 col-lg-4">
                    <div class="single-blog-area mb-100">
                        <div class="blog-thumbnail">
                            <?php if($noticia->foto != null){ ?>
                                <img src="{{'data:image;base64,'.base64_encode($noticia->foto)}}" alt=""> 
                            <?php }else{ ?>
                                <img src="{{asset('/storage/no-news.jpg')}}" alt=""> 
                            <?php } ?>
                            <div class="post-date">
                                <a href="#">Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</a>
                            </div>
                        </div>
                        <div class="blog-content">
                            <a href="{{route('site.noticia', ['url'=>$site->url,'id'=>$noticia->id])}}" class="blog-title"><?php echo htmlentities($noticia->nome); ?></a>
                            <p><?php echo htmlentities($noticia->descricao); ?></p>
                            <?php
                            if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                                ?>
                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}</a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            {{ $noticias->appends(request()->query())->links() }}
        </div>

    </div>
</div>
<!-- ##### Blog Area End ##### -->

@endsection