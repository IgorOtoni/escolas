<?php /* C:\xampp\htdocs\adm_eglise\resources\views\eglise\igrejas.blade.php */ ?>
<?php $__env->startSection('content'); ?>
<!-- Full Width Column -->
<div class="content-wrapper">
<div class="container">
    <!-- Content Header (Page header) -->
    <!--<section class="content-header">
    <h1>
        Congregações
    </h1>
    </section>-->

    <form id="filtrarIgrejaForm" method="GET" role="form" action="<?php echo e(route('plataforma.filtrarIgreja')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
        <div class="box-body">
            <div class="row">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="nome" placeholder="Congregação">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-flat">Filtrar</button>
                    </span>
                </div>
            </div>
        </div>
    </form>

    <div class="row"><center><?php echo e($igrejas_e_configuracoes->appends(request()->query())->links()); ?></center></div>
    <!-- Main content -->
    <div class="row">
    <section class="content">
    <?php $__currentLoopData = $igrejas_e_configuracoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $igreja): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 col-xs-12">
        <!-- Attachment -->
        <div class="attachment-block clearfix">
        <?php if($igreja->logo != null): ?>
            <img class="attachment-img" src="/storage/igrejas/<?php echo e($igreja->logo); ?>" alt="Attachment Image">
        <?php else: ?>
            <img class="attachment-img" src="/storage/no-logo.jpg" alt="Attachment Image">
        <?php endif; ?>
        
        <div class="attachment-pushed" style="word-wrap: break-word; overflow-wrap: break-word;">
            <h4 class="attachment-heading">
                <?php if($igreja->url != null && $igreja->status == true): ?>
                    <a href="<?php echo e(($igreja->url != null && $igreja->status == true) ? "/".$igreja->url: "#"); ?>"><?php echo e($igreja->nome); ?></a>
                <?php else: ?>
                    <?php echo e($igreja->nome); ?>

                <?php endif; ?>
            </h4>

            <div class="attachment-text">
            Cidade: <?php echo e($igreja->cidade); ?> - <?php echo e($igreja->estado); ?><br/>
            Bairro: <?php echo e($igreja->bairro); ?><br/>
            Rua: <?php echo e($igreja->rua); ?>, n°: <?php echo e($igreja->num); ?><br/>
            <?php if($igreja->complemento != null): ?>
                Complemento: <?php echo e($igreja->complemento); ?>

            <?php else: ?>
                Complemento: <span class="label bg-red">Não informado</span>
            <?php endif; ?>
            <br/>
            <?php if($igreja->telefone != null): ?>
                Telefone: <?php echo e($igreja->telefone); ?>

            <?php else: ?>
                Telefone: <span class="label bg-red">Não informado</span>
            <?php endif; ?>
            <br />
            <?php if($igreja->email != null): ?>
                Email: <?php echo e($igreja->email); ?>

            <?php else: ?>
                Email: <span class="label bg-red">Não informado</span>
            <?php endif; ?>
            </div>
            <!-- /.attachment-text -->
        </div>
        <!-- /.attachment-pushed -->
        </div>
        <!-- /.attachment-block -->
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
    </div>
    <!-- /.content -->
    <div class="row"><center><?php echo e($igrejas_e_configuracoes->appends(request()->query())->links()); ?></center></div>
</div>
<!-- /.container -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('eglise.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>