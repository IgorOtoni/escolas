@extends('layouts.template1')
@push('script')

@endpush
@section('content')
<!-- End Site Header --> 
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="{{route('site.index',['url'=>$site->url])}}">Home</a></li>
        <li class="active">Linha do tempo</li>
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
        <h1>Linha do tempo</h1>
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
        {{ $eventos->appends(request()->query())->links() }}
    </center>
    <?php
    if($eventos != null && sizeof($eventos) > 0){
    ?>
        <ul class="timeline">
            <?php
            $x = 0;
            for($x_ = sizeof($eventos) - 1; $x_ >= 0; $x_--){
                $evento = $eventos[$x_];
                $class = ($x % 2 == 0) ? "timeline-inverted" : "";
                $x++;
                ?>
                <li class="{{$class}}">
                    <div class="timeline-badge">{{strtoupper(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('MMM YYYY'))}}</div>
                    <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h3 class="timeline-title">
                        <?php /* ?>
                        <a href="/{{$site->url}}/evento/{{$site->id}}" data-toggle="modal" data-target="#modal-evento" data-foto="{{$evento->foto}}" data-local="{{$evento->dados_local}}" data-nome="{{$evento->nome}}" data-descricao="{{$evento->descricao}}" data-inicio="{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-fim="{{(($evento->dados_horario_fim != null) ? \Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio) : '')}}">{{$evento->nome}}</a>
                        */ ?>
                        <a href="{{route('site.evento', ['url'=>$site->url,'id'=>$evento->id])}}"><?php echo $evento->nome ?></a>
                        </h3>
                    </div>
                    <div class="timeline-body">
                        <ul class="info-table">
                            <li><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}</li>
                            <?php if($evento->dados_horario_fim != null){ ?>
                                <li><i class="fa fa-clock-o"></i> Final previsto para {{\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)}}</li>
                            <?php } ?>
                            <li><i class="fa fa-map-marker"></i> <?php echo $evento->dados_local ?></li>
                            <!--<li><i class="fa fa-phone"></i> 1 800 321 4321</li>-->
                        </ul>
                    </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    <?php
    }else{
        ?>
        <center>
            <span class="label label-warning">Nenhum evento para mostrar.</span>
        </center>
        <?php
    }
    ?>
    <center>
        {{ $eventos->appends(request()->query())->links() }}
    </center>
    </div>
</div>
</div>
@endsection