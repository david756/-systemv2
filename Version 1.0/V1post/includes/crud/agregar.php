<?php





// process form
include '../db/serv.php';

$identificador=$_POST['identificador'];
if ($identificador=='administrador') {

	$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$genero=$_POST['genero'];
$telefono=$_POST['telefono'];

include '../validaciones/validaciones.php';

	$validacion = validarUsuario($usuario);

	if ($validacion==1) {
		echo'<script> window.location="../../templates/administradores.php?error=1"; </script>';

	}

	else {


$sql = "INSERT INTO empleados (nombre, apellido, usuario, clave,genero,telefono,admin) VALUES ('$nombre', '$apellido', '$usuario', '$clave','$genero','$telefono',1)";

$result = mysql_query($sql);
	//error=0 es que se agrego exitosamente
	echo'<script> window.location="../../templates/administradores.php?error=0"; </script>';
}
}


else if ($identificador=='empleado') {
	
		$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$genero=$_POST['genero'];
$telefono=$_POST['telefono'];
$identificador=$_POST['identificador'];


include '../validaciones/validaciones.php';

	$validacion = validarUsuario($usuario);

	if ($validacion==1) {
		echo'<script> window.location="../../templates/empleados.php?error=1"; </script>';

	}

	else {

		//Agregar el empleado a la base de datos , con la foranea del administrador que lo esta creando
		$sql = "INSERT INTO empleados (nombre, apellido, usuario, clave,genero,telefono,admin) VALUES ('$nombre', '$apellido', '$usuario', '$clave','$genero','$telefono',0)";
		$result = mysql_query($sql) or die("Error 0 en: " . mysql_error()); 
	

 
			$consultaid='SELECT id FROM empleados  where usuario="'.$usuario.'" ' ; 

			$id=mysql_query($consultaid,$conect) or die("Error 2 en: " . mysql_error()); 
			$rows=mysql_fetch_array($id);

			//identificador del usuario que se acaba de registrar.
			$id=$rows[0];

		


		// a continuacion se crea el perfil del empleado que se acaba de crear

			if(isset($_POST['privilegio'])) {
				

				$list =$_POST['privilegio'];

				for ($i=0; $i < count($list) ; $i++) { 
				echo $id;

					$sql = "INSERT INTO perfil_empleados(fk_perfil,fk_empleado) VALUES ($list[$i],'$id')";

					$result = mysql_query($sql) or die("Error 3 privilegio en: " . mysql_error()); 


				}

    	



			}

	echo'<script> window.location="../../templates/empleados.php?error=0"; </script>';
}
}


else if ($identificador=='categoria') {
	
	
		$nombre=$_POST['nombre'];

		//Agregar el empleado a la base de datos , con la foranea del administrador que lo esta creando
		$sql = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
		$result = mysql_query($sql) or die("Error 0 en: " . mysql_error()); 
	




		echo'<script> window.location="../../templates/categorias.php"; </script>';
}

else if ($identificador=='mesa') {
	
	
		$nombre=$_POST['nombre'];

		//Agregar el empleado a la base de datos , con la foranea del administrador que lo esta creando
		$sql = "INSERT INTO mesas (descripcion) VALUES ('$nombre')";
		$result = mysql_query($sql) or die("Error 0 en: " . mysql_error()); 
	




		echo'<script> window.location="../../templates/mesas.php"; </script>';
}



else if ($identificador=='producto') {
	
	
		$nombre=$_POST['nombre'];
		$descripcion=$_POST['descripcion'];
		$valor=$_POST['valor'];
		$categoria=$_POST['categoria'];
		$inventario=$_POST['inventario'];

		//Agregar el empleado a la base de datos , con la foranea del administrador que lo esta creando
		$sql = "INSERT INTO productos (nombre,valor,descripcion,fk_categoria,inventario) VALUES ('$nombre','$valor','$descripcion','$categoria','$inventario')";
		$result = mysql_query($sql) or die("Error 0 en: " . mysql_error()); 
	




		//echo'<script> window.location="../../templates/productos.php"; </script>';
}

?>
