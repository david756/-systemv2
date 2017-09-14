<?php  
  include 'controller/Sesiones.php';
  caja();

       if (isset($_GET['id'])) {
               $idCierre=$_GET['id'];
        }else{
            header('Location: menu_principal.php');
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
  <link href="css/icheck/flat/green.css" rel="stylesheet">

  <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
   <style type="text/css">
      @media screen { 
       #informe { display:none; }       
      }       
    </style>
  <script src="js/jquery.min.js"></script>

 
  <script type="text/javascript">
      $(document).ready(function() {
               datosCierre();
               listaAtenciones();
               listaAtencionesImprimir();
               
        });
    </script>
    <script type="text/javascript">

    
      function imprSelec(muestra)
      {       
        
        var ficha=document.getElementById(muestra);
        var ventimp=window.open(' ','popimpr');
        ventimp.document.write(ficha.innerHTML);
        ventimp.document.close();
        ventimp.print();
        ventimp.close();
        location.href ="caja.php";
      }

    </script>
    <script type="text/javascript">

      var idCierre=<?php echo $idCierre; ?> ; 
     
      function datosCierre(){ 
              $.ajax({
                   type   : 'POST',
                   url    : 'controller/Atencion.php',
                   data  : {metodo: "datosCierre",id_cierre:idCierre },
                   dataType : 'json',
                   success  : function(data){
                    
                    if (data.total==null) {
                      data.total=0;
                    }
                    if (data.subtotal==null) {
                      data.subtotal=0
                    }
                    if (data.descuentos==null) {
                      data.descuentos=0
                    }
                   var total=data.total;
                   total=parseInt(total);
                   total = total.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                   var subtotal=parseInt(data.subtotal);
                   subtotal = subtotal.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                   var descuentos=parseInt(data.descuentos);
                   descuentos = descuentos.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                   

                      $('.total').html(total);
                      $('.subtotal').html(subtotal);
                      $('.descuentos').html(descuentos);
                      $('.inicio').html(data.horaInicio);
                      $('.fin').html(data.horaFin);
                      $('.usuario').html(data.usuario);
                      $('.idCierre').html(idCierre);

                     
                  },
                   error  : function(data){
                    console.log(data);
                  }
               });
      }

      function listaAtenciones(){
         $.post("controller/Atencion.php", 
                    {metodo: "pedidosAlCierre",idCierre: idCierre},
                    function(tabla){
                      $('.detalleOrdenes').html(tabla);             
                    }
              );  
      }

       function listaAtencionesImprimir(){
         $.post("controller/Atencion.php", 
                    {metodo: "pedidosAlCierreImprimir",idCierre: idCierre},
                    function(tabla){
                      $('.detalleOrdenesImprimir').html(tabla);             
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
                      <div class="x_title">
                        <h2>Detalle del cierre:</h2>
                        <div class="clearfix"></div>
                      </div>
                      <!-- /.col -->
                        <div class="col-sm-6 invoice-col">
                            <b> Id :</b>  <span class="idCierre"></span><br>
                            <b> Usuario :</b>  <span class="usuario"></span><br>
                            <b> Fecha Inicio :</b> <span class="inicio"></span><br>                                          
                            <b> Fecha Fin:</b> <span class="fin"></span><br><br>        
                            <b> Subtotal :</b> $ <span class="subtotal"></span> <br>
                            <b> Descuentos :</b>  $ <span class="descuentos"></span><br><br>
                            <b> TOTAL:</b> $ <span class="total"></span> <br>   <br>

                            <a class="btn btn-default btn-xs" href='javascript:imprSelec("informe_resumen")' >                                   
                                    <i class="fa fa-print"></i> Imprimir Resumen
                            </a> <br><hr>                           
                        </div>
                        <!-- /.col -->
                        <!-- /.col -->
                        <div class="col-sm-6 invoice-col">
                            <a class="btn btn-app" href='javascript:imprSelec("informe")' >                                   
                                    <i class="fa fa-print"></i> Imprimir todo
                            </a>                           
                        </div>                        
                        <!-- /.col -->

                      <div class="x_content">                       
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Fecha cierre</th>
                              <th>Mesa</th>
                              <th>Subtotal</th>
                              <th>Descuento</th>
                              <th>Total</th>
                              <th>Estado</th>                            
                              <th>Hora Pago</th>
                              <th>Accion</th>
                            </tr>
                          </thead>
                          <tbody class="detalleOrdenes" ></tbody>
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

         <!-- / informe de cuenta-->
                    <section id="informe" class="content invoice">
                              <!-- info row -->
                              <div id="informe_resumen" class="row invoice-info">
                                    <div class="col-sm-12 invoice-col" align="center">
                                        <h4>Restaurante Holly Tropical</h4>
                                        <address>       <strong>Cierre de Caja</strong>                                     
                                         </address>
                                    </div>
                                      <!-- /.col -->
                                      <div class="col-sm-12 invoice-col">
                                          <h4>Detalle del cierre:</h4>
                                          <b> Id :</b> <span class="idCierre"></span><br>
                                          <b> Usuario :</b>  <span class="usuario"></span><br>
                                          <b> Fecha Inicio :</b> <span class="inicio"></span><br>                                          
                                          <b> Fecha Fin:</b> <span class="fin"></span><br><br>        
                                          <b> Subtotal :</b> $ <span class="subtotal"></span> <br>
                                          <b> Descuentos :</b>  $ <span class="descuentos"></span><br><br>
                                          <b> TOTAL:</b> $ <span class="total"></span><br><br><hr>
                                      </div>
                                      <!-- /.col -->
                              </div>
                              <!-- /.row -->
                              <!-- Table row -->                              
                                <table id="table_cierre"  width="100%">
                                  <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Mesa</th>
                                        <th>Sub</th>
                                        <th>Desc</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </tr>
                                  </thead>
                                  <tbody class="detalleOrdenesImprimir" ></tbody>
                                </table>
                                <!-- /.row -->                              
                                <div class="col-sm-12 invoice-col" align="center">
                                  <hr>
                                  <strong>Holly Tropical</strong>
                                </div>
                  </section>
                  <!-- /informe -->

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
