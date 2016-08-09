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
   
  <!-- /datepicker -->
    <script type="text/javascript">
      $(document).ready(function() {
          var f = new Date();
          var actual =((f.getMonth() +1) + "/" +  f.getDate()+ "/" + f.getFullYear());
          $('#fecha_inicio').val("06/01/2016");
          $('#fecha_fin').val(actual);
          $('#reservation').daterangepicker({ 
            "startDate": "06/01/2016",
            "endDate": actual
          }, function(start, end, label) {
            $('#fecha_inicio').val(start.format('MM/DD/YYYY'));
            $('#fecha_fin').val(end.format('MM/DD/YYYY'));
          });
      });
    </script>

    <script>
            $(document).ready(function() {      
              mostrarLista();  
              productos();                       
            });
    </script>

    <script>
            $(document).ready(function() {      
                 $('#accion').on('change', function () {
                       if ($("#accion option:selected").val()==2) {
                          $(".proveedor").css("display", "none");
                          $(".valor").css("display", "none");
                       }
                       else{
                          $(".proveedor").css("display", "block");
                          $(".valor").css("display", "block");
                       }
                  });                    
            });
    </script>

   <script type="text/javascript">

      function crear(){
        if ((!$("#crear_inventario").hasClass( "disabled" ))&&(!$('#productoCrear option:selected').val()==""))  {
            producto=$('#productoCrear option:selected').val();
            cantidad=$('#cantidad').val();
            proveedor=$('#proveedor').val();
            valor=$('#valor').val();
            descripcion=$('#descripcion').val();
            accion=$('#accion option:selected').val();

            $.post("controller/Inventario.php", 
                    {metodo: "create",
                     producto:  producto,
                     cantidad:  cantidad,
                     proveedor: proveedor,
                     valor:  valor,
                     descripcion:  descripcion,
                     accion:  accion
                   },function(respuesta){
                      $('#Modalinventario').modal('hide');
                      if (respuesta=="Exito") {                        
                        $('#resultado').html("se agrego al inventario!");
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
                  event.preventDefault();
       }

      function mostrarLista(){   
           
            fechaInicio=$('#fecha_inicio').val();
            fechaFin=$('#fecha_fin').val(); 
            producto=$("#productoBuscar option:selected").val(); 
            if (!(producto === undefined || producto === null || producto == "")) {
               datosInventario();
                $.post("controller/Inventario.php", 
                  {metodo: "listaInventario",
                  id:producto,
                  fecha1:fechaInicio,
                  fecha2:fechaFin}
                  ,function(tabla){
                    $('#tabla').html(tabla);
                    $('#datatable').dataTable(); 
                  }
                );
            }                     
      }
      function datosInventario(){         
       var producto=$("#productoBuscar option:selected").val();
        if (!(producto === undefined || producto === null || producto == "")) {         
            $.ajax({
                   type   : 'POST',
                   url    : 'controller/Inventario.php',
                   data  : {metodo: "datosInventario"
                          ,producto: producto},
                   dataType : 'json',
                   success  : function(data){
                      $('#productoNombre').html(data.productoNombre);
                      $('#disponibles').html(data.disponibles);
                      $('#cantidad_ingresados').html(data.cantidad_ingresados);
                      $('#cantidad_vendidos').html(data.cantidad_vendidos);
                      $('#cantidad_eliminados').html(data.cantidad_eliminados);
                      $('#valorPromedio').html(data.valorPromedio);
                      $('#costoPromedio').html(data.costoPromedio); 
                  },
                   error  : function(data){
                    console.log(data);
                  }
               });
        }              
      }

      function productos(){
          $.post("controller/Inventario.php", 
                  {metodo: "productos"}
                  ,function(tabla){
                    $('.productos').html(tabla);
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



      <!-- page content -->
      <div class="right_col" role="main">

        <div class="x_content">
          <div class="page-title">
            <div class="title_left">
              <h3>Inventario</h3>
            </div>            
            <div class="title_right">
              <div class="pull-right">
                <button type="button" class="btn btn-info btn-sm " data-toggle="modal" data-target="#Modalinventario">Nueva entrada </button>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
                <div style="display:none" id="resultado"><button class="close" data-dismiss="alert"></button></div>
          </div>
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
                                <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control" value="Seleccione fecha" />
                                <input type="text" id ="fecha_inicio" value="" style="display:none">
                                <input type="text" id ="fecha_fin" value="" style="display:none">
                              </div>
                            </div>
                          </div>

                            <div class="form-group col-md-4">
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <select class="select2_single form-control productos" id="productoBuscar" tabindex="-1">
                                  </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                              <button type="button" onclick="mostrarLista()" class="btn btn-default btn-sm">Consultar</button>
                            </div>
                        </div>
                      </fieldset>
                    </form>
                  </div>

             <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><sp id="productoNombre">Producto</sp><small>Inventario</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                        <div class="col-sm-12 invoice-col">
                                <b>Unidades disponibles:</b> <span id="disponibles">0</span>
                                <br>
                                <br>
                                <b>Total ingresados: </b> <span id="cantidad_ingresados">0</span>
                                <br>
                                <b>Total vendidos: </b> <span id="cantidad_vendidos">0</span>
                                <br>
                                <b>Total eliminados: </b> <span id="cantidad_eliminados">0</span>
                                <br><br>
                                <b>Valor de venta promedio: $</b> <span id="valorPromedio">0</span>
                                <br>
                                <b>Costo promedio: $ </b><span id="costoPromedio">0</span>
                                <br><br>
                              </div>
                        <table id="datatable" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Fecha</th>
                              <th>Usuario</th>
                              <th>Cantidad</th>
                              <th>Accion</th>
                              <th>Descripcion</th>
                              <th>V.Unidad</th>
                              <th>Total</th>
                              <th>Proveedor</th>
                            </tr>
                          </thead>
                          <tbody id="tabla">
                                                 
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
                               <form id="create" data-toggle="validator" class="form-horizontal form-label-left" novalidate>                                    
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Accion</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control" id="accion" required="required">
                                            <option value="1">Ingresar</option>
                                            <option value="2">Eliminar</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Producto</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control productos" id="productoCrear" required="required">                                          
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" id="cantidad" class="form-control" required="required" placeholder="ej : 10">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12 valor">Costo</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12 valor">
                                        <input type="text" class="form-control " id="valor" placeholder="ej : 12000" >
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12 proveedor">Proveedor</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12  proveedor">
                                        <input type="text" class="form-control" id="proveedor" placeholder="Nombre del proveedor" >
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Descricpion<span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <textarea class="form-control" rows="3" id="descripcion" placeholder='Descripción' required="required"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                      <button type="submit" id="crear_inventario"  class="btn btn-success disabled" onclick="crear()">Confirmar</button>
                                    </div>
                                </form>
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
