<?php
        include "../model/database.php";
	if(!isset($_SESSION)){session_start();}
        try {
              $pdo = Database::connect();
              Database::disconnect();            
        } catch (Exception $e) {
               echo $e->getMessage();
        }
?>