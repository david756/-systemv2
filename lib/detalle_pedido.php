<?php
        include 'controller/Sesiones.php';
        user();
        if (isset($_GET['atencion'])) {
               $idAtencion=$_GET['atencion'];
        }else{
            header('Location: menu_principal.php');
        }

 ?>
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
    <script src="js/jquery.min.js"></script>
  <style type="text/css">
      @media screen { 
       #informe { display: none; }
      }       
    </style>
    <script type="text/javascript">
      function imprSelec(muestra)
      {
        $(".eliminar").hide();
        var ficha=document.getElementById(muestra);
        var ventimp=window.open(' ','popimpr');
        ventimp.document.write(ficha.innerHTML);
        ventimp.document.close();
        ventimp.print();
        ventimp.close();
        $(".eliminar").show();
      }
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
               datosAtencion();
               detalleItems();
               listaMesas();
        });
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
                    estadoAtencion=estadoAtencion;
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
                      $('.tiempoTotal').html(data.tiempoTotal);

                  },
                   error  : function(data){
                    console.log(data);
                  }
               });
      }

      function listaMesas(){
        $.post("controller/Mesa.php", 
                  {metodo: "mesasSelect"}
                  ,function(tabla){
                    $('#mesas').html(tabla);
                    
                  }
        );
      }
      function detalleItems(){
        $.post("controller/Item.php", 
                  {metodo: "detalleItems",atencion:idAtencion}
                  ,function(tabla){
                    $('.detalleItems').html(tabla);
                  }
        );
      }
      function modalEliminarItem(id){
                  var textoId=document.getElementById("id_item_remove");    
                  textoId.setAttribute("value", id);
                  $('#ModalConfirmar').modal('show');
       }
      function confirmarEliminar(){
            itemId=$('#id_item_remove').attr("value");
            $.post("controller/Item.php", 
                    {metodo: "delete",
                     id_item:  itemId},function(respuesta){
                      $('#ModalConfirmar').modal('hide');
                      if (respuesta=="Exito") {
                        datosAtencion();
                        detalleItems();
                        $('#resultado').html("item eliminado!");
                        $('#resultado').attr("class","alert alert-success");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                      }
                      else{
                        $('#resultado').html(respuesta);
                        $('#resultado').attr("class","alert alert-danger");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                      }
                      
                    }
              );  
       }
       function confirmarEditar(){
        if (!$("#editar_atencion").hasClass("disabled")) {
            atencion=idAtencion;
            mesa=$('#mesas').val();
            descuento=$('#descuento').val();
            estado=$('#estado').val();
            if (mesa!="") {
            $.post("controller/Atencion.php", 
                    {metodo: "update",
                     id_atencion:  atencion,
                     mesa:  mesa,
                     estado:  estado,
                     descuento:  descuento
                   },function(respuesta){
                      $('#ModalOrden').modal('hide');
                      if (respuesta=="Exito") {
                        datosAtencion();
                        $('#mesas').val("");
                        listaMesas();
                        $('#descuento').val(0);
                        $('#estado').val("");
                        $('#resultado').html("la atencion fue editada!");
                        $('#resultado').attr("class","alert alert-success");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                      }
                      else{
                        $('#resultado').html(respuesta);
                        $('#resultado').attr("class","alert alert-danger");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                      }
                      
                    }
              );  }
            }
                  event.preventDefault();
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
                    Detalle de atencion
                    <small>
                        Orden Id : <span class="idAtencion"></span>
                    </small>                    
                </h3>

            </div>

            <div class="title_right">
              <div class="pull-right">
                <h2>Estado Atencion : Pago </h2>
                <small>
                   <h5><span class="horaInicio"></span></h5>
                </small>
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
                      <div style="display:none" id="resultado"><button class="close" data-dismiss="alert"></button></div>
                  </div>
                    <div class="row">                      
                      <div class="col-md-6">                       
                        <h4>Detalle de la orden</h4>
                              <b> Mesa :</b>  <span class="mesa"></span><br>
                              <b> Cajero :</b> <span class="cajero"></span><br>
                              <b> sub total :</b> $ <span class="subtotal"></span> <br>
                              <b>Descuento Total :</b> $ <span class="descuento"></span><br>
                              <b>total:</b> $ <span class="totalPedido"></span><br>
                              <b>Hora pago:</b> <span class="horaPago"></span><br>                   
                              <b> Estado :</b>  <span class="estadoAtencion"></span> <br>
                              <b> Tiempo Total :</b>  <span class="tiempoTotal"></span> <br><br>
                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ModalOrden">Editar Orden</button>
                        <a type="button" class="btn btn-default btn-sm" href="javascript:imprSelec('informe')">Imprimir a detalle</a>
                        <hr>
                      </div>


                      <div class="col-md-6">   
                        <h4>Pedidos Atencion</h4> 
                        <div class="detalleItems"></div>
                        
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
                            <div class="modal-body">
                            <form data-toggle="validator" id="form_create" class="form-horizontal form-label-left" novalidate>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cambiar estado</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select id="estado" class="form-control" required>
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">Pedido</option>
                                            <option value="4">Aplazado</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Descuento</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" id="descuento" class="form-control" placeholder="Agregar descuento" value="0" required>
                                      </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cambiar mesa</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control" id="mesas" required>                                            
                                          </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                      <button id="editar_atencion" type="submit" class="btn btn-success disabled" onclick="confirmarEditar()">Confirmar</button>
                                    </div>
                            </form>                            
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modal editar orden  -->

                    <!-- /modal confirmar eliminar item -->
                        <div class="modal fade bs-example-modal-sm" id="ModalConfirmar" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content" align="center">
                              <div class="modal-body">
                                <h4>¿Esta seguro de eliminar este item?</h4>
                              </div>
                              <input type="text" id ="id_item_remove" value="" style="display:none">
                                <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                      <button id="confirmar" type="button" class="btn btn-success" onclick="confirmarEliminar()">Confirmar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                     <!-- /modal confirmar eliminar item-->

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
                                          <b> Orden Id :</b># <span class="idAtencion"></span><br>
                                          <b> Mesa :</b>  <span class="mesa"></span><br>
                                          <b> Cajero :</b> <span class="cajero"></span><br>                                          
                                          <b> Hora pago:</b> <span class="horaPago"></span><br>                   
                                          <b> Estado :</b>  <span class="estadoAtencion"></span> <br>
                                          <b> Subtotal :</b> $ <span class="subtotal"></span> <br>
                                          <b> Descuento Total :</b>  $ <span class="descuento"></span><br>
                                          <b> TOTAL:</b> $ <span class="totalPedido"></span><br><br><hr>
                                      </div>
                                      <!-- /.col -->
                              </div>
                              <!-- /.row -->
                              <!-- Table row -->
                              <div class="row">
                                 <h4>Detalle de la orden</h4>
                                    <div class="detalleItems">
                                        
                                    </div>                                   
                              </div>
                              <!-- /.row -->
                              <div class="row">
                                  <!-- /.col -->
                                <div class="col-sm-12 invoice-col"><hr>
                                    <b>Tiempo Total :</b>  <span class="tiempoTotal"></span> <br>
                                    <small>Basado en la hora de inicio y la hora de pago</small>
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

  <script src="js/validator.min.js"></script>

 <!-- pace -->
  <script src="js/pace/pace.min.js"></script>

          <script>
            var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
              showLeftPush = document.getElementById( 'showLeftPush' ),
              body = document.body;
              
            showLeftPush.onclick = function() {
              classie.toggle( this, 'active' );
              classie.toggle( body, 'cbp-spmenu-push-toright' );
              classie.toggle( menuLeft, 'cbp-spmenu-open' );
              disableOther( 'showLeftPush' );
            };
            
            function disableOther( button ) {
              if( button !== 'showLeftPush' ) {
                classie.toggle( showLeftPush, 'disabled' );
              }
          }
          </script>
  </body>

</html>
