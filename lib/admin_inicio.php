<?php  
  include 'controller/Sesiones.php';
  include 'controller/Reportes.php';
  admin();
  //echo actividadDiaria();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Mantil Sistema Pos | </title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="css/icheck/flat/green.css" rel="stylesheet" />
  <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />


  <script src="js/jquery.min.js"></script>
  <script src="js/nprogress.js"></script>
  <script type="text/javascript">
  </script>

  <!--[if lt IE 9]>
  <script src="../assets/js/ie8-responsive-file-warning.js"></script>
  <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>


<body class="nav-md">

  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="menu_principal.php" class="site_title"><i class="fa fa-glass"></i> <span>Mantil System</span></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="images/userMale.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido,</span>
              <h2>Usuario</h2>
            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>Administrador</h3><br>
              <ul class="nav side-menu">
              <li class="active"><a href="admin_inicio.php"><i class="fa fa-home"></i> Inicio </a></li>
               <li><a><i class="fa fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="admin_user_emp.php">Empleados</a></li>                    
                    <li><a href="admin_user_admin.php">Administradores</a></li>                    
                  </ul>
                </li>
                <li><a><i class="fa fa-th-large"></i> Mesas <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="admin_mesas.php">Administrar</a></li>               
                  </ul>
                </li>
                <li><a><i class="fa fa-folder-o"></i> Categorias <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                  <li><a href="admin_categorias.php">Administrar</a></li>             
                  </ul>
                </li>
                <li><a><i class="fa fa-beer"></i> Productos <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="admin_productos.php">Administrar</a></li>            
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Atenciones <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="admin_atenciones.php">Administrar</a></li>                  
                  </ul>
                </li>
                <li><a><i class="fa fa-bar-chart"></i> Presentacion de datos <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="#">General</a></li>                    
                    <li><a href="#">Empleados</a></li>
                    <li><a href="#">Categorias</a></li>                    
                    <li><a href="#">Productos</a></li>
                    <li><a href="#">Atenciones</a></li>                    
                    <li><a href="#">Inventarios</a></li>                    
                  </ul>
                </li>
                <li><a><i class="fa fa-line-chart"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="admin_reportes_dia.php">Reporte de hoy</a></li>                    
                    <li><a href="admin_reportes_fecha.php">Reportes pasados</a></li>
                    <li><a href="#">Informe mes</a></li>                                        
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Soporte">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Pantalla Completa">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Salir">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Inicio">
              <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

          <!-- top Menu navigation-->
          <?php include 'admin_menu.php'; ?>
          <!-- /top Menu navigation -->


      <!-- page content -->
      <div class="right_col" role="main">

          <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-edit"></i>
                </div>
                <div class="count"><?php echo pedidosHoy(); ?></div>

                <h3>Pedidos Hoy</h3>
                <p>Ordenes facturadas el dia de hoy.</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-th"></i>
                </div>
                <div class="count"><?php echo mesasOcupadas(); ?></div>

                <h3>Mesas Ocupadas</h3>
                <p>Mesas que registran atenciones.</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-male"></i>
                </div>
                <div class="count"><?php echo meserosActivos(); ?></div>

                <h3>Meseros Activos</h3>
                <p>Meseros que registraron hoy.</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-usd"></i>
                </div>
                <div class="count"><?php echo ingresosHoy(); ?></div>

                <h3>Total ingresos</h3>
                <p>ingresos totales de ventas.</p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph x_panel">
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Actividad diaria <small> ultimos dias</small></h3>
                  </div>
                </div>
                <div class="x_content">
                  <div class="demo-container" style="height:250px">
                    <div id="placeholder3xx3" class="demo-placeholder" style="width: 100%; height:250px;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="row">


          <div class="col-md-4 col-sm-4 col-xs-12 bg-white">
          <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                <h2>Productos <small>ult.7 dias</small></h2>                
                <div class="clearfix"></div>
              </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  
                	<?php echo productosMasVendidos(); ?>

                </div>
              </div>
           </div>

          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden">
              <div class="x_title">
                <h2>Mesero <small>ult.7 dias</small> </h2>                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table class="" style="width:100%">
                  <tr>
                    <th style="width:37%;">
                      <p>Top 5</p>
                    </th>
                    <th>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="">Usuario</p>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                    </td>
                    <td>
                      <table class="tile_info">
                        <tr>
                          <td>
                            <p><i class="fa fa-square blue"></i>Juan</p>
                          </td>                          
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square green"></i>Pipe</p>
                          </td>                          
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square purple"></i>Ana</p>
                          </td>                          
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square aero"></i>Maria</p>
                          </td>                          
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square red"></i>Yesica</p>
                          </td>                          
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>


         <div class="col-md-4 col-sm-4 col-xs-12 bg-white">
          <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                <h2>Categorias <small>ult.7 dias</small></h2>                
                <div class="clearfix"></div>
              </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                 	<?php echo categoriasMasVendidas(); ?>
                
                </div>
              </div>
           </div>
            <div class="clearfix"></div><br>
           <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph x_panel">

              <div class="row x_title">
                <div class="col-md-12">
                  <h3>Actividad <small>  Ultimos dias</small></h3>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12 widget_tally_box">
                <div class="x_content">
                  <h4>Ingresos</h4>
                  <div id="graph_bar" style="width:100%; height:200px;"></div>
                </div>
            </div>
              <div class="clearfix"></div>
            </div>
          </div>

        </div>
        <br />

        </div>
        <!-- footer content -->
        <?php include 'footer.php'; ?>
        <!-- /footer content -->

      </div>      
       
      </div>
      <!-- /page content -->

    </div>

  </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>
  <!-- gauge js -->
  <script type="text/javascript" src="js/gauge/gauge.min.js"></script>
  <script type="text/javascript" src="js/gauge/gauge_demo.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="js/moment/moment.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
  <!-- chart js -->
  <script src="js/chartjs/chart.min.js"></script>
  <!-- sparkline -->
  <script src="js/sparkline/jquery.sparkline.min.js"></script>

  <script src="js/custom.js"></script>
  <!-- skycons -->
  <script src="js/skycons/skycons.min.js"></script>

  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
  <script type="text/javascript" src="js/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="js/flot/date.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.spline.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="js/flot/curvedLines.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.resize.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  
 
  <!-- flot -->
  <script>
    //random data
    var d1 =   [
            <?php echo actividadDiaria(); ?>
        ];

         function gd(year, month, day) {
            return new Date(year, (month-1), day).getTime();
        }
    //flot options
    var options = {
    	 xaxis: {
        mode: "time"
    },
      series: {
        curvedLines: {
          apply: true,
          active: true,
          monotonicFit: true
        }
      },
      colors: ["#26B99A"],
      grid: {
        borderWidth: {
          top: 0,
          right: 0,
          bottom: 1,
          left: 1
        },
        borderColor: {
          bottom: "#7F8790",
          left: "#7F8790"
        }
      }
    };
    var plot = $.plot($("#placeholder3xx3"), [{
      label: "Cantidad de pedidos",
      data: d1,
      lines: {
        fillColor: "rgba(150, 202, 89, 0.12)"
      }, //#96CA59 rgba(150, 202, 89, 0.42)
      points: {
        fillColor: "#fff"
      }
    }], options);
  </script>
  <!-- /flot -->



  <!--  -->
  <script>
    $('document').ready(function() { 
      Chart.defaults.global.legend = {
        enabled: false
      };

      var data = {
        labels: [
          "Maria",
          "Ana",
          "Yesica",
          "Pipe",
          "Juan"
        ],
        datasets: [{
          data: [15, 20, 30, 10, 30],
          backgroundColor: [
            "#BDC3C7",
            "#9B59B6",
            "#455C73",
            "#26B99A",
            "#3498DB"
          ],
          hoverBackgroundColor: [
            "#CFD4D8",
            "#B370CF",
            "#34495E",
            "#36CAAB",
            "#49A9EA"
          ]

        }]
      };

      var canvasDoughnut = new Chart(document.getElementById("canvas1"), {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: data
      });
    });
  </script>
  <!-- -->
  



  <!-- moris js -->
  <script src="js/moris/raphael-min.js"></script>
  <script src="js/moris/morris.min.js"></script>
  <script>
    $(function() {
      var day_data = [{
        "period": "Dom",
        "Hours worked": 400000
      }, {
        "period": "Lun",
        "Hours worked": 250000
      }, {
        "period": "Mar",
        "Hours worked": 960000
      }, {
        "period": "Mie",
        "Hours worked": 325000
      }, {
        "period": "Jue",
        "Hours worked": 265000
      }, {
        "period": "Vie",
        "Hours worked": 265000
      }, {
        "period": "Sab",
        "Hours worked": 314000
      },{
        "period": "Dom",
        "Hours worked": 400000
      }, {
        "period": "Lun",
        "Hours worked": 250000
      }, {
        "period": "Mar",
        "Hours worked": 960000
      }, {
        "period": "Mie",
        "Hours worked": 325000
      }, {
        "period": "Jue",
        "Hours worked": 265000
      }, {
        "period": "Vie",
        "Hours worked": 265000
      }, {
        "period": "Sab",
        "Hours worked": 314000
      }];
      Morris.Bar({
        element: 'graph_bar',
        data: day_data,
        hideHover: 'always',
        xkey: 'period',
        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        ykeys: ['Hours worked', 'sorned'],
        labels: ['Hours worked', 'SORN'],
        xLabelAngle: 60
      });
    });
  </script>


  <!-- skycons -->
  <script>
    var icons = new Skycons({
        "color": "#73879C"
      }),
      list = [
        "clear-day", "clear-night", "partly-cloudy-day",
        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
        "fog"
      ],
      i;

    for (i = list.length; i--;)
      icons.set(list[i], list[i]);
    icons.play();
  </script>

 
</body>

</html>
