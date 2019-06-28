@extends('layouts.template2')
@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/{{$igreja->url}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sobre nós</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### About Us Area Start ##### -->
<div class="about-us-area about-page section-padding-100">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-12 col-lg-12">
                <div class="about-content">
                    <h2>Sobre nós</h2>
                    <p>{{$igreja->texto_apresentativo}}</p>
                </div>
            </div>
            <!--<div class="col-12 col-lg-6">
                <div class="about-thumbnail">
                    <img src="img/bg-img/26.jpg" alt="">
                </div>
            </div>-->
        </div>
    </div>
</div>
<!-- ##### About Us Area End ##### -->

@if ($funcoes != null && sizeof($funcoes) > 0)
    <!-- ##### Team Members Area Start ##### -->
    <div class="team-members-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading">
                        <h2>Equipe</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($funcoes as $funcao)
                    @foreach ($membros[$funcao->id] as $membro)
                        <!-- Team Members Area -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="single-team-members text-center mb-100">
                                <div class="team-thumb" style="background-image: url({{asset('/storage/'.($membro->foto != null ? 'membros/'.$membro->foto : 'no-foto.png'))}}); background-repeat: no-repeat; background-size: 200px 200px;">
                                    <div class="team-social-info">
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
                                <h6>{{$membro->nome}} ({{$funcao->nome}})</h6>
                                <span>{{$membro->descricao}}</span>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <!-- ##### Team Members Area End ##### -->
@endif

@endsection