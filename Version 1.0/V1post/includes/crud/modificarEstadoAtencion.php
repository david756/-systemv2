<?php
	
		

		require("../db/serv.php");
        $consulta="SELECT * FROM aten_prod"; 
        $resultado=mysql_query($consulta,$conect); 

        
        while($rows=mysql_fetch_array($resultado)){ 

           if (isset($_GET[$rows[0]])) {

            
                  if ($_GET[$rows[0]]==1) {
                    $query = 'UPDATE aten_prod SET fk_estadoProd = 2 WHERE id = '.$rows[0].' '; 
                    $result = mysql_query ($query)
                    or die ("Falló Consulta"); 
                  }

                  else if ($_GET[$rows[0]]==2) {
                    $query = 'UPDATE aten_prod SET fk_estadoProd = 3 WHERE id = '.$rows[0].' '; 
                    $result = mysql_query ($query)
                    or die ("Falló Consulta"); 
                  
                 
                  }  

            }

        }


echo '<script> window.location="../../pago.php"; </script>';



?>
