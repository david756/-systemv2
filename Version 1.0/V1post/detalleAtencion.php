
<?php
  include 'includes/auth/validarSesiones.php';
  include 'includes/dbconsultas/consulta.php';
  include 'includes/dbconsultas/consultaAtencion.php';
  include 'includes/db/serv.php';
  //cualquier usuario puede ver el detalle de una atencion
  menu();
  if (isset($_GET['idAtencion'])) {
   $atencion=$_GET['idAtencion'];  
  }
  else{
   header('Location: menu.php');
  }
  
?>

    <!DOCTYPE html>
    <html>
    <head>

              <meta charset="UTF-8" />
              <title>Pedido</title>

              <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
              <script src="js//jquery.min.js"></script>
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
              <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
              <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>

              <script type="text/javascript">

               
                function abrirEliminar(id){

                  var texto=document.getElementById("textAtencion");    
                  texto.setAttribute("value", id);
                  var texto2=document.getElementById("textAtencion2");    
                  texto2.setAttribute("value", id);

                   $( "#eliminar" ).dialog({
                        modal: true
                    });
                }

                function abrirEliminarAtencion(id){

                    var texto=document.getElementById("elimtextAtencion");    
                    texto.setAttribute("value", id);
                    var texto2=document.getElementById("elimtextAtencion2");    
                    texto2.setAttribute("value", id);

                     $( "#eliminarAtencion" ).dialog({
                          modal: true
                      });
                }

                function abrirModificar(id){
                  
                       var texto=document.getElementById("textAtencionMod");    
                      texto.setAttribute("value", id);
                      var texto2=document.getElementById("textAtencionMod2");    
                      texto2.setAttribute("value", id);

                      $( "#modificar" ).dialog({
                          modal: true
                      });


                }

                function abrirModificarAtencion(id){                
                 
                    $( "#modificarAtencion" ).dialog({
                        modal: true
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


                   <hr> <hr><h3 class="title1">Detalles del Pedido</h3>
                         
                   

                 <div class="col-md-6 panel-group tool-tips widget-shadow" id="accordion" role="tablist" aria-multiselectable="true">
                 <h3 class="media-heading"> Productos :</h3>
                      <?php 
                        $idAtencion=$_GET['idAtencion'];

                        //0ap.id,1ap.valor,2ap.anexos,3ap.hora_pedido,4ap.hora_preparacion,
                        //5ap.hora_despacho,6ep.descripcion,7p.nombre,8p.valor,9p.descripcion,10e.usuario,11ea.descripcion,12c.nombre,13ap.descuento
                        $resultado=consultarDetalleAtencion($idAtencion);
                        $estado="";
                          
                               if (isset($_SESSION['usuario_administrador_login'])) {
                                 $Visibilidad="block";
                               }
                               else{

                                $Visibilidad="hidden";
                               }



                         while($rows=mysql_fetch_array($resultado)){ 


                          echo '

                            

                            
                            <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading'.$rows[0].'">
                            <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$rows[0].'"
                             aria-expanded="false" aria-controls="collapse'.$rows[0].'">
                              <h4><b>'.$rows[7].'</b></h4>
                            </a> 
                            </h4>
                            </div>
                            <div id="collapse'.$rows[0].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$rows[0].'">
                            <div class="panel-body">

                             <b> Valor Actual :</b>  '.$rows[8].'</br>
                              <b>Valor Registrado :</b>  '.$rows[1].'</br>
                              <b>Descuento:</b> '.$rows[13].'</br>
                              <b>Total:</b> '.($rows[1]-$rows[13]).'</br>
                             <b> Estado :</b>  '.$rows[6].'</br>
                             <b> Mesero :</b>  '.$rows[10].'</br>
                              <b>Descripcion :</b>  '.$rows[9].'</br>
                             <b> Anexos :</b>  '.$rows[2].'</br>
                             <b> Hora Pedido :</b>  '.$rows[3].'</br>
                             <b> Hora Inicio Preparacion :</b>  '.$rows[4].'</br>
                             <b> Hora Despacho :</b>  '.$rows[5].'</br>
                             <b> Categoria : </b> '.$rows[12].'</br>

                             <h4><a style="visibility: '.$Visibilidad.'" id="boton"  onclick="abrirEliminar('.$rows[0].')" >
                            <span class="label label-danger">Eliminar</span></a>

                            <a style="visibility: '.$Visibilidad.'" onclick="abrirModificar('.$rows[0].')">
                            <span class="label label-warning" >Modificar Descuento</span></a></h4>
                              

                            </div>
                          </div>
                          </div>

                          ' ;







                          $estado=$rows[11];

                         }






                      ?>

            			</div>

                     <div class="col-md-6 panel-group tool-tips widget-shadow">
                         <h3 class="media-heading"> Atencion :</h3>
            <?php 

             $consulta=consultarDatosAtencion($idAtencion);
                      
                   
                        $mesa="";
                        $total="";
                        $cajero="";
                       while($rows=mysql_fetch_array($consulta)){ 
                                 
                                $mesa=$rows[0];
                                $subtotal=$rows[1];
                                $cajero=$rows[2];
                                $descuento=$rows[3];
                                $total=$rows[4]-$descuento;
                                $horaPago=$rows[5];
                               
                        }


                        if (empty($descuento)) {
                          $descuento=0;
                          $total=$subtotal; 
                         }
                         
                        if (!empty($cajero)) {
                          
                         $query= 'SELECT *
                          FROM
                             empleados 
                                                                      
                              WHERE(id='.$cajero.')';

                            // enviamos la consulta a MySQL
                            $consulta2 = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());

                              while($rows=mysql_fetch_array($consulta2)){ 
                                 
                               $cajero=$rows[5];
                               
                        }



                        }

             ?>


                          <?php  echo '

                            <b> Mesa :</b>  '.$mesa.'</br>
                            <b> Cajero :</b>  '.$cajero.'</br>
                             <b> sub total :</b>  '.$subtotal.'</br>
                              <b>Descuento Total :</b>  '.$descuento.'</br>
                              <b>total:</b> '.$total.'</br>
                              <b>Hora pago:</b> '.$horaPago.'</br>                   
                             <b> Estado :</b>  '.$estado.'</br>

                              <h4><a style="visibility: '.$Visibilidad.'" id="boton"  onclick="abrirEliminarAtencion('.$idAtencion.')" >
                            <span class="label label-danger">Eliminar</span></a>

                            <a style="visibility: '.$Visibilidad.'" onclick="abrirModificarAtencion('.$rows[0].')">
                            <span class="label label-warning" >Modificar</span></a></h4>
                          ' ;
                          ?>

                     </div>
                        
                    <div class="clearfix"> </div>
                     

               


               </div>
              </div>  

             <div id="eliminar" nombre="no asignado" title="Confirmar" style="display:none;">
               

                     <form action="includes/crud/modificarAtenProd.php" method="POST">

                            Esta seguro de que quiere eliminar este producto de esta atencion: 

                            <input type="text" id="textAtencion2"  value ="eliminar" disabled="">
                            <input type="text" id="textAtencion" name="accionEliminar" style="visibility: hidden" value ="eliminar">
                            <input type="text"  name="idAtencion" style="visibility: hidden" value ="<?php echo $_GET['idAtencion']; ?>">

                           <br>  <input type="submit" value="Eliminar">
                            



                     </form>
                     


            </div>

             <div id="eliminarAtencion" nombre="no asignado" title="Confirmar" style="display:none;">
               

                     <form action="includes/crud/modificarAtencion.php" method="POST">

                            Esta seguro de que quiere eliminar esta atención: 

                            <input type="text" id="elimtextAtencion2"  value ="eliminar" disabled="">
                            <input type="text" id="elimtextAtencion" name="accionEliminar" style="visibility: hidden" value ="eliminar">
                            <input type="text"  name="idAtencion" style="visibility: hidden" value ="<?php echo $_GET['idAtencion']; ?>">

                           <br>  <input type="submit" value="Eliminar">
                            



                     </form>
                     


            </div>


             <div id="modificar" title="Confirmar" style="display:none;">
               

                    <form action="includes/crud/modificarAtenProd.php" method="POST">

                            <input type="text" id="textAtencionMod2"  value ="eliminar" disabled="">
                            <input type="text" id="textAtencionMod" name="accionModificar" style="visibility: hidden" value ="Modificar">
                            <input type="text"  name="idAtencion" style="visibility: hidden" value ="<?php echo $_GET['idAtencion']; ?>">

                            Agregar descuento:<hr>

                      (Ingresar el numero negativo equivale a hacer un aumento)<hr>

                           


                            <input type="text"  name="valor" >

                           <br>  <input type="submit" value="Modificar">
                            



                     </form>


            </div>


             <div id="modificarAtencion" title="Confirmar" style="display:none;">
               

                    <form action="includes/crud/modificarAtencion.php" method="POST">

                            atencion:
                            <input type="text" value ="<?php echo $idAtencion; ?>" disabled >
                            <input type="text" name="id"  value ="<?php echo $idAtencion; ?>" style="visibility: hidden" >
                            descuento:
                            <input type="text" name="descuento"  value ="<?php echo $descuento; ?>" >

                            Cambiar Mesa:
                                      <select NAME="mesa" required>

                                          <?php

                                          echo '<option value="igual">'.$mesa.'</option>';
                                         

                                          $resultado=consultarMesasLibres();

                                          while($rows=mysql_fetch_array($resultado)){

                                          echo'<option value='.$rows[0].'>'.$rows[1].'</option>';

                                          }

                                          ?>

                                        </select> 


                          Cambiar estado:
                                      <select NAME="estado" required>

                                      <?php

                                          echo ' <option value="igual">'.$estado.'</option>';

                                      ?>
                                        <option value="3">cortesia</option>
                                         <option value="1">pedido</option>
                                         <option value="4">aplazado</option>
                                         <option value="2">pago</option>




                                        </select> 

                              <input type="text"  name="accionModificar" style="visibility: hidden" value ="Modificar">
                           <br>  <input type="submit" value="Modificar">

                     </form>


            </div>


              </div>
             <!--footer-->
                <div class="footer">
                       <p>2016 Post Premium. Todos Los Derechos Reservados | David Hernandez </p>
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

