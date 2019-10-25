<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/template5/confirmacaoDados.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div id="intro">
    <div class="wrap">
        <div class="c-12">
        	<h1>Confirmação</h1>
        </div>
    </div>
</div>

<div id="content">
    <div class="wrap">
        <div class="c-8">
            <div class="page">
            	<h3>Dados recebidos, entraremos em contato se for necessário, agradecemos pela atenção!</h3>
        	</div>
    	</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template5', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>