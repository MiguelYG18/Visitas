@extends('layouts.app')
@section('title', 'Actualizar Usuario')
    @push('css')
    @endpush
    @section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Actualización de Usuario</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('users.index')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active">USUARIO: {{$user->surnames}}, {{$user->names}}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header" style="background-color: #00476D !important;">
            <h3 class="card-title text-white">ACTUALIZAR DATOS DEL USUARIO</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Errores en el registro!</h5>
                    {{implode(' ',$errors->all()) }}
                  </div>
                @endif
            </div>
            <form action="{{route('users.update',['user'=>$user])}}" method="post">
                @csrf @method('PATCH')
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">DNI</label>
                      <input readonly type="text" class="form-control" id="dni" name="dni" placeholder="DNI" maxlength="8" minlength="8" value="{{old('dni',$user->dni)}}">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">APELLIDOS</label>
                      <input readonly type="text" class="form-control" id="surnames" name="surnames" placeholder="Apellidos" value="{{old('surnames',$user->surnames)}}">
                    </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">NOMBRES</label>
                        <input readonly type="text" class="form-control" id="names" name="names" placeholder="Nombres" value="{{old('names',$user->names)}}">
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>NIVEL</label>
                      <select class="form-control select2" style="width: 100%;" id="level" name="level" data-placeholder="SELECCIONE...">
                        <option value="1" {{ old('level') == '1' || $user->level=='1' ? 'selected' : '' }}>Administrador</option>
                        <option value="2" {{ old('level') == '2' || $user->level=='2' ? 'selected' : '' }}>Vigilante</option> 
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>ESTADO</label>
                      <select class="form-control select2" data-placeholder="SELECCIONE..."style="width: 100%;" id="status" name="status">
                        <option value="0" {{ old('status') == '0' || $user->status=='0' ? 'selected' : '' }}>Desactivado</option>
                        <option value="1" {{ old('status') == '1' || $user->status=='1' ? 'selected' : '' }}>Activado</option> 
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="surnames" class="form-label">CONTRASEÑA</label>
                    <div class="input-group mb-3">
                      <input type="password" maxlength="8" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
                      <div class="input-group-append">
                        <button id="show_password" class="btn btn-primary" onclick="mostrarPassword()" type="button" style="background-color: #00476D !important;"><span class="fa fa-eye-slash icon"></span></button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="surnames" class="form-label">CONFIRMAR CONTRASEÑA</label>
                    <div class="input-group mb-3">
                      <input type="password" maxlength="8" name="password_confirm" id="password_confirm" class="form-control" placeholder="Confirmar password" autocomplete="off">
                      <div class="input-group-append">
                        <button id="show_password_confirm" class="btn btn-primary" onclick="mostrarPasswordConfirm()" type="button" style="background-color: #00476D !important;"><span class="fa fa-eye-slash icon_confirm"></span></button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn text-white" style="background-color: #00476D !important;">Actualizar</button>
                  </div> 
                </div>
              </form>
            </div>
          </div>
        </div>        
      </div>
    </div>
    @endsection
    @push('js')
      <script src="{{ asset('dist/js/mostrar_ocultar.js') }}"></script>
      <script src="{{ asset('dist/js/digitos_numericos.js') }}"></script>  
    @endpush
