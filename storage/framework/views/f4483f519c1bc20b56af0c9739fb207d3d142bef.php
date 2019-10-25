<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/layouts/carrinho.blade.php */ ?>
<!DOCTYPE HTML>
<html>
	<head>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title><?php echo e($site->nome); ?></title>

		<!-- Bootstrap 3.3.7 -->
  		<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
  		<!-- jQuery 3 -->
  		<script src="<?php echo e(asset('template_adm/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="<?php echo e(asset('template_adm/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>

		<!-- Toastr -->
  		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('template_adm/plugins/toastr/toastr.min.css')); ?>">
  		<!-- Toastr -->
  		<script src="<?php echo e(asset('template_adm/plugins/toastr/toastr.min.js')); ?>"></script>
  		<!-- Bootstrap Validator -->
		<script src="<?php echo e(asset('template_adm/plugins/bootstrap-validator/validator.js')); ?>"></script>

		<style>
			.sidebar-module {
			  	padding: 15px;
			  	margin: 0 -15px 15px;
			}
			.sidebar-module-inset {
			  	padding: 15px;
			  	background-color: #f5f5f5;
			  	border-radius: 4px;
			}
			.sidebar-module-inset p:last-child,
			.sidebar-module-inset ul:last-child,
			.sidebar-module-inset ol:last-child {
			 	margin-bottom: 0;
			}

			html, body {
			 	overflow-x: hidden; /* Prevent scroll on narrow devices */
			}
			body {
			  	padding-top: 70px;
			}
			footer {
			  	padding: 30px 0;
			}
		</style>
    </head>

    <body role="document">

    	<nav class="navbar navbar-inverse navbar-fixed-top">
		  	<div class="container">
			    <div class="navbar-header">
		          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Abrir menus</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a href="/<?php echo e($site->url); ?>" class="navbar-brand"><?php echo e($site->nome); ?></a>
		        </div>
			    <div id="navbar" class="navbar-collapse collapse">
				    <ul class="nav navbar-nav">
				        <?php
				        if(!isset(\Auth::user()->id_perfil)){
				            ?>
				            <li><a href="/<?php echo e($site->url); ?>/produtos">Produtos</a></li>
				            <li><a href="/<?php echo e($site->url); ?>/carrinho">Carrinho</a></li>
				            <form data-toggle="validator" method="post" action="<?php echo e(route('autenticar_', $site->url)); ?>" class="navbar-form navbar-right">
			            	<?php echo csrf_field(); ?>
					            <div class="form-group">
					              	<input type="email" placeholder="E-mail" name="email" class="form-control" required>
					            </div>
					            <div class="form-group">
					              	<input type="password" placeholder="Senha" name="password" class="form-control" required>
					            </div>
					            <button type="submit" class="btn btn-success">Entrar</button>
					            <a href="/<?php echo e($site->url); ?>/cadastro" class="btn btn-info">Cadastrar</a>
					        </form>
				            <?php
				        }else{
				            ?>
				            <li><a href="/<?php echo e($site->url); ?>/produtos">Produtos</a></li>
				            <li><a href="/<?php echo e($site->url); ?>/carrinho">Carrinho</a></li>
				            <?php
				        }
				        ?>
				    </ul>
				    <?php
				    if(isset(\Auth::user()->id_perfil) && \Auth::user()->id_perfil == 100){
				    	?>
				      	<ul class="nav navbar-nav navbar-right">
				      		<li><a class="navbar-brand"><?php echo "Bem vindo(a) ".\Auth::user()->nome."!" ?></a></li>
				      		<li class="dropdown">
					      		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Minha conta <span class="caret"></span></a>
					      		<ul class="dropdown-menu" role="menu">
						        	<li><a href="/<?php echo e($site->url); ?>/compras">Minha compras</a></li>
						        	<li><a href="/<?php echo e($site->url); ?>/conta">Meus dados</a></li>
						        	<li class="divider"></li>
						        	<li><a href="/<?php echo e($site->url); ?>/desativar_conta">Desativar conta</a></li>
						        	<li class="divider"></li>
						        	<li><a href="<?php echo e(route('logout')); ?>">Sair</a></li>
					        	</ul>
				        	</li>
				        </ul>
			        	<?php
		        	}
		        	?>
			    </div>
	        </div>
		</nav>

		<div class="container" role="main">

			<div class="row row-offcanvas row-offcanvas-right">

		      	<div class="row">
					<div class="col-xs-12 col-sm-8">
						<?php echo $__env->yieldContent('content'); ?>
					</div>

					<!--<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
			          	<div class="sidebar-module sidebar-module-inset">
				            <h4>Sistema de gestão comercial</h4>
				            <p>Sistema desnvolvido por <em>Igor Otoni Ripardode Assis</em>, como proposta de TCC no curso técnico de informática CEFET-MG Campus Timóteo em 2014.</p>
			          	</div>
		          	</div>-->

		          	<?php if($site->logo != null): ?>
			          	<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
				          	<div class="sidebar-module sidebar-module-inset">
					            <!--<h4><?php echo e($site->nome); ?></h4>-->
					            <div class="row">
									<div class="col-md-12">
										<img width="100%" class="img-thumbnail" src="<?php echo e(asset('/storage/sites/'.$site->logo)); ?>">
									</div>
								</div>
				          	</div>
			          	</div>
		          	<?php endif; ?>

	          	</div>

			</div>

	    	<hr>

	      	<footer>
		        <p><?php echo e($site->nome); ?> - <b> powered by hotsystems</b></p>
	      	</footer>

		</div>

	    <!-- Toaster message SCRIPT -->
		<script>
		  <?php if(Session::has('message')): ?>
		    var type = "<?php echo e(Session::get('alert-type', 'info')); ?>";
		    switch(type){
		        case 'info':
		            toastr.info("<?php echo e(Session::get('message')); ?>");
		            break;
		        
		        case 'warning':
		            toastr.warning("<?php echo e(Session::get('message')); ?>");
		            break;

		        case 'success':
		            toastr.success("<?php echo e(Session::get('message')); ?>");
		            break;

		        case 'error':
		            toastr.error("<?php echo e(Session::get('message')); ?>");
		            break;

	            /*default:
	            	toastr.info("<?php echo e(Session::get('message')); ?>");
	            	break;*/
		    }
		    <?php
		    \Session()->put('message', null);
		    \Session()->put('alert-type', null);
		    ?>
		  <?php endif; ?>
		</script>

		<script>
		  url = window.location.href;
		  achou = false;
		  $('li a').each(function(index) {
		    if($(this).attr('href') === url){
		      $(this).parent().addClass('active');
		      achou = true;
		    }
		  });
		  if(achou == false){
		    $('li a').each(function(index) {
		      if(url.indexOf($(this).attr('href')) >= 0){
		        $(this).parent().addClass('active');
		      }
		    });
		  }
		</script>

		<?php echo $__env->yieldPushContent('script'); ?>
		
    </body>
</html>