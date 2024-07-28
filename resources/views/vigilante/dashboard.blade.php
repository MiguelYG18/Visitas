@extends('layouts.app')
@section('title', 'Panel')
    @push('css')
      <style>
        #chartdiv {
          width: 100%;
          height: 400px;
        }
      </style>        
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
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-university"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Área: {{ isset($topArea->area_name) ? $topArea->area_name : 'S/A' }}</span>
              <span class="info-box-number">{{ isset($topArea->total) ? $topArea->total : 0 }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">5 ÁREAS CON MAYOR VISITA</h3>
            </div>
            <div class="card-body">
              <table id="areas" class="table table-bordered table-hover table-responsive text-center">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th class="text-center" style="width: 500px;">Área</th>
                    <th class="text-center" style="width: 50px;">Visitantes</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($topAreas as $index=>$area)
                    <tr>
                      <td class="text-center">{{$index + 1}}</td>
                      <td class="text-center">{{$area->area_name}}</td>
                      <td class="text-center">{{ $area->total}}</td>
                    </tr>                      
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">GRÁFICA DE BARRAS DE LAS 5 ÁREAS CON MAYOR VISITA</h3>
            </div>
            <div class="card-body">
              <div id="chartdiv"></div>
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
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Chart code -->
    <script>
      am5.ready(function() {
        var topAreasData = @json($topAreas);
  
        var chartData = topAreasData.map(function(area) {
          return {
            area: area.area_name,
            value: area.total
          };
        });
  
        // Create root element
        var root = am5.Root.new("chartdiv");
  
        // Set themes
        root.setThemes([
          am5themes_Animated.new(root)
        ]);
  
        // Create chart
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
          panX: true,
          panY: true,
          wheelX: "panX",
          wheelY: "zoomX",
          pinchZoomX: true,
          paddingLeft:0,
          paddingRight:1
        }));
  
        // Add cursor
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);
  
        // Create axes
        var xRenderer = am5xy.AxisRendererX.new(root, { 
          minGridDistance: 30, 
          minorGridEnabled: true
        });
  
        xRenderer.labels.template.setAll({
          rotation: -90,
          centerY: am5.p50,
          centerX: am5.p100,
          paddingRight: 15
        });
  
        xRenderer.grid.template.setAll({
          location: 1
        });
  
        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
          maxDeviation: 0.3,
          categoryField: "area",
          renderer: xRenderer,
          tooltip: am5.Tooltip.new(root, {})
        }));
  
        var yRenderer = am5xy.AxisRendererY.new(root, {
          strokeOpacity: 0.1
        });
  
        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
          maxDeviation: 0.3,
          renderer: yRenderer
        }));
        // Create series
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
          name: "Series 1",
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: "value",
          sequencedInterpolation: true,
          categoryXField: "area",
          tooltip: am5.Tooltip.new(root, {
            labelText: "{valueY}"
          })
        }));
  
        series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
        series.columns.template.adapters.add("fill", function (fill, target) {
          return chart.get("colors").getIndex(series.columns.indexOf(target));
        });
  
        series.columns.template.adapters.add("stroke", function (stroke, target) {
          return chart.get("colors").getIndex(series.columns.indexOf(target));
        });
  
        // Set data
        xAxis.data.setAll(chartData);
        series.data.setAll(chartData);
  
        // Make stuff animate on load
        series.appear(1000);
        chart.appear(1000, 100);
  
      }); // end am5.ready()
    </script>
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
              "info": "Mostrando la página _PAGE_ de _PAGES_ de _TOTAL_ top areas",
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
