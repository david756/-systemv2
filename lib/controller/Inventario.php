<?php
/*
 * incluye el modelo mesa, con los metodos y acceso 
 * a la base de datos
 */
include "../model/Inventario.php";
include "../model/Producto.php";
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
    case "productos":
        verificarUser();
        productos();
        break;
    case "datosInventario":
        verificarUser();
        datosInventario();
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
$fecha= date('Y-m-d H:i:s');
$cantidad = $_POST["cantidad"];
$proveedor = $_POST["proveedor"];
$valor = $_POST["valor"];
$descripcion= $_POST["descripcion"];
$accion= $_POST["accion"];
$usuario = new Usuario();
$usuario= $usuario->getSesion();
$producto= new Producto($producto);
$producto=$producto->getProducto();


$inventario = new Inventario(null,$producto,$usuario,$fecha,$cantidad,$proveedor,$valor,$descripcion);
if ($accion==1) {
    $respuesta=$inventario->agregarInventario();
}
else{
    $respuesta=$inventario->bajarInventario();
}
if (is_object($respuesta)) {
    echo "Exito";
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
    $fecha1 = strtotime($fecha1);
    $fecha1 = date('Y-m-d',$fecha1);    
    $fecha2 = strtotime("$fecha2 + 1 days");
    $fecha2 = date('Y-m-d',$fecha2);
    
    $inventarioConsulta= new Inventario();
    $inventarioConsulta->setProducto($id);
    $inventarioConsulta->setFechaInicio($fecha1);
    $inventarioConsulta->setFechaFin($fecha2);
    $consulta=$inventarioConsulta->getListaInventario(); 
         
    $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
    
    foreach ($consulta as $inventario) {        
        $f = date_create($inventario['fecha']);        
        $fecha= date_format($f,'d')." de ".$meses[date_format($f,'n')-1].
                " del ".date_format($f,'Y'). " - ". date_format($f,'g:i a');

        if ($inventario['accion']=="Agregar"){
            $claseEstado="success";
            $accion="agregado";
        }
        else {
            $claseEstado="danger";
            $accion="eliminado";
        }
        echo '<tr>
                <td>'.$fecha.'</td>
                <td>'.$inventario['usuario'].'</td>
                <td>'.$inventario['cantidad'].'</td>
                <td><button type="button" class="btn btn-'.$claseEstado.' btn-xs">'.$accion.'</button></td>
                <td>'.$inventario['descripcion'].'</td>
                <td>'.$inventario['unidad'].'</td>
                <td>'.$inventario['total'].'</td>
                <td>'.$inventario['proveedor'].'</td>
              </tr>';
        } 
  
    }
    
    function datosInventario(){
        $data = array();
        $producto = $_POST["producto"];
        $inventario = new Inventario();     
        $producto= new Producto($producto);
        $producto=$producto->getProducto();        
        $inventario->setProducto($producto);
        
       
        $data['cantidad_ingresados'] =0+ $inventario->getDisponibles()['cantidad_ingresados'];
        $data['cantidad_vendidos'] = 0+$inventario->getCantidadVendidos();
        $data['cantidad_eliminados'] = 0+$inventario->getDisponibles()['cantidad_eliminados'];
        $data['disponibles'] =$data['cantidad_ingresados']-$data['cantidad_vendidos']-$data['cantidad_eliminados'] ;
        $data['valorPromedio'] = $inventario->getValorPromedio();
        $data['costoPromedio'] = $inventario->getCostoPromedio();
        $data['productoNombre'] = $producto->getNombre();
        
        echo json_encode($data);
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
     /**
    * retorna la lista de todos los productos en inventario
    * para mostrarlo en el select y ver el inventario
    */
    function productos(){
        $productoConsulta= new Producto();
        $consulta=$productoConsulta->getProductosInventario();  
        echo '<option value="">Seleccione un producto</option>';
        foreach ($consulta as $producto) {        
        echo '<option value="'.$producto["id"].'">'.$producto["nombre"].'</option>';
        } 
    }
  
?>