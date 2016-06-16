<?php
        include "../model/database.php";
	$pdo = Database::connect();
        $query = "select * from productos";
        $result = $pdo->prepare($query);
        $result->execute();
        Database::disconnect();
        //$result = $result->fetch(PDO::FETCH_ASSOC);
        //while( $datos = $result->fetch())
        // echo $datos[1] . '<br/>';
        
        $resultado = $result->fetchAll();
        
        foreach ($resultado as $titleData) {
            echo $titleData[0];
            echo $titleData[1];            
         }
?>