<?php


	include 'includes/auth/validarSesiones.php';
	include 'includes/db/serv.php';
	include 'includes/dbconsultas/consulta.php';
  ingresos();
  $id_empleado=$_SESSION['id_empleado_login'];  

		if(isset($_POST['iniciar'])){ 

      		//$fecha='2016-01-15 00:00:0';
      		$fecha= date('Y-m-d H:i:s');
      		$sql = "INSERT INTO horarios (fk_accion,fk_empleado,fecha) VALUES (1, '$id_empleado','$fecha')";
      		$result = mysql_query($sql);
      		echo '<script> window.location="menu.php"; </script>';
		}
		elseif (isset($_POST['terminar'])) {		
      		$fecha= date('Y-m-d H:i:s');	
      		$sql = "INSERT INTO horarios (fk_accion,fk_empleado,fecha) VALUES (2, '$id_empleado','$fecha')";
      		$result = mysql_query($sql);
      		echo '<script> window.location="includes/auth/logoutEmpleados.php"; </script>';
		} 

    $estado_anterior=2;
    if (isset($_SESSION['id_empleado_login'])) {      
          $id_empleado=$_SESSION['id_empleado_login'];    
          $consulta='SELECT * FROM horarios  where fk_empleado="'.$id_empleado.'"  ORDER BY fecha DESC' ; 
          $resultado=mysql_query($consulta,$conect) or die ("Error 1 en: " . mysql_error());  
          $rows=mysql_fetch_array($resultado);
              if (isset($rows[3])) {
                      $estado_anterior=$rows[3];
              }
    }
 ?>
 


      <!DOCTYPE html>
      <html>
      <head>
          <meta charset="UTF-8" />
          <title>Ingresos</title>
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
                <div class="main-page row">
                  <hr><hr><h3 class="title1">Registrar ingreso</h3>
                   
                      <div class="col-md-12 grids widget-shadow">
                         <?php
                              if ($estado_anterior==1) {

                         echo '<form action="" method="POST" >                           
                              <input type="text" value="TERMINAR  TURNO" name="terminar"  style="display:none" />
                              <input id="wrapperbutton" type=image src="images/salida.png" name="terminar" >
                              </form>';
                          }
                          elseif ($estado_anterior=2) {
                          echo '<form action="" method="POST" >
                              <input type="text" value="INICIAR  TURNO" name="iniciar" style="display:none" />
                              <input id="wrapperbutton" type=image src="images/ingreso.png" name="iniciar">
                            </form>';
                          }                  
                         ?>
                        <div class="clearfix"> </div>
                    </div>
              </div> 
         </div>

         <div class="table-responsive">
             <table class="table table-bordered table-striped no-margin grd_tble">
                                     
                                         <thead>
                                               <tr>
                                                   <th>Usuario</th>
                                                   <th>Fecha</th>
                                                   <th>Accion</th>
                                               </tr>
                                         </thead>
           
                                           <tbody> 
                                              
                                                    <?php
                                                     $id_empleado=$_SESSION['id_empleado_login'];
                                                     $resultado = consultarListaIngresos($id_empleado);
                                                     while($rows=mysql_fetch_array($resultado)){ 
           
                                                         echo'<tbody>
                                                                 <tr>
           
                                                                   <td>'.$rows[0].'</td>
                                                                   <td>'.$rows[1].'</td>
                                                                   <td>'.$rows[2].'</td>
                                                                 </tr>
                                                              </tbody>
           
                                                           ';} 
                                                     ?> 
                                           </tbody>
                     </table>
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
