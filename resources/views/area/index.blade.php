@extends('layouts.app')
@section('title', 'Areas')
    @push('css')
      <!--Alertas-->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <!--CSS TABLA-->
      <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">        
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

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-end">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('areas.index')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active">AREAS</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->
    <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">CREAR ÁREA</h3>
            </div>
            <div class="card-body">
              <div class="col-md-12">
                @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Errores en el registro!</h5>
                    {{implode(' ',$errors->all()) }}
                  </div>
                @endif
              </div>
              <form action="{{route('areas.store')}}" method="post">
                @csrf @method('POST')
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">ÁREA</label>
                      <input  type="text" class="form-control" id="names" name="names" placeholder="Ingrese Nombre" value="{{old('names')}}">
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
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">LISTA DE AREAS</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="areas" class="table table-bordered table-hover table-responsive">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th class="text-center" style="width: 500px;">Nombre</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($areas as $index=>$area)
                    <tr>
                      <td class="text-center">{{$index + 1}}</td>
                      <td class="text-center">{{$area->names}}</td>
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
      $('#areas').DataTable({
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
              "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ areas",
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
    <script>
      const input = document.getElementById('names');
      // Capitaliza la primera letra de la entrada
      input.addEventListener('input', function() {
          let value = input.value;
          input.value = value.charAt(0).toUpperCase() + value.slice(1);
      });
    </script>       
    @endpush
