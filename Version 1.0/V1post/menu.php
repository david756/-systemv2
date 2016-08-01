<?php
  include 'includes/auth/validarSesiones.php';
  menu();
  include 'includes/dbconsultas/consulta.php';
?>

<!DOCTYPE html>
<html>
          <head>

                <title>Menu</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="keywords" content="Novus Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
                SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
                <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
                <!-- Bootstrap Core CSS -->
                <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
                <!-- Custom CSS -->
                <link href="css/style.css" rel='stylesheet' type='text/css' />

                <style type="text/css">


                  

                /***** radio-box *****/

                /* radio-box grupo 01*/
                li.radio_01 { width: auto;}

                li.radio_01 input[type=radio] { display: none;}
                li.radio_01 input[type=radio] + label { 
                  color: #000; 
                  display: block; 
                  float: left;
                  width: auto; 
                  height: 143px;
                  text-indent: -1000em;
                }

                li.radio_01 input[type=radio].primero + label       { background: url(images/radio_01.png) 0px 0px no-repeat; width: 140px; }
                li.radio_01 input[type=radio].primero:checked + label   { background: url(images/radio_01.png) 0px -140px no-repeat; }

                li.radio_01 input[type=radio].ultimo + label      { background: url(images/radio_01.png) 100% 0px no-repeat; width: 140px; }
                li.radio_01 input[type=radio].ultimo:checked + label  { background: url(images/radio_01.png) 100% -140px no-repeat; }


                </style>

                <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
                <!-- Bootstrap Core CSS -->
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
                <script type="text/javascript">
                      
                           function toggle2(elemento) {
                          if(elemento.value=="Administrador") {
                              document.getElementById("opc_admin").style.display = "block";
                              document.getElementById("opc_empl").style.display = "none";
                              

                           }else if(elemento.value=="Empleado"){
                                   document.getElementById("opc_admin").style.display = "none";
                                   document.getElementById("opc_empl").style.display = "block";
                                
                               
                           }

                      }

                </script>

                <link href="css/custom.css" rel="stylesheet">
                <!--//Metis Menu -->




          </head> 


<body>


<div class="main-content">

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
            <li class="dropdown head-dpdn">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">0</span></a>
              <ul class="dropdown-menu">
                <li>
                  <div class="notification_header">
                    <h3>No tiene notificaciones</h3>
                  </div>
                </li>
            
                 <li>
                  <div class="notification_bottom">
                    <a href="#">Ver todas las notificaciones</a>
                  </div> 
                </li>
              </ul>
            </li> 
            <li class="dropdown head-dpdn">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">0</span></a>
              <ul class="dropdown-menu">
                <li>
                  <div class="notification_header">
                    <h3>No tiene nuevas Tareas</h3>
                  </div>
                </li>
                
                <li>
                  <div class="notification_bottom">
                    <a href="#">ver tareas pendientes</a>
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
                <li> <a href="#"><i class="fa fa-user"></i>Perfil</a> </li> 
                <li> <a href="includes/auth/logoutEmpleados.php"><i class="fa fa-sign-out"></i>Cerrar Sesion</a> </li>
              </ul>
            </li>
          </ul>
        </div>

        <div class="clearfix"> </div> 
      </div>
      <div class="clearfix"> </div> 


</div>

<div id="page-wrapper-center">
      <div class="main-page">
       <hr><hr><h3 class="title1">Menu Principal</h3>
        
        <div class="grids widget-shadow">

<br>

<div class="row">
  <?php  
    $resultado = consultarPerfilEmpleados();
    $registroEntrada=false;
    
              while($rows=mysql_fetch_array($resultado)){ 
                 
     
                
              
                 if (isset($_SESSION['id_empleado_login']) and $_SESSION['id_empleado_login']  == $rows[2]) {
  
                   $ultimoIngreso=consultarEstadoIngreso();
                   
                       if ($registroEntrada==false) {
                         echo '<div class="col-md-3 col-sm-6">
                           <a href="ingresos.php"><img src="images/salida.png" class="img-responsive" alt="Responsive image"></a>
                         </div>';
                       
                         $registroEntrada=true;
                       }                     
  
                       if ($rows[1]==1 and $ultimoIngreso==1) {
                         echo '<div class="col-md-3 col-sm-6">
                           <a href="caja.php"><img src="images/caja.png" class="img-responsive" alt="Responsive image"></a>
                         </div>';
                       
                       }
  
                       if ($rows[1]==2  and $ultimoIngreso==1) {
                         echo '<div class="col-md-3 col-sm-6">
                           <a href="pedido.php"><img src="images/mesa.png" class="img-responsive" alt="Responsive image"></a>
                         </div>';
                       
                       }


                      if ($rows[1]==3  and $ultimoIngreso==1) {
  
                         echo '<div class="col-md-3 col-sm-6">
                           <a href="cocina.php"><img src="images/cocina.png" class="img-responsive" alt="Responsive image"></a>
                         </div>';
                       
                       }

                       if ($rows[1]==4  and $ultimoIngreso==1) {
  
                         echo '<div class="col-md-3 col-sm-6">
                           <a href="inventarios.php"><img src="images/inventarios.png" class="img-responsive" alt="Responsive image"></a>
                         </div>';
                       
                       }
              
              
  
                 }
                }
  
               if (isset($_SESSION['id_administrador_login'])) {
                 
              echo '<div class="col-md-3 col-sm-6">
                <a href="pedido.php"><img src="images/mesa.png"  class="img-responsive" alt="Responsive image" ></a>
              </div>';
              echo '<div class="col-md-3 col-sm-6">
                <a href="caja.php"><img src="images/caja.png" class="img-responsive" alt="Responsive image" ></a>
              </div>';
              echo '<div class="col-md-3 col-sm-6">
                <a href="cocina.php"><img src="images/cocina.png" class="img-responsive" alt="Responsive image" ></a>
              </div>';
              echo '<div class="col-md-3 col-sm-6">
                <a href="inventarios.php"><img src="images/inventarios.png " class="img-responsive" alt="Responsive image"></a>
              </div>';
              echo '<div class="col-md-3 col-sm-6">
                <a href="red_administracion.php"><img src="images/administracion.png " class="img-responsive" alt="Responsive image"></a>
              </div>';

  
                 }
               
    
  
   ?></div>

<br>

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