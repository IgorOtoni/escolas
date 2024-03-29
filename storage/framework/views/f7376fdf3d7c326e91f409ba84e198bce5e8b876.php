<?php /* C:\xampp\htdocs\adm_eglise\resources\views/eglise/sites.blade.php */ ?>
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

    <form id="filtrarSiteForm" method="GET" role="form" action="<?php echo e(route('plataforma.filtrarSite')); ?>" enctype="multipart/form-data">
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

    <div class="row"><center><?php echo e($sites_e_configuracoes->appends(request()->query())->links()); ?></center></div>
    <!-- Main content -->
    <div class="row">
    <section class="content">
    <?php $__currentLoopData = $sites_e_configuracoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 col-xs-12">
        <!-- Attachment -->
        <div class="attachment-block clearfix">
        <?php if($site->logo != null): ?>
            <img class="attachment-img" src="/storage/sites/<?php echo e($site->logo); ?>" alt="Attachment Image">
        <?php else: ?>
            <img class="attachment-img" src="/storage/no-logo.jpg" alt="Attachment Image">
        <?php endif; ?>
        
        <div class="attachment-pushed" style="word-wrap: break-word; overflow-wrap: break-word;">
            <h4 class="attachment-heading">
                <?php if($site->url != null && $site->status == true): ?>
                    <a href="<?php echo e(($site->url != null && $site->status == true) ? "/".$site->url: "#"); ?>"><?php echo e($site->nome); ?></a>
                <?php else: ?>
                    <?php echo e($site->nome); ?>

                <?php endif; ?>
            </h4>

            <div class="attachment-text">
            Cidade: <?php echo e($site->cidade); ?> - <?php echo e($site->estado); ?><br/>
            Bairro: <?php echo e($site->bairro); ?><br/>
            Rua: <?php echo e($site->rua); ?>, n°: <?php echo e($site->num); ?><br/>
            <?php if($site->complemento != null): ?>
                Complemento: <?php echo e($site->complemento); ?>

            <?php else: ?>
                Complemento: <span class="label bg-red">Não informado</span>
            <?php endif; ?>
            <br/>
            <?php if($site->telefone != null): ?>
                Telefone: <?php echo e($site->telefone); ?>

            <?php else: ?>
                Telefone: <span class="label bg-red">Não informado</span>
            <?php endif; ?>
            <br />
            <?php if($site->email != null): ?>
                Email: <?php echo e($site->email); ?>

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
    <div class="row"><center><?php echo e($sites_e_configuracoes->appends(request()->query())->links()); ?></center></div>
</div>
<!-- /.container -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('eglise.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>