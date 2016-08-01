<?php
	
		

		require("../db/serv.php");
        $consulta="SELECT * FROM aten_prod"; 
        $resultado=mysql_query($consulta,$conect); 

        
        while($rows=mysql_fetch_array($resultado)){ 

           if ($_POST['idAp']==$rows[0]) {

                $fecha= date('Y-m-d H:i:s');

                  if ($_POST['estado']==1) {
                    //si ya se esta preparando el pedido = e1
                    if ($rows[9]==2) {
                      $result="e1";
                    }
                    else if ($rows[9]==3) {
                      $result="e2";
                    }
                    else{
                    $query = 'UPDATE aten_prod SET fk_estadoProd=2,hora_preparacion="'.$fecha.' " WHERE id = '.$rows[0].' '; 
                    $result = mysql_query ($query) or die (mysql_error());
                     if ($result!=1) {
                      $result="-1";
                    }
                    break;
                    }
                  }

                  else if ($_POST['estado']==2) {
                    //si ya se despacho el pedido = e2
                    if ($rows[9]==3) {
                      $result="e2";
                    }
                    else
                    {
                    $query = 'UPDATE aten_prod SET fk_estadoProd=3,hora_despacho="'.$fecha.'"  WHERE id = '.$rows[0].' '; 
                    $result = mysql_query ($query) or die (mysql_error());
                    if ($result!=1) {
                      $result="-1";
                    }
                    break;
                    }
                  }  
                
            }

        }
        echo $result;

        


?>
