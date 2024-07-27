@extends('layouts.app')
@section('title', 'Admin')
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
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active">
                  @if (Auth::user()->level == 1)
                      ADMINISTRADOR
                  @endif
              </li>
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
              <span class="info-box-text">Registrados</span>
              <span class="info-box-number">{{$users}}</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-times"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Descanso</span>
              <span class="info-box-number">{{$rest}}</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Conectados</span>
              <span class="info-box-number">{{$linked}}</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Activos</span>
              <span class="info-box-number">{{$asset}}</span>
            </div>
          </div>
        </div>
    </div>
    @endsection
    @push('js')
    @endpush
