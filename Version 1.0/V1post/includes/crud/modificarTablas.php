<?php





// process form
include '../db/serv.php';

$identificador=$_POST['identificador'];



if ($identificador=='administrador') {
	$id=$_POST['id'];
	$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$clave=$_POST['clave'];
$genero=$_POST['genero'];
$telefono=$_POST['telefono'];


$sql = "UPDATE empleados SET nombre='$nombre', apellido='$apellido', clave='$clave',genero='$genero',telefono='$telefono',admin=1
 WHERE empleados.id = '$id'";

$result = mysql_query($sql);
	//error=0 es que se agrego exitosamente
	echo'<script> window.location="../../templates/administradores.php?error=0"; </script>';
}


else if ($identificador=='empleado') {


		$id=$_POST['id'];
		$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$clave=$_POST['clave'];
$genero=$_POST['genero'];
$telefono=$_POST['telefono'];





		//Agregar el empleado a la base de datos , con la foranea del administrador que lo esta creando
		$sql = "UPDATE empleados SET nombre='$nombre', apellido='$apellido', clave='$clave',genero='$genero',telefono='$telefono',admin=0
		 WHERE empleados.id = '$id'";

		$result = mysql_query($sql) or die("Error 0 en: " . mysql_error()); 
 		

		// a continuacion se crea el perfil del empleado que se acaba de crear
		$sql = "DELETE FROM perfil_empleados WHERE  fk_empleado ='$id' ";
		$result = mysql_query($sql) or die("Error 3 en: " . mysql_error()); 

			if(isset($_POST['privilegio'])) {
					
					


				$list =$_POST['privilegio'];

				for ($i=0; $i < count($list) ; $i++) { 
			


					$sql = "INSERT INTO perfil_empleados(fk_perfil,fk_empleado) VALUES ($list[$i],'$id')";

					$result = mysql_query($sql) or die("Error 3 en: " . mysql_error()); 


				}

    	



			}

	echo'<script> window.location="../../templates/empleados.php?error=0"; </script>';
}



else if ($identificador=='categoria') {
	
	
		$nombre=$_POST['nombre'];
		$id=$_POST['id'];

		$sql = "UPDATE categorias SET nombre='$nombre' WHERE categorias.id = '$id' ";
		$result = mysql_query($sql) or die("Error 0 en: " . mysql_error()); 

	




		echo'<script> window.location="../../templates/categorias.php"; </script>';
}

else if ($identificador=='mesa') {
	
	
		$nombre=$_POST['nombre'];
		$id=$_POST['id'];

		//Agregar el empleado a la base de datos , con la foranea del administrador que lo esta creando
		$sql = "UPDATE mesas SET descripcion='$nombre' WHERE mesas.id = '$id' ";
		$result = mysql_query($sql) or die("Error 0 en: " . mysql_error()); 

	




		echo'<script> window.location="../../templates/mesas.php"; </script>';
}



else if ($identificador=='producto') {
	
	
		$nombre=$_POST['nombre'];
		$id=$_POST['id'];
		$descripcion=$_POST['descripcion'];
		$valor=$_POST['valor'];
		$categoria=$_POST['categoria'];
		$inventario=$_POST['inventario'];

		//Agregar el empleado a la base de datos , con la foranea del administrador que lo esta creando
		$sql = "UPDATE productos SET nombre='$nombre',descripcion='$descripcion',valor='$valor',fk_categoria='$categoria',inventario='$inventario' WHERE productos.id = '$id' ";
		$result = mysql_query($sql) or die("Error 0 en: " . mysql_error()); 


	echo'<script> window.location="../../templates/productos.php"; </script>';
}

?>
