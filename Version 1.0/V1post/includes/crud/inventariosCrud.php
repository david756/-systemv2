<?php

// process form
include '../db/serv.php';

if (isset($_POST['identificador'])) {
	$identificador=$_POST['identificador'];


if ($identificador=='inventario') {
	

	
		$producto=$_POST['productos'];
		$cantidad=$_POST['cantidad'];
		$costo=$_POST['costo'];
		$descripcion=$_POST['descripcion'];
		$accion=$_POST['accion'];
		$proveedor=$_POST['proveedor'];
		$empleado=$_POST['empleado'];

		if ($accion==2) {
		$costo=null;
		$proveedor=null;
		}

		

	$fecha= date('Y-m-d H:i:s');

		//Agregar el empleado a la base de datos , con la foranea del administrador que lo esta creando
		$sql = "INSERT INTO inventarios (fecha,cantidad,proveedor,costo,descripcion,fk_producto,fk_accion,fk_empleado) 
				VALUES ('$fecha','$cantidad','$proveedor','$costo','$descripcion','$producto','$accion','$empleado')";

		$result = mysql_query($sql) or die("Error 0 en: " . mysql_error()); 
	




	echo'<script> window.location="../../inventarios.php"; </script>';
}

}
else{

echo'<script> window.location="inventarios.php"; </script>';

}


?>
