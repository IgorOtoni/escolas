<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Language" content="pt-br">
  <title>Sites</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('template_adm/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template_adm/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('template_adm/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('template_adm/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template_adm/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('template_adm/dist/css/skins/_all-skins.min.css')}}">

  <!-- Toastr -->
  <link rel="stylesheet" type="text/css" href="{{asset('template_adm/plugins/toastr/toastr.min.css')}}">
  <!-- Toogle Button -->
  <link rel="stylesheet" href="{{asset('template_adm/plugins/switch/switch.css')}}">

  <!-- jQuery 3 -->
  <script src="{{asset('template_adm/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- HTML5 Shim and Respond.js')}} IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js')}} doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <!-- Toastr -->
  <script src="{{asset('template_adm/plugins/toastr/toastr.min.js')}}"></script>

  <!-- Google Font URL: https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic -->
  <link rel="stylesheet" href="{{asset('css/fontes/font.css')}}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
      <a href="{{route('admin.home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Sites</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"> <b>Sites</b></span>
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
              <span class="hidden-xs">{{Auth::user()->nome}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('admin.account')}}" class="btn btn-default btn-flat">Conta</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sair</a>
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
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">BARRA DE NAVEGAÇÃO</li>
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="{{route('sites')}}"><i class="fa fa-institution "></i> <span>Sites</span></a></li>
        <li><a href="{{route('perfis')}}"><i class="fa fa-users"></i> <span>Perfis</span></a></li>
        <li><a href="{{route('usuarios')}}"><i class="fa fa-user"></i> <span>Usuários</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  @yield('content')

  <footer class="main-footer">
    <strong>Sites
  </footer>

</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.7 -->
<script src="{{asset('template_adm/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('template_adm/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('template_adm/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('template_adm/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('template_adm/dist/js/demo.js')}}"></script>
<!-- Bootstrap Validator -->
<script src="{{asset('template_adm/plugins/bootstrap-validator/validator.js')}}"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();

    url = window.location.href;
    $('li a').each(function(index) {
      if($(this).attr('href') === url || url.indexOf($(this).attr('href')) >= 0){
        $(this).parent().addClass('active');
      }
    });

    x = localStorage.getItem("menu");
    if(x == null || x == 'off'){
      $('body').removeClass('sidebar-collapse');
      localStorage.setItem("menu", 'off');
    }else{
      $('body').addClass('sidebar-collapse');
      localStorage.setItem("menu", 'on');
    }
  });

  $('.sidebar-toggle').on('click', function(){
    x = localStorage.getItem("menu");
    if(x == null || x == 'off'){
      //$('body').addClass('sidebar-collapse');
      x = 'on';
      localStorage.setItem("menu", x);
    }else{
      //$('body').removeClass('sidebar-collapse');
      x = 'off';
      localStorage.setItem("menu", x);
    }
  });
</script>

@stack('script')
</body>

<!-- Toaster message SCRIPT -->
<script>
  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>
</html>
