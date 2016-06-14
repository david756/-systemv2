<?php

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	$conect = @mysql_connect("localhost","root","") or die("No se encontró el servidor");
	mysql_select_db("cafe_superior",$conect)or die("No se encontró la base de datos");
?>