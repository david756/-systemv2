<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


if (isset($_SESSION["usuario_administrador_login"])) {
	 unset($_SESSION["usuario_administrador_login"]);
	 unset($_SESSION["id_administrador_login"]);
	
}
elseif (isset($_SESSION["usuario_empleado_login"])) {
	unset($_SESSION["usuario_empleado_login"]);
	unset($_SESSION["id_empleado_login"]);

}




echo 'Cerraste sesión';
echo '<script> window.location="../../perfil.php"; </script>';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Saliendo...</title>
	<meta charset="utf-8">
</head>
<body>
<h1>SALIENDO</h1>
</body>
</html>