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
                        <li class="breadcrumb-item active" aria-current="page"><a href="/{{$igreja->url}}/sermoes">Vídeos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Vídeo</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

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
                            <a class="btn crose-btn mt-15" href="{{$sermao->link}}">Assistir</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Sermons End Start ##### -->
@endsection