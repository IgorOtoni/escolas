<?php /* E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/eglise/template.blade.php */ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sites</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/Ionicons/css/ionicons.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('template_adm/dist/css/AdminLTE-mod.css')); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(asset('template_adm/dist/css/skins/_all-skins-mod.css')); ?>">

  <!-- jQuery 3 -->
  <script src="<?php echo e(asset('template_adm/bower_components/jquery/dist/jquery.min.js')); ?>"></script>

  <!-- Toastr -->
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('template_adm/plugins/toastr/toastr.min.css')); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Toastr -->
  <script src="<?php echo e(asset('template_adm/plugins/toastr/toastr.min.js')); ?>"></script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-rcc layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div style="min-height: 55px; vertical-align: center; margin: 15px;">
          <div class="navbar-header">
            <a href="#" class="navbar-brand"><b>Sites</b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <li><a href="<?php echo e(route('plataforma.home')); ?>">Inicial</a></li>
              <li><a href="<?php echo e(route('plataforma.congregacoes')); ?>">Sites</a></li>
              <li><a href="<?php echo e(route('plataforma.formulario')); ?>">Cadastro</a></li>
              <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
        </div>
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

  <?php echo $__env->yieldContent('content'); ?>

  <footer class="main-footer">
    <div class="container">
        <div class="pull-right hidden-xs">
        <b>Sites - powered by hotsystems</b>
        </div>
    </div>
    <!-- /.container -->
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo e(asset('template_adm/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('template_adm/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo e(asset('template_adm/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(asset('template_adm/bower_components/fastclick/lib/fastclick.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('template_adm/dist/js/adminlte.min.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('template_adm/dist/js/demo.js')); ?>"></script>
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
    }
  <?php endif; ?>
</script>
</html>