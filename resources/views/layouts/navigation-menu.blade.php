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
          <a href="#" class="d-block">MARCO</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home.index') }}" class="nav-link {{ request()->routeIs('home.index') ? 'active' : '' }}">
                    <i class="nav-icon fa fa-tachometer-alt"></i>
                    <p>PANEL</p>
                </a>
            </li>
            <li class="nav-header">GESTION DE VISITANTES</li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                    <i class="nav-icon fa fa-user"></i>
                    <p>VISITANTES</p>
                </a>
            </li>
            <li class="nav-header">GESTION DE AREAS</li>
            <li class="nav-item">
                <a href="{{ route('areas.index') }}" class="nav-link {{ request()->routeIs('areas.index') ? 'active' : '' }}">
                    <i class="nav-icon fa fa-university"></i>
                    <p>AREAS</p>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>