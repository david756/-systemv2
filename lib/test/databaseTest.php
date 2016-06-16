<?php
        include "../model/database.php";
	
        try {
              $pdo = Database::connect();
              Database::disconnect();            
        } catch (Exception $e) {
               echo $e->getMessage();
        }
?>