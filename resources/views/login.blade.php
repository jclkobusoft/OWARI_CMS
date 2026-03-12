<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="CMS web page Nikko Refacciones">
  <meta name="keywords" content="cms, nikko, refacciones">
  <meta name="author" content="PIXINVENT">
  <title>Login</title>
  <link rel="apple-touch-icon" href="{{ asset('cms/images/favicon.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('cms/images/favicon.png') }}">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  {{ Html::style('cms/css/vendors.css') }}
  {{ Html::style('cms/vendors/css/forms/icheck/icheck.css') }}
  {{ Html::style('cms/vendors/css/forms/icheck/custom.css') }}
  <!-- END VENDOR CSS-->
  <!-- BEGIN STACK CSS-->
  {{ Html::style('cms/css/app.css') }}
  <!-- END STACK CSS-->
  <!-- BEGIN Page Level CSS-->
  {{ Html::style('cms/css/core/menu/menu-types/horizontal-menu.css') }}
  {{ Html::style('cms/css/pages/login-register.css') }}
  <!-- END Page Level CSS-->
</head>
<body class="horizontal-layout horizontal-menu 1-column   menu-expanded blank-page blank-page"
data-open="click" data-menu="horizontal-menu" data-col="1-column">
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content container center-layout mt-2">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <div class="p-1">
                      <img src="{{ asset('cms/images/logo.svg') }}" alt="branding logo" width="200px">
                    </div>
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>Iniciar sesión</span>
                  </h6>
                  @if (Session::has('message'))
                  <div class="alert bg-danger alert-icon-left alert-dismissible" role="alert" style="margin-bottom: 0px !important;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                    <strong>Oh no!</strong> {{ Session::get('message') }}
                  </div>
                  @endif
                </div>
                <div class="card-content">
                  <div class="card-body">
                    {{ Form::open(['route' => 'login', 'method' => 'post', 'class' => 'form-horizontal form-simple']) }}
                      <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input type="text" class="form-control form-control-lg" name="usuario" id="user-name" placeholder="Usuario"
                        required>
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control form-control-lg" name="password" id="user-password" placeholder="Password"
                        required>
                        <div class="form-control-position">
                          <i class="fa fa-key"></i>
                        </div>
                      </fieldset>
                      <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-md-left">
                          <fieldset>
                            <input type="checkbox" id="remember-me" class="chk-remember" name="recordarme">
                            <label for="remember-me"> Recuerdame</label>
                          </fieldset>
                        </div>
                        
                      </div>
                      <button type="submit" class="btn btn-secondary btn-lg btn-block"><i class="ft-unlock"></i> Acceder</button>
                    {{ Form::close() }}
                  </div>
                </div>
                <div class="card-footer">
                  <div class="">
                    <p class="float-sm-left text-center m-0"><a href="recover-password.html" class="card-link">Recuperar password</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- BEGIN VENDOR JS-->
  {{ Html::script('cms/vendors/js/vendors.min.js') }}
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  {{ Html::script('cms/vendors/js/ui/jquery.sticky.js') }}
  {{ Html::script('cms/vendors/js/charts/jquery.sparkline.min.js') }}
  {{ Html::script('cms/vendors/js/forms/icheck/icheck.min.js') }}
  {{ Html::script('cms/vendors/js/forms/validation/jqBootstrapValidation.js') }}
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->
  {{ Html::script('cms/js/core/app-menu.js') }}
  {{ Html::script('cms/js/core/app.js') }}
  {{ Html::script('cms/js/scripts/customizer.js') }}
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  {{ Html::script('cms/js/scripts/ui/breadcrumbs-with-stats.js') }}
  {{ Html::script('cms/js/scripts/forms/form-login-register.js') }}
  <!-- END PAGE LEVEL JS-->
</body>
</html>