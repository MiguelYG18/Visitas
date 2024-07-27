@extends('layouts.app')
@section('title', 'Usuarios')
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
          <div class="col-sm-3">
            <a href="{{route('users.create')}}" class="btn btn-primary btn-block"><i class="fa fa-user-plus"></i> Crear Usuario</a>
          </div>
          <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('users.index')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active">USUARIOS</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">LISTA DE USUARIOS</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="user" class="table table-bordered table-hover table-responsive">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th class="text-center" style="width: 500px;">Usuario</th>
                    <th class="text-center" style="width: 300px;">DNI</th>
                    <th class="text-center" style="width: 200px;">Nivel</th>
                    <th class="text-center" style="width: 200px;">Estado</th>
                    <th class="text-center" style="width: 200px;">Creado</th>
                    <th class="text-center" style="width: 200px;">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $index=>$user)
                    <tr>
                      <td class="text-center">{{$index + 1}}</td>
                      <td class="text-center">{{$user->surnames}},{{$user->names}}</td>
                      <td class="text-center">{{$user->dni}}</td>
                      <td class="text-center">
                        <span class="badge bg-info">
                          @switch($user->level)
                              @case(1)
                                  Administrador
                                  @break
                              @case(2)
                                  Vigilante
                                  @break
                              @default
                          @endswitch
                        </span>
                      </td>
                      <td class="text-center">
                        @switch($user->status)
                            @case(0)
                                <span class="badge bg-danger">
                                  Desactivado
                                </span>    
                                @break
                            @case(1)
                                <span class="badge bg-success">
                                  Activo
                                </span> 
                                @break
                            @default
                        @endswitch
                      </td>
                      <td class="text-center">{{date('d-m-Y', strtotime($user->created_at))}} <br> {{date('H:i:s',strtotime($user->created_at))}}</td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="{{route('users.edit',['user'=>$user])}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                          <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#modal-danger--{{ $user->id }}">
                            <i class="far fa-trash-alt"></i>
                          </button>
                          <div class="modal fade" id="modal-danger--{{ $user->id }}">
                            <div class="modal-dialog">
                              <div class="modal-content bg-secondary">
                                <div class="modal-header">
                                  <h4 class="modal-title">Eliminación de Usuario</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-12 text-center align-content-center">
                                      <img src="{{asset('dist/img/user_delete.png')}}" width="250px" height="250px">
                                    </div>
                                  </div>
                                  <p>Debe comunicarse con el usuario {{$user->surnames}},{{$user->names}} antes de proceder.</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                                  <form action="{{route('users.destroy',['user'=>$user->id])}}" method="post">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>  
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
              "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ usuarios",
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
    @endpush
