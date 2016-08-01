
      <?php
        include 'includes/auth/validarSesiones.php';
        Caja();
      ?>

    <!DOCTYPE html>
          <html lang="en">
      <head>
          <meta charset="UTF-8" />
          <title>Caja</title>
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
                        //  pide a (pedidosCocina) todos los pedidos que estan en espera en la base de datos.y los recible como (tabla)
                        $.post("includes/json/pedidosCaja.php", function(tabla){
                              $('#comentarios').html(tabla);
                            });

                        $( "#actualizar" ).click(function() {
                          $.post("includes/json/pedidosCaja.php", function(tabla){
                                $('#comentarios').html(tabla);                
                          });                          
                        });

            });
           
                 
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
                       <hr><hr><h3 class="title1">Caja</h3> 
                          <a type="button" id="actualizar" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh"></span> 
                          Actualizar</a><hr>   
                       
                        <div class="grids widget-shadow">                   
                            <div class="table-responsive">
                               <table class="table table-bordered table-striped no-margin grd_tble">                                              
                                       <thead>
                                             <tr>
                                                 <th>Mesa</th>
                                                 <th>Total</th>
                                                 <th>Accion</th>
                                                 <th>Estado</th>
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
        <!--scrolling js-->
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!--//scrolling js-->
        <!-- Bootstrap Core JavaScript -->
         <script src="js/bootstrap.js"> </script>
      </body>
</html>


