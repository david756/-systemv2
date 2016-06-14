<?php




function validarUsuario($usuario){

include '../dbconsultas/consulta.php';

$resultado = consultarEmpleados();
$resultado2 = consultarAdministradores();

$validacion=0;

while($rows=mysql_fetch_array($resultado)){ 
	if ($rows[5]==$usuario) {
		$validacion=1;
		break;
	}
}
while($rows=mysql_fetch_array($resultado2)){ 

	if ($validacion==1) {
		break;
	}
	if ($rows[5]==$usuario) {
		$validacion=1;
		break;
	}
}
//si ya existe retorna 1, de lo contrario retorna 0
return $validacion;


}




?>