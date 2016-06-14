
<?php
include 'includes/auth/validarSesiones.php';
  cocina();
?>

<!DOCTYPE html>
  <html lang="en">
    <head>
          <meta charset="UTF-8" />
          <title>Cocina</title>
          <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
          <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
          <!-- Custom CSS -->
          <link href="css/style.css" rel='stylesheet' type='text/css' />
          <!-- font CSS -->
          <!-- font-awesome icons -->
          <link href="css/font-awesome.css" rel="stylesheet"> 
          <!-- //font-awesome icons -->
           <!-- js-->
          <script src="js/jquery-1.11.1.min.js"></script>
          <script src="js/modernizr.custom.js"></script>
          <!--webfonts-->
          <!--//webfonts--> 
          <!--animate-->
          <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
          <script src="js/wow.min.js"></script>
              <script>
                   new WOW().init();
              </script>
          <!--//end-animate-->
          <!-- Metis Menu -->
          <script src="js/metisMenu.min.js"></script>
          <script src="js/custom.js"></script>
          <link href="css/custom.css" rel="stylesheet">
          <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
          <script>        
             //cuando carga la pagina obtiene los datos de la base de datos y los muestra en la tabla
              $( document ).ready(function() {             
                          //actializa los pedidos de la cocina cada minuto
                          setInterval(function(){ 
                                    $('#actualizar').trigger('click');                                            
                          }, 60000);

                          //  pide a (pedidosCocina) todos los pedidos que estan en espera en la base de datos.y los recible como (tabla)
                           $.ajax({
                                    url:   'includes/json/pedidosCocina.php',
                                    type:  'post',

                                    beforeSend: function () {
                                            $("#comentarios").html("Procesando, espere por favor...");
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                            $('#comentarios').html('<o> ocurrio un error </p>');
                                    },
                                    success:  function (tabla,estado,objeto) {
                                           $('#comentarios').html(tabla);
                                           $tiempo= $('.timeprogress').html();                           
                                            setInterval(function(){ 
                                                //$('.timeprogress').html($tiempo);
                                                $('.timeprogress').each(function(i, item) {
                                                    var text = item.innerText;
                                                    item.innerText=parseInt(text)+parseInt(1);
                                                  });                                
                                             }, 60000);    
                                    },
                                 
                            });

                          $( "#actualizar" ).click(function() {
                           //  pide a (pedidosCocina) todos los pedidos que estan en espera en la base de datos.y los recible como (tabla)
                           $.ajax({
                                    url:   'includes/json/pedidosCocina.php',
                                    type:  'post',
                                    error: function(jqXHR, textStatus, errorThrown) {
                                            $('#comentarios').html('<o> <hr> ocurrio un error, por favor intente nuevamente </p>');
                                    },
                                    success:  function (tabla,estado,objeto) {
                                           $('#comentarios').html(tabla);
                                           $tiempo= $('.timeprogress').html();                           
                                            setInterval(function(){ 
                                                //$('.timeprogress').html($tiempo);
                                                $('.timeprogress').each(function(i, item) {
                                                    var text = item.innerText;
                                                    item.innerText=parseInt(text)+parseInt(1);
                                                  });                                
                                             }, 60000);    
                                    },
                                    
                            });

                          });

             });

          function cambiarEstado(idAtemProd,estado){

              datos= {idAp:idAtemProd,estado:estado};
              $.ajax({
                      url:   'includes/crud/modificarEstadoAtencionProducto.php',
                      type:  'POST',
                      data: datos,

                      beforeSend: function () {
                              $("#mensajeT").text("Procesando, espere por favor...");
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR);
                             $("#mensaje").show();
                            $("#mensajeT").text("ocurrio un error fatal ! Verifica la conexion a internet");
                      },
                      success:  function (resultado,estado,objeto) {
                            console.log(resultado);
                            if (resultado=="1") {
                                $("#mensaje").hide("slow");
                                $("#mensaje").attr("class","alert alert-info");
                                $("#mensaje").show("fast");
                                $("#mensajeT").text("Exito !");
                            }
                            else if (resultado=="-1") {
                                $("#mensaje").hide("slow");
                                $("#mensaje").attr("class","alert alert-danger");
                                $("#mensaje").show("fast");
                               $("#mensajeT").text("Ocurrio un error , por favor verifica");
                            }
                            else if (resultado=="e1") {
                                $("#mensaje").hide("slow");
                                $("#mensaje").attr("class","alert alert-danger");
                                $("#mensaje").show("fast");
                                $("#mensajeT").text("Atencion, alguien ya esta preparando este producto");
                            }
                            else if (resultado=="e2") {
                                $("#mensaje").hide("slow");
                                $("#mensaje").attr("class","alert alert-danger");
                                $("#mensaje").show("fast");
                                $("#mensajeT").text("Atencion, alguien ya despacho este producto");
                            }

                            $('#actualizar').trigger('click');
                                                      
                             
                      },
                      
              });          
          }
             
          </script>
      
    </head>

    <body>
             
          <div class="main-content">
           <!--  Menu -->
                  <div class="sticky-header header-section ">
                    <div class="header-right">
                      <div class="profile_details_left">
                      <!--notifications of menu start -->
                        <ul class="nofitications-dropdown">
                          <li class="dropdown head-dpdn">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">0</span></a>
                            <ul class="dropdown-menu">
                              <li>
                                <div class="notification_header">
                                  <h3>No tiene Mensajes</h3>
                                </div>
                              </li>
                            
                              <li>
                                <div class="notification_bottom">
                                  <a href="#">Ver todos los Mensajes</a>
                                </div> 
                              </li>
                            </ul>
                          </li> 
                        </ul>
                        <div class="clearfix"> </div>
                      </div>
                      <!--notification menu end -->
                    <div class="profile_details">   
                        <ul>
                          <li class="dropdown profile_details_drop">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <div class="profile_img"> 
                                        <div class="user-name">                                          
                                          <?php 
                                          if (isset($_SESSION['usuario_empleado_login'])) {
                                            echo $_SESSION['usuario_empleado_login'];
                                          }
                                         else if (isset($_SESSION['usuario_administrador_login'])) {
                                           echo $_SESSION['usuario_administrador_login'];
                                         }

                                          ?> 
                                          <span> <br> Más Opciones</span>
                                        </div>
                                        <i class="fa fa-angle-down lnr"></i>
                                        <i class="fa fa-angle-up lnr"></i>
                                        <div class="clearfix"></div>  
                                  </div>  
                            </a>
                            <ul class="dropdown-menu drp-mnu">
                              <li> <a href="menu.php"><i class="fa fa-sign-out"></i>Volver a Menu</a> </li>
                              <li> <a href="includes/auth/logoutEmpleados.php"><i class="fa fa-sign-out"></i>Cerrar Sesion</a> </li>
                            </ul>
                          </li>
                        </ul>
                    </div>

                      <div class="clearfix"> </div> 
                    </div>
                    <div class="clearfix"> </div> 
                  </div>
                 <!-- End Menu -->


          
                <div id="page-wrapper-center">
                      <div class="main-page">
                       <hr><hr><h3 class="title1">Pedidos Pendientes</h3>  
                          <a type="button" id="actualizar" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh"></span> 
                          Actualizar</a><hr>  
                          <div class="alert alert-danger" id="mensaje" style="display: none"><span id="mensajeT"></span></div>                    
                          <div class="grids widget-shadow">
                              <div class="table-responsive">
                                   <table class="table stats-table ">
                                                     <thead>
                                                             <tr>
                                                               <th>Producto</th>                                  
                                                               <th>Anexos</th>
                                                               <th>Mesa</th>
                                                               <th>Tiempo</th>
                                                               <th>Mesero</th>
                                                               <th>Estado</th>
                                                               <th>Accion</th>
                                                             </tr>
                                                     </thead>
                                         <tbody id="comentarios" ></tbody>
                                 </table>
                              </div>
                          </div>
                       </div>
                 </div>  
      </div>

           <!--footer-->
              <div class="footer">
                 <p>&copy; 2016 Post Premium. Todos Los Derechos Reservados | David Hernandez </p>
              </div>
            <!--//footer-->



           <!-- Classie -->
              <script src="js/classie.js"></script>
              <!--scrolling js-->
              <script src="js/jquery.nicescroll.js"></script>
              <script src="js/scripts.js"></script>
              <!--//scrolling js-->
              <!-- Bootstrap Core JavaScript -->
               <script src="js/bootstrap.js"> </script>

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


