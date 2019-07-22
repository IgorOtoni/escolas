@extends('layouts.template1')
@section('content')
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="/{{$igreja->url}}/">Home</a></li>
        <li class="active">Vídeos</li>
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
        <h1>Vídeos</h1>
    </div>
    </div>
</div>
</div>
<!-- End Page Header --> 
<!-- Start Content -->
<div class="main" role="main">
<div id="content" class="content full">
    <div class="container">
    <center>
        {{ $sermoes->appends(request()->query())->links() }}
    </center>
    <div class="row">
        <div class="col-md-12 sermon-archive"> 
        <!-- Sermons Listing -->
        <?php
        if($sermoes != null && sizeof($sermoes) > 0){
        ?>
            <?php foreach($sermoes as $sermao){ ?>
                <article class="post sermon">
                    <header class="post-title">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                        <h3><a href="/{{$igreja->url}}/sermao/{{$sermao->id}}">{{$sermao->nome}}</a></h3>
                        <span class="meta-data"><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($sermao->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}} </div>
                    </div>
                    </header>
                    <div class="post-content">
                    <div class="row">
                        <div class="col-md-5"> <iframe frameborder="0" src="{{$sermao->link}}"></iframe> </div>
                        <div class="col-md-7">
                        <p>{{$sermao->descricao}}</p>
                        <p><a href="{{$sermao->link}}" class="btn btn-primary">Assistir vídeo <i class="fa fa-long-arrow-right"></i></a></p>
                        </div>
                    </div>
                    </div>
                </article>
            <?php } ?>
            </div>
            <?php
        }else{
            ?>
            <center>
                <span class="label label-warning">Nenhum vídeo para mostrar.</span>
            </center>
            <?php
        }
        ?>
    </div>
    <center>
        {{ $sermoes->appends(request()->query())->links() }}
    </center>
    </div>
</div>
</div>
@endsection