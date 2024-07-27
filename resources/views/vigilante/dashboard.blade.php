@extends('layouts.app')
@section('title', 'Panel')
    @push('css')
    @endpush
    @section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Panel</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('vigilante/panel')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active">VIGILANCIA</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-plus"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Visitantes</span>
              <span class="info-box-number">{{$visitors}}</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <a href="{{url('vigilante/panel/reporte')}}" target="_blank" class="info-box-icon bg-success elevation-1"><i class="fa fa-calendar-check"></i></a>
            <div class="info-box-content">
              <span class="info-box-text">Hoy</span>
              <span class="info-box-number">{{$today}}</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-calendar"></i></span>
            <div class="info-box-content">
              <span class="info-box-text" id="mes-actual">Mes: </span>
              <span class="info-box-number">{{$month}}</span>
            </div>
          </div>
        </div>
    </div>
    @endsection
    @push('js')
    <script>
      // Crear un array con los nombres de los meses
      const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
      // Obtener la fecha actual
      const fechaActual = new Date();
      // Obtener el mes actual (0-11) y usarlo para obtener el nombre del mes
      const mesNombre = meses[fechaActual.getMonth()];
      // Seleccionar el span y actualizar su contenido
      document.getElementById('mes-actual').innerHTML += " " + mesNombre;
    </script>    
    @endpush
