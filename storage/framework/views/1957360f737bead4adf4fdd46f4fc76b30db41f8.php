<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- End Site Header --> 
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="/<?php echo e($site->url); ?>/">Home</a></li>
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
        <?php echo e($eventos->appends(request()->query())->links()); ?>

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
                <li class="<?php echo e($class); ?>">
                    <div class="timeline-badge"><?php echo e(strtoupper(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('MMM YYYY'))); ?></div>
                    <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h3 class="timeline-title">
                        <?php /* ?>
                        <a href="/{{$site->url}}/evento/{{$site->id}}" data-toggle="modal" data-target="#modal-evento" data-foto="{{$evento->foto}}" data-local="{{$evento->dados_local}}" data-nome="{{$evento->nome}}" data-descricao="{{$evento->descricao}}" data-inicio="{{\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-fim="{{(($evento->dados_horario_fim != null) ? \Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio) : '')}}">{{$evento->nome}}</a>
                        */ ?>
                        <a href="<?php echo e(route('site.evento', ['url'=>$site->url,'id'=>$evento->id])); ?>"><?php echo e($evento->nome); ?></a>
                        </h3>
                    </div>
                    <div class="timeline-body">
                        <ul class="info-table">
                            <li><i class="fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($evento->dados_horario_inicio, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')); ?></li>
                            <?php if($evento->dados_horario_fim != null){ ?>
                                <li><i class="fa fa-clock-o"></i> Final previsto para <?php echo e(\Carbon\Carbon::parse($evento->dados_horario_fim)->diffForHumans($evento->dados_horario_inicio)); ?></li>
                            <?php } ?>
                            <li><i class="fa fa-map-marker"></i> <?php echo e($evento->dados_local); ?></li>
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
        <?php echo e($eventos->appends(request()->query())->links()); ?>

    </center>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template1/eventos.blade.php ENDPATH**/ ?>