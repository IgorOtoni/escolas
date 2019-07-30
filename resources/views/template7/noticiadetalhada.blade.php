@extends('layouts.template7')
@push('script')

@endpush
@section('content')
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area">
    <div class="ht__bradcaump__container">
    	<!-- <img src="images/bg-png/6.png" alt="bradcaump images">-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Notícia detalhada</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<!-- Start Blog Grid Area -->
<div class="dcare__blog__list bg--white">
    <div class="container">
        <div class="row">
            <!-- Start BLog Details -->
            <div class="col-lg-12">
                <div class="page__blog__details">
                    <article class="dacre__blog__details">
                        <div class="blog__thumb">
                            <img width="839" height="600" src="{{($noticia->foto != null) ? '/storage/noticias/'.$noticia->foto : '/storage/no-news.jpg'}}" alt="blog images">
                        </div>
                        <div class="blog__inner">
                            <h2>{{ $noticia->nome }}</h2>
                            <ul>
                                <li>Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</li>
                                <?php
                                if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                                    ?>
                                    Atualizada {{\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()}}
                                    <?php
                                }
                                ?>
                            </ul>

                            <p>{{ $noticia->descricao }}</p>

                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection