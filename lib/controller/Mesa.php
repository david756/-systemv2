<?php
include "../model/Mesa.php";

if (isset($_POST["metodo"])) {
    $metodo=$_POST["metodo"];
}
 else {
    die ('301:Error, no existe dirección');
}

if ($metodo="create") {
    crear();
}
elseif ($metodo="update") {
    actualizar();
}
elseif ($metodo="delete") {
    eliminar();
}
elseif ($metodo="get_mesas_estado") {
    get_mesas_estado();
}
else{
    die ('302:Error, no se encontro dirección');
}

function crear(){
$nombre = $_POST["nombre_mesa"];
$mesa = new Mesa(null,$nombre);
$respuesta = $mesa->createMesa();

if (is_object($respuesta)) {
    echo "exito";
} else {
    echo "$respuesta";
}
}

function actualizar(){
$id=$_POST["id_mesa"];
$nombre = $_POST["nombre_mesa"];
$mesa = new Mesa($id,$nombre);
$respuesta = $mesa->updateMesa();

if (is_object($respuesta)) {
    echo "El usuario se ha actualizado con exito";
} else {
    echo $respuesta;
}
}

function eliminar(){
$id=$_POST["id_mesa"];
$mesa = new Mesa($id);
$respuesta = $mesa->deleteMesa();
if (is_object($respuesta)) {
   echo "El usuario se ha actualizado con exito";
} else {
    echo $respuesta;
}
}
function get_mesas_estado(){
    
}
?>