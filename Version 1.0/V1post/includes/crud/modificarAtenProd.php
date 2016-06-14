<?php
	
		

		require("../db/serv.php");


        if (isset($_POST['accionEliminar'])) {

          $atencion=$_POST['idAtencion'];
          $atencionProd=$_POST['accionEliminar'];

            $sql = "DELETE FROM `aten_prod` WHERE `aten_prod`.`id` = '$atencionProd'";
           $result = mysql_query($sql) or die("ocurrio un error");

        }


        else if (isset($_POST['accionModificar'])) {

           $atencionProd=$_POST['accionModificar'];
           $valor=$_POST['valor'];
           $atencion=$_POST['idAtencion'];


          $sql = "UPDATE `aten_prod` SET `descuento` = '$valor' WHERE `aten_prod`.`id` = '$atencionProd'";



           $result = mysql_query($sql) or die ("Error 1 en: " . mysql_error());



        }


      echo '<script> window.location="../../detalleAtencion.php?idAtencion='.$atencion.'"</script>';



?>
