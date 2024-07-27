<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UGJ | LOGIN</title>
  <link rel="icon" href="{{asset('dist/img/ugel.png')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>UGEL</b>JUDICIAL</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Iniciar Sesión</p>
      <div class="col-md-12">
        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{implode(' ',$errors->all()) }}
          </div>
        @endif
      </div>
      <form method="post" action="{{url('login')}}" class="user">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="DNI" maxlength="8" type="text" id="dni" name="dni" value="{{ session('dni') ? session('dni') : '' }}">
          <div class="input-group-append">
            <div class="input-group-text" style="background-color: #00476D !important;">
              <span class="fa fa-address-card text-white"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" maxlength="8" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
          <div class="input-group-append">
            <button id="show_password" class="btn btn-primary" onclick="mostrarPassword()" type="button" style="background-color: #00476D !important;"><span class="fa fa-eye-slash icon"></span></button>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Recuerdame!
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-block text-white" style="background-color: #00476D !important;">Iniciar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('dist/js/mostrar_ocultar.js') }}"></script>
</body>
</html>
