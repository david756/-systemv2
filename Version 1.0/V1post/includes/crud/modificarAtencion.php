<?php
	
		

		require("../db/serv.php");

        if (isset($_POST['accionEliminar'])) {

          $atencion=$_POST['idAtencion'];
          $atencionProd=$_POST['accionEliminar'];

           $sql = "DELETE FROM `aten_prod` WHERE `aten_prod`.`fk_atencion` = '$atencion'";
           $result = mysql_query($sql) or die("ocurrio un error");

          $sql = "DELETE FROM `atenciones` WHERE `atenciones`.`id` = '$atencion'";
          $result = mysql_query($sql) or die("ocurrio un error");
          echo '<script> window.location="../../caja.php"</script>';

        }


        else if (isset($_POST['accionModificar'])) {

           $id=$_POST['id'];
           $descuento=$_POST['descuento'];
           $mesa=$_POST['mesa'];
           $estado=$_POST['estado'];

           if ( $mesa!= "igual") {
              $consultaMesa=",fk_mesa='$mesa'";
           }
           else{
              $consultaMesa="";
           }
           if ( $estado!= "igual") {
             $consultaEstado=",fk_estado='$estado'";  
           }
           else{
              $consultaEstado="";
           }


             $sql = "UPDATE atenciones SET descuento='$descuento' $consultaMesa $consultaEstado
             WHERE atenciones.id = '$id'";

            
           $result = mysql_query($sql) or die ("Error 1 en: " . mysql_error());

            echo '<script> window.location="../../detalleAtencion.php?idAtencion='.$id.'"</script>';

        }





?>
