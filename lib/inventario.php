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

    <!-- ion_range -->
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="css/ion.rangeSlider.css" />
  <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />

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



      <!-- page content -->
      <div class="right_col" role="main">

        <div class="x_content">
          <div class="page-title">
            <div class="title_left">
              <h3>Inventario</h3>
            </div>

            <div class="title_right">
              <div class="pull-right">
                <h2>Modificar Inventario <button type="button" class="btn btn-info btn-sm " data-toggle="modal" data-target="#Modalinventario">Agregar </button></h2>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <!-- x_content-->                
                <div class="x_content">
                <div class="well">             
                    
                    <form class="form-horizontal">
                      <fieldset>
                      <div class="row">
                          <div class="control-group col-md-4 col-sm-3 col-xs-12">
                            <div class="controls">
                              <div class="input-prepend input-group">
                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control" value="03/18/2013 - 03/23/2013" />
                              </div>
                            </div>
                          </div>

                            <div class="form-group col-md-4">
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <select class="select2_single form-control" tabindex="-1">
                                    <option value="p1">Producto1</option>
                                    <option value="p2">Producto2</option>
                                    <option value="p3">Producto3</option>
                                    <option value="p4">Producto4</option>
                                  </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                              <button type="button" class="btn btn-default btn-sm">Consultar</button>
                            </div>
                        </div>
                      </fieldset>
                    </form>
                  </div>

             <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Producto 1 <small>Inventario</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                        <div class="col-sm-12 invoice-col">
                                <b>Unidades disponibles: 13</b>
                                <br>
                                <br>
                                <b>Valor de venta promedio:</b> $12.000
                                <br>
                                <b>Costo promedio:</b> $9.500
                                <br><br>
                              </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Fecha</th>
                              <th>Usuario</th>
                              <th>Cantidad</th>
                              <th>Accion</th>
                              <th>Descripcion</th>
                              <th>Costo</th>
                              <th>Proveedor</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>23/marzo/2016 12:02 pm</td>
                              <td>Juan</td>
                              <td>12</td>
                              <td><button type="button" class="btn btn-success btn-xs">ingresado</button></td>
                              <td>productos ingresados normalmente al inventario</td>
                              <td>$12.500</td>
                              <td>Babaria</td>
                            </tr>
                            <tr>
                              <td>25/junio/2016 10:02 pm</td>
                              <td>pedro</td>
                              <td>10</td>
                              <td><button type="button" class="btn btn-info btn-xs">Vendido</button></td>
                              <td>productos sacados del inventario</td>
                              <td>$10.500</td>
                              <td>Colombina</td>
                            </tr> 
                            <tr>
                              <td>25/junio/2016 10:02 pm</td>
                              <td>pedro</td>
                              <td>10</td>
                              <td><button type="button" class="btn btn-danger btn-xs">eliminado</button></td>
                              <td>productos sacados del inventario</td>
                              <td>$10.500</td>
                              <td>Colombina</td>
                            </tr>                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <!-- /modal editar inventario -->
                    <div class="modal fade bs-example-modal-lg" id="Modalinventario" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content" align="center">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Acciones de inventario</h4>
                            </div>
                            <div class="modal-body">
                               <form class="form-horizontal form-label-left">                                    
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Accion</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control">
                                            <option>Ingresar</option>
                                            <option>Eliminar</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Producto</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control">
                                            <option>producto one</option>
                                            <option>Option two</option>
                                            <option>Option three</option>
                                            <option>Option four</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" placeholder="ej : 10">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Costo</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" placeholder="ej : 12000">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Proveedor</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" placeholder="Nombre del proveedor">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Descricpion<span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <textarea class="form-control" rows="3" placeholder='Descripción'></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-info">Confirmar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modal editar inventario  -->
                </div>
                <!-- /x_content End dv -->
              </div>
            </div>
          </div>
        </div>

        <!-- footer content -->
        <?php include 'footer.php'; ?>
        <!-- /footer content -->

      </div>
      <!-- /page content -->

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

         <!-- datepicker -->
  <script type="text/javascript">
    $(document).ready(function() {

      var cb = function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
      }

      var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: {
          days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'right',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        }
      };

      $('#reportrange_right span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

      $('#reportrange_right').daterangepicker(optionSet1, cb);

      $('#reportrange_right').on('show.daterangepicker', function() {
        console.log("show event fired");
      });
      $('#reportrange_right').on('hide.daterangepicker', function() {
        console.log("hide event fired");
      });
      $('#reportrange_right').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
      });
      $('#reportrange_right').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
      });

      $('#options1').click(function() {
        $('#reportrange_right').data('daterangepicker').setOptions(optionSet1, cb);
      });

      $('#options2').click(function() {
        $('#reportrange_right').data('daterangepicker').setOptions(optionSet2, cb);
      });

      $('#destroy').click(function() {
        $('#reportrange_right').data('daterangepicker').remove();
      });

    });
  </script>
  <!-- datepicker -->
  <script type="text/javascript">
    $(document).ready(function() {

      var cb = function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
      }

      var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: {
          days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        }
      };
      $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
      $('#reportrange').daterangepicker(optionSet1, cb);
      $('#reportrange').on('show.daterangepicker', function() {
        console.log("show event fired");
      });
      $('#reportrange').on('hide.daterangepicker', function() {
        console.log("hide event fired");
      });
      $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
      });
      $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
      });
      $('#options1').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
      });
      $('#options2').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
      });
      $('#destroy').click(function() {
        $('#reportrange').data('daterangepicker').remove();
      });
    });
  </script>
  <!-- /datepicker -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#single_cal1').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
      $('#single_cal2').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_2"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
      $('#single_cal3').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_3"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
      $('#single_cal4').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#reservation').daterangepicker(null, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
    });
  </script>
  <!-- /datepicker -->
</body>

</html>
