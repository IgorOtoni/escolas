@extends('layouts.template2')
@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('site.index',['url'=>$site->url])}}"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('site.midias',['url'=>$site->url])}}">Vídeos</a></li>
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
                            <h2 class="post-title mb-30"><?php echo htmlentities($midia->nome); ?></h2>
                            <iframe style="width: 100%; min-height: 400px;" frameborder="0" src="{{$midia->link}}"></iframe>
                            <h6>Publicado {{\Carbon\Carbon::parse($midia->created_at)->diffForHumans()}}</h6>
                            <?php
                            if($midia->updated_at != null && $midia->updated_at != $midia->created_at){
                                ?>
                                <h6> Editado {{\Carbon\Carbon::parse($midia->updated_at)->diffForHumans()}}</h6>
                                <?php
                            }
                            ?>
                            <p><?php echo htmlentities($midia->descricao); ?></p>
                            <a class="btn crose-btn mt-15" href="{{$midia->link}}">Assistir</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Sermons End Start ##### -->
@endsection