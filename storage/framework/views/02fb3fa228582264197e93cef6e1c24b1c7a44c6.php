<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/layouts/template3/confirmacaoDados.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

<!-- ##### Ministries Area Start ##### -->
<section class="ministries-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3>Confirmação</h3>
                    <p>Dados recebidos, entraremos em contato se for necessário, agradecemos pela atenção!</p>
                </div>
            </div>
        </div>

    </div>
</div>
</section>
<!-- ##### Ministries Area End ##### -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>