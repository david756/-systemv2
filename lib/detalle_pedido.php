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
       #informe { display: none; }
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
                    Detalle de atencion
                    <small>
                        Orden Id : 154785
                    </small>
                </h3>
            </div>

            <div class="title_right">
              <div class="pull-right">
                <h2>Estado Atencion : Pago </h2>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <!-- x_content-->                
                <div class="x_content">

                    <div class="row">                      
                      <div class="col-md-6">                       
                        <h4>Detalle de la orden</h4>
                              <b> Mesa :</b>  Mesa 2<br>
                              <b> Cajero :</b>  juan<br>
                              <b> sub total :</b> $15.000 <br>
                              <b>Descuento Total :</b>  $3.000<br>
                              <b>total:</b> $12.000<br>
                              <b>Hora pago:</b> 27/Feb/2016 12:01:01 pm<br>                   
                              <b> Estado :</b>  Pago <br><br>
                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ModalOrden">Editar Orden</button>
                        <a type="button" class="btn btn-default btn-sm" href="javascript:imprSelec('informe')">Imprimir a detalle</a>
                        <hr>
                      </div>


                      <div class="col-md-6">   
                        <h4>Pedidos Atencion</h4> 
                         <!-- start accordion -->
                         <div class="accordion" id="accordion" role="tablist" aria-multiselectable="false">
                            <div class="panel">
                                  <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <h4 class="panel-title"><strong>Producto 1</strong></h4>
                                  </a>
                                  <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                           <b> Valor Actual :</b>  $5.000 <br>
                                            <b>Valor Registrado :</b>  $4.900 <br>
                                            <b>Total:</b> $2.500<br>
                                            <b> Mesero :</b>  juan<br>
                                            <b>Descripcion :</b> pan jamon y queso <br>
                                            <b> Anexos :</b>  anexo del pedido<br>
                                            <b> Hora Pedido :</b> 27/Feb/2016 02:13:12 pm <br>
                                            <b> Hora Inicio Preparacion :</b> 27/Feb/2016  02:18:12 pm <br>
                                            <b> Hora Despacho :</b> 27/Feb/2016  02:25:12 pm <br>
                                            <b> Tiempo Total :</b> 35 minutos  <br>
                                            <b> Cocinero :</b>  Pedro <br>
                                            <b> Categoria : </b> bebidas<br><br>
                                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalitem">Editar</button>
                                            <button type="button" class="btn btn-default btn-xs">Eliminar</button><hr>
                                        </div>
                                  </div>
                            </div>
                          </div>   
                          <!-- end accordion -->  

                          <!-- start accordion -->
                         <div class="accordion" id="accordion" role="tablist" aria-multiselectable="false">
                            <div class="panel">
                                  <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h4 class="panel-title"><strong>Producto 1</strong></h4>
                                  </a>
                                  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                           <b> Valor Actual :</b>  $5.000 <br>
                                            <b>Valor Registrado :</b>  $4.900 <br>
                                            <b>Total:</b> $2.500<br>
                                            <b> Mesero :</b>  juan<br>
                                            <b>Descripcion :</b> pan jamon y queso <br>
                                            <b> Anexos :</b>  anexo del pedido<br>
                                            <b> Hora Pedido :</b> 27/Feb/2016 02:13:12 pm <br>
                                            <b> Hora Inicio Preparacion :</b> 27/Feb/2016  02:18:12 pm <br>
                                            <b> Hora Despacho :</b> 27/Feb/2016  02:25:12 pm <br>
                                            <b> Tiempo Total :</b> 35 minutos  <br>                                            
                                            <b> Cocinero :</b>  Pedro <br>
                                            <b> Categoria : </b> bebidas<br><br>
                                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#Modalitem">Editar</button>
                                            <button type="button" class="btn btn-default btn-xs">Eliminar</button><hr>
                                        </div>
                                  </div>
                            </div>
                          </div>   
                          <!-- end accordion -->                               
                       
                  </div>

                  <!-- /modal editar Orden -->
                    <div class="modal fade bs-example-modal-lg" id="ModalOrden" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content" align="center">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Modificar Atencion</h4>
                            </div>
                            <form class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mesa</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control">
                                            <option>Choose option</option>
                                            <option>Option one</option>
                                            <option>Option two</option>
                                            <option>Option three</option>
                                            <option>Option four</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Descuento</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" placeholder="Default Input">
                                      </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control">
                                            <option>Choose option</option>
                                            <option>Option one</option>
                                            <option>Option two</option>
                                            <option>Option three</option>
                                            <option>Option four</option>
                                          </select>
                                        </div>
                                    </div>
                            </form>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-info">Confirmar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modal editar orden  -->

                    <!-- /modal editar item pedido -->
                    <div class="modal fade bs-example-modal-lg" id="Modalitem" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content" align="center">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Modificar Pedido</h4>
                            </div>
                               <form class="form-horizontal form-label-left">                                    
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Producto</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control">
                                            <option>Choose option</option>
                                            <option>Option one</option>
                                            <option>Option two</option>
                                            <option>Option three</option>
                                            <option>Option four</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" placeholder="Valor del producto">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Anexos<span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <textarea class="form-control" rows="3" placeholder='Anexos'></textarea>
                                        </div>
                                    </div>
                                </form>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-info">Confirmar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modal editar item pedido  -->

                    <!-- / informe de cuenta-->
                    <section id="informe" class="content invoice">
                              <!-- info row -->
                              <div class="row invoice-info">
                                    <div class="col-sm-12 invoice-col" align="center">
                                        <h2>Nombre establecimiento</h2>
                                        <address>
                                            <br>Nit 7852145-8                                       
                                            <br> Cra 13 Norte 12-35
                                            <br>Armenia , Quindio
                                            <br>(57) 7356985
                                            <br>contacto@nombre.com <br><br>                                       
                                         </address>
                                        <address>
                                                        <strong>Cuenta Detallada</strong>
                                                        <br>Este ticket no remplaza la 
                                                        factura de venta.                            
                                                                                            
                                         </address>
                                    </div>
                                      <!-- /.col -->
                                      <div class="col-sm-12 invoice-col">
                                          <h4>Detalle de la orden</h4>
                                          <b> Orden Id :</b>  #25714<br>
                                          <b> Mesa :</b>  Mesa 2<br>
                                          <b> Cajero :</b>  juan<br>                                          
                                          <b> Hora pago:</b> 27/Feb/2016 12:01:01 pm<br>                   
                                          <b> Estado :</b>  Pago <br>
                                          <b> Subtotal :</b> $15.000 <br>
                                          <b> Descuento Total :</b>  $3.000<br>
                                          <b> TOTAL:</b> $12.000<br><br><hr>
                                      </div>
                                      <!-- /.col -->
                              </div>
                              <!-- /.row -->
                              <!-- Table row -->
                              <div class="row">
                                 <h4>Detalle de la orden</h4>
                                    <div class="">
                                        <h4 class="panel-title"><strong>Producto 1</strong></h4>
                                         <b> Valor Actual :</b>  $5.000 <br>
                                            <b>Valor Registrado :</b>  $4.900 <br>
                                            <b>Total:</b> $2.500<br>
                                            <b> Mesero :</b>  juan<br>
                                            <b>Descripcion :</b> pan jamon y queso <br>
                                            <b> Anexos :</b>  anexo del pedido<br>
                                            <b> Hora Pedido :</b> 27/Feb/2016 02:13:12 pm <br>
                                            <b> Hora Inicio Preparacion :</b> 27/Feb/2016  02:18:12 pm <br>
                                            <b> Hora Despacho :</b> 27/Feb/2016  02:25:12 pm <br>
                                            <b> Tiempo Total :</b> 35 minutos  <br>                                            
                                            <b> Cocinero :</b>  Pedro <br>
                                            <b> Categoria : </b> bebidas<br><br> 
                                    </div>

                                    <div class="">
                                        <h4 class="panel-title"><strong>Producto 1</strong></h4>
                                         <b> Valor Actual :</b>  $5.000 <br>
                                            <b>Valor Registrado :</b>  $4.900 <br>
                                            <b>Total:</b> $2.500<br>
                                            <b> Mesero :</b>  juan<br>
                                            <b>Descripcion :</b> pan jamon y queso <br>
                                            <b> Anexos :</b>  anexo del pedido<br>
                                            <b> Hora Pedido :</b> 27/Feb/2016 02:13:12 pm <br>
                                            <b> Hora Inicio Preparacion :</b> 27/Feb/2016  02:18:12 pm <br>
                                            <b> Hora Despacho :</b> 27/Feb/2016  02:25:12 pm <br>
                                            <b> Tiempo Total :</b> 35 minutos  <br>                                            
                                            <b> Cocinero :</b>  Pedro <br>
                                            <b> Categoria : </b> bebidas<br><br> 
                                    </div>

                                    <div class="">
                                        <h4 class="panel-title"><strong>Producto 1</strong></h4>
                                         <b> Valor Actual :</b>  $5.000 <br>
                                            <b>Valor Registrado :</b>  $4.900 <br>
                                            <b>Total:</b> $2.500<br>
                                            <b> Mesero :</b>  juan<br>
                                            <b>Descripcion :</b> pan jamon y queso <br>
                                            <b> Anexos :</b>  anexo del pedido<br>
                                            <b> Hora Pedido :</b> 27/Feb/2016 02:13:12 pm <br>
                                            <b> Hora Inicio Preparacion :</b> 27/Feb/2016  02:18:12 pm <br>
                                            <b> Hora Despacho :</b> 27/Feb/2016  02:25:12 pm <br>
                                            <b> Tiempo Total :</b> 35 minutos  <br>                                            
                                            <b> Cocinero :</b>  Pedro <br>
                                            <b> Categoria : </b> bebidas<br><br> 
                                    </div>
                              </div>
                              <!-- /.row -->
                              <div class="row">
                                  <!-- /.col -->
                                <div class="col-sm-12 invoice-col"><hr>
                                    <b>Tiempo Total :</b>  27 minutos <br>
                                    <b>Tiempo Prom. de espera :</b>  2 minutos <br>
                                    <p align="center"><i>Trabajamos para mejorar nuestros servicios</i>
                                    <br><i>Gracias por preferirnos.</i></p>
                                </div>
                                <!-- /.col -->
                              </div>

                              <div class="col-sm-12 invoice-col" align="center">
                                <hr>
                                <strong>Sistema Manitl www.mantil.com</strong>
                              </div>
                  </section>
                  <!-- /informe -->

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
