<?php  
  include 'controller/Sesiones.php';
  admin();
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
  <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="css/icheck/flat/green.css" rel="stylesheet" />
  <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />

  <script src="js/jquery.min.js"></script>
  <script src="js/nprogress.js"></script>

  <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>   
  <script>
            $(document).ready(function() {
                // process the form
                $('#create').submit(function() {
                    if (!$("#crear_categoria").hasClass( "disabled" )) {
                    console.log("entro");
                    // get the form data
                    // there are many ways to get this data using jQuery 
                    // (you can use the class or id also)
                    var data = {
                        'nombre_categoria'     : $('input[name=crear-nombre]').val(),
                        'metodo'          : "create"
                    };
                    // process the form
                    $.ajax({
                            data:  data,
                            url:   'controller/Categoria.php',
                            type:  'post',

                            beforeSend: function () {
                                    $("#resultado").html("Procesando, espere por favor...");
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                    $('#resultado').attr("class","alert alert-danger");
                                    $('#resultado').html('<o>201:Ocurrio un error </p>');
                                    $('#resultado').show("slow").delay(4000).hide("slow");
                            },
                            success:  function (response,estado,objeto) {
                                   if (response=="exito") {
                                    $('input[name=crear-nombre]').val("")
                                    $('#resultado').html("el usuario se agrego con exito!");
                                    $('#resultado').attr("class","alert alert-info");
                                    $('#resultado').show("slow").delay(4000).hide("slow");
                                    mostrarLista();
                                   }
                                   else{
                                     $('#resultado').attr("class","alert alert-danger");
                                     $('#resultado').html("202:Ocurrio un error: ");
                                     $('#resultado').html(response);
                                     $('#resultado').show("slow").delay(4000).hide("slow");
                                   } 
                            },

                    });
                  }
                  event.preventDefault(); 
                });

            });

  </script> 
  <script>
            $(document).ready(function() {
              mostrarLista();
            });
  </script>
  <script type="text/javascript">
      function mostrarLista(){         
                  $.post("controller/Categoria.php", 
                  {metodo: "listaCategorias"}
                  ,function(tabla){
                    $('#tabla').html(tabla);
                  }
                  );
      }
     function modalEliminarCategoria(id){
                  var textoId=document.getElementById("id_categoria_remove");    
                  textoId.setAttribute("value", id);
                  $('#ModalConfirmar').modal('show');
       }

       function modalEditarCategoria(id,nombre){

                  

                  var textoId=$('#id_categoria_edit').val(id);  
                  var textoNombre=$('#descripcion_categoria_edit').val(nombre); 
                  $('#ModalEdiarCategoria').modal('show');
       }

       function confirmarEliminar(){
            categoriaId=$('#id_categoria_remove').attr("value");
            console.log(categoriaId);
            $.post("controller/Categoria.php", 
                    {metodo: "delete",
                     id_categoria:  categoriaId},function(respuesta){
                      $('#ModalConfirmar').modal('hide');
                      if (respuesta=="exito") {
                        mostrarLista()
                        $('#resultado').html("la categoria fue eliminada!");
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
        if (!$("#editar_categoria").hasClass( "disabled" )) {
            categoriaId=$('#id_categoria_edit').val();
            categoriaDescripcion=$('#descripcion_categoria_edit').val();
            console.log(categoriaDescripcion);
            $.post("controller/Categoria.php", 
                    {metodo: "update",
                     id_categoria:  categoriaId,
                     descripcion:  categoriaDescripcion},function(respuesta){
                      $('#ModalEdiarCategoria').modal('hide');
                      if (respuesta=="Exito") {
                        mostrarLista();
                        $('#resultado').html("la categoria fue editada!");
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


<body class="nav-md">

  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="menu_principal.php" class="site_title"><i class="fa fa-glass"></i> <span>Holly System</span></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="images/userMale.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido,</span>
              <h2>Usuario</h2>
            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>Administrador</h3><br>
              <ul class="nav side-menu">
              <li ><a href="admin_inicio.php"><i class="fa fa-home"></i> Inicio </a></li>
               <li><a><i class="fa fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="admin_user_emp.php">Empleados</a></li>                    
                    <li><a href="admin_user_admin.php">Administradores</a></li>                    
                  </ul>
                </li>
                <li><a><i class="fa fa-th-large"></i> Mesas <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="admin_mesas.php">Administrar</a></li>               
                  </ul>
                </li>
                <li class="active"><a><i class="fa fa-folder-o"></i> Categorias <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                  <li class="current-page"><a href="admin_categorias.php">Administrar</a></li>             
                  </ul>
                </li>
                <li><a><i class="fa fa-beer"></i> Productos <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="admin_productos.php">Administrar</a></li>            
                  </ul>
                </li>               
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Soporte">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Pantalla Completa">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Salir">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Inicio">
              <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

          <!-- top Menu navigation-->
          <?php include 'admin_menu.php'; ?>
          <!-- /top Menu navigation -->


      <!-- page content -->
      <div class="right_col" role="main">

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

              <div class="row x_title">
                <div class="col-md-6">
                  <h3>Categorias</h3>
                </div>
                <div class="col-md-6">

                </div>
              </div>

              <div class="row">
                <div style="display:none" id="resultado"><button class="close" data-dismiss="alert"></button></div>
              </div>

           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Formulario de ingreso nuevas categorias</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form id="create" data-toggle="validator" id="form_create" class="form-horizontal form-label-left" novalidate>
                      <p>Formulario de ingreso de categorias</p>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"">Nombre <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control col-md-7 col-xs-12" data-validate-length-range="20"  name="crear-nombre" placeholder="ingrese nombre de la categoria" required type="text">
                        </div>
                      </div>                     
                      <div class="ln_solid"></div>  
                      <button id="crear_categoria" type="submit" class="btn btn-success disabled" >Guardar</button>                  
                    </form>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Lista de categorias</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">                        
                        <table id="datatable-buttons" class="table table-striped">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Nombre</th>
                              <th>Accion</th>
                            </tr>
                          </thead>                         
                          <tbody id="tabla">                           
                           
                          </tbody>
                        </table>                       
                      </div>
                    </div>
                  </div>

              <div class="clearfix"></div>
            </div>
          </div>

          <!-- /modal editar categoria -->
          <div class="modal fade bs-example-modal-lg" id="ModalEdiarCategoria" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" align="center">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">Editar Categoria</h4>
                  </div>
                <div class="modal-body">
                  <form data-toggle="validator" id="form_create" class="form-horizontal form-label-left" novalidate>
                    <p>Formulario para editar Categoria</p>
                    <input type="text" id ="id_categoria_edit" value="" style="display:none">
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"">Nombre <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="descripcion_categoria_edit" class="form-control col-md-7 col-xs-12" data-validate-length-range="20"  name="name" placeholder="ingrese nombre de la categoria" required="required" type="text" value="Nombre de la categoria">
                      </div>
                    </div>                 
                    <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          <button id="editar_categoria" type="submit" class="btn btn-success disabled" onclick="confirmarEditar()">Confirmar</button>
                    </div>
                  </form>  
                </div>
                </div>
              </div>
            </div>
            <!-- /modal editar categoria  -->

            <!-- /modal confirmar eliminar categoria -->
          <div class="modal fade bs-example-modal-sm" id="ModalConfirmar" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content" align="center">
                <div class="modal-body">
                  <h4>¿Esta seguro de eliminar esta categoria?</h4>
                </div>
                <input type="text" id ="id_categoria_remove" value="" style="display:none">
                  <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="confirmar" type="button" class="btn btn-success" onclick="confirmarEliminar()">Confirmar</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /modal confirmar eliminar categoria-->

        </div>
        <br />       
       <!-- footer content -->
        <?php include 'footer.php'; ?>
        <!-- /footer content -->
      </div>
      <!-- /page content -->

    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="js/bootstrap.min.js"></script>

  <!-- gauge js -->
  <script type="text/javascript" src="js/gauge/gauge.min.js"></script>
  <script type="text/javascript" src="js/gauge/gauge_demo.js"></script>
  <!-- chart js -->
  <script src="js/chartjs/chart.min.js"></script>
  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="js/moment/moment.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>

  <script src="js/custom.js"></script>

  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
  <script type="text/javascript" src="js/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="js/flot/date.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.spline.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="js/flot/curvedLines.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.resize.js"></script>
  
  <!-- worldmap -->
  <script type="text/javascript" src="js/maps/jquery-jvectormap-2.0.3.min.js"></script>
  <script type="text/javascript" src="js/maps/gdp-data.js"></script>
  <script type="text/javascript" src="js/maps/jquery-jvectormap-world-mill-en.js"></script>
  <script type="text/javascript" src="js/maps/jquery-jvectormap-us-aea-en.js"></script>

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
