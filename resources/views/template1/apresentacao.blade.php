@extends('layouts.template1')
@section('content')
<!-- End Site Header --> 
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="{{route('igreja.index',['url'=>$igreja->url])}}">Home</a></li>
        <li class="active">Sobre nós/Visões e valores</li>
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
        <h1>Sobre nós</h1>
    </div>
    </div>
</div>
</div>
<!-- End Page Header --> 
<!-- Start Content -->
<div class="main" role="main">
<div id="content" class="content full">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <p>{{$igreja->texto_apresentativo}}</p>
        <hr>
        @if ($funcoes != null && sizeof($funcoes) > 0)
            <h3>Equipe</h3>
        @endif
        </div>
        @foreach ($funcoes as $funcao)
            @foreach ($membros[$funcao->id] as $membro)
                <div class="col-md-4 col-sm-4">
                <div class="grid-item staff-item">
                    <div class="grid-item-inner">
                    <div class="media-box"> 
                        @if ($membro->foto != null)
                            <img width="250" height="250" src="{{'data:image;base64,'.base64_encode($membro->foto)}}" alt=""> 
                        @else
                            <img src="{{ route('igreja.carrega_imagem',['largura'=>250,'altura'=>250,'pasta'=>'X','arquivo'=>'no-foto.png']) }}" alt=""> 
                        @endif
                    </div>
                    <div class="grid-content">
                        <h3>{{$membro->nome}} ({{$funcao->nome}})</h3>
                        <nav class="social-icons"> 
                            @if ($membro->facebook != null)
                                <a href="{{$membro->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a>
                            @endif
                            @if ($membro->twitter != null)
                                <a href="{{$membro->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a>
                            @endif
                            @if ($membro->youtube != null)
                                <a href="{{$membro->youtube}}" target="_blank"><i class="fa fa-youtube"></i></a>
                            @endif
                        </nav>
                        <p>{{$membro->descricao}}</p>
                    </div>
                    </div>
                </div>
                </div>
            @endforeach
        @endforeach
    </div>
    </div>
</div>
</div>
@endsection