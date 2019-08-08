<?php /* C:\xampp\htdocs\apresentacao_escolas\resources\views/carrinho/cadastro.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1>Cadastro</h1>

    <div>
    	<form data-toggle="validator" method="POST" action="<?php echo e(route('igreja.cadastrar', $igreja->url)); ?>" class="form-group">
        <?php echo csrf_field(); ?>
        	 <div class="panel panel-primary">
                <div class="panel-heading"><h3 class="panel-title">Dados:</h3></div>
                <div class="panel-body">
                    <div class="row">
                    	<div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label >Nome</label>
                                <input id="nome" name="nome" type="text" class="form-control" placeholder="Nome" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label >Email</label>
                                <input id="email" name="email" type="text" class="form-control" placeholder="Email" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label >Senha</label>
                                <input minlength="6" id="password" name="password" type="password" class="form-control" placeholder="Senha" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label >Confirmação da senha</label>
                                <input minlength="6" id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Senha" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <input class="btn btn-warning" type="reset" value="Limpar campos">
                    <input class="btn btn-success" type="submit" value="Cadastrar">
                </div>
            </div>
        </form>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.carrinho', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>