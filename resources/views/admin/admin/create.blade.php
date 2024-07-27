@extends('layouts.app')
@section('title', 'Crear Usuarios')
    @push('css')
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
      <!--Alertas-->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
    @section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Crear Usuario</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('users.index')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active">CREAR USUARIO</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header" style="background-color: #00476D !important;">
            <h3 class="card-title text-white">FORMULARIO DE USUARIOS</h3>
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
              <div class="col-md-12">
                <label for="exampleInputEmail1">CONSULTAR DNI</label>
                <div class="input-group mb-3">
                  <input  class="form-control" type="text" maxlength="8" minlength="8" id="documento" class="form-control" placeholder="Ingrese el DNI" aria-label="Ingrese el DNI" aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="buscar" style="background-color: #00476D !important;">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
              <form action="{{route('users.store')}}" method="post">
                @csrf @method('POST')
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">DNI</label>
                      <input readonly type="text" class="form-control" id="dni" name="dni" placeholder="DNI" maxlength="8" minlength="8" value="{{old('dni')}}">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">APELLIDOS</label>
                      <input readonly type="text" class="form-control" id="surnames" name="surnames" placeholder="Apellidos" value="{{old('surnames')}}">
                    </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">NOMBRES</label>
                        <input readonly type="text" class="form-control" id="names" name="names" placeholder="Nombres" value="{{old('names')}}">
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>NIVEL</label>
                      <select class="form-control selectpicker show-tick" style="width: 100%;" id="level" name="level" title="SELECCIONE..." data-style="btn-secondary" data-size="2">
                        <option value="1"  {{ old('level') == '1' ? 'selected' : '' }}>Administrador</option>
                        <option value="2"  {{ old('level') == '2' ? 'selected' : '' }}>Vigilante</option> 
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>ESTADO</label>
                      <select class="form-control selectpicker show-tick" style="width: 100%;" id="status" name="status" title="SELECCIONE..." data-style="btn-secondary" data-size="2">
                        <option value="0"  {{ old('status') == '0' ? 'selected' : '' }}>Desactivado</option>
                        <option value="1"  {{ old('status') == '1' ? 'selected' : '' }}>Activado</option> 
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
                    <button type="submit" class="btn text-white" style="background-color: #00476D !important;">Guardar</button>
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
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
      <script src="{{ asset('dist/js/mostrar_ocultar.js') }}"></script>
      <script src="{{ asset('dist/js/digitos_numericos.js') }}"></script>
      <script>
        // Función para realizar la búsqueda
            function buscarDNI() {
                var dni = $('#documento').val();
                // Validar longitud del DNI
                if (dni.length !== 8) {
                    showModal('El DNI debe tener 8 dígitos');
                }
                if (!dni.trim()) {
                    showModal('Por favor, ingrese el DNI');
                }
                $.ajax({
                    url: '{{ url('admin/users/create/add-consulta') }}', // Ruta para la consulta del DNI
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'dni': dni
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.numeroDocumento == dni) {
                            var nombreCompleto = response.apellidoPaterno + ' ' + response.apellidoMaterno;
                            $('#surnames').val(nombreCompleto);
                            $('#names').val(response.nombres);
                            $('#dni').val(response.numeroDocumento);
                            $('#documento').val('');
                        }
                    }
                });
            }
            // Asociar evento click al botón #buscar
            $('#buscar').click(buscarDNI);
            // Asociar evento de teclado al campo #dni
            $('#documento').keypress(function(event) {
                // Verificar si la tecla presionada es Enter (código 13)
                if (event.which == 13) {
                    buscarDNI(); // Llamar a la función de búsqueda
                }
            });
            function showModal(message,icon="error"){
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: icon,
                    title: message
                });                
            }
        </script>
    @endpush
