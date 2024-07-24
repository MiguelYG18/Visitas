<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
          <label class="form-label input-group-text" style="height: 30px; width:187px" id="fecha_hora"></label>
          <script>
              function updateTime() {
                var now = new Date();
                var formattedTime = now.getFullYear() + '-' + (now.getMonth() + 1).toString().padStart(2, '0') + '-' + now.getDate().toString().padStart(2, '0') + ' ' + now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0') + ':' + now.getSeconds().toString().padStart(2, '0');
                document.getElementById('fecha_hora').textContent = formattedTime;
              }
              setInterval(updateTime, 1000); 
              updateTime(); 
          </script>
        </div>
      </form>
    </ul>
  </nav>
<!-- /.navbar -->