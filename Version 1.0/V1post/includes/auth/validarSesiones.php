<?php


function login (){


if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if(isset($_SESSION['usuario_admin'])){

		echo '<script> window.location="perfil.php; </script>';

	}


	if(isset($_SESSION['usuario_administrador_login'])){

    echo '<script> window.location="menu.php"; </script>';

 	 }
 	 if(isset($_SESSION['usuario_empleado_login'])){

    	echo '<script> window.location="menu.php"; </script>';

 	 }



}


function perfil (){

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if(!isset($_SESSION['usuario_admin'])){

		echo '<script> window.location="login.php"; </script>';

	}

	if(isset($_SESSION['usuario_administrador_login'])){

    echo '<script> window.location="menu.php"; </script>';

 	 }
 	 if(isset($_SESSION['usuario_empleado_login'])){

    	echo '<script> window.location="menu.php"; </script>';

 	 }
}
    


function cocina(){

	include'includes/db/serv.php';

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if(!isset($_SESSION['usuario_admin'])){

		echo '<script> window.location="login.php"; </script>';

	}

	if  ( ( isset($_SESSION['usuario_empleado_login']) ) ) {

		$id_empleado=$_SESSION['id_empleado_login'];

    	$consulta='SELECT * FROM   perfil_empleados  where (fk_empleado="'.$id_empleado.'" and fk_perfil=3)' ; 

		$resultado=mysql_query($consulta,$conect) or die ("Error 1 en: " . mysql_error());
		
		$rows=mysql_fetch_array($resultado);


		if (is_null($rows[0])) {
			
			echo '<script> window.location="perfil.php"; </script>';
			
		}

 	 }




if  (  (!isset($_SESSION['usuario_administrador_login'])) && ( !isset($_SESSION['usuario_empleado_login']) ) ) {

    echo '<script> window.location="perfil.php"; </script>';

 	 }

		


}

function inventarios(){

	include'includes/db/serv.php';

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if(!isset($_SESSION['usuario_admin'])){

		echo '<script> window.location="login.php"; </script>';

	}

	if  ( ( isset($_SESSION['usuario_empleado_login']) ) ) {

		$id_empleado=$_SESSION['id_empleado_login'];

    	$consulta='SELECT * FROM   perfil_empleados  where (fk_empleado="'.$id_empleado.'" and fk_perfil=4)' ; 

		$resultado=mysql_query($consulta,$conect) or die ("Error 1 en: " . mysql_error());
		
		$rows=mysql_fetch_array($resultado);


		if (is_null($rows[0])) {
			
			echo '<script> window.location="perfil.php"; </script>';
			
		}

 	 }




if  (  (!isset($_SESSION['usuario_administrador_login'])) && ( !isset($_SESSION['usuario_empleado_login']) ) ) {

    echo '<script> window.location="perfil.php"; </script>';

 	 }

		


}

function mesero(){

	include'includes/db/serv.php';

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if(!isset($_SESSION['usuario_admin'])){

		echo '<script> window.location="login.php"; </script>';

	}

	if  ( ( isset($_SESSION['usuario_empleado_login']) ) ) {

		$id_empleado=$_SESSION['id_empleado_login'];

    	$consulta='SELECT * FROM   perfil_empleados  where (fk_empleado="'.$id_empleado.'" and fk_perfil=2)' ; 

		$resultado=mysql_query($consulta,$conect) or die ("Error 1 en: " . mysql_error());

		
		
		$rows=mysql_fetch_array($resultado);


		if (is_null($rows[0])) {
			
			echo '<script> window.location="menu.php"; </script>';
			
		}

 	 }




if  (  (!isset($_SESSION['usuario_administrador_login'])) && ( !isset($_SESSION['usuario_empleado_login']) ) ) {

    echo '<script> window.location="perfil.php"; </script>';

 	 }

		


}

function caja(){

	include'includes/db/serv.php';

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if(!isset($_SESSION['usuario_admin'])){

		echo '<script> window.location="login.php"; </script>';

	}

	if  ( ( isset($_SESSION['usuario_empleado_login']) ) ) {

		$id_empleado=$_SESSION['id_empleado_login'];

    	$consulta='SELECT * FROM   perfil_empleados  where (fk_empleado="'.$id_empleado.'" and fk_perfil=1)' ; 

		$resultado=mysql_query($consulta,$conect) or die ("Error 1 en: " . mysql_error());

		
		
		$rows=mysql_fetch_array($resultado);


		if (is_null($rows[0])) {
			
			echo '<script> window.location="perfil.php"; </script>';
			
		}

 	 }




if  (  (!isset($_SESSION['usuario_administrador_login'])) && ( !isset($_SESSION['usuario_empleado_login']) ) ) {

    echo '<script> window.location="perfil.php"; </script>';

 	 }

		


}



function menu (){

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if(!isset($_SESSION['usuario_admin'])){

		echo '<script> window.location="login.php"; </script>';

	}

	if  (    (!isset($_SESSION['usuario_administrador_login'])) && ( !isset($_SESSION['usuario_empleado_login']) ) ) {

    echo '<script> window.location="perfil.php"; </script>';

 	 }
 	
}

function ingresos (){

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if(!isset($_SESSION['usuario_admin'])){

		echo '<script> window.location="login.php"; </script>';

	}

	if  (    (!isset($_SESSION['usuario_administrador_login'])) && ( !isset($_SESSION['usuario_empleado_login']) ) ) {

    echo '<script> window.location="perfil.php"; </script>';

 	 }


    if (isset($_SESSION['id_administrador_login'])) {
        echo '<script> window.location="menu.php"; </script>';

    }

 	
}


function pedido (){

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if(!isset($_SESSION['usuario_admin'])){

		echo '<script> window.location="login.php"; </script>';

	}

	if  (    (!isset($_SESSION['usuario_administrador_login'])) && ( !isset($_SESSION['usuario_empleado_login']) ) ) {

    echo '<script> window.location="perfil.php"; </script>';

 	 }
 	

}

function administracion(){

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if(!isset($_SESSION['usuario_admin'])){

		echo '<script> window.location="../login.php"; </script>';

	}
	if(!isset($_SESSION['usuario_administrador_login'])){


		echo '<script> window.location="../perfil.php"; </script>';

	}

	if(isset($_SESSION['usuario_empleado_login'])){

    echo '<script> window.location="../menu.php"; </script>';

 	 }
 	elseif(isset($_SESSION['usuario_administrador_login'])){

 		
 	 }

	else{

	echo '<script> window.location="../perfil.php"; </script>';
	}

}


?>