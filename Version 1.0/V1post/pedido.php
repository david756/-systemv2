
<?php

    
    include 'includes/auth/validarSesiones.php';
    include 'includes/dbconsultas/consulta.php';

    mesero();

?>

<!DOCTYPE html>

<html>
           <head>
                  <meta charset="UTF-8" />
                      <title>Pedido</title>
                      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                      <script src="http://js.pusherapp.com/1.9/pusher.min.js"></script>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
                    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
                     <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
                    <script>
                    
                   //cuando carga la pagina obtiene los datos de la base de datos y los muestra en la tabla
                    $( document ).ready(function() {                     

                                $( ".mesas-disponibles,.mesas-ocupadas" ).click(function() {

                                 var idMesa = $(this).attr("id");
                                  url='pedido2.php?mesa='+idMesa;
                                  $(location).attr('href',url);

                                });

                    });
                   
                    </script>

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

           </head>
           <!-- end head -->

            <body>

            <div class="main-content">
                  <!--  Menu -->
                  <div class="sticky-header header-section ">
                    <div class="header-right">
                      <div class="profile_details_left"><!--notifications of menu start -->
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
                                 <hr><hr><h3 class="title1">Nuevo Pedido</h3>             
                                <div class="grids widget-shadow">

                                    <div class="row">
                                         <?php
                                       
                                        $resultado = consultarMesas();
                                        while($rows=mysql_fetch_array($resultado)){ 
                                          $estado=consultarEstadoMesa($rows[0]);
                                          if ( $estado=="disponible") {
                                           echo '<div id ="'. $rows[0] .'" class="col-md-3 col-xs-12 col-sm-4   mesas-disponibles">                                              
                                                  <h5>'.$estado.'</h5>
                                                  <img src="images/mesaV.png">
                                                  <h4>'. $rows[1] .'</h4>                                             
                                                 </div>';  
                                          }
                                          else {
                                            echo '<div id ="'. $rows[0] .'"class="col-md-3 col-xs-12 col-sm-4 mesas-ocupadas">   
                                                  <h5> ocupada </h5>
                                                  <img src="images/mesaV.png">
                                                  <h4>'. $rows[1] .'</h4>
                                                 </div>';  
                                          }
                                        } 
                                        
                                       ?>
                                       </div>

                                    <div class="clearfix"> </div>
                                </div>

                                <div class="grids widget-shadow">
                              			<h3 class="title2">Ver todas las cuentas de hoy : </h3><br>
                              		  <a href="cuentasAbiertas.php" class="btn btn-primary btn-sm"> cuentas de hoy </a>
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

