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
<div class="breadcumb-area bg-img" style="background-image: url({{asset('template_igreja/template-escuro/img/bg-img/bg-7.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6">
                <div class="breadcumb-text">
                    <h2>Contatos</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Contact Area Start ##### -->
<section class="contact-area section-padding-0-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-info-area">
                    <div class="row">
                        <!-- Contact Information -->
                        <div class="col-12 col-lg-6">
                            <div class="contact-information">
                                <h5>Contatos</h5>
                                <!-- Single Contact Area -->
                                <div class="single-contact-area mb-30">
                                    <p>Endereço:</p>
                                    <span>Cidade: {{$igreja->cidade}} - {{$igreja->estado}}<br />
                                    Bairro: {{$igreja->bairro}}<br />
                                    Rua: {{$igreja->rua}}, n°: {{$igreja->num}}</span>
                                </div>

                                <!-- Single Contact Area -->
                                <div class="single-contact-area mb-30">
                                    <p>Telefone:</p>
                                    <?php if($igreja->telefone != null){ ?> <span>{{$igreja->telefone}}</span> <?php }else{ ?> <span class="text-red">Não informado</span> <?php } ?>
                                </div>

                                <!-- Single Contact Area -->
                                <div class="single-contact-area mb-30">
                                    <p>Email:</p>
                                    <?php if($igreja->email != null){ ?> <span>{{$igreja->email}}</span> <?php }else{ ?> <span class="text-red">Não informado</span> <?php } ?>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Form Area -->
                        <div class="col-12 col-lg-6">
                            <div class="contact-form-area">
                                <h5>Envie uma mensagem</h5>
                                <form action="/{{$igreja->url}}/enviaContato" id="contactForm" name="contactForm" method="get">
                                    @csrf
                                    <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome" required>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="Email" required>
                                    <input name="telefone" type="text" class="form-control" id="telefone" placeholder="Telefone" data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                                    <textarea name="mensagem" class="form-control" id="message" cols="30" rows="10" placeholder="Message" required></textarea>
                                    <button class="btn faith-btn" type="submit">Contact Us</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Contact Area End ##### -->

<!-- ##### Google Maps ##### -->
<div class="map-area">
    <iframe id="googleMap" src="https://maps.google.com/?ie=UTF8&amp;q={{muda_cep($igreja->cep)}}&amp;t=m&amp;z=14&amp;output=embed" allowfullscreen></iframe>
</div>
@endsection