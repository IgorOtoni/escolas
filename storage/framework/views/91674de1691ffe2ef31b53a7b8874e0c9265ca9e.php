<?php /* C:\xampp\htdocs\adm_eglise\resources\views/layouts/usuario/index.blade.php */ ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Language" content="pt-br">
  <title>SGE Eglise</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/Ionicons/css/ionicons.min.css')); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('template_adm/dist/css/AdminLTE.min.css')); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(asset('template_adm/dist/css/skins/_all-skins.min.css')); ?>">

  <!-- Toastr -->
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('template_adm/plugins/toastr/toastr.min.css')); ?>">
  <!-- Toogle Button -->
  <link rel="stylesheet" href="<?php echo e(asset('template_adm/plugins/switch/switch.css')); ?>">

  <!-- jQuery 3 -->
  <script src="<?php echo e(asset('template_adm/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
  <!-- HTML5 Shim and Respond.js')}} IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js')}} doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <!-- Toastr -->
  <script src="<?php echo e(asset('template_adm/plugins/toastr/toastr.min.js')); ?>"></script>

  <!-- Google Font URL: https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic -->
  <link rel="stylesheet" href="<?php echo e(asset('css/fontes/font.css')); ?>">
</head>
<?php
$id_perfil = Auth::user()->id_perfil;
$perfil = \DB::table('tbl_perfis')
  ->select('tbl_perfis.*')
  ->where('id','=',$id_perfil)
  ->get();
$perfil = $perfil[0];
$site = obter_dados_site_id($perfil->id_site);
?>
<body class="hold-transition skin-<?php echo e(($site->cor != null) ? $site->cor : 'blue'); ?> sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/usuario/home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Eglise</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">SGE <b>Eglise</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?php echo e(Auth::user()->nome); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo e(route('account')); ?>" class="btn btn-default btn-flat">Conta</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo e(route('logout')); ?>" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/storage/<?php echo e(($site->logo != null) ? "sites/" . $site->logo : "no-logo.jpg"); ?>" class="img" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo e($site->nome); ?></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">BARRA DE NAVEGAÇÃO</li>
        <?php
        $id_perfil = \Auth::user()->id_perfil;

        $modulos = \DB::table('tbl_modulos')
            ->select('tbl_modulos.*', 'tbl_sites_modulos.icone')
            ->leftJoin('tbl_sites_modulos', 'tbl_modulos.id', '=', 'tbl_sites_modulos.id_modulo')
            ->leftJoin('tbl_perfis_sites_modulos', 'tbl_sites_modulos.id', '=', 'tbl_perfis_sites_modulos.id_modulo_site')
            ->where('tbl_perfis_sites_modulos.id_perfil','=',$id_perfil)
            ->where('tbl_modulos.sistema','like','%web%')
            ->where('tbl_modulos.gerencial','=',true)
            ->orderBy('tbl_modulos.nome', 'ASC')
            ->get();

        foreach($modulos as $modulo){
          ?> <li><a href="<?php echo e(route('usuario.'.$modulo->rota)); ?>">
            <?php if($modulo->icone != null){ ?> 
              <i class="<?php echo e($modulo->icone); ?>"></i>
            <?php } ?>
            <span><?php echo e($modulo->nome); ?></span></a></li> <?php
        }
        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <?php echo $__env->yieldContent('content'); ?>

  <footer class="main-footer">
    <strong>Plataforme Eglie - SGE
  </footer>

</div>
<!-- ./wrapper -->

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
<!-- Bootstrap Validator -->
<script src="<?php echo e(asset('template_adm/plugins/bootstrap-validator/validator.js')); ?>"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
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
