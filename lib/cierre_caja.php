<?php  
  include 'controller/Sesiones.php';
  caja();
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

  <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

  <script src="js/jquery.min.js"></script>
  <script>   
           //cuando carga la pagina obtiene los datos de la base de datos y los muestra en la tabla
            $( document ).ready(function() {                       
                //  
                $.post("controller/Atencion.php", 
                    {metodo: "pedidosAlCierre"},
                    function(tabla){
                      $('#comentarios').html(tabla);             
                    }
              );  
            });    

            $( document ).ready(function() {                       
                //  pide a  todos los pedidos que estan en espera en la base de datos.y los recible como (tabla)
                $.post("controller/Atencion.php", 
                    {metodo: "atencionesAbiertas"},
                    function(tabla){
                      $('#peiddos_pendientes').html(tabla);             
                    }
              );  
            });   


            function confirmar(){

            $.post("controller/Atencion.php", 
                    {metodo: "cierreCaja"},function(respuesta){
                      $('#ModalConfirmar').modal('hide');
                      if (respuesta!="Error") {
                        $('#resultado').html("Se realizo cierre de caja!");
                        $('#resultado').attr("class","alert alert-success");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                        setTimeout(function(){window.location.href = 'cierres.php?id='+respuesta}, 600);
                      }
                      else{
                        $('#resultado').html("Ocurrio un error al hacer cierre, por favor verifique.");
                        $('#resultado').attr("class","alert alert-danger");
                        $('#resultado').show("slow").delay(4000).hide("slow");
                      }                      
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
              <h3>Cierre de Caja</h3>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                    <a type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#ModalConfirmar"> </i> Confirmar Cierre</a>
                    <hr>    
                      <div class="x_title">
                        <h2>Pedidos que aún no han sido facturados </h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="row">
                      <div style="display:none" id="resultado"><button class="close" data-dismiss="alert"></button></div>
                      </div>
                      <div class="x_content">                                        
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Fecha</th>
                              <th>Mesa</th>
                              <th>Subtotal</th>
                              <th>Descuento</th>
                              <th>Total</th>
                              <th>Estado</th>
                            </tr>
                          </thead>
                          <tbody id="peiddos_pendientes" ></tbody>                         
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>


                   <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Pedidos para este cierre</h2>
                        <div class="clearfix"></div>
                      </div>

                      <div class="x_content">                       
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Fecha</th>
                              <th>Mesa</th>
                              <th>Subtotal</th>
                              <th>Descuento</th>
                              <th>Total</th>
                              <th>Estado</th>                            
                              <th>Hora Pago</th>
                              <th>Accion</th>
                            </tr>
                          </thead>
                          <tbody id="comentarios" ></tbody>                         
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>



                  <!-- /modal confirmar -->
                    <div class="modal fade bs-example-modal-sm" id="ModalConfirmar" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content" align="center">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Confirmar Cierre de caja</h4>
                            </div>
                              <form>
                                <h2> ¿Seguro desea hacer cierre de caja? </h2><br>
                                <h4> Atencion: Esta accion no tiene reversa, desea continuar? </h4><br>
                              </form>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" onclick="confirmar()" class="btn btn-info">Confirmar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modal confirmar -->


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
        
</body>

</html>
