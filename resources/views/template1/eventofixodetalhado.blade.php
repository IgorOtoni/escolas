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
        <li><a href="{{route('site.index',['url'=>$site->url])}}">Home</a></li>
        <li><a href="{{route('site.eventosfixos',['url'=>$site->url])}}">Eventos fixos</a></li>
        <li class="active">Evento fixo</li>
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
        <h1><?php echo htmlentities($eventofixo->nome); ?></h1>
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
                        <p><?php echo htmlentities($eventofixo->descricao); ?></p>
                        <ul class="info-table">
                        <li><i class="fa fa-calendar"></i><i class="fa fa-map-marker"></i> <?php echo htmlentities($eventofixo->dados_horario_local); ?></li>
                        </ul>
                    </div>
                    <div class="post-thumbnail mb-30">
                        <img src="{{($eventofixo->foto != null) ? 'data:image;base64,'.base64_encode($eventofixo->foto) : asset('/storage/no-event.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
@endsection