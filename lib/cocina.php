<?php  
  include 'controller/Sesiones.php';
  cocina();
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
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet" />
  <!-- Checkbox verdes css -->
  <style type="text/css">
    input[type=checkbox].css-checkbox {
              position:absolute; 
              z-index:-1000; 
              left:-1000px;
              overflow: hidden;
              clip: rect(0 0 0 0);
              height:1px; 
              width:1px;
              margin:-1px;
              padding:0; border:0;
            }

            input[type=checkbox].css-checkbox + label.css-label {
              padding-left:26px;
              height:21px; 
              display:inline-block;
              line-height:21px;
              background-repeat:no-repeat;
              background-position: 0 0;
              font-size:13px;
              vertical-align:middle;
              cursor:pointer;

            }

            input[type=checkbox].css-checkbox:checked + label.css-label {
              background-position: 0 -21px;
            }
            label.css-label {
                background-image:url("images/check.png");
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
              }
  </style>

  <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

  <script src="js/jquery.min.js"></script>
    <style type="text/css">
      @media screen {  
       #informe { display: none; }
       #infoDespacho { display: none; }

      }       
    </style>  
    <script type="text/javascript">
      function verificarUltimoDespacho(idAtemProd)
      {  

      llenarDatosDespacho(idAtemProd);
       $.post("controller/Atencion.php", 
                    {metodo: "ultimoDespacho",item:idAtemProd},
                    function(resultado){
                       if (document.getElementById("imprimirChck").checked==true) {
                          //imprimir despacho automaticamente
                          imprimirDespacho();
                       }
                       else{
                        //pregunta si desea imprimir despacho--ModalImprimirDespacho
                        $('#ModalImprimirDespacho').modal('show');
                       }

                       if (resultado=="true") {                           
                            llenarDatos(idAtemProd);
                            //pregunta si desea imprimir Detalle -- ModalImprimirDetalle
                            $('#ModalImprimirDetalle').modal('show');
                        } 
                    }
        ); 
      }
        function llenarDatos(idAtemProd){            
            //Datos atencion
            $.ajax({
                   type   : 'POST',
                   url    : 'controller/Atencion.php',
                   data  : {metodo: "datosAtencionCocina",atencionProd: idAtemProd},
                   dataType : 'json',
                   success  : function(data){
                    var total=data.totalPedido;
                    total=parseInt(total);
                    var total = total.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");                    
                      $('.totalPedido').html(total);
                      $('.mesa').html(data.mesa);
                      $('.meseros').html(data.meseros);
                      $('.horaInicio').html(data.horaInicio);
                      $('.idAtencion').html(data.idAtencion);
                      itemsFactura(data.idAtencion);
                  },
                   error  : function(data){
                    console.log(data);
                  }
               });           
        }
        function llenarDatosDespacho(idAtemProd){            
            //Datos atencion
            $.ajax({
                   type   : 'POST',
                   url    : 'controller/Atencion.php',
                   data  : {metodo: "datosAtencionDespachoCocina",atencionProd: idAtemProd},
                   dataType : 'json',
                   success  : function(data){       
                      $('.Nmesa').html(data.mesa);
                      $('.Nmesero').html(data.mesero);
                      $('.Nproducto').html(data.producto);
                      $('.Nanexo').html(data.anexo);
                      $('.NhoraDespacho').html(data.horaDespacho);
                      $('.Ncocinero').html(data.cocinero);
                      $('.Ntiempo').html(data.tiempo);
                  },
                   error  : function(data){
                    console.log(data);
                  }
               });           
        }
        
        function itemsFactura(idAtencion){        
            $.post("controller/Item.php", 
              {metodo: "detalleItemsCocina",atencion:idAtencion}
              ,function(tabla){
                $('.detalleItems').html(tabla);                
              }
             );      
        }
        
        function imprimirDetalle(){        
            muestra="informe"; 
            $('#ModalImprimirDetalle').modal('hide');       
            var ficha=document.getElementById(muestra);
            var ventimp=window.open(' ','popimpr');
            ventimp.document.write(ficha.innerHTML);
            ventimp.document.close();
            ventimp.print();
            ventimp.close();        
        }    

        function imprimirDespacho(){        
            muestra="infoDespacho"; 
            $('#ModalImprimirDespacho').modal('hide');       
            var ficha=document.getElementById(muestra);
            var ventimp=window.open(' ','popimpr');
            ventimp.document.write(ficha.innerHTML);
            ventimp.document.close();
            ventimp.print();
            ventimp.close();        
        }      
    </script>
    <script>        
                //cuando carga la pagina obtiene los datos de la base de datos y los muestra en la tabla
                $( document ).ready(function() {
                   //actializa los pedidos de la cocina cada 15 segundos
                  setInterval(function(){ 
                  $('#actualizar').trigger('click');                                            
                  }, 15000);

                //  pide a  todos los pedidos que estan en espera en la base de datos.y los recible como (tabla)
                $.post("controller/Atencion.php", 
                    {metodo: "pedidosCocina"},
                    function(tabla){
                      $('#comentarios').html(tabla);             
                    }
                );  

              $("#actualizar").click(function() {
                  $.post("controller/Atencion.php", 
                    {metodo: "pedidosCocina"},
                    function(tabla){
                      $('#comentarios').html(tabla); 
                    }
                   );  
                });
            });  
    </script>
    <script type="text/javascript">
      function cambiarEstado(idAtemProd,accion){
              datos= {id:idAtemProd,accion:accion,metodo:"cambiarEstado"};
              $.ajax({
                      url:   'controller/Item.php',
                      type:  'POST',
                      data: datos,
                      error: function(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR);
                                $('#resultado').html("Error: por favor verifique su conexion!");
                                $('#resultado').attr("class","alert alert-danger");
                                $('#resultado').show("slow").delay(4000).hide("slow");
                      },
                      success:  function (resultado,estado,objeto) {
                            console.log(resultado);
                            if (resultado=="Exito") {
                                $('#resultado').html("Se realizo la peticion con exito!");
                                $('#resultado').attr("class","alert alert-success");
                                $('#resultado').show("slow").delay(4000).hide("slow");
                                $('#actualizar').trigger('click');
                                if (accion=="Despachar") {
                                    verificarUltimoDespacho(idAtemProd);
                                }
                            }
                            else{
                                 $('#resultado').attr("class","alert alert-danger");
                                 $('#resultado').html(resultado);
                                 $('#resultado').show("slow").delay(4000).hide("slow");
                            }
                      },
                      
              });          
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

  <div class="container body">

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="x_content">
          <div class="page-title">
            <div class="title_left">
              <h3>Cocina</h3>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Lista de pedidos en espera </h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="row">
                        <div style="display:none" id="resultado"><button class="close" data-dismiss="alert"></button></div>
                      </div>
                      <div class="x_content">
                        <p class="text-muted font-13 m-b-30">
                          Opciones:
                        </p>
                        <button type="button" id="actualizar" class="btn btn-success btn-xs"> Actualizar </button>                         
                         <label> Imprimir Automaticamente <input type="checkbox" id="imprimirChck" name="categoria" value="2" class="flat" checked></label>                        
                        <hr>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                           <thead>
                            <tr>
                              <th>Producto</th>
                              <th>Anexos</th>
                              <th>Mesa</th>
                              <th>Tiempo</th>
                              <th>Mesero</th>
                              <th>Cocinero</th>
                              <th>Estado</th>
                              <th>Accion</th>
                            </tr>
                          </thead>
                          <tbody id="comentarios"> 
                            
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
                    <!-- / informe de cuenta-->
                    <section id="informe" class="content invoice">
                              <!-- info row -->
                              <div class="row invoice-info">
                                    <div class="col-sm-12 invoice-col" align="center">
                                        <h4>Restaurante Holly Tropical</h4>
                                        <address>       <strong>Cuenta Detallada</strong>                              
                                                        <br> Santiago
                                                        <br> Santiago de los caballeros
                                                        <br>8096124747                                      
                                         </address>
                                        <address>
                                              <br>Este ticket no remplaza la 
                                              factura de venta.                           
                                         </address>
                                    </div>
                                      <!-- /.col -->
                                      <div class="col-sm-12 invoice-col">
                                          <h4>Detalle de la orden</h4>
                                          <b> Fecha Inicio :</b> <span class="horaInicio"></span><br>
                                          <b> Orden Id :</b> <span class="idAtencion"></span><br>
                                          <b> Mesa :</b>  <span class="mesa"></span><br>
                                          <b> Meseros :</b> <span class="meseros"></span><br>                                         
                                          <b> TOTAL:</b> $ <span class="totalPedido"></span><br><br><hr>
                                      </div>
                                      <!-- /.col -->
                              </div>
                              <!-- /.row -->
                              <!-- Table row -->
                              <div class="row">
                                 <h4>Items:</h4>
                                    <div class="detalleItems">
                                        
                                    </div>                                   
                              </div>
                              <!-- /.row -->
                              <div class="row">
                                  <!-- /.col -->
                                <div class="col-sm-12 invoice-col"><hr>                                    
                                    <p align="center"><i>Trabajamos para mejorar nuestros servicios</i>
                                    <br><i>Gracias por preferirnos.</i></p>
                                </div>
                                <!-- /.col -->
                              </div>

                              <div class="col-sm-12 invoice-col" align="center">
                                <hr>
                                <strong>Holly Tropical</strong>
                              </div>
                  </section>
                  <!-- /informe -->

                  <!-- / informe de despacho-->
                    <section id="infoDespacho" class="content invoice">
                              <!-- info row -->
                              <div class="row invoice-info">
                                    <div class="col-sm-12 invoice-col" align="center">
                                        <h4>Restaurante Holly Tropical</h4>
                                        <address><strong>Detalle</strong></address> <br>                                    
                                    </div>
                                    <!-- /.col -->
                                      <div class="col-sm-12 invoice-col">
                                          <b> Fecha:</b><i> <span class="NhoraDespacho"></span></i><br>
                                          <b> Mesa:</b> <i><span class="Nmesa"></span></i><br>
                                          <b> Producto:</b> <i><span class="Nproducto"></span></i><br>
                                          <b> Anexo:</b> <i> <span class="Nanexo"></span></i><br>
                                          <b> Mesero:</b> <i><span class="Nmesero"></span></i><br>
                                          <b> Cocinero:</b><i> <span class="Ncocinero"></span></i><br>
                                          <b> Tiempo:</b><i> <span class="Ntiempo"></span></i><br>  
                                      </div>
                                      <!-- /.col -->
                                      <div class="col-sm-12 invoice-col" align="center">
                                        <hr>
                                        <strong>Gracias por preferirnos</strong>
                                      </div>
                              </div>                              
                  </section>
                  <!-- /informe de despacho -->


                  <!-- /modal confirmar imprimir detalle -->
                  <div class="modal fade bs-example-modal-sm" id="ModalImprimirDetalle" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content" align="center">
                        <div class="modal-body">
                          <h5>Se han despachado todos los productos en esta mesa, <b>¿Desea imprimir el detalle completo del pedido</b>?</h5>
                        </div>
                        <input type="text" id ="id_usuario_remove" value="" style="display:none">
                          <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button id="confirmar" type="button" class="btn btn-success" onclick="imprimirDetalle()">Confirmar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /modal-->

                    <!-- /modal confirmar imprimir despacho -->
                  <div class="modal fade bs-example-modal-sm" id="ModalImprimirDespacho" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content" align="center">
                        <div class="modal-body">
                          <h4>¿Desea imprimir la orden de despacho para este producto?</h4>
                        </div>
                        <input type="text" id ="id_usuario_remove" value="" style="display:none">
                          <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button id="confirmar" type="button" class="btn btn-success" onclick="imprimirDespacho()">Confirmar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /modal-->
        
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
        
</body>

</html>
