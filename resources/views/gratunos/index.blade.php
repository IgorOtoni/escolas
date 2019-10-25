@extends('layouts.gratunos')
@section('content')
<!-- Full Width Column -->
<div class="content-wrapper">
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
    </section>

    <div class="row" style="margin-top: 50px;">
        <div class="col-xs-12 col-md-5 text-justify" style="margin-bottom: 30px;">
            <h1>
                Plataforma Sites
                <!--<small>Example 2.0</small>-->
            </h1>
            <h3>Adquira já seu site e aplicativo, para divulgar seus eventos, notícias, vídeos, galerias, publicações, divulgar seus produtos e agendar reuniões.</h3>
            <a class="btn btn-primary btn-lg" href="{{route('plataforma.formulario')}}"><b>CLIQUE AQUI PARA SABER MAIS</b></a>
        </div>
        <div class="col-xs-12 col-md-7">
            <center><img style="width: 100%;" src="storage/bg-sites.png"></center>
        </div>
    </div>
</div>
<!-- /.container -->
</div>
<!-- /.content-wrapper -->
@endsection