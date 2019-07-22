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
                        <li class="breadcrumb-item active" aria-current="page">Contato</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Google Maps Start ##### -->
<div class="map-area mt-30">
    <iframe src="https://maps.google.com/?ie=UTF8&amp;q={{muda_cep($igreja->cep)}}&amp;t=m&amp;z=14&amp;output=embed" allowfullscreen></iframe>
</div>
<!-- ##### Google Maps End ##### -->

<!-- ##### Contact Area Start ##### -->
<section class="contact-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-content-area">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="contact-content contact-information">
                                <h4>Contatos</h4>
                                <p>Email: <?php if($igreja->email != null){ echo $igreja->email; }else{ ?> <span class="text-red">Não informado</span> <?php } ?> </p>
                                <p>Telefone: <?php if($igreja->telefone != null){ echo $igreja->telefone; }else{ ?> <span class="text-red">Não informado</span> <?php } ?> </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="contact-content contact-information">
                                <h4>Endereço</h4>
                                <p>Cidade: {{$igreja->cidade}} - {{$igreja->estado}}</p>
                                <p>Bairro: {{$igreja->bairro}}</p>
                                <p>Rua: {{$igreja->rua}}, n°: {{$igreja->num}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Contact Area End ##### -->

<!-- ##### Contact Form Area Start ##### -->
<div class="contact-form section-padding-0-100">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-12">
                <div class="section-heading">
                    <h2>Envie uma mensagem</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Contact Form Area -->
                <div class="contact-form-area">
                    <form action="/{{$igreja->url}}/enviaContato" id="contactForm" name="contactForm" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="contact-name">Nome completo:</label>
                                    <input name="nome" type="text" class="form-control" id="contact-name" placeholder="Nome completo" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="contact-email">Email:</label>
                                    <input type="email" class="form-control" name="email" id="contact-email" placeholder="exemplo@gmail.com" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="contact-number">Telefone:</label>
                                    <input type="text" class="form-control" name="telefone" id="contact-number" placeholder="(99) 99999-9999" data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message">Mensagem:</label>
                                    <textarea class="form-control" name="mensagem" id="message" cols="30" rows="10" placeholder="Mensagem" required></textarea>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn crose-btn mt-15">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Contact Form Area End ##### -->
@endsection