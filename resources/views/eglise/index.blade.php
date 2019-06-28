@extends('eglise.template')
@section('content')
<!-- Full Width Column -->
<div class="content-wrapper">
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
    </section>

    <div class="row" style="margin-top: 50px;">
        <div class="col-xs-12 col-md-6 text-justify" style="margin-bottom: 30px;">
            <h1>
                Plataforma para as escolas
                <!--<small>Example 2.0</small>-->
            </h1>
            <!--<h3>Temos uma forma fácil para você, líder, providenciar uma página de internet para sua igreja. Temos 10 modelos à sua disposição.  Com ela você irá manter seu público informado sobre as programações de sua igreja e usá-lo como um canal de evangelismo, postando suas mensagens e divulgando o evangelho de Cristo. Você poderá ainda usufruir de vários benefícios que estamos desenvolvendo para facilitar seu trabalho, como o controle do rol de membros, dízimos, etc.</h3>-->
            <a class="btn btn-primary btn-lg" href="{{route('plataforma.formulario')}}"><b>CLIQUE AQUI PARA SABER MAIS</b></a>
        </div>
        <!--<div class="col-xs-12 col-md-6">
            <center><img style="width: 60%;" src="/storage/bg-eglise.png"></center>
        </div>-->
    </div>
</div>
<!-- /.container -->
</div>
<!-- /.content-wrapper -->
@endsection