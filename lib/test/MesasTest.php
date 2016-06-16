<?php
include "../model/Mesa.php";

//creando una nueva mesa
$mesa1 = new Mesa(null,"mesa Prueba 1");
$mesa2 = new Mesa(null,"mesa Prueba 2");
echo("***Agregando mesas a la base de datos***<br>");
$id1=$mesa1->createMesa();
$id2=$mesa1->createMesa();
echo 'mesa prueba1 id: '.$id1.'<br>';
echo 'mesa prueba2 id: '.$id2.'<br>';
?>