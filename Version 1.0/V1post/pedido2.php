    <?php 
             include 'includes/class/atencion.php';
            session_start();
            include 'includes/auth/validarSesiones.php';
            mesero();
            include 'includes/dbconsultas/consulta.php';
            if (isset($_GET['mesa'])) {
               $idMesa=$_GET['mesa'];
            }
            else{
               echo'<script> window.location="pedido.php"; </script>';
            }

            $resultado=consultarMesas();
            while($rows=mysql_fetch_array($resultado)){ 

                if ($rows[0]==$idMesa) {
                       $mesa= $rows[1];             
                }

            }

            $resultado2=consultarAtencionPorMesa($idMesa);
            while($rows=mysql_fetch_array($resultado2)){ 
                    $idAtencion=$rows[1]; 
                    $estadoMesa="ocupado";                                
            }
            if (!isset($estadoMesa)) {
             $estadoMesa="Disponible";
            }

     ?>

<!DOCTYPE html>
<html>
<head>

<title>Pedidos</title>



   <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="http://js.pusherapp.com/1.9/pusher.min.js"></script>
   <script src="js/jquery.min.js"></script>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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


      <!-- inicio de las funciones  -->
      <script type="text/javascript">
      $(document).ready(function()
        {

        $(".categoria").click(function () {  
          $(this).animate({'opacity': 0.2});
          $(this).animate({'opacity': 1});

         });

        $(".categoria-anime").click(function () {  
          $(this).animate({'opacity': 0.4});
          $(this).animate({'opacity': 1});

         });

        
         });
      </script>


         <!-- Script para manejar la lista de productos -->
        <script type="text/javascript">
            
               function enableTxt(idCategoria) {
                    
                    
                    $(".categoria").hide();
                    $( "span[name="+idCategoria+"]" ).show();
                     $( "a[name="+idCategoria+"]" ).show();
                                
                     
                 

                }


              function agregarFila(dataArr){
                

                    idProducto=dataArr[0];
                  

                    tabla = document.getElementById("myTable");

                      for(var i = 1; tabla.rows[i]; i++){

                        if (tabla.rows[i].cells[0].innerHTML==idProducto) {

                            dataArr[1]=1+parseInt(tabla.rows[i].cells[1].innerHTML);
                            dataArr[4]=(1+parseInt(tabla.rows[i].cells[1].innerHTML))*parseInt(tabla.rows[i].cells[3].innerHTML)
                            deleteRow(idProducto);
                        }

                      }

                    var tr=document.createElement('tr');
                    var len=dataArr.length; 

                    for(var i=0;i<len;i++){
                        var td=document.createElement('th');


                        if (i==0) {

                         td.style.display="none";
                        }


                        td.appendChild(document.createTextNode(dataArr[i]));
                        tr.appendChild(td);

                    }

                    var btn = document.createElement("BUTTON");   
                    btn.className = "btn btn-default";

                    btn.setAttribute("onclick", 'eliminarProductoLista('+idProducto+')');
                    btn.id=idProducto;
                    
                    var t = document.createTextNode("Borrar");
                    btn.appendChild(t);                          
                    tr.appendChild(btn); 

                    
                    sumarTotales(dataArr);
                    document.getElementById('tbl_bdy').appendChild(tr);

                    
                    
                    return true;  

                    

                }


                 

                  function sumarTotales(dataArr){
                        var total =0;
                        tabla = document.getElementById("myTable");
                        var cuenta=dataArr[4];

                        for(var i = 1; tabla.rows[i]; i++){
                              cuenta =cuenta+parseInt(tabla.rows[i].cells[4].innerHTML);
                         }

                       total=cuenta;
                      var num = '$ ' + total.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                      var t = document.getElementById("total");
                      t.innerHTML=num;



                         for(var i = 1; tabla.rows[i]; i++){

                              total = total+parseInt(tabla.rows[i].cells[4].innerHTML);
                         }     

                              

                                            

                  }




              $(function(){

                $('form').submit(function(){


                      tabla = document.getElementById("myTable");
                      var mesa=<?php echo $idMesa; ?> ; 
                      var cadena={};
                      cadena["idMesa"]=mesa;
                      var hayProductos=0;

                        for(var j = 1; tabla.rows[j]; j++){
                                
                                hayProductos=1;
                                  
                                var clave=tabla.rows[j].cells[0].innerHTML;
                                var valor=tabla.rows[j].cells[1].innerHTML; 

                                 
                              
                                cadena[clave]= [valor,"hola"];

                          
                         }
                
                        if (hayProductos==0) {

                            location.href="";


                        }
                        else
                        {
                               $.ajax({
                                        type:  'POST',
                                        url:   'includes/json/productos.php',
                                        data:{cadena : cadena},
                                        
                                        beforeSend: function () {
                                          $('#resultado').show();
                                          $("#resultado").html("Procesando, espere por favor...");
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                          $('#resultado').attr("class","alert alert-danger");
                                          $('#resultado').show();
                                          $('#resultado').html('<p>ocurrio un error! por favor verifica que el pedido no haya sido registrado</p>');
                                        },
                                        success:  function (response,estado,objeto) {
                                           $("#resultado").html("<p>Se guardo con exito exito</p>");
                                           console.log(response);
                                           console.log(estado);
                                           console.log(objeto);
                                        },
                                         // código a ejecutar sin importar si la petición falló o no
                                        complete : function(xhr, status) {
                                            console.log("completo");
                                            location.href="pedido.php";
                                        }

                                });
                              
                               

                        }             





                    return false;

                });
            });





                function deleteRow(id) {


                   tabla = document.getElementById("myTable");
                   for(var i = 1; tabla.rows[i]; i++){

                        if (tabla.rows[i].cells[0].innerHTML==id) {

                            tabla.deleteRow(i); 
                        }

                      }
                }


                function eliminarProductoLista(id) {

                tabla = document.getElementById("myTable");
                   for(var i = 1; tabla.rows[i]; i++){

                        if (tabla.rows[i].cells[0].innerHTML==id && tabla.rows[i].cells[1].innerHTML>1) {
                          tabla.rows[i].cells[1].innerHTML=(tabla.rows[i].cells[1].innerHTML)-1;
                          tabla.rows[i].cells[4].innerHTML=(tabla.rows[i].cells[1].innerHTML)*(tabla.rows[i].cells[3].innerHTML);

                        }
                       else if (tabla.rows[i].cells[0].innerHTML==id && tabla.rows[i].cells[1].innerHTML==1) {

                            tabla.deleteRow(i); 
                        }

                      }

                  sumarTotales([0,0,0,0,0,0,0]);
                }



            </script> 

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

                  



           <!-- div que agrupa cuenta -->
           <hr><hr>

                 <div id="page-wrapper-center" class="row">
                         <div class="col-md-4">
                           <h3 class="title1">Nuevo Pedido : <?php echo( $mesa ) ; ?> </h3>
                         </div>
                        
                     <div class="col-md-3">
                           <h3 class="title2" >Estado :<strong> <?php echo( $estadoMesa ) ; ?></strong>
                          <label >  <?php if (isset($idAtencion)) {
                            echo '<a class="btn btn-defautl" href="detalleAtencion.php?idAtencion='.$idAtencion.'">ver detalle</a>';
                          } ?></h3>
                     </div>


                          <div class="col-md-3">
                            <h3 class="title2">Total: <label id="total">0</h3><br>
                          </div>

                           <div class="col-md-2">
                             <form action="" method="post">
                              <input type="submit" class="btn btn-default" value="Guardar" />
                                                       </form>
                           </div>


                  </div>
                  <div style="display: none" class="alert alert-info" id="resultado"></div>



                    <!-- div que agrupa categorias y productos-->
                   <div class="col-md-8 grids widget-shadow">



                            <!-- div que agrupa categorias -->
                                   <div class="grid_3 grid_5 widget-shadow">
                                      <h3 class="hdg" >Seleccione Categoria</h3>
                                      <h1>
                                        <?php
                                              $resultado = consultarCategorias();
                                              while($rows=mysql_fetch_array($resultado)){ 
                                                      echo'
                                                       <a ><span class="label label-primary categoria-anime"
                                                       onclick="enableTxt('.$rows[0].')" >'.$rows[1].'</span></a>
                                                      ';

                                              } 
                                         ?> 
                                    </h1>
                              </div>




                             <!-- div que agrupa productos -->

                                    <div class="grid_3 grid_5 widget-shadow">

                                    <h2 id="productos">Productos </h2><br>
                                     
                                        <h1>
                                          <?php
                                          $resultado = consultarProductos();
                                          while($rows=mysql_fetch_array($resultado)){ 
                                             echo  '  <script type="text/javascript">
                                                  var numero'.$rows[0].' = '.$rows[0].'; 
                                                  var cantidad'.$rows[0].' = 1 ;
                                                  var producto'.$rows[0].' = "'.$rows[1].'";
                                                  var valor'.$rows[0].'= '.$rows[2].';
                                                  var total'.$rows[0].' = cantidad'.$rows[0].'*valor'.$rows[0].' ;                                          
                                                 </script>

                                          <a>   
                                          <span class="label label-primary  categoria " style="display:none" name="'.$rows[5].'"
                                          onclick="agregarFila([numero'.$rows[0].',cantidad'.$rows[0].',producto'.$rows[0].',valor'.$rows[0].',total'.$rows[0].'])">
                                          <!--  <img src="images/comida.png"> --><span class="glyphicon glyphicon-glass"></span> '.$rows[1].'
                                           </span>
                                           </a>
                                          ';
                                          }
                                           ?>     
                                       </h1>
                                  </div>            
                    </div>





                     <!-- div que agrupa listado -->
                    <div class="col-md-4 grids widget-shadow">
                       
                    <h3 class="hdg" >Listado</h3>
                            <table class="table table-bordered"  id="myTable">
                                <thead>
                                    <tr>
                                     <th style="display:none">Cod</th>
                                     <th>Cant</th>
                                     <th>Producto</th>                  
                                     <th>Precio</th>             
                                     <th>total</th>
                                     <th>accion</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_bdy"> </tbody>
                            </table>
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
