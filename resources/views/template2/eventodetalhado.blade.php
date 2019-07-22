@extends('layouts.template2')
@push('script')
<!-- InputMask -->
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

<script>
$(function(){
    $('[data-mask]').inputmask();
});
</script>

@endpush
@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/{{$igreja->url}}"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/{{$igreja->url}}/eventos">Linha do tempo</a></li>
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
                            <h2 class="post-title">{{$evento->nome}}</h2>
                            <p>{{$evento->descricao}}</p>
                            <p><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}</p>
                            <?php if($evento->dados_horario_fim != null){ ?>
                                <p><i class="fa fa-clock-o"></i> Final previsto para {{\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)}}</p>
                            <?php } ?>
                            <p><i class="fa fa-map-marker"></i> {{$evento->dados_local}}</p>
                        </div>
                        <div class="post-thumbnail mb-30">
                            @if ($evento->foto != null)
                            <img src="/storage/{{($evento->foto != null) ? "timeline/".$evento->foto : "no-event.jpg"}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Blog Content Area End ##### -->

<!-- ##### Subscribe Area Start ##### -->
<section class="subscribe-area">
    <div class="container">
        <div class="row align-items-center">
            <!-- Subscribe Text -->
            <div class="col-12 col-lg-6">
                <div class="subscribe-text">
                    <h3>Me inscrever no evento</h3>
                    <!--<h6>Subcribe Us And Tell Us About Your Story</h6>-->
                </div>
            </div>
            <!-- Subscribe Form -->
            <div class="col-12 col-lg-6">
                <div class="subscribe-form text-right">
                    <form action="/{{$igreja->url}}/inscreveEnvento" method="get" id="subscribeForm" name="subscribeForm">
                        <input type="hidden" name="id_evento" value="{{$evento->id}}">
                        @csrf
                        <input type="text" data-inputmask='"mask": "(99) 99999-9999"' data-mask name="telefone" id="subscribeTel" placeholder="Telefone" required>
                        <input type="email" name="email" id="subscribeEmail" placeholder="Email" required>
                        <button type="submit" class="btn crose-btn">Increver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Subscribe Area End ##### -->
@endsection