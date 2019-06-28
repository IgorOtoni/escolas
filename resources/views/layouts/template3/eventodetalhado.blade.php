@extends('layouts.template3')
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
<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url({{asset('storage/no-event.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6">
                <div class="breadcumb-text">
                    <h2>Evento</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

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

<!-- ##### CTA Area Start ##### -->
<div class="faith-cta-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cta-text d-flex justify-content-between align-items-center">
                    <form id="subscribeForm" name="subscribeForm" method="get" action="/{{$igreja->url}}/inscreveEnvento" class="contact-form-area">
                        <input type="hidden" name="id_evento" value="{{$evento->id}}">
                        @csrf
                        <h5>Me inscrever</h5>
                        <input class="form-control" type="text" data-inputmask='"mask": "(99) 99999-9999"' data-mask name="telefone" placeholder="Telefone" required> 
                        <input class="form-control" type="email" name="email" placeholder="Email" required> 
                        <input type="submit" class="btn faith-btn" value="Inscrever">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### CTA Area End ##### -->

@endsection