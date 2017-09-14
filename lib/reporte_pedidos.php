<?php  
  include 'controller/Sesiones.php';
  include 'controller/Reportes.php';
  admin();
  caja();
  if(isset($_GET['inicio'])&&isset($_GET['fin'])) {
    $inicio=$_GET['inicio'];
    $fin=$_GET['fin'];
    $fecha_actual=$inicio." - ".$fin;
  }
  else{
    $inicio= date("d/m/Y");
    $fin=date("d/m/Y");
    $fecha_actual=$inicio." - ".$fin;

  }

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Holly Sistema Pos | </title>

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

  <!--[if lt IE 9]>
  <script src="../assets/js/ie8-responsive-file-warning.js"></script>
  <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body style="background:#F7F7F7;">
<!-- top Menu navigation-->
<?php include 'menu.php'; ?>
<!-- /top Menu navigation -->

  <div class="container body">

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="x_content">         
          <div class="clearfix"></div>
          <div class="row">
                <div class="col-md-6">
                  <h3>Pedidos <small>reporte de ordenes individuales</small></h3>
                </div>
                <div class="col-md-6">
                </div>
              </div>
                <div class="well"> 
                    <a class="pull-right" href="menu_principal.php" type="button" class="btn btn-default btn-sm">Volver</a>
                    <form class="form-horizontal">
                      <fieldset>
                      <div class="row">
                          <div class="control-group col-md-4 col-sm-6 col-xs-12">
                            <div class="controls">
                            <h5>Seleccione un rango de fecha:</h5>
                              <div class="input-prepend input-group">
                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control"
                                 value="<?php echo $fecha_actual; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                  </div>                 

              <div class="col-md-12 col-sm-12 col-xs-12">                    
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Fecha Pedido</th>
                              <th>Producto</th>
                              <th>Anexos</th> 
                              <th>Mesero</th>
                              <th>Cocinero</th>                             
                              <th>Mesa</th> 
                              <th>Cant.</th>
                              <th>Valor</th>
                              <th>Total</th>
                              <th>Accion</th>
                            </tr>
                          </thead>
                          <tbody>                            
                            <?php 
                            if (isset($inicio)&&isset($fin)) {
                              echo pedidos($inicio,$fin);
                            }
                            else{
                             echo "Seleccione una fecha <hr>" ;
                            }
                            ?>
                          </tbody>
                        </table>
                  </div>
             <!-- footer content -->
              <?php include 'footer.php'; ?>
              <!-- /footer content -->
            </div>
            <!-- /page content -->
          </div>


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


        <!-- pace -->
        <script src="js/pace/pace.min.js"></script>
        <script>
          var handleDataTableButtons = function() {
              "use strict";
              0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                    "order": []
                },{
                dom: "Bfrtip",
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
                responsive: !0
              })
            },
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
        </script>
        <script type="text/javascript">
          $(document).ready(function() {
            
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
            
          });
          TableManageButtons.init();
        </script>
       
    <script type="text/javascript">
      $(document).ready(function() {
        $('#reservation').daterangepicker(null, function(start, end, label) {

          var a_inicio=start.format("DD/MM/YYYY");
          var a_fin=end.format("DD/MM/YYYY")
          var url="reporte_pedidos.php?inicio="+a_inicio+"&fin="+a_fin;

          location.href =url;

        });
      });
    </script>
 
</body>

</html>
