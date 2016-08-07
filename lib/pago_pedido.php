<?php
        if (isset($_GET['atencion'])) {
               $idAtencion=$_GET['atencion'];
        }else{
            $idAtencion="N/A";
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

  <title>Mantil Sistema Pos | </title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>

  <style type="text/css">
      @media screen {         
       #factura { display: none; }
       #informe { display: none; }
      }       
    </style>  

    <script type="text/javascript">
      $(document).ready(function() {
               datosAtencion();
               pedidoCompleto();
        });
    </script>  
    <script type="text/javascript">
      function imprSelec()
      {
        muestra="informe";
        if ($('.estadoAtencion').html()=="pago") {
          muestra="factura";
        }
        var ficha=document.getElementById(muestra);
        var ventimp=window.open(' ','popimpr');
        ventimp.document.write(ficha.innerHTML);
        ventimp.document.close();
        ventimp.print();
        ventimp.close();
      }
    </script>
    <script type="text/javascript">
      var idAtencion=<?php echo $idAtencion; ?> ;
      var estadoAtencion;
      function datosAtencion(){ 
              $.ajax({
                   type   : 'POST',
                   url    : 'controller/Atencion.php',
                   data  : {metodo: "datosAtencion2",atencion: idAtencion },
                   dataType : 'json',
                   success  : function(data){
                    var total=data.totalPedido;
                    total=parseInt(total);
                    var total = total.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                    subtotal=parseInt(data.subtotal);
                    var subtotal = subtotal.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                    descuento=parseInt(data.descuento);
                    var descuento = descuento.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                    var urlDetallle="detalle_pedido.php?atencion="+idAtencion;
                    estadoAtencion=estadoAtencion;
                      $('#urlDetallle').attr("href",urlDetallle);
                      $('.totalPedido').html(total);
                      $('.mesa').html(data.mesa);
                      $('.estadoAtencion').html(data.estadoAtencion);
                      $('.descuento').html(descuento);
                      $('.cajero').html(data.cajero);
                      $('.horaPago').html(data.horaPago);
                      $('.horaInicio').html(data.horaInicio);
                      $('.subtotal').html(subtotal);
                      $('.idAtencion').html(data.idAtencion);
                      $('.impuesto').html(data.impuesto);



                  },
                   error  : function(data){
                    console.log(data);
                  }
               });
      }

       function pedidoCompleto(){         
                  $.post("controller/Atencion.php", 
                  {metodo: "pedidoCompleto2",atencion:idAtencion}
                  ,function(tabla){
                    $('.pedidoCompleto').html(tabla);
                  }
                  );
      }

      function descuento(){

            var descuento=$('#descuento_atencion').val();            
            $.post("controller/Atencion.php", 
                    {metodo: "descuento",
                     idAtencion: idAtencion,descuento:descuento},function(respuesta){
                      $('#ModalDescuento').modal('hide');
                      if (respuesta=="Exito") {
                        $('#descuento_atencion').val(0);
                        $('#resultado').html("se agrego descuento al pedido!");
                        $('#resultado').attr("class","alert alert-success");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                        datosAtencion();
                      }
                      else{
                        $('#resultado').html(respuesta);
                        $('#resultado').attr("class","alert alert-danger");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                      }
                      
                    }
              ); 
       }
       function pagar(){

            var detalle=$('#descripcion_pagar').val();
            if (detalle!="") { 
            $.post("controller/Atencion.php", 
                    {metodo: "pagar",
                     idAtencion: idAtencion,detalle: detalle},function(respuesta){
                      $('#ModalPago').modal('hide');
                      if (respuesta=="Exito") {
                        $('#resultado').html("Se registro el pago del pedido correctamente!");
                        $('#resultado').attr("class","alert alert-success");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                        $('.estadoAtencion').html("pago");
                        datosAtencion();
                        $('#btnImprimir')[0].click();

                      }
                      else{
                        $('#resultado').html(respuesta);
                        $('#resultado').attr("class","alert alert-danger");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                      }
                      
                    }
              ); 
            }
       }
       function aplazar(){

            var detalle=$('#descripcion_aplazar').val();
            if (detalle!="") {             
            $.post("controller/Atencion.php", 
                    {metodo: "aplazar",
                     idAtencion: idAtencion,detalle: detalle},function(respuesta){
                      $('#ModalAplazar').modal('hide');
                      if (respuesta=="Exito") {
                        $('#resultado').html("Se aplazo el pago del pedido!");
                        $('#resultado').attr("class","alert alert-success");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                        datosAtencion();
                      }
                      else{
                        $('#resultado').html(respuesta);
                        $('#resultado').attr("class","alert alert-danger");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                      }
                      
                    }
              ); 
          }
       }
       function cortesia(){

            var detalle=$('#descripcion_cortesia').val(); 
            if (detalle!="") {            
            $.post("controller/Atencion.php", 
                    {metodo: "cortesia",
                     idAtencion: idAtencion,detalle: detalle},function(respuesta){
                      $('#ModalCortesia').modal('hide');
                      if (respuesta=="Exito") {
                        $('#resultado').html("Se facturo como cortesia!");
                        $('#resultado').attr("class","alert alert-success");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                        datosAtencion();
                      }
                      else{
                        $('#resultado').html(respuesta);
                        $('#resultado').attr("class","alert alert-danger");
                        $('#resultado').show("slow").delay(4000).hide("slow");                        
                      }
                      
                    }
              ); 
          }
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
                            <h2>Pedido : <span class="mesa"></span></h2>
                            <small>
                              <h4>Cajero : <span class="cajero"></span></h4>
                            </small>
                          </div>
                        </div>
                        <div class="title_right">
                          <div class="pull-right">
                            <h2>Total: $ <span class="totalPedido"></span></h2>
                            <small>
                              <h4><span class="horaInicio"></span></h4>
                            </small>
                          </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr> <!-- Separador -->
                    <div class="row">
                      <div style="display:none" id="resultado"><button class="close" data-dismiss="alert"></button></div>
                    </div>
                    <div class="row">
                        <!-- div que listado de productos-->
                        <div class="col-md-7">
                              <div class="col-sm-12 invoice-col">
                                <b>Orden ID #<span class="idAtencion"></span></b>
                                <br>
                                <br>
                                <b>Estado:  </b><span class="estadoAtencion"></span>
                                <br>
                                <b>Fecha de pago:  </b><span class="horaPago"></span>                                
                                <br><br>
                              </div>

                             <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Cant</th>
                                    <th>Producto</th>
                                    <th>Anexo</th>
                                    <th>Sub-total</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody class="pedidoCompleto">
                                </tbody>
                            </table>
                            <a type="button" class="btn btn-info btn-sm" id="urlDetallle" href="#"><i class="fa fa-plus-square"></i>  Mas detalles</a><hr>
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
                                      <td>$<span class="subtotal"></span></td>
                                    </tr>
                                    <tr>
                                      <th>Descuento:</th>
                                      <td>$<span class="descuento"></span></td>
                                    </tr>
                                    <tr>
                                      <th>Total:</th>
                                      <td>$<span class="totalPedido"></span></td>
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
                                  <a id="btnImprimir" class="btn btn-app" href="javascript:imprSelec()" >
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
                                    <input id="descripcion_pagar" type="text" class="form-control" placeholder="Descripción" value="Pago simple">
                                  </div>
                                  <br><br>
                                </div>
                              </form>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" onclick="pagar()" class="btn btn-info">Confirmar</button>
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
                                    <input id="descripcion_cortesia" type="text" class="form-control" placeholder="escriba una descripción" required>
                                  </div>
                                  <br><br>
                                </div>
                              </form>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" onclick="cortesia()" class="btn btn-info">Confirmar</button>
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
                                    <input type="text" id="descripcion_aplazar" class="form-control" placeholder="escriba una descripción" required>
                                  </div>
                                  <br><br>
                                </div>
                              </form>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" onclick="aplazar()" class="btn btn-info">Confirmar</button>
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
                                    <input type="number" id="descuento_atencion" class="form-control" value="0">
                                  </div>
                                  <br><br>
                                </div>                                
                              </form>
                              <div class="modal-footer">
                                  <button type="button"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                  <button type="button" onclick="descuento()" class="btn btn-info">Confirmar</button>
                                </div>
                            
                          </div>
                        </div>
                    </div>
                    <!-- /modal descuento -->

                    <!-- /factura de venta-->
                    <section id="factura" class="content invoice">
                              <!-- info row -->
                              <div class="row invoice-info">
                                    <div class="col-sm-12 invoice-col" align="center">
                                        <h2>Nombre establecimiento</h2>
                                        <address>
                                                        <strong>Regimen comun</strong>
                                                        <br>Nit 7852145-8                                       
                                                        <br> Cra 13 Norte 12-35
                                                        <br>Armenia , Quindio
                                                        <br>(57) 7356985
                                                        <br>contacto@nombre.com                                        
                                         </address>
                                      </div>
                                      <!-- /.col -->
                                      <div class="col-sm-12 invoice-col">
                                          <br>
                                          <b>Factura de venta  #<span class="idAtencion"></span></b>
                                          <br>                                          
                                          <br>
                                          <b>Cajero:</b> <span class="cajero"></span>
                                          <br>
                                          <b>Fecha:</b> <span class="horaPago"></span>
                                          <br>
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
                                                <th>Producto</th>
                                                <th>Anexo</th>
                                                <th>Subtotal</th>
                                                <th>Total</th>
                                              </tr>
                                            </thead>
                                            <tbody class="pedidoCompleto">                                             
                                            </tbody>
                                          </table>
                                    </div>
                                    <!-- /.col -->
                              </div>
                              <!-- /.row -->
                              <div class="row">
                                  <!-- /.col -->
                                <div class="col-sm-12 invoice-col">
                                    <br>
                                    <br>
                                    <b>Subtotal:</b> <span class="subtotal"></span>
                                    <br>
                                    <b>Descuento:</b> <span class="descuento"></span>
                                    <br><br>
                                    <b>TOTAL NETO: <span class="totalPedido"></span></b>
                                    <br><br><hr>
                                </div>
                                <!-- /.col -->
                              </div>

                              <div class="row">
                                    <div class="col-xs-12 table">
                                      <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th style="width: 20%">% Imp.</th>
                                            <th style="width: 40%">Compra</th>
                                            <th style="width: 20%">Base</th>
                                            <th style="width: 20%">Imp.Consumo</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>8.0 %</td>
                                            <td>$ <span class="totalPedido"></span></td>
                                            <td>$ <span class="totalPedido"></span></td>
                                            <td>$ <span class="impuesto"></span></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                              </div>

                              <div class="col-sm-12 invoice-col" align="center">
                                <hr>Res DIAN : 10000056870  2015/10/25  <br>                              
                                Rango 2000 hasta 7000 <br>
                                <strong>Sistema Manitl www.mantil.com</strong>
                              </div>
                  </section>
                  <!-- /factura -->


                  <!-- / informe de cuenta-->
                    <section id="informe" class="content invoice">
                              <!-- info row -->
                              <div class="row invoice-info">
                                    <div class="col-sm-12 invoice-col" align="center">
                                        <h2>Nombre establecimiento</h2>
                                        <address>
                                                        <strong>Su cuenta</strong>
                                                        <br>Este ticket no remplaza la 
                                                        factura de venta. Recuerde exigir 
                                                        su factura al realizar el pago del pedido.                                  
                                                                                            
                                         </address>
                                    </div>
                                      <!-- /.col -->
                                      <div class="col-sm-12 invoice-col">
                                          <br>
                                          <b>Id de pedido: # <span class="idAtencion"></span></b>
                                          <br>
                                          <b>Estado:</b> <span class="estadoAtencion"></span>
                                          <br>
                                          <b>Fecha pedido:</b> <span class="horaInicio"></span>
                                          <br>
                                          <b>Mesa:</b> <span class="mesa"></span>
                                          <br>
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
                                                <th>Producto</th>
                                                <th>Anexo</th>
                                                <th>Subtotal</th>
                                                <th>Total</th>
                                              </tr>
                                            </thead>
                                            <tbody class="pedidoCompleto">                                         
                                            </tbody>
                                          </table>
                                    </div>
                                    <!-- /.col -->
                              </div>
                              <!-- /.row -->
                              <div class="row">
                                  <!-- /.col -->
                                <div class="col-sm-12 invoice-col">
                                    <br>
                                    <br>
                                    <b>Subtotal:</b> $<span class="subtotal"></span>
                                    <br>
                                    <b>Descuento:</b> $<span class="descuento"></span>
                                    <br><br>
                                    <b>TOTAL NETO: $<span class="totalPedido"></span></b>
                                    <br><br>
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
