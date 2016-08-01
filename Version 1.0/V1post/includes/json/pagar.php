

	<?php 

        if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

        require("../db/serv.php");

        if (isset($_POST['atencion']) and isset($_POST['accion'])) {
           
            $atencion=$_POST['atencion'];
            $accion=$_POST['accion'];
            $descripcion=$_POST['descripcion'];


                if (isset($_SESSION["id_administrador_login"])) {
                     $cajero=$_SESSION["id_administrador_login"];
                    
                }
                elseif (isset($_SESSION["id_empleado_login"])) {
                     $cajero=$_SESSION["id_empleado_login"];
                }

        }

        else {
       
            echo'<script> window.location="../../caja.php"; </script>';
        }


          //consulta si la cuenta ya fue pagada


           $query = 'SELECT ea.id              

              FROM estados_atencion  AS ea INNER JOIN atenciones AS a ON (ea.id=a.fk_estado)
              
              WHERE(a.id='.$atencion.')';


              $consulta = mysql_query($query, $conect) or die ("Error 1 en: " . mysql_error());

              $estado=1;
              $actualizar=0;

                 while($rows=mysql_fetch_array($consulta)){ 
                     

                    $estado=$rows[0];
                    

                }

              if ($estado!=1) {
                

                 if ($estado!=4) {
                
                echo '<h2> Error: la cuenta ya fue facturada anteriormente </h2>';
                echo  '<a href="../../pago.php"><button> Volver </button></a>';
                }
                else{
                    $actualizar=1;

                }


              }

              else{

                $actualizar=1;
              }
              


$horaPago=date('Y-m-d H:i:s');

if ($actualizar==1) {
  


        if ($accion=='pagar') {

                  
                          $query = 'UPDATE atenciones SET fk_estado=2,horaPago="'.$horaPago.'" WHERE id ='.$atencion.' ';
                          $result = mysql_query ($query)
                        or die ("Error 1 en: " . mysql_error());


                         $query = 'UPDATE atenciones SET descripcion_estado="'.$descripcion.'" WHERE id ='.$atencion.' ';
                          $result = mysql_query ($query)
                        or die ("Error 2 en: " . mysql_error());

                        $query = 'UPDATE atenciones SET fk_cajero='.$cajero.' WHERE id ='.$atencion.' ';
                          $result = mysql_query ($query)
                        or die ("Error 3 en: " . mysql_error());


                    echo '<script> window.location="../../pago.php"; </script>';


        }
        elseif ($accion=='aplazar') {
           $query = 'UPDATE atenciones SET fk_estado=4 WHERE id ='.$atencion.' ';
                          $result = mysql_query ($query)
                        or die ("Error 4 en: " . mysql_error());


                         $query = 'UPDATE atenciones SET descripcion_estado="'.$descripcion.'",horaPago="'.$horaPago.'" WHERE id ='.$atencion.' ';
                          $result = mysql_query ($query)
                        or die ("Error 5 en: " . mysql_error());

                        $query = 'UPDATE atenciones SET fk_cajero='.$cajero.' WHERE id ='.$atencion.' ';
                          $result = mysql_query ($query)
                        or die ("Error 6 en: " . mysql_error());


                    echo '<script> window.location="../../pago.php"; </script>';

        }
         elseif ($accion=='cortesia') {
           $query = 'UPDATE atenciones SET fk_estado=3 WHERE id ='.$atencion.' ';
                          $result = mysql_query ($query)
                        or die ("Error 7 en: " . mysql_error());


                         $query = 'UPDATE atenciones SET descripcion_estado="'.$descripcion.'" ,horaPago="'.$horaPago.'"WHERE id ='.$atencion.' ';
                          $result = mysql_query ($query)
                        or die ("Error 8 en: " . mysql_error());

                        $query = 'UPDATE atenciones SET fk_cajero='.$cajero.' WHERE id ='.$atencion.' ';
                          $result = mysql_query ($query)
                        or die ("Error 9 en: " . mysql_error());


                    echo '<script> window.location="../../pago.php"; </script>';

        }
         elseif ($accion=='descuento') {
          
          
                         $query = 'UPDATE atenciones SET descuento ="'.$descripcion.'" WHERE id ='.$atencion.' ';
                          $result = mysql_query ($query)
                        or die ("Error 10 en: " . mysql_error());

                       

                    echo '<script> window.location="../../pago.php?atencion='.$atencion.'"; </script>';



        }

}








    ?>