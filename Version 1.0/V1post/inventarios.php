
      <?php
        include 'includes/auth/validarSesiones.php';
        include 'includes/dbconsultas/consultaInventario.php';
        inventarios();
       if (isset($_SESSION['id_administrador_login'])) {

         $idEmpleado=$_SESSION['id_administrador_login'];

      }
      elseif (isset($_SESSION['id_empleado_login'])) {
         
          $idEmpleado=$_SESSION['id_empleado_login'];
        }
      ?>

    <!DOCTYPE html>
          <html lang="en">
      <head>
          <meta charset="UTF-8" />
          <title>Inventarios</title>
          <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
          <script src="https://js.pusher.com/3.0/pusher.min.js"></script>
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

           <!-- inicio de las funciones  -->
              <script type="text/javascript">
              $(document).ready(function()
                {

                   $("#cambio").click(function () {
                         if ( $("#cambio").attr("actual")=="ingresar") {
                          $(".ingreso").attr("style","display:none");
                          $("#query").attr("style","display:block");
                          $("#cambio").attr("actual","consultar");
                          $("#cambio").html("Modificar Inventario");
                         }
                         else if ( $("#cambio").attr("actual")=="consultar") {
                          $(".ingreso").attr("style","display:block");
                          $("#query").attr("style","display:none");
                          $("#cambio").attr("actual","ingresar");
                          $("#cambio").html("Consultar Inventario");
                         }

                            
                         
                          
                      
                    });
                
                });
              </script>
          
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
                      <div class="main-page">
                       <hr><hr><h3 class="title1">Inventarios</h3> 

              <a actual="ingresar"  id="cambio" class="btn btn-primary">Consultar Inventario</a><hr>
                
             <div class="grids widget-shadow">  
             <h3 class="ingreso">Modificar Inventario</h3>
                 <div class="sign-up-row widget-shadow ingreso" >
                      <form data-toggle="validator" action ="includes/crud/inventariosCrud.php" method="POST">
                         <div class="sign-u">
                          <div class="sign-up1">
                            <h4>Producto* :</h4>
                          </div>

                          <div class="sign-up2">

                              
                              <select NAME="productos" required>

                             <?php

                              include 'includes/dbconsultas/consulta.php';

                              $resultado = consultarProductosInventario();
                              while($rows=mysql_fetch_array($resultado)){

                              echo'<option value='.$rows[0].'>'.$rows[1].'</option>';

                              }

                              ?>
                              </select>                         
                            
                          </div>
                          <div class="clearfix"> </div>
                        </div>

                         <div class="sign-u">
                          <div class="sign-up1">
                            <h4>Cantidad* :</h4>
                          </div>
                          <div class="form-group">
                            
                              <input type="number" step="1" min="0" name="cantidad" class="form-control" id="inputName" placeholder=" ejemplo : 5" required>
                            
                          </div>
                          <div class="clearfix"> </div>
                        </div>

                        <div class="sign-u">
                          <div class="sign-up1">
                            <h4>Accion* :</h4>
                          </div>

                          <div class="sign-up2">

                              
                              <select id="accion" NAME="accion" required>
                                  <option value='1'>Agregar</option>
                                  <option value='2'>Eliminar</option>
                              </select>                         
                            
                          </div>
                          <div class="clearfix"> </div>
                        </div>

                        <div id="proveedor"  class="sign-u">
                          <div class="sign-up1">
                            <h4>Proveedor* :</h4>
                          </div>
                          <div class="form-group">
                          
                              <input type="text" maxlength="20" name="proveedor" class="form-control" id="inputName" placeholder="Babaria ... " required>
                          
                          </div>
                          <div class="clearfix"> </div>
                        </div>

                        <div  id="costo" class="sign-u">
                          <div class="sign-up1">
                            <h4>Costo* :</h4>
                          </div>
                          <div class="form-group">
                            
                              <input  type="number" step="1" min="0" name="costo" class="form-control" id="inputName" placeholder=" ejemplo : 1500" required>
                            
                          </div>
                          <div class="clearfix"> </div>
                        </div>

                        <div class="sign-u">
                          <div class="sign-up1">
                            <h4>Descripcion* :</h4>
                          </div>
                          <div class="form-group">
                          
                              
                              <textarea name="descripcion" class="form-control" placeholder="Escriba aca la descripcion" 
                              id="inputName"   rows="3" cols="40" required></textarea>
                          </div>
                          <div class="clearfix"> </div>
                        </div>


                   
                        <div class="sub_home">

                            <input type="text" name ="identificador" value="inventario" style="visibility:hidden" > 

                            <?php 
                              echo '<input type="text" name ="empleado" value="'.$idEmpleado.'" style="visibility:hidden" > ';
                             ?>
                            
                            <hr><button type="submit" class="btn btn-primary disabled">Guardar</button>
                          
                          <div class="clearfix"> </div>
                        </div>
                 </form>


                </div>

                <div class="sign-up-row widget-shadow" id="query" style="display: none">
                        <div class="table-responsive">
                               <table class="table table-bordered table-striped no-margin grd_tble">                                              
                                       <thead>
                                             <tr>
                                                 <th>Producto</th>
                                                 <th>Ingresados</th>
                                                 <th>Vendidos</th>
                                                 <th>Eliminados</th>
                                                 <th>Total</th>
                                              </tr>
                                       </thead>
                                       <tbody>
                                    <?php

                                          $resultado = consultarInventario();
                                          echo $resultado;
                                          ?> 


                                       </tbody>
                               </table>
                            </div>
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
         <script src="js/validator.min.js"></script>
         <script>
        $( "#accion" )
          .change(function() {
            var str = "";
            $( "#accion option:selected" ).each(function() {
              str += $( this ).text() + " ";
            });
            
            console.log(str);
             if (str=="Agregar ") {
              console.log("a");
               $( "#proveedor" ).attr("style","display:show");
               $( "#costo" ).attr("style","display:show");
            }else if (str=="Eliminar "){
              console.log("e");
              $( "#proveedor" ).attr("style","display:none");
              $( "#costo" ).attr("style","display:none");

            }
          })
          .trigger( "change" );

         

        </script>
         
      </body>
</html>


