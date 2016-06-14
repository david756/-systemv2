<?php
	session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
<head>
	<title>Validando...</title>
	<meta charset="utf-8">
</head>
</head>
<body>

		<?php
			include '../db/serv.php';

		
				$id_perfil=$_POST['radio_01'];


				$id_empleado = null;
				$id_administrador=null;
				$clave = $_POST['clave'];

				if (ereg("[^A-Za-z0-9]+",$_POST['clave'])) {
					$clave="error";
					
				}



				if (isset($_POST['empleado'])) {
					$id_empleado=$_POST['empleado'];
				}
				if (isset($_POST['administrador'])) {
					$id_administrador=$_POST['administrador'];
				}
				
				
	

				if ($id_perfil=='Administrador') {
					
						if (!is_null($id_administrador)) {
					


											$log = mysql_query("SELECT * FROM empleados WHERE id='$id_administrador' AND clave='$clave' AND admin=1");

								

											if (mysql_num_rows($log)>0) {
												$row = mysql_fetch_array($log);

												$_SESSION["usuario_administrador_login"] = $row['usuario']; 
												$_SESSION["id_administrador_login"] = $row['id'];
											  	echo 'Iniciando sesión para '.$_SESSION['usuario_administrador_login'].' <p>';

												if (isset($_POST['pedido'])) {
											  		echo'<script> window.location="../../pedido.php"; </script>';
											  	}
											  	else{
											  		echo'<script> window.location="../../menu.php"; </script>';
											  	}

											}
											else{
												
												
												echo '<script> window.location="../../perfil.php?error=true"; </script>';
											}

						}

						else{

							echo '<script> window.location="../../perfil.php?error=true"; </script>';
						}



				}
				else if ($id_perfil=='Empleado') {
					
						if (!is_null($id_empleado)) {
							


											$log = mysql_query("SELECT * FROM empleados WHERE id='$id_empleado' AND clave='$clave'");

								

											if (mysql_num_rows($log)>0) {
												$row = mysql_fetch_array($log);

												$_SESSION["usuario_empleado_login"] = $row['usuario'];
												$_SESSION["id_empleado_login"] = $row['id']; 


											  	echo 'Iniciando sesión para '.$_SESSION['usuario_empleado_login'].' <p>';


											  	if (isset($_POST['pedido'])) {
											  		echo'<script> window.location="../../pedido.php"; </script>';
											  	}
											  	else{
											  		echo'<script> window.location="../../menu.php"; </script>';
											  	}

												
											}
											else{
												
												echo '<script> window.location="../../perfil.php?error=true"; </script>';
											}

						}	
						else{

							echo '<script> window.location="../../perfil.php?error=true"; </script>';
						}

				}
				else{
						echo '<script> window.location="../../perfil.php?error=true"; </script>';
							
						}





		?>	
</body>
</html>