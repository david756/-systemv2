<?php  
  include 'controller/Sesiones.php';
  admin();
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

  <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

  <script src="js/jquery.min.js"></script>
  <script src="js/nprogress.js"></script>

  <!-- /datepicker -->
    <script type="text/javascript">
      $(document).ready(function() {
          var f = new Date();
          var actual =((f.getMonth() +1) + "/" +  f.getDate()+ "/" + f.getFullYear());
          var anterior =((f.getMonth() +1) + "/" +  (f.getDate())+ "/" + f.getFullYear());
          $('#fecha_inicio').val(anterior);
          $('#fecha_fin').val(actual);
          $('#reservation').daterangepicker({ 
            "startDate": anterior,
            "endDate": actual
          }, function(start, end, label) {
            $('#fecha_inicio').val(start.format('MM/DD/YYYY'));
            $('#fecha_fin').val(end.format('MM/DD/YYYY'));
          });
      });
    </script>

   <script type="text/javascript">

     
      function mostrarLista(){   
           
            fechaInicio=$('#fecha_inicio').val();
            fechaFin=$('#fecha_fin').val(); 
                $.post("controller/Atencion.php", 
                  {metodo: "listaAtenciones",
                  fecha1:fechaInicio,
                  fecha2:fechaFin}
                  ,function(tabla){
                    $('#tabla').html(tabla);
                  }
                );                 
      }
    

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
              <li ><a href="admin_inicio.php"><i class="fa fa-home"></i> Inicio </a></li>
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
                <li  class="active" ><a><i class="fa fa-edit"></i> Atenciones <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li class="current-page"><a href="admin_atenciones.php">Administrar</a></li>                  
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

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

              <div class="row x_title">
                <div class="col-md-6">
                  <h3>Atenciones <small>Ordenes de pedidos</small></h3>
                </div>
                <div class="col-md-6">

                </div>
              </div>
                <div class="well"> 
                    <form class="form-horizontal">
                      <fieldset>
                      <div class="row">
                          <div class="control-group col-md-4 col-sm-3 col-xs-12">
                            <div class="controls">
                              <div class="input-prepend input-group">
                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control" value="Seleccione fecha" />
                                <input type="text" id ="fecha_inicio" value="" style="display:none">
                                <input type="text" id ="fecha_fin" value="" style="display:none">
                              </div>
                            </div>
                          </div>
                            <div class="col-md-4">
                              <button type="button" onclick="mostrarLista()" class="btn btn-default btn-sm">Consultar</button>
                            </div>
                        </div>
                      </fieldset>
                    </form>
                  </div>
              <div class="col-md-12 col-sm-12 col-xs-12">                    
                        <table id="datatable" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Fecha</th>
                              <th>Mesa</th>
                              <th>Estado</th>
                              <th>Descripcion</th>
                              <th>Descuento</th>
                              <th>Total</th>
                              <th>Cajero</th>
                              <th>Accion</th>
                            </tr>
                          </thead>
                         <tbody id="tabla">
                            
                          </tbody>
                        </table>
                  </div>

              <div class="clearfix"></div>
            </div>
          </div>

        </div>
        <br />       
       <!-- footer content -->
        <?php include 'footer.php'; ?>
        <!-- /footer content -->
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

        <script src="js/custom.js"></script>

        <!-- daterangepicker -->
        <script type="text/javascript" src="js/moment/moment.min.js"></script>
        <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
        <!-- input mask -->
        <script src="js/input_mask/jquery.inputmask.js"></script>
        <!-- knob -->
        <script src="js/knob/jquery.knob.min.js"></script>
        <!-- range slider -->
        <script src="js/ion_range/ion.rangeSlider.min.js"></script>
        <!-- color picker -->
        <script src="js/colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="js/colorpicker/docs.js"></script>

   <!-- Datatables -->
        <!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

        <!-- Datatables-->
        <script src="js/datatables/jquery.dataTables.min.js"></script>
        <script src="js/datatables/dataTables.bootstrap.js"></script>
        <script src="js/datatables/dataTables.buttons.min.js"></script>
        <script src="js/datatables/buttons.bootstrap.min.js"></script>
        <script src="js/datatables/jszip.min.js"></script>
        <script src="js/datatables/pdfmake.min.js"></script>
        <script src="js/datatables/vfs_fonts.js"></script>
        <script src="js/datatables/buttons.html5.min.js"></script>
        <script src="js/datatables/buttons.print.min.js"></script>
        <script src="js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="js/datatables/dataTables.keyTable.min.js"></script>
        <script src="js/datatables/dataTables.responsive.min.js"></script>
        <script src="js/datatables/responsive.bootstrap.min.js"></script>
        <script src="js/datatables/dataTables.scroller.min.js"></script>
</body>

</html>
