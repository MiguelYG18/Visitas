@extends('layouts.app')
@section('title', 'Visitantes')
    @push('css')
      <!--Alertas-->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <!--CSS TABLA-->
      <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">    
    @endpush
    @section('content')
      @if (session('success'))
          <script>
              let message ="{{session('success')}}";
              const Toast = Swal.mixin({
                  toast: true,
                  position: "top-end",
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                      toast.onmouseenter = Swal.stopTimer;
                      toast.onmouseleave = Swal.resumeTimer;
                  }
              });
              Toast.fire({
                  icon: "success",
                  title: message
              });
          </script>                
      @endif  
    <div class="row mt-4">
        <div class="col-md-5">
          <div class="card">
            <div class="card-header" style="background-color: #00476D !important;">
              <h3 class="card-title text-white">FORMULARIO DE VISITANTE</h3>
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
                  <label for="exampleInputEmail1">VERIFICAR DNI</label>
                  <div class="input-group mb-3">
                    <input  class="form-control" type="text" maxlength="8" minlength="8" id="documento" class="form-control" placeholder="Ingrese el DNI" aria-label="Ingrese el DNI" aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button" id="buscar" style="background-color: #00476D !important;">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <div class="card">
              <div class="card-body">
                <form action="{{route('visitors.store')}}" method="post">
                  @csrf @method('POST')
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">DNI</label>
                        <input readonly type="text" class="form-control" id="dni" name="dni" placeholder="DNI" maxlength="8" minlength="8" value="{{old('dni')}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">APELLIDOS</label>
                        <input readonly type="text" class="form-control" id="surnames" name="surnames" placeholder="Apellidos" value="{{old('surnames')}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">NOMBRES</label>
                          <input readonly type="text" class="form-control" id="names" name="names" placeholder="Nombres" value="{{old('names')}}">
                        </div>
                    </div>
                    <div class="col-md-12">
                      <label for="fecha_hora" class="form-label">FECHA Y HORA DE INGRESO: </label>
                      <input readonly type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control boder-success" value="<?php echo date('Y-m-d\TH:i'); ?>">
                      <?php
                          use Carbon\Carbon;
                          $fecha_hora = Carbon::now()->toDateTimeString();
                      ?>
                      <input type="hidden" name="fecha_hora_hidden" value="{{$fecha_hora}}">
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>ÁREA</label>
                        <select class="form-control selectpicker show-tick" data-live-search="true" style="width: 100%;" id="id_area" name="id_area" title="SELECCIONE..." data-style="btn-secondary" data-size="5">
                          @foreach ($areas as $area)
                            <option value="{{$area->id}}"  {{ old('id_area') == $area->id ? 'selected' : '' }}>{{$area->names}}</option>
                          @endforeach
                        </select>
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
        <div class="col-md-7">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">LISTA DE VISITANTES</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="user" class="table table-bordered table-hover table-responsive">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th class="text-center" style="width: 300px;">Visitante</th>
                    <th class="text-center" style="width: 280px;">DNI</th>
                    <th class="text-center" style="width: 200px;">Área</th>
                    <th class="text-center" style="width: 350px;">Ingreso</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($visitors as $index=>$visitor)
                    <tr>
                      <td class="text-center">{{$index + 1}}</td>
                      <td class="text-center">{{$visitor->surnames}},{{$visitor->names}}</td>
                      <td class="text-center">{{$visitor->dni}}</td>
                      <td class="text-center">{{$visitor->area->names}}</td>
                      <td class="text-center">{{$visitor->fecha_hora}}</td>
                    </tr>                      
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
    @endsection
    @push('js')
    <script>
      $('#user').DataTable({
          responsive: true,
          autoWidth:false,
          "language": {
              "lengthMenu": "Mostrar "+
                              `<select class="custom-select custom-select-sm w-50 form-select form-select-sm mb-2">
                                  <option value="5">5</option>
                                  <option value="10">10</option>
                                  <option value="15">15</option>
                                  <option value="20">20</option>
                              </select>`,
              "zeroRecords": "No se encontró nada - lo siento",
              "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ visitantes",
              "infoEmpty": "No hay registros disponibles",
              "infoFiltered": "(filtrado de _MAX_ registros totales)",
              "search": "Buscar:",
              "emptyTable": "No hay datos disponibles en la tabla",
              "paginate":{
                  "next":">",
                  "previous":"<"
              }
          }
      });
    </script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
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
                  url: '{{ url('vigilante/visitors/create/add-consulta') }}', // Ruta para la consulta del DNI
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
    <script>
      document.getElementById('documento').focus();
    </script>     
    @endpush
