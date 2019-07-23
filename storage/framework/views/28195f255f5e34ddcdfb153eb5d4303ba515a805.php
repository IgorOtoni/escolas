<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template2\sermoes.blade.php */ ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/<?php echo e($igreja->url); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sermões</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Latest Sermons Area Start ##### -->
<section class="latest-sermons-area">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-12">
                <div class="section-heading">
                    <h2>Sermões</h2>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-100">
            <div class="pagination-area mt-70">
                <nav aria-label="Page navigation example">
                    <?php echo e($sermoes->appends(request()->query())->links()); ?>

                </nav>
            </div>
        </div>

        <div class="row">

            <?php foreach($sermoes as $sermao){ ?>
                <!-- Single Latest Sermons -->
                <div class="col-12 col-sm-6 col-lg-6">
                    <div class="single-latest-sermons mb-100">
                        <!--<div class="sermons-thumbnail">-->
                        <iframe frameborder="0" src="<?php echo e($sermao->link); ?>"></iframe>
                        <!--</div>-->
                        <div class="sermons-content">
                            <a href="/<?php echo e($igreja->url); ?>/sermao/<?php echo e($sermao->id); ?>"><h4><?php echo e($sermao->nome); ?></h4></a>
                            <div class="sermons-meta-data">
                                <p><i class="fa fa-tag" aria-hidden="true"></i> <?php echo e($sermao->descricao); ?></p>
                                <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo e(\Carbon\Carbon::parse($sermao->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')); ?></p>
                                <p><a href="<?php echo e($sermao->link); ?>" class="btn crose-btn btn-2">Assistir sermão</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

        <div class="row d-flex justify-content-center section-padding-0-100">
            <div class="pagination-area mt-70">
                <nav aria-label="Page navigation example">
                    <?php echo e($sermoes->appends(request()->query())->links()); ?>

                </nav>
            </div>
        </div>

    </div>
</section>
<!-- ##### Latest Sermons Area End ##### -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>