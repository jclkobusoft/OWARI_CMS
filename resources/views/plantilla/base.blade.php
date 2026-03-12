<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="CMS webpage Autopartes Owari">
  <meta name="keywords" content="cms, owari, refacciones">
  <meta name="author" content="Kobusoft">
  <title>Owari</title>
  <link rel="apple-touch-icon" href="{{ asset('cms/images/favicon.ico') }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('cms/images/favicon.ico') }}">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  {{ Html::style('cms/css/vendors.css') }}
  {{ Html::style('cms/vendors/css/ui/prism.min.css') }}
  <!-- END VENDOR CSS-->
  <!-- BEGIN STACK CSS-->
  {{ Html::style('cms/css/app.css') }}
  <!-- END STACK CSS-->
  <!-- BEGIN Page Level CSS-->
  {{ Html::style('cms/css/core/menu/menu-types/horizontal-menu.css') }}
  {{ Html::style('cms/datetime/jquery.datetimepicker.css') }}
  <!-- END Page Level CSS-->
  @yield('css')
</head>
<body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="click"
data-menu="horizontal-menu" data-col="2-columns">
  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-light navbar-border navbar-brand-center">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="index.html" style="padding:2px !important;">
              <img class="brand-logo" alt="stack admin logo" src="{{  asset('cms/images/logo.svg') }}" width="100px">
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container container center-layout">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="avatar avatar-online">
                  <img src="{{ asset('cms/images/portrait/small/avatar-s-1.png') }}" alt="avatar"><i></i></span>
                <span class="user-name">{{ \Auth::user()->name }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="user-profile.html"><i class="ft-user"></i> Editar perfil</a>
                <a class="dropdown-item" href="{{ asset('manual.pdf') }}"><i class="ft-compass"></i> Ayuda</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"><i class="ft-power"></i> Cerrar sesión</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- Horizontal navigation-->
  <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border"
  role="navigation" data-menu="menu-wrapper">
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content container center-layout" data-menu="menu-container">
      <!-- include ../../../includes/mixins-->
      @include('plantilla.menu')
    </div>
    <!-- /horizontal menu content-->
  </div>
  <!-- Horizontal navigation-->
  <div class="app-content container center-layout mt-2">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-1">
          <h3 class="content-header-title">{{ $seccion }}</h3>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              @foreach($breadcrumb as $key => $value)
              <li class="breadcrumb-item @if($key == ( count( $breadcrumb ) - 1 )) active @endif"><a href="{{ route($value['route']) }}">{{ $value['nombre'] }}</a>
              </li>
              @endforeach
            </ol>
          </div>
        </div>
      </div>
      <div class="content-body">
       @yield('contenido')
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <footer class="footer fixed-bottom footer-light navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 container center-layout">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a class="text-bold-800 grey darken-2" href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent"
        target="_blank">Kobusoft </a>. Todos los derechos reservados. </span>
      <span class="float-md-right d-block d-md-inline-block d-none d-lg-block"> Planeado y desarrollado.</span>
    </p>
  </footer>
  <div class="modal fade text-left" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10"
      aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger white">
              <h4 class="modal-title" id="modal-danger-titulo">Alerta</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modal-danger-cuerpo">
              <p>¿Estas seguro que deseas eliminar este registro?</p>
            </div>
            <div class="modal-footer" id="modal-danger-botones">
              <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-outline-danger">Eliminar</button>
            </div>
          </div>
        </div>
      </div>
  <!-- BEGIN VENDOR JS-->
  {{ Html::script('cms/vendors/js/vendors.min.js') }}
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  {{ Html::script('cms/vendors/js/ui/jquery.sticky.js') }}
  {{ Html::script('cms/vendors/js/charts/jquery.sparkline.min.js') }}
  {{ Html::script('cms/vendors/js/ui/prism.min.js') }}
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->
  {{ Html::script('cms/js/core/app-menu.js') }}
  {{ Html::script('cms/js/core/app.js') }}
  {{ Html::script('cms/js/scripts/customizer.js') }}
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  {{ Html::script('cms/js/scripts/ui/breadcrumbs-with-stats.js') }}
  <!-- END PAGE LEVEL JS-->
  {{ Html::script('cms/datetime/jquery.datetimepicker.full.js') }}

  @yield('js')
</body>
</html>