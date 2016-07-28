<?php
        if (isset($_GET['mesa'])) {
               $idMesa=$_GET['mesa'];
        }else{
            $idMesa="N/A";
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
    
    .categoria{
      float: left;
      margin: 5px;
      width: 150px;
      height: 155px;
      }
  </style>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
  <script>
            $(document).ready(function() {
               datosAtencion();
               pedidoCompleto();
               categorias();
               productos();

            });
  </script>
  <script type="text/javascript">
  var idMesa=<?php echo $idMesa; ?> ;
      function datosAtencion(){ 
              $.ajax({
                   type   : 'POST',
                   url    : 'controller/Atencion.php',
                   data  : {metodo: "datosAtencion",mesa: idMesa },
                   dataType : 'json',
                   success  : function(data){
                      $('#totalPedido').html(data.totalPedido);
                      $('#mesa').html(data.mesa);
                      $('#estadoMesa').html(data.estadoMesa); 
                      $('#urlDetallle').prop("href", data.urlDetalle);
                  },
                   error  : function(data){
                    console.log(data);
                  }
               });
      }
      function categorias(){         
                  $.post("controller/Atencion.php", 
                  {metodo: "listaCategorias"}
                  ,function(tabla){
                    $('#categorias').html(tabla);
                  }
                  );
      }
      function productos(){         
                  $.post("controller/Atencion.php", 
                  {metodo: "listaProductos"}
                  ,function(tabla){
                    $('#productos').html(tabla);
                  }
                  );
      }
      function pedidoCompleto(){         
                  $.post("controller/Atencion.php", 
                  {metodo: "pedidoCompleto",mesa:idMesa}
                  ,function(tabla){
                    $('#pedidoCompleto').html(tabla);
                  }
                  );
      }

      function verProductos(idCategoria) {
                    $(".categoria").hide();
                    $( "div[name="+idCategoria+"]" ).show();
      }

  </script>      

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
                    Pedido
                    <small>
                        Seleccion de pedidos 
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
                            <h2>Nuevo Pedido : <span id="mesa"></span></h2>
                            <small>
                              <h4> <span id="estadoMesa"></span> :<a id="urlDetallle" href="">Ver detalle</a></h4>
                            </small>
                          </div>
                        </div>
                        <div class="title_right">
                          <div class="pull-right">
                            <h2>Total Pedido: $ <span id="totalPedido">0</span></h2>
                            <small>
                              <h4>Esta orden : $ <span id="totalOrden">0</span></h4>
                            </small>
                          </div>
                        </div>
                    </div>
                    <div class="clearfix"></div><br>


                    <!-- start accordion -->
                  <div class="accordion" id="accordion" role="tablist" aria-multiselectable="false">
                      <div class="panel">
                          <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h4 class="panel-title"><strong>Pedido completo</strong></h4>
                          </a>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                  <div class="panel-body">
                                  <table class="table datatable">
                                    <thead>
                                      <tr>
                                        <th>Cant</th>
                                        <th>Producto</th>
                                        <th></th>
                                        <th>Sub-total</th>
                                        <th>Total</th>
                                      </tr>
                                    </thead>
                                    <tbody id="pedidoCompleto">
                                      
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                      </div>
                  </div>   
                    <!-- end accordion -->

                    <hr> <!-- Separador -->

                    <div class="row">
                        <!-- div que agrupa categorias y productos-->
                        <div class="col-md-8 col-xs-12 ">


                              <!-- div que agrupa categorias-->
                              <div id="categorias">
                                 
                              </div><div class="clearfix"></div><br>


                              <!-- div que agrupa productos-->
                              <div id="productos">
                                                      
                              </div>
                        </div>

                        <!-- div que agrupa listado -->
                        <div class="col-md-4 col-xs-12 ">
                        <button type="button" class="btn btn-info btn-sm">Guardar</button>
                        <button type="button" class="btn btn-default btn-sm">Cancelar</button><hr>
                          <table  class="table datatable" id="tablaOrden">
                                    <thead>
                                      <tr>
                                        <th width=15% >Cant</th>
                                        <th width=30% >Producto</th>
                                        <th width=5% ></th>
                                        <th width=20% >Total</th>
                                        <th width=20% >Del</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <th scope="row">1</th>
                                        <td>Producto</td>
                                        <td></td>
                                        <td>2500</td>                                        
                                        <td><a class="fa fa-remove"></a></td>

                                      </tr>
                                      <tr>
                                        <th scope="row">2</th>
                                        <td>Producto</td>
                                        <td >*</td>
                                        <td>2500</td>
                                        <td><a class="fa fa-remove"></a></td>

                                      </tr>
                                      <tr>
                                        <th scope="row">1</th>
                                        <td>Producto</td>
                                        <td >*</td>
                                        <td>2500</td>
                                        <td><a class="fa fa-remove"></a></td>

                                      </tr>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /modals -->
                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Ingresar Anexo</h4>
                            </div>
                              <form>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Anexo</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Anexo">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="number" class="form-control" placeholder="Cantidad">
                                  </div>
                                </div>
                              </form>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-info">Guardar</button>
                            </div>

                          </div>
                        </div>
                    </div>
                    <!-- /modals -->
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
