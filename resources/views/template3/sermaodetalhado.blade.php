@extends('layouts.template3')
@push('script')

@endpush
@section('content')
<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url({{asset('template_igreja/template-escuro/img/bg-img/bg-6.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6">
                <div class="breadcumb-text">
                    <h2>Vídeo</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Sermons Area Start ##### -->
<div class="sermons-details-area section-padding-100">
    <div class="container">
        <div class="row justify-content-between">
            <!-- Blog Posts Area -->
            <div class="col-12 col-lg-8">
                <div class="sermons-details-area">

                    <!-- Sermons Details Area -->
                    <div class="single-post-details-area">
                        <div class="post-content">
                            <h2 class="post-title mb-30">{{$sermao->nome}}</h2>
                            <iframe style="width: 100%; min-height: 400px;" frameborder="0" src="{{$sermao->link}}"></iframe>
                            <h6>Publicado {{\Carbon\Carbon::parse($sermao->created_at)->diffForHumans()}}</h6>
                            <?php
                            if($sermao->updated_at != null && $sermao->updated_at != $sermao->created_at){
                                ?>
                                <h6> Editado {{\Carbon\Carbon::parse($sermao->updated_at)->diffForHumans()}}</h6>
                                <?php
                            }
                            ?>
                            <p>{{$sermao->descricao}}</p>
                            <a href="{{$sermao->link}}">Assistir</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Sermons End Start ##### -->

@endsection