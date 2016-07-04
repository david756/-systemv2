<!DOCTYPE html>
<html lang="en">

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
  <link href="css/icheck/flat/green.css" rel="stylesheet">

  <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

  <script src="js/jquery.min.js"></script>

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
          <div class="page-title">
            <div class="title_left">
              <h3>Cuentas abiertas</h3>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Pedidos no pagos </h2>
                        <div class="clearfix"></div>
                      </div>

                      <div class="x_content">
                        <p class="text-muted font-13 m-b-30">
                          Lista de pedidos que aun no han sido tarifados.
                        </p>
                        <p class="text-muted font-13 m-b-30">
                          Opciones:
                        </p>
                        <button type="button" class="btn btn-success">Actualizar</button>
                        <hr>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Mesa</th>
                              <th>Total</th>
                              <th>Estado</th>
                              <th>Hora Inicio</th>
                              <th>Accion</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Mesa 2</td>
                              <td>25000</td>
                              <td>pedido</td>
                              <td>12:12 Pm , 22-feb-2016</td>
                              <td>
                                <button type="button" class="btn btn-success btn-xs">Pagar</button>
                                <button type="button" class="btn btn-defautl btn-xs">Quitar <i class="fa fa-remove"></i></button>
                              </td>
                            </tr>
                            <tr>
                              <td>Mesa 2</td>
                              <td>25000</td>
                              <td>pedido</td>
                              <td>12:12 Pm , 22-feb-2016</td>
                              <td>
                                <button type="button" class="btn btn-success btn-xs">Pagar</button>
                                <button type="button" class="btn btn-defautl btn-xs">Quitar <i class="fa fa-remove"></i></button>
                              </td>
                            </tr>
                            <tr>
                              <td>Mesa 2</td>
                              <td>25000</td>
                              <td>pedido</td>
                              <td>12:12 Pm , 22-feb-2016</td>
                              <td>
                                <button type="button" class="btn btn-success btn-xs">Pagar</button>
                                <button type="button" class="btn btn-defautl btn-xs">Quitar <i class="fa fa-remove"></i></button>
                              </td>
                            </tr>
                            <tr>
                              <td>Mesa 2</td>
                              <td>25000</td>
                              <td>pedido</td>
                              <td>12:12 Pm , 22-feb-2016</td>
                              <td>
                                <button type="button" class="btn btn-success btn-xs">Pagar</button>
                                <button type="button" class="btn btn-defautl btn-xs">Quitar <i class="fa fa-remove"></i></button>
                              </td>
                            </tr>
                            <tr>
                              <td>Mesa 2</td>
                              <td>25000</td>
                              <td>pedido</td>
                              <td>12:12 Pm , 22-feb-2016</td>
                              <td>
                                <button type="button" class="btn btn-success btn-xs">Pagar</button>
                                <button type="button" class="btn btn-defautl btn-xs">Quitar <i class="fa fa-remove"></i></button>
                              </td>
                            </tr>

                          </tbody>
                        </table>

                      </div>
                    </div>
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
</body>

</html>
