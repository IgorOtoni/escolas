@extends('layouts.template3')
@push('script')

@endpush
@section('content')
<!-- ##### Breadcumb Area Start ##### -->
<!--<div class="breadcumb-area bg-img" style="background-image: url({{asset('template_igreja/template-escuro/img/bg-img/bg-4.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6">
                <div class="breadcumb-text">
                    <h2>Visões e valores</h2>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Ministries Area Start ##### -->
<section class="ministries-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3>Sobre nós/Visões e valores</h3>
                    <p>{{$igreja->texto_apresentativo}}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Ministries Area End ##### -->

<!-- ##### Pastors Area Start ##### -->
<section class="pastors-area section-padding-100-0 bg-img bg-overlay" style="background-image: url({{asset('/template_igreja/template-escuro/img/bg-img/bg-5.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading white text-center mx-auto">
                    <!-- <img src="{{asset('/template_igreja/template-escuro/img/core-img/cross.png')}}" alt=""> -->
                    <h3>Equipe</h3>
                </div>
            </div>
        </div>

        @if ($funcoes != null && sizeof($funcoes) > 0)
            <div class="row">
                @foreach ($funcoes as $funcao)
                    @foreach ($membros[$funcao->id] as $membro)
                        <!-- Single Pastors Area -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="single-pastor-area mb-100">
                                @if ($membro->foto != null)
                                    <img src="/carrega_imagem/250,250,membros,{{$membro->foto}}" alt=""> 
                                @else
                                    <img src="/carrega_imagem/250,250,X,no-foto.png" alt=""> 
                                @endif
                                <div class="pastor-content">
                                    <h5>{{$membro->nome}} ({{$funcao->nome}})</h5>
                                    <h6>{{$membro->descricao}}</h6>
                                    <div class="pastor-meta d-flex align-items-center justify-content-between">
                                            @if ($membro->facebook != null)
                                                <a href="{{$membro->facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            @endif
                                            @if ($membro->twitter != null)
                                                <a href="{{$membro->twitter}}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                            @endif
                                            @if ($membro->youtube != null)
                                                <a href="{{$membro->youtube}}"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        @endif
    </div>
</section>
<!-- ##### Pastors Area End ##### -->
@endsection