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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('site.eventosfixos',['url'=>$site->url])}}">Eventos fixos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Evento</li>
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
                            <h2 class="post-title"><?php echo htmlentities($eventofixo->nome); ?></h2>
                            <p><?php echo htmlentities($eventofixo->descricao); ?></p>
                            <p><i class="fa fa-calendar"></i> <i class="fa fa-map-marker"></i> <?php echo htmlentities($eventofixo->dados_horario_local); ?></li></p>
                        </div>
                        <div class="post-thumbnail mb-30">
                            <img src="{{($eventofixo->foto != null) ? 'data:image;base64,'.base64_encode($eventofixo->foto) : asset('/storage/no-event.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->
@endsection