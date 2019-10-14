@extends('layouts.template1')
@section('content')
<!-- Start Nav Backed Header -->
<<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="{{route('igreja.index',['url'=>$igreja->url])}}">Home</a></li>
        <li class="active">Eventos fixos</li>
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
        <h1>Eventos fixos</h1>
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
        {{ $eventos_fixos->appends(request()->query())->links() }}
    </center>
    <div class="row">
        <div class="col-md-12">
        <ul class="grid-holder col-3 events-grid">
            <?php
            if($eventos_fixos != null && sizeof($eventos_fixos) > 0){
                foreach($eventos_fixos as $evento){
                    ?>
                    <li class="grid-item format-standard">
                    <div class="grid-item-inner"> 
                        <?php if($evento->foto != null){ ?>
                            <img src="{{'data:image;base64,'.base64_encode($evento->foto)}}" alt="">
                        <?php }else{ ?>
                            <img src="{{asset('/storage/no-event.jpg')}}" alt="">
                        <?php } ?>
                        <div class="grid-content">
                        <h3>
                            <a href="{{route('igreja.eventofixo', ['url'=>$igreja->url,'id'=>$evento->id])}}">
                                <?php echo $evento->nome ?>
                            </a>
                        </h3>
                        <?php if($evento->descricao != null){ ?> <p><?php echo $evento->descricao ?></p> <?php } ?>
                        </div>
                        <ul class="info-table">
                        <li><i class="fa fa-calendar"></i><i class="fa fa-map-marker"></i> {{$evento->dados_horario_local}}</li>
                        </ul>
                    </div>
                    </li>
                    <?php
                }
            }else{
                ?>
                <center>
                    <span class="label label-warning">Nenhum evento fixo para mostrar.</span>
                </center>
                <?php
            }
            ?>
        </ul>
        </div>
    </div>
    <center>
        {{ $eventos_fixos->appends(request()->query())->links() }}
    </center>
    </div>
</div>
</div>
@endsection