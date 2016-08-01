<?php

 


function agregarAtencion($mesa){

	//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}


	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

			
			$sql = "INSERT INTO atenciones (fk_estado, fk_mesa,descuento) VALUES (1,'$mesa',0)" or die ("Error 1 en: " . mysql_error());
			$result = mysql_query($sql);
			$idAtencion=mysql_insert_id();
		
			return $idAtencion;


}


function agregarAtencionProducto($idProducto,$idAtencion,$valor){


	//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 






	$fecha= date('Y-m-d H:i:s');
	$sql = "INSERT INTO aten_prod (hora_pedido, fk_producto,fk_atencion,valor,fk_estadoProd,descuento) 
	VALUES ('$fecha','$idProducto','$idAtencion','$valor',1,0)" ;

	$result = mysql_query($sql,$conect) or die ("Error Aten_prod id duplicate en: " . mysql_error());
	$idAtencionProducto=mysql_insert_id();

	
              			   
	return $idAtencionProducto;


}

function agregarEmpleadoAtencion($idEmpleado,$idAtencionProducto){

	//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}


	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	$sql = "INSERT INTO empl_atencion (fk_empleado, fk_aten_prod) VALUES ('$idEmpleado','$idAtencionProducto')";
	$result = mysql_query($sql) or die ("Error 2 en: " . mysql_error());
}




?>
