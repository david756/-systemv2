

         <?php 
              session_start();
              include 'includes/auth/validarSesiones.php';
              include 'includes/dbconsultas/consultaAtencion.php';
              include 'includes/db/serv.php';
              caja();

              if (isset($_GET['atencion'])) {
                   $idAtencion=$_GET['atencion'];               
                   $empleadosAtencion=consultarEmpleadosAtencion($idAtencion);
                   $productosAtencion=consultarProductosAtencion($idAtencion);
                     //consulta atencion: Mesa,Valor,Cajero
                   $datosAtencion=consultarDatosAtencion($idAtencion);
                  }
            else {
               echo'<script> window.location="caja.php"; </script>';
                  }
         ?>
         
    <!DOCTYPE html>
    <html>
    <head>

                  <title>Pedidos</title>
                  <meta name="viewport" content="width=device-width, initial-scale=1">
                  <script src="http://js.pusherapp.com/1.9/pusher.min.js"></script>
                  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>  
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


            <!-- div que agrupa Numero de Mesa , total y cajero -->
            <div id="page-wrapper-center">
            <hr><hr><h3 class="title1">Detalle de Atencion</h3>
                    
                    <?php $consulta=$datosAtencion;
                      
                   
                        $mesa="";
                        $total="";
                        $cajero="";
                       while($rows=mysql_fetch_array($consulta)){ 
                                 
                                $mesa=$rows[0];
                                $subtotal=$rows[1];
                                $cajero=$rows[2];
                                $horaPago=$rows[5];
                                $estado=$rows[6];
                                $descuento=$rows[3];
                                $total=$rows[4]-$descuento;
                               
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


                         $Texto='
                         <div class="row">
                           <div class="col-md-11">
                             <div class="col-md-3">
                               <h3><strong>'.$mesa.'</strong></h3>
                             </div>
                             <div class="col-md-2">
                               <h4> <strong>Estado: </strong>'.$estado.'</h4><br>
                             </div>
                             <div class="col-md-3">
                               <h4> <strong>Cajero: </strong>'.$cajero.'</h4><br>
                             </div>                             
                             <div class="col-md-4">
                               <h4> <strong>Hora Pago: </strong>'.$horaPago.'</h4><br>
                             </div>


                              <div class="col-md-4">
                                <h4> Sub-Total: '.$subtotal.'</h4>
                              </div>
                              <div class="col-md-4">
                                <h4> Descuento: '.$descuento.'</h4>
                              </div>
                              <div class="col-md-4">
                                <h3> <strong>Total: '.$total.'</strong></h3>
                              </div>
                           </div>
                         </div>';


                            echo $Texto;
                     ?> 



            </div>

           <div class="row"> 

             <div class="col-md-8">           
                            <!-- div que agrupa listado del pedido-->
                            <div class="grids widget-shadow">               
                            <h3 class="hdg" >Listado</h3>
                            <table class="table table-bordered table-striped no-margin grd_tble">
                                                    <thead>
                                                            <tr>
                                                              <th>Cant</th>
                                                              <th>Producto</th>
                                                              <th>Anexo</th>
                                                              <th>Valor</th>
                                                             <th>Total</th>
                                                            </tr>
                                                    </thead>
                                        <tbody >                                     
                                                <?php  echo $productosAtencion; ?>
                                        </tbody>
                                </table>
                            </div> </div>

          
               <div class="col-md-4">
                <!-- div que agrupa Meseros de la atencion -->
               <div class="grids widget-shadow">               
                   
                   <h3>Meseros que atendieron :</h3>
                   <?php  echo $empleadosAtencion; ?>
               
                   
               </div>
               
               <!-- div que agrupa botones 1 -->
               <div>              
                  <a type="button" class="btn btn-primary btn-lg" href=<?php echo ('"detalleAtencion.php?idAtencion='.$idAtencion.'"'); ?>>Detalles</a>
                  <a type="button" class="btn btn-primary btn-lg" href="Imprimir.php">Imprimir Cuenta</a>
                              
               </div>
                <!-- div que agrupa botones 2 -->
                <div class="modal-grids row">                    
                        <button type="button" class="btn btn-primary btn- " data-toggle="modal" data-target="#ModalPago"
                             data-whatever="@mdo">Pagar </button>
                       <button type="button" class="btn btn-primary btn- " data-toggle="modal" data-target="#ModalAplazar"
                             data-whatever="@mdo">Aplazar </button>
                        <button type="button" class="btn btn-primary btn- " data-toggle="modal" data-target="#ModalCortesia"
                             data-whatever="@mdo">Cortesia </button>
                        <button type="button" class="btn btn-primary btn- " data-toggle="modal" data-target="#ModalDescuento"
                             data-whatever="@mdo">Descuento </button>                     
                </div>
            </div>

         </div>
   </div>

            <!-- Modals-->

                <div class="col-md-4 modal-grids">
                  

                  <div class="modal fade" id="ModalPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="exampleModalLabel">Pagar cuenta </h4>
                        </div>
                        <div class="modal-body">
                          <form action="includes/json/pagar.php" method="POST">
                            <input type="text"  style="visibility:hidden" name="atencion" value ="<?php echo $idAtencion; ?>" >
                            <input type="text"  style="visibility:hidden" name="accion" value ="pagar" >

                              <h3>¿Desea confirmar el pago de este pedido?</h3><br>
                              <h3>Total: <strong><?php echo $total; ?></strong></h3><br>
                            <div class="form-group">
                              <label for="message-text" class="control-label">Descripcion:</label>
                              <textarea class="form-control" id="message-text" name="descripcion" required >Pago normal</textarea>
                            </div>
                            <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                          </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>

                 <div class="col-md-4 modal-grids">
                  

                  <div class="modal fade" id="ModalAplazar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="exampleModalLabel">Aplazar cuenta </h4>
                        </div>
                        <div class="modal-body">
                          <form action="includes/json/pagar.php" method="POST">
                            <input type="text"  style="visibility:hidden" name="atencion" value ="<?php echo $idAtencion; ?>" >
                             <input type="text"  style="visibility:hidden" name="accion" value ="aplazar" >

                              <h3>¿Desea aplazar el pago de este pedido?</h3><br>
                              <h3>Total: <strong><?php echo $total; ?></strong></h3><br>
                            <div class="form-group">
                              <label for="message-text" class="control-label">Descripcion:</label>
                              <textarea class="form-control" id="message-text" name="descripcion" required ></textarea>
                            </div>
                            <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                          </form>
                        </div>                        
                      </div>
                    </div>
                  </div>
                </div>

                 <div class="col-md-4 modal-grids">
                 
                  <div class="modal fade" id="ModalCortesia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="exampleModalLabel">Cortesia </h4>
                        </div>
                        <div class="modal-body">
                          <form action="includes/json/pagar.php" method="POST">
                             <input type="text"  style="visibility:hidden" name="atencion" value ="<?php echo $idAtencion; ?>" >
                              <input type="text"  style="visibility:hidden" name="accion" value ="cortesia" >

                              <h3>¿Desea confirmar cortesia para este pedido?</h3><br>
                              <h3>Total: <strong><?php echo $total; ?></strong></h3><br>
                            <div class="form-group">
                              <label for="message-text" class="control-label">Descripcion:</label>
                              <textarea class="form-control" id="message-text" name="descripcion" required ></textarea>
                            </div>
                            <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                          </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>

                 <div class="col-md-4 modal-grids">
                  

                  <div class="modal fade" id="ModalDescuento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="exampleModalLabel">Agregar descuentos </h4>
                        </div>
                        <div class="modal-body">
                          <form action="includes/json/pagar.php" method="POST">
                              <input type="text"  style="visibility:hidden" name="atencion" value ="<?php echo $idAtencion; ?>" >
                              <input type="text"  style="visibility:hidden" name="accion" value ="descuento" >

                              <h3>¿Desea agregar descuento a este pedido?</h3><br>
                              <h3>Total: <strong><?php echo $total; ?></strong></h3><br>
                              <h4>
                                 (Ingresar el numero negativo equivale a hacer un aumento)
                              </h4><hr>
                            <div class="form-group">
                               <input type="number" step="1" min="0" placeholder=" ejemplo : 5000" type="text" name="descripcion" class="form-control" id="message-text" name="descripcion" required ></textarea>
                            </div>
                            <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                          </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>

          

           <!--footer-->
            <div class="col-md-12 grid_3 grid_5 widget-shadow">
              <div class="footer">
                 <p>&copy; 2016 Post Premium. Todos Los Derechos Reservados | David Hernandez </p>
              </div>
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