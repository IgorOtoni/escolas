@extends('layouts.template1')
@push('script')
<!-- InputMask -->
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

<script>
$(function(){
    $('[data-mask]').inputmask();

    $('#subscribeForm').validator('update');
});
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
        <li><a href="{{route('site.eventos',['url'=>$site->url])}}">Linha do tempo</a></li>
        <li class="active">Evento</li>
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
        <h1><?php echo htmlentities($evento->nome); ?></h1>
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
                        <p><?php echo htmlentities($evento->descricao); ?></p>
                        <ul class="info-table">
                            <li><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}</li>
                            <?php if($evento->dados_horario_fim != null){ ?>
                                <li><i class="fa fa-clock-o"></i> Final previsto para {{\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)}}</li>
                            <?php } ?>
                            <li>
                                <i class="fa fa-map-marker"></i>
                                <?php echo htmlentities($evento->dados_local); ?>
                            </li>
                            <!--<li><i class="fa fa-phone"></i> 1 800 321 4321</li>-->
                        </ul>
                    </div>
                    <div class="post-thumbnail mb-30">
                        <img src="{{($evento->foto != null) ? 'data:image;base64,'.base64_encode($evento->foto) : asset('/storage/no-event.jpg')}}" alt="">
                    </div>
                </div>
            </div>
            <section class="post-comment-form">
            <h3><i class="fa fa-share"></i> Inscrever me</h3>
            <form action="{{route('site.inscreveEnvento',['url'=>$site->url])}}" method="get" data-toggle="validator" id="subscribeForm">
                <input type="hidden" name="id_evento" value="{{$evento->id}}">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                    <input type="text" data-inputmask='"mask": "(99) 99999-9999"' data-mask name="telefone" class="form-control input-lg" placeholder="Telefone" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                    <input type="email" name="email" class="form-control input-lg" placeholder="Email" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg">Inscrever</button>
                    </div>
                </div>
                </div>
            </form>
            </section>
        </div>
    </div>
</div>
<!-- End Content -->
@endsection