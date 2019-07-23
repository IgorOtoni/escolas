<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/usuario/home.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Home
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <?php $__currentLoopData = $quadros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quadro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($quadro['link']); ?>">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box">
                    <span class="info-box-icon bg-<?php echo e($quadro['color']); ?>"><i class="fa <?php echo e($quadro['icon']); ?>"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo e($quadro['title']); ?></span>
                        <span class="info-box-number"><?php echo e($quadro['info']); ?></span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.usuario.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>