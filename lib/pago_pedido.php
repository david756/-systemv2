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
  <style type="text/css">
      @media screen {         
       #factura { display: none; }
      }       
    </style>
    <script type="text/javascript">
      function imprSelec(muestra)
      {
        var ficha=document.getElementById(muestra);
        var ventimp=window.open(' ','popimpr');
        ventimp.document.write(ficha.innerHTML);
        ventimp.document.close();
        ventimp.print();
        ventimp.close();
      }
    </script>


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
              <h3>
                    Pago
                    <small>
                        detalle del pedido 
                    </small>
                </h3>
            </div>            
          </div>
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <!-- x_content-->                
                <div class="x_content">
                    <div>
                        <div class="title_left">
                          <div class="pull-left">
                            <h3>Pedido : Mesa 4</h3>
                            <small>
                              <h4>Cajero : Admin</h4>
                            </small>
                          </div>
                        </div>
                        <div class="title_right">
                          <div class="pull-right">
                            <h3>Total: $32.000</h3>
                            <small>
                              <h4>06 Junio 2016 , 12:57 pm</h4>
                            </small>
                          </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr> <!-- Separador -->

                    <div class="row">
                        <!-- div que listado de productos-->
                        <div class="col-md-7">
                              <div class="col-sm-12 invoice-col">
                                <b>Orden ID #007612</b>
                                <br>
                                <br>
                                <b>Estado:</b> Pago
                                <br>
                                <b>Fecha de pago:</b> 2/22/2014
                                <br>
                                <b>Hora de pago:</b> 9:57 pm
                                <br><br>
                              </div>

                             <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Cant</th>
                                    <th>Producto</th>
                                    <th>Valor</th>
                                    <th>Subtotal</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>1</td>
                                    <td>pedido prod</td>
                                    <td>$5.000</td>
                                    <td>$64.500</td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>pedido prod</td>
                                    <td>$10.000</td>
                                    <td>$50.000</td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>pedido prod</td>
                                    <td>$7000</td>
                                    <td>$10.070</td>
                                  </tr>
                                  <tr>
                                    <td>2</td>
                                    <td>pedido prod</td>
                                    <td>$8.000</td>
                                    <td>$25.099</td>
                                  </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-plus-square"></i>  Mas detalles</button><hr>
                        </div>

                        <!-- div que agrupa totales y botones -->
                        <div class="col-md-5">

                          <!-- div que agrupa totales-->
                          <div class="col-md-12">
                              <p class="lead">Monto a pagar :</p>
                              <div class="table-responsive">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <th style="width:50%">Subtotal:</th>
                                      <td>$32.000</td>
                                    </tr>
                                    <tr>
                                      <th>Descuento:</th>
                                      <td>$7.000</td>
                                    </tr>
                                    <tr>
                                      <th>Impuesto (9.3%):</th>
                                      <td>$950</td>
                                    </tr>
                                    <tr>
                                      <th>Total:</th>
                                      <td>$265.24</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                          </div>

                         <!-- div que agrupa botones-->
                              <div class="col-md-12">
                                  <a class="btn btn-app" data-toggle="modal" data-target="#ModalPago">
                                    <i class="fa fa-credit-card"></i> Pagar
                                  </a>
                                  <a class="btn btn-app" data-toggle="modal" data-target="#ModalAplazar">
                                    <i class="fa fa-remove"></i> Aplazar
                                  </a>
                                  <a class="btn btn-app" data-toggle="modal" data-target="#ModalDescuento">
                                    <i class="fa fa-inbox"></i> Descuento
                                  </a>
                                  <a class="btn btn-app" data-toggle="modal" data-target="#ModalCortesia">
                                    <i class="fa fa-gift"></i> Cortesia
                                  </a>
                                  <a class="btn btn-app" href="javascript:imprSelec('factura')" >
                                    <span class="badge bg-orange fa fa-check"></span>
                                    <i class="fa fa-print"></i> Imprimir
                                  </a>
                              </div><div class="clearfix"></div><br>                        
                        </div>
                    </div>

                    <!-- /modal pago -->
                    <div class="modal fade bs-example-modal-sm" id="ModalPago" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content" align="center">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Confirmar Pago</h4>
                            </div>
                              <form>
                                <h2> ¿Confirmar pago del pedido? </h2><br>
                                <Title> Total: <strong>$15.000 </strong></Title><br>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Detalle : </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Descripción" value="Pago simple">
                                  </div>
                                  <br><br>
                                </div>
                              </form>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-info">Confirmar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modal pago -->

                    <!-- /modal cortesia -->
                    <div class="modal fade bs-example-modal-sm" id="ModalCortesia" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content" align="center">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Cortesia</h4>
                            </div>
                              <form>
                                <h2> ¿Confirmar cortesia? </h2><br>
                                <Title> Total: <strong>$15.000 </strong></Title><br>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Detalle : </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="escriba una descripción" required>
                                  </div>
                                  <br><br>
                                </div>
                              </form>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-info">Confirmar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modal cortesia -->

                    <!-- /modal aplazar -->
                    <div class="modal fade bs-example-modal-sm" id="ModalAplazar" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content" align="center">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Aplazar el pago</h4>
                            </div>
                              <form>
                                <h2> ¿desea aplazar el pago de este pedido? </h2><br>
                                <p>Puede aplazar pedidos cuando el pago se va a hacer mas adelante, es util para poner disponible una mesa que aun no han pagado o cuando existe algun problema con el pedido y no se puede llevar a cabo el pago. </p>
                                <Title> Total: <strong>$15.000 </strong></Title><br>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Detalle : </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="escriba una descripción" required>
                                  </div>
                                  <br><br>
                                </div>
                              </form>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-info">Confirmar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modal aplazar -->

                    <!-- /modal descuento -->
                    <div class="modal fade bs-example-modal-sm" id="ModalDescuento" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content" align="center">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Descuento</h4>
                            </div>
                              <form>
                                <h2> Agregar descuento al pedido </h2><br>
                                <Title> Total Pedido: <strong>$15.000 </strong></Title><br>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Descuento: </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="ej: 2500">
                                  </div>
                                  <br><br>
                                </div>
                              </form>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-info">Confirmar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modal descuento -->

                    <!-- /factura -->
                    <section id="factura" class="content invoice">
                    <!-- info row -->
                    <div class="row invoice-info">
                      <div class="col-sm-12 invoice-col" align="center">
                        <h2>Nombre del restaurante</h2>
                        <address>
                                        <strong>Regimen comun</strong>
                                        <br>Cra 13 Norte 12-35
                                        <br>Armenia , Quindio
                                        <br>(57) 7356985
                                        <br>contacto@nombre.com
                                    </address>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-12 invoice-col">
                        <b>Factura de venta  #007612</b>
                        <br>
                        <br>
                        <b>Cajero:</b> JuanDavid
                        <br>
                        <b>Fecha:</b> 2 noviembre 2016
                        <br>
                        <b>hora:</b> 12:15 pm
                        <br><hr>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th style="width: 10%">Cant</th>
                              <th style="width: 50%">Producto</th>
                              <th style="width: 20%">valor</th>
                              <th style="width: 20%">Subtotal</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>Nombre del producto</td>
                              <td>$25.000</td>
                              <td>$35.000</td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>nombreso</td>
                              <td>$55.000</td>
                              <td>$135.000</td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td>Product</td>
                              <td>$12.000</td>
                              <td>$189.000</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">                     
                      <!-- /.col -->
                      <div class="col-xs-12">
                        <!-- /.col -->
                      <div class="col-sm-12 invoice-col">
                        <br>
                        <br>
                        <b>Subtotal: $250.030</b>
                        <br>
                        <br>
                        <b>Impuesto (9.3%):</b> $10.534
                        <br>
                        <b>Descuento:</b> $5.880
                        <br>
                        <b>Total:</b> $265.024
                        <br><hr>
                      </div>
                      <!-- /.col -->
                      </div>
                      <div class="col-sm-12 invoice-col" align="center">
                         <hr><strong>Factura electronica Sistema Manitl</strong>
                         <br>www.mantil.com
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </section>
                  <!-- /factura -->


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

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>

</body>

</html>
