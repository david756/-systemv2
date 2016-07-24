<?php
/*
 * incluye el modelo mesa, con los metodos y acceso 
 * a la base de datos
 */
include "../model/Inventario.php";
include "../model/Usuario.php";
/**
 * recibe por POST el metodo segun
 * el proceso que valla a realizar
 */
if (isset($_POST["metodo"])) {
    $metodo=$_POST["metodo"];
}
//si no recibe metodo
 else {
    die ('301:Error, no existe dirección');
}

/**
 * Direcciona al metodo que se recibe
 */
switch ($metodo) {
    case "create":
        verificarUser();
        crear();
        break;
    case "listaInventario":
        verificarUser();
        listaInventario();
        break;
    default:
        die ('302:Error, no se encontro dirección');
}
   
/**
 * Crear un nuevo inventario
 * @param Post nombreMesa recibe nombre de la mesa que 
 * va a crear
 */
function crear(){
$producto = $_POST["producto"];
$usuario = $_POST["usuario"];
$fecha = $_POST["fecha"];
$cantidad = $_POST["cantidad"];
$proveedor = $_POST["proveedor"];
$valor = $_POST["valor"];
$descripcion= $_POST["descripcion"];
$accion= $_POST["accion"];


$inventario = new Inventario(null,$producto,$usuario,$fecha,$cantidad,$proveedor,$valor,$descripcion);
if ($accion==1) {
    $respuesta=$inventario->agregarInventario();
}
else{
    $respuesta=$inventario->bajarInventario();
}
if (is_object($respuesta)) {
    echo "exito";
} else {
    echo "$respuesta";
}
}
/**
 * Lista de  inventarios
 * @Return lista de inventario de un producto
 * formato HTML tabla
 */
function listaInventario(){  
    
    $id = $_POST["id"];
    $fecha1=$_POST["fecha1"];
    $fecha2=$_POST["fecha2"];    
    $inventarioConsulta= new Inventario();
    $inventarioConsulta->setProducto($id);
    $inventarioConsulta->setFechaInicio($fecha1);
    $inventarioConsulta->setFechaFin($fecha2);
    $consulta=$inventarioConsulta->getListaInventario();     
    foreach ($consulta as $inventario) {
        if ($inventario['accion']=="Agregar"){
            $claseEstado="success";
            $accion="agregado";
        }
        else {
            $claseEstado="danger";
            $accion="eliminado";
        }
        echo '<tr>
                <td>'.$inventario['fecha'].'</td>
                <td>'.$inventario['usuario'].'</td>
                <td>'.$inventario['cantidad'].'</td>
                <td><button type="button" class="btn btn-'.$claseEstado.' btn-xs">'.$accion.'</button></td>
                <td>'.$inventario['descripcion'].'</td>
                <td>'.$inventario['unidad'].'</td>
                <td>'.$inventario['total'].'</td>
                <td>'.$inventario['proveedor'].'</td>
              </tr>';
        } 
        
    $consulta=$inventarioConsulta->getListaItemsVendidos();     
    foreach ($consulta as $inventario) {
        echo '<tr>
                <td>'.$inventario['fecha'].'</td>
                <td>'.$inventario['usuario'].'</td>
                <td>1</td>
                <td><button type="button" class="btn btn-info btn-xs">Vendido</button></td>
                <td>'.$inventario['descripcion'].'</td>
                <td>'.$inventario['unidad'].'</td>
                <td>'.$inventario['total'].'</td>
                <td></td>
              </tr>';
        } 
        
        
    }
    
    /**
    * confirma que exista la sesion de usuario y que sea empleado
    * para poder realizar cambios propios de este privilegio
    */
    function verificarUser(){
        
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        if (!is_object($usuario)) {
            die ('Por favor inicie sesion para continuar');
        }
    }
    
  
?>