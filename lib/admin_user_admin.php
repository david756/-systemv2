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
  <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="css/icheck/flat/green.css" rel="stylesheet" />
  <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />
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

  <script src="js/jquery.min.js"></script>
  <script src="js/nprogress.js"></script>

  <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

  <script>
            $(document).ready(function() {
                // process the form
                $('#create').submit(function() {
                    if (!$("#crear_usuario").hasClass( "disabled" )) {
                        var privilegios = [1,0,0,0,0];
                        var privilegios = JSON.stringify(privilegios);                        
                              // get the form data
                              // there are many ways to get this data using jQuery 
                              // (you can use the class or id also)
                              var data = {
                                  'nombre_usuario'     : $('input[name=crear-nombre]').val(),
                                  'apellido_usuario'     : $('input[name=crear-apellido]').val(),
                                  'usuario_usuario'     : $('input[name=crear-usuario]').val(),
                                  'clave_usuario'     : $('input[name=crear-clave]').val(),
                                  'telefono_usuario'     : $('input[name=crear-telefono]').val(),
                                  'genero_usuario'     : $('input[name=crear-genero]:checked').val(),
                                  'privilegios_usuario' : privilegios,
                                  'metodo'          : "create"
                              };
                                // process the form
                                  $.ajax({
                                          data:  data,
                                          url:   'controller/Usuario.php',
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
                                                  $('input[name=crear-nombre]').val(""),
                                                  $('input[name=crear-apellido]').val(""),
                                                  $('input[name=crear-usuario]').val(""),
                                                  $('input[name=crear-clave]').val(""),
                                                  $('input[name=crear-clave2]').val(""),
                                                  $('input[name=crear-telefono]').val(""),

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
                  $.post("controller/Usuario.php", 
                  {metodo: "listaUsuariosAdm"}
                  ,function(tabla){
                    $('#tabla').html(tabla);
                  }
                  );
      }
     function modalEliminarUsuario(id){
                  var textoId=document.getElementById("id_usuario_remove");    
                  textoId.setAttribute("value", id);
                  $('#ModalConfirmar').modal('show');
       }

       function modalEditarUsuario(id,nombre,apellido,usuario,genero,telefono,privilegios){

                  var textoId=$('#id_usuario_edit').val(id);  
                  var textoNombre=$('#nombre_usuario_edit').val(nombre);
                  var textoApellido=$('#apellido_usuario_edit').val(apellido);
                  var textoTelefono=$('#telefono_usuario_edit').val(telefono);
                  var privilegios = JSON.parse(privilegios);
                  $('#ModalEdiarUsuario').modal('show');
       }

       function bloquearUsuario(id){
              $.post("controller/Usuario.php", 
                    {metodo: "cambiarEstado",
                     id_usuario: id},function(respuesta){
                      if (respuesta=="Exito") {
                        mostrarLista();
                        $('#resultado').html("Cambio de estado del usuario");
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
       function confirmarEliminar(){
         
            usuarioId=$('#id_usuario_remove').attr("value");
            $.post("controller/Usuario.php", 
                    {metodo: "delete",
                     id_usuario:  usuarioId},function(respuesta){
                      $('#ModalConfirmar').modal('hide');
                      if (respuesta=="exito") {
                        mostrarLista()
                        $('#resultado').html("el usuario fue eliminado!");
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
        if (!$("#editar_usuario").hasClass( "disabled" )) {
            usuarioId=$('#id_usuario_edit').val();
            usuarioNombre=$('#nombre_usuario_edit').val();
            usuarioApellido=$('#apellido_usuario_edit').val();
            usuarioGenero=$('input[name=editar-genero]:checked').val();
            usuarioTelefono=$('#telefono_usuario_edit').val();

            var privilegios= [1,0,0,0,0];
            var privilegios = JSON.stringify(privilegios); 

                    $.post("controller/Usuario.php", 
                            {metodo: "update2",
                           id_usuario:  usuarioId,
                           nombre:  usuarioNombre,
                           apellido:  usuarioApellido,
                           genero:  usuarioGenero,
                           telefono:  usuarioTelefono,
                           privilegios:  privilegios,},function(respuesta){
                            $('#ModalEdiarUsuario').modal('hide');
                            if (respuesta=="Exito") {
                              mostrarLista();
                              $('#resultado').html("el usuario fue editado!");
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
            <a href="index.html" class="site_title"><i class="fa fa-glass"></i> <span>Mantil System</span></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="images/img.jpg" alt="..." class="img-circle profile_img">
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
              <li><a><i class="fa fa-home"></i> Inicio </a></li>
                <li><a><i class="fa fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="empty.html">Empleados</a></li>                    
                    <li><a href="empty.html">Administradores</a></li>                    
                  </ul>
                </li>
                <li><a><i class="fa fa-th-large"></i> Mesas <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="empty.html">Administrar</a></li>               
                  </ul>
                </li>
                <li><a><i class="fa fa-folder-o"></i> Categorias <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                  <li><a href="empty.html">Administrar</a></li>             
                  </ul>
                </li>
                <li><a><i class="fa fa-beer"></i> Productos <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="empty.html">Administrar</a></li>            
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Atenciones <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="empty.html">Administrar</a></li>                  
                  </ul>
                </li>
                <li><a><i class="fa fa-bar-chart"></i> Presentacion de datos <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="empty.html">General</a></li>                    
                    <li><a href="empty.html">Empleados</a></li>
                    <li><a href="empty.html">Categorias</a></li>                    
                    <li><a href="empty.html">Productos</a></li>
                    <li><a href="empty.html">Atenciones</a></li>                    
                    <li><a href="empty.html">Inventarios</a></li>                    
                  </ul>
                </li>
                <li><a><i class="fa fa-line-chart"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="empty.html">Reporte de hoy</a></li>                    
                    <li><a href="empty.html">Reportes pasados</a></li>
                    <li><a href="empty.html">Informe mes</a></li>                                        
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
                  <h3>Administradores</h3>
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
                  <h2>Formulario de ingreso nuevo Administrador</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <form id="create" data-toggle="validator" id="form_create" class="form-horizontal form-label-left" novalidate>

                    <p>Formulario de ingreso de usuarios</p>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"">Nombre <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="20"  name="crear-nombre" placeholder="ingrese nombre" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="20"  name="crear-apellido" placeholder="ingrese apellido" required="required" type="text">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Genero <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="gender" class="btn-group" data-toggle="buttons">

                          <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" class="flat" name="crear-genero"  value="M" checked required />
                            <input type="radio" name="crear-genero" value="M"> &nbsp; Hombre &nbsp;
                          </label>
                          <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" class="flat" name="crear-genero"  value="F" />
                            <input type="radio" name="crear-genero" value="F"> Mujer
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Telefono <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" step="1" min="0" data-minlength="7" id="number" name="crear-telefono" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Usuario <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="8"  name="crear-usuario" placeholder="ingrese usuario" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label for="password" class="control-label col-md-3">Contraseña</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" name="crear-clave" data-toggle="validator" data-minlength="4" class="form-control" id="inputPassword" placeholder="Contraseña" required>
                        <span class="help-block">Minimo 4 caracteres</span>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repetir contraseña</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" name="crear-clave2" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Opps! las contraseñas no coinciden" placeholder="Confirmar Contraseña" required>
                               <div class="help-block with-errors"></div> 
                      </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                        <button id="crear_usuario" type="submit" class="btn btn-success disabled" >Guardar</button>  
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Administradores <small>usuarios</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                        
                        <table id="datatable-buttons" class="table table-striped">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Nombre</th>
                              <th>Apellido</th>                             
                              <th>Telefono</th>
                              <th>Estado</th>
                              <th>Usuario</th>
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

          <!-- /modal editar usuario -->
          <div class="modal fade bs-example-modal-lg" id="ModalEdiarUsuario" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" align="center">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">Editar Usuario</h4>
                  </div>
                <div class="modal-body">
                  <form data-toggle="validator" class="form-horizontal form-label-left" novalidate>
                    <p>Formulario para editar usuarios</p>
                    <input type="text" id ="id_usuario_edit" value="" style="display:none">
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="nombre_usuario_edit" class="form-control col-md-7 col-xs-12"  name="name" placeholder="ingrese nombre" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Apellido <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="apellido_usuario_edit" class="form-control col-md-7 col-xs-12" name="name" placeholder="ingrese apellido" required="required" type="text" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Genero <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="gender" class="btn-group" data-toggle="buttons">
                          <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" class="flat" name="editar-genero" value="M" checked required />
                            <input  type="radio" name="editar-genero" value="M"> &nbsp; Hombre &nbsp;
                          </label>
                          <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" class="flat" name="editar-genero" value="F" />
                            <input  type="radio" name="editar-genero" value="F"> Mujer
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Telefono <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="telefono_usuario_edit" name="number"  step="1" min="0" data-minlength="7" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <hr>   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button id="editar_usuario" type="submit" class="btn btn-success disabled" onclick="confirmarEditar()">Confirmar</button>
                  </div>                
                  </form>
                 </div>                  
                </div>
              </div>
            </div>
            <!-- /modal editar usuario  -->

            <!-- /modal confirmar eliminar usuario -->
          <div class="modal fade bs-example-modal-sm" id="ModalConfirmar" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content" align="center">
                <div class="modal-body">
                  <h4>¿Esta seguro de eliminar este usuario?</h4>
                </div>
                <input type="text" id ="id_usuario_remove" value="" style="display:none">
                  <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="confirmar" type="button" class="btn btn-success" onclick="confirmarEliminar()">Confirmar</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /modal confirmar eliminar usuario-->

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
