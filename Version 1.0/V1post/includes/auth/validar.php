<?php
			session_start(); 

			include '../db/serv.php';

				$clave = $_POST['clave'];
				$usuario = $_POST['establecimiento'];

				if (ereg("[^A-Za-z0-9]+",$_POST['clave'])) {
					$clave="error";
					
				}
				if (ereg("[^A-Za-z0-9]+",$_POST['establecimiento'])) {
					$clave="error";
					
				}
				

				$log = mysql_query("SELECT * FROM empleados WHERE admin=1 AND claveIngreso='$clave'");

				if (mysql_num_rows($log)>0 && $usuario=="cafe") {
					$row = mysql_fetch_array($log);
					$_SESSION["usuario_admin"] = $row['usuario']; 				  	
					echo'<script> window.location="../../perfil.php"; </script>';
				}
				else{					
					echo '<script> window.location="../../login.php?error=true"; </script>';
				}
		
		?>	

