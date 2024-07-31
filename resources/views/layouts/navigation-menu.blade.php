  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('dist/img/ugel.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">UGELVISITANTE</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/seguridad.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->names}}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @switch(Auth::user()->level)
              @case(1)
                  <li class="nav-item">
                    <a href="{{ url('admin/panel') }}" class="nav-link {{ Request::is('admin/panel') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>PANEL</p>
                    </a>
                  </li>
                  <li class="nav-header">GESTION DE USUARIOS</li>
                  <li class="nav-item">
                      <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                          <i class="nav-icon fa fa-user"></i>
                          <p>USUARIOS</p>
                      </a>
                  </li>
                  @break
              @case(2)
                  <li class="nav-item">
                    <a href="{{ url('vigilante/panel') }}" class="nav-link {{ Request::is('vigilante/panel') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>PANEL</p>
                    </a>
                  </li>
                  <li class="nav-header">GESTION DE VISITANTES</li>
                  <li class="nav-item">
                      <a href="{{ route('visitors.index') }}" class="nav-link {{ request()->routeIs('visitors.index') ? 'active' : '' }}">
                          <i class="nav-icon fa fa-street-view"></i>
                          <p>VISITANTES</p>
                      </a>
                  </li>                  
                  @break
              @default
                  
          @endswitch
            <li class="nav-header">SESION</li>
            <li class="nav-item">
              <a href="{{url('logout')}}" class="nav-link">
                <i class="fa fa-power-off text-danger"></i>
                <p>
                  CERRAR SESION
                </p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>